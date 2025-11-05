<?php
  session_start();

  // データベースの情報を取得
  require_once '../db_config.php' ;

  // セッションに保存されてあるuser情報を格納
  (int)$user_id = $_SESSION['user_id'];

  try{
    // データベースに接続
    $connect = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8' ;
    $pdo = new PDO($connect, DB_USER, DB_PASSWORD);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_search = $pdo -> prepare(
      'select oh.order_id, oh.user_id, oh.order_time, oh.number_of_item, oh.sum_price, oh.delivery_status, i.item_name from order_history as oh inner join items as i on oh.item_id = i.item_id where oh.user_id = ? order by oh.order_time desc'
    );
    $sql_search -> bindValue(1,$user_id,PDO::PARAM_INT);
    $sql_search -> execute();
    $myOrderhistory = $sql_search -> fetchAll(PDO::FETCH_ASSOC);

    if(!empty($myOrderhistory)){
      // テーブルに注文履歴有
      $_SESSION['myOrderhistory'] = $myOrderhistory ;
      header('Location: ./view/teaGarden_myOrderhistoryScreen.php');
      exit();
    }
    else{
      header('Location: ./view/teaGarden_myOrderhistoryScreen.php');
      exit();
    }
  }
  catch(PDOException $e){
    header('Location: ./showUser_items.php');
    exit();
  }
?>