<?php
  session_start();

  // データベースの情報を取得
  require_once '../db_config.php' ;

  try{
    // データベースに接続
    $connect = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8' ;
    $pdo = new PDO($connect, DB_USER, DB_PASSWORD);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_search = $pdo -> query('select oh.order_id, oh.user_id, oh.order_time, oh.number_of_item, oh.sum_price, oh.delivery_status, i.item_name from order_history as oh inner join items as i on oh.item_id = i.item_id order by oh.order_time desc');
    $order_history = $sql_search -> fetchAll(PDO::FETCH_ASSOC);

    if(isset($order_history)){
      // テーブルに商品情報有
      $_SESSION['order_history'] = $order_history ;
      header('Location: ./view/admin_orderhistoryScreen.php');
      exit();
    }
  }
  catch(PDOException $e){
    header('Location: ./view/admin_topScreen.php');
    exit();
  }
?>