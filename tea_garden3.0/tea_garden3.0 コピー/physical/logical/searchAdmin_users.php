<?php
  session_start();

  // データベースの情報を取得
  require_once '../db_config.php' ;

  // 送信された検索ワードを格納
  $keyword ;
  if(isset($_POST['keyword'])){
    if(trim($_POST['keyword']) === ""){
      header('Location: ./showAdmin_users.php');
      exit();
    }
    else{
      $keyword = $_POST['keyword'];
    }
  }
  else{
    header('Location: ./showAdmin_users.php');
    exit();
  }

  try{
    // データベースに接続
    $connect = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8' ;
    $pdo = new PDO($connect, DB_USER, DB_PASSWORD);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_search = $pdo -> prepare('select * from users where is_admin = 0 and (user_name like ? or email like ?)');
    $sql_search -> bindValue(1,'%'.$keyword.'%',PDO::PARAM_STR);
    $sql_search -> bindValue(2,'%'.$keyword.'%',PDO::PARAM_STR);
    $sql_search -> execute();
    $users = $sql_search -> fetchAll(PDO::FETCH_ASSOC);

    if(!empty($users)){
      // テーブルにユーザー情報有
      $_SESSION['users'] = $users ;
      header('Location: ./view/admin_userManagementScreen.php');
      exit();
    }
    else{
      $_SESSION['error_message'] = "検索されたユーザーはいません。" ;
      header('Location: ./showAdmin_users.php');
      exit();
    }
  }
  catch(PDOException $e){
    header('Location: ./showAdmin_users.php');
    exit();
  }
?>