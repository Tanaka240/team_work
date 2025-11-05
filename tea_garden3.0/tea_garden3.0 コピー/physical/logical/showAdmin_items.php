<?php
  session_start();

  // データベースの情報を取得
  require_once '../db_config.php' ;

  $search_method = 'df' ;
  // 絞り込みの処理命令が送られてきたら値を格納
  if(isset($_POST['search_method'])){
    $search_method = $_POST['search_method'] ;
  }

  try{
    // データベースに接続
    $connect = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8' ;
    $pdo = new PDO($connect, DB_USER, DB_PASSWORD);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 検索処理分岐
    switch($search_method){
      case 'df':
        // 全商品表示処理
        $sql_search = $pdo -> query('select * from items');
        $items = $sql_search -> fetchAll(PDO::FETCH_ASSOC);

        if(isset($items)){
          // テーブルに商品情報有
          $_SESSION['items'] = $items ;
          header('Location: ./view/admin_productScreen.php');
          exit();
        }
      break;
    }
  }
  catch(PDOException $e){
    header('Location: ./view/admin_topScreen.php');
    exit();
  }
?>