<?php
  // データベースの情報を取得
  require_once '../db_config.php' ;

  // admin_userManagementScreen.phpから送信された値を格納
  $user_id = $_POST['user_id'];
  $command = $_POST['command'];

  try{
    // データベースに接続
    $connect = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8' ;
    $pdo = new PDO($connect, DB_USER, DB_PASSWORD);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 処理の分岐(復旧、削除)
    switch($command){
      case 'restoration':
        $sql_restoration = $pdo -> prepare('update users set is_deleted=0 where user_id = ?');
        $sql_restoration -> bindValue(1,$user_id,PDO::PARAM_INT);
        $sql_restoration -> execute();

        // 成功
        header('Location: ./showAdmin_users.php');
        exit();
      break;
      case 'delete':
        $sql_restoration = $pdo -> prepare('update users set is_deleted=1 where user_id = ?');
        $sql_restoration -> bindValue(1,$user_id,PDO::PARAM_INT);
        $sql_restoration -> execute();

        // 成功
        header('Location: ./showAdmin_users.php');
        exit();
      break;
    }
  }
  catch(PDOException $e){
    header('Location: ./showAdmin_users.php');
    exit();
  }
?>