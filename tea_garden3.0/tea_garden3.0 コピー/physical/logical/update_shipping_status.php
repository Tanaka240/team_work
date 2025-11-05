<?php
  session_start();
  header('Content-Type: application/json');

  // データベースの情報を取得
  require_once '../db_config.php' ;

  // teaGarden_productDetailScreen.phpから送信された値を格納
  $input = file_get_contents('php://input');
  $data = json_decode($input, true);

  // 必要データの確認
  if(!isset($_SESSION['user_id']) || !isset($data['item_id']) || !isset($data['quantity']) || !isset($data['price'])){
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => '注文に必要な情報が不足しています。']);
    exit ;
  }

  $user_id = $_SESSION['user_id'];
  $item_id = (int)$data['item_id'];
  $order_time = date('Y-m-d H:i:s');
  $quantity = (int)$data['quantity'];
  $price = (int)$data['price'];
  $sum_price = $price * $quantity ;

  try{
    // データベースに接続
    $connect = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8' ;
    $pdo = new PDO($connect, DB_USER, DB_PASSWORD);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 追加処理
    $sql_insert = $pdo -> prepare('insert into order_history(user_id, item_id, order_time, number_of_item, sum_price) values(?, ?, ?, ?, ?)');
    $sql_insert -> bindValue(1,$user_id,PDO::PARAM_INT);
    $sql_insert -> bindValue(2,$item_id,PDO::PARAM_INT);
    $sql_insert -> bindValue(3,$order_time,PDO::PARAM_STR);
    $sql_insert -> bindValue(4,$quantity,PDO::PARAM_INT);
    $sql_insert -> bindValue(5,$sum_price,PDO::PARAM_INT);
    $sql_insert -> execute();

    echo json_encode(['status' => 'success', 'message' => 'ご注文が完了しました。']);
  }
  catch(PDOException $e){
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'データベースエラー:ご注文が失敗しました。' . $e->getMessage()]);
  }
?>