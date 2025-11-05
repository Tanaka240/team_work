<?php
  session_start();

  // データベースの情報を取得
  require_once '../db_config.php' ;

  // teaGarden_topScreen.php or teaGarden_todayTea-outScreen.php から送られてきた値を格納
  $item_id = $_POST["item_id"];

  try{
    // データベースに接続
    $connect = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8' ;
    $pdo = new PDO($connect, DB_USER, DB_PASSWORD);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_search = $pdo -> prepare('select * from items where is_deleted=0 and item_id=?');
    $sql_search -> bindValue(1,$item_id,PDO::PARAM_INT);
    $sql_search -> execute();
    $item = $sql_search -> fetchAll(PDO::FETCH_ASSOC);

    if(!empty($item)){
      // テーブルに商品情報有
      $_SESSION['item'] = $item ;
      header('Location: ./view/teaGarden_productDetailScreen.php');
      exit();
    }
  }
  catch(PDOException $e){
    header('Location: ./view/showUser_items.php');
    exit();
  }
?>