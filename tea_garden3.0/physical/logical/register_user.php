<?php
  // データベースの情報を取得
  require_once '../db_config.php' ;

  // newLoginScreen.phpから送信された値を格納
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // 現在の日時を取得
  $created_at = date('Y-m-d H:i:s');

  // パスワードをハッシュ化
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  try{
    // データベースに接続
    $connect = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8' ;
    $pdo = new PDO($connect, DB_USER, DB_PASSWORD);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 追加処理
    $sql_insert = $pdo -> prepare('insert into users(user_name, email, password_hash, created_at) values(?, ?, ?, ?)');
    $sql_insert -> bindValue(1,$name,PDO::PARAM_STR);
    $sql_insert -> bindValue(2,$email,PDO::PARAM_STR);
    $sql_insert -> bindValue(3,$hashed_password,PDO::PARAM_STR);
    $sql_insert -> bindValue(4,$created_at,PDO::PARAM_STR);

    // 実行
    $sql_insert -> execute();

    // 成功
    session_start();
    $_SESSION['success_message'] = "登録しました。" ;
    header('Location: ./view/loginScreen.php');
    exit();
  }
  catch(PDOException $e){
    session_start();
    $_SESSION['error_message'] = "登録に失敗しました。" ;
    header('Location: ./view/newLoginScreen.php');
    exit();
  }
?>