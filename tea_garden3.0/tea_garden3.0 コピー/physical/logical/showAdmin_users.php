<?php
  session_start();

  // データベースの情報を取得
  require_once '../db_config.php' ;

  try{
    // データベースに接続
    $connect = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8' ;
    $pdo = new PDO($connect, DB_USER, DB_PASSWORD);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 全ユーザー表示処理
    $sql_search = $pdo -> query('select * from users where is_admin = 0');
    $users = $sql_search -> fetchAll(PDO::FETCH_ASSOC);

    if(!empty($users)){
      // ユーザー管理システムへ
      $_SESSION['users'] = $users ;
      header('Location: ./view/admin_userManagementScreen.php');
      exit();
    }
  }
  catch(PDOException $e){
    header('Location: ./view/admin_topScreen.php');
    exit();
  }
?>