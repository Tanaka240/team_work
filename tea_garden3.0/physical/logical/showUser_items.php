<?php
  session_start();

  // データベースの情報を取得
  require_once '../db_config.php' ;

  $search_method = 'df' ;
  // 絞り込みの処理が送られてきたら値を格納
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
      case 'all':
        // 全商品表示処理
        $sql_search = $pdo -> query('select * from items where is_deleted=0');
        $items = $sql_search -> fetchAll(PDO::FETCH_ASSOC);

        if($items){
          // テーブルに商品情報有
          $_SESSION['items'] = $items ;
          header('Location: ./view/teaGarden_topScreen.php');
          exit();
        }
      break;
      case '1':
        $sql_search = $pdo -> prepare('select * from items where is_deleted=0 and type like ?');
        $sql_search -> bindValue(1,'%'.'特上高級茶'.'%',PDO::PARAM_STR);
        $sql_search -> execute();
        $items = $sql_search -> fetchAll(PDO::FETCH_ASSOC);

        if(!empty($items)){
          // テーブルに商品情報有
          $_SESSION['items'] = $items ;
          header('Location: ./view/teaGarden_topScreen.php');
          exit();
        }
      break;
      case '2':
        $sql_search = $pdo -> prepare('select * from items where is_deleted=0 and type like ?');
        $sql_search -> bindValue(1,'%'.'深蒸し茶'.'%',PDO::PARAM_STR);
        $sql_search -> execute();
        $items = $sql_search -> fetchAll(PDO::FETCH_ASSOC);

        if(!empty($items)){
          // テーブルに商品情報有
          $_SESSION['items'] = $items ;
          header('Location: ./view/teaGarden_topScreen.php');
          exit();
        }
      break;
      case '3':
        $sql_search = $pdo -> prepare('select * from items where is_deleted=0 and type like ?');
        $sql_search -> bindValue(1,'%'.'玄米茶'.'%',PDO::PARAM_STR);
        $sql_search -> execute();
        $items = $sql_search -> fetchAll(PDO::FETCH_ASSOC);

        if(!empty($items)){
          // テーブルに商品情報有
          $_SESSION['items'] = $items ;
          header('Location: ./view/teaGarden_topScreen.php');
          exit();
        }
      break;
      case '4':
        $sql_search = $pdo -> prepare('select * from items where is_deleted=0 and type like ?');
        $sql_search -> bindValue(1,'%'.'ほうじ茶'.'%',PDO::PARAM_STR);
        $sql_search -> execute();
        $items = $sql_search -> fetchAll(PDO::FETCH_ASSOC);

        if(!empty($items)){
          // テーブルに商品情報有
          $_SESSION['items'] = $items ;
          header('Location: ./view/teaGarden_topScreen.php');
          exit();
        }
      break;
      case '5':
        $sql_search = $pdo -> prepare('select * from items where is_deleted=0 and type like ?');
        $sql_search -> bindValue(1,'%'.'掛川紅茶'.'%',PDO::PARAM_STR);
        $sql_search -> execute();
        $items = $sql_search -> fetchAll(PDO::FETCH_ASSOC);

        if(!empty($items)){
          // テーブルに商品情報有
          $_SESSION['items'] = $items ;
          header('Location: ./view/teaGarden_topScreen.php');
          exit();
        }
      break;
      case '6':
        $sql_search = $pdo -> prepare('select * from items where is_deleted=0 and type like ?');
        $sql_search -> bindValue(1,'%'.'抹茶'.'%',PDO::PARAM_STR);
        $sql_search -> execute();
        $items = $sql_search -> fetchAll(PDO::FETCH_ASSOC);

        if(!empty($items)){
          // テーブルに商品情報有
          $_SESSION['items'] = $items ;
          header('Location: ./view/teaGarden_topScreen.php');
          exit();
        }
      break;
      case '7':
        $sql_search = $pdo -> prepare('select * from items where is_deleted=0 and type like ?');
        $sql_search -> bindValue(1,'%'.'ハーブティー'.'%',PDO::PARAM_STR);
        $sql_search -> execute();
        $items = $sql_search -> fetchAll(PDO::FETCH_ASSOC);

        if(!empty($items)){
          // テーブルに商品情報有
          $_SESSION['items'] = $items ;
          header('Location: ./view/teaGarden_topScreen.php');
          exit();
        }
      break;
      case 'df':
        // 全商品表示処理
        $sql_search = $pdo -> query('select * from items where is_deleted=0');
        $items = $sql_search -> fetchAll(PDO::FETCH_ASSOC);

        if($items){
          // テーブルに商品情報有
          $_SESSION['items'] = $items ;
          header('Location: ./view/teaGarden_topScreen.php');
          exit();
        }
      break;
    }
  }
  catch(PDOException $e){
    header('Location: ./view/teaGarden_topScreen.php');
    exit();
  }
?>