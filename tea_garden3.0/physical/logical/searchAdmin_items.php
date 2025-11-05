<?php
  session_start();

  // データベースの情報を取得
  require_once '../db_config.php' ;

  // 送信された検索ワードを格納
  $keyword ;
  if(isset($_POST['keyword'])){
    if(trim($_POST['keyword']) === ""){
      header('Location: ./showAdmin_items.php');
      exit();
    }
    else{
      $keyword = $_POST['keyword'];
    }
  }
  else{
    header('Location: ./showAdmin_items.php');
    exit();
  }

  try{
    // データベースに接続
    $connect = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8' ;
    $pdo = new PDO($connect, DB_USER, DB_PASSWORD);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_search = $pdo -> prepare('select * from items where item_name like ?');
    $sql_search -> bindValue(1,'%'.$keyword.'%',PDO::PARAM_STR);
    $sql_search -> execute();
    $items = $sql_search -> fetchAll(PDO::FETCH_ASSOC);

    if(!empty($items)){
      // テーブルに商品情報有
      $_SESSION['items'] = $items ;
      header('Location: ./view/admin_productScreen.php');
      exit();
    }
    else{
      $_SESSION['error_message'] = "検索された商品はありません。" ;
      header('Location: ./showAdmin_items.php');
      exit();
    }
  }
  catch(PDOException $e){
    header('Location: ./showAdmin_items.php');
    exit();
  }
?>