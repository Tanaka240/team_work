<?php
  // データベースの情報を取得
  require_once '../db_config.php' ;

  // loginScreen.phpから送信された値を格納
  $email = $_POST['email'];
  $password = $_POST['password'];

  try{
    // データベースに接続
    $connect = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8' ;
    $pdo = new PDO($connect, DB_USER, DB_PASSWORD);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 検索処理
    $sql_search = $pdo -> prepare('select user_id, password_hash, home_address, phone_number, is_deleted, is_admin from users where email = ?');
    $sql_search -> bindValue(1,$email,PDO::PARAM_STR);

    // 実行
    $sql_search -> execute();

    $users = $sql_search -> fetch(PDO::FETCH_ASSOC);

    if($users){
      if(password_verify($password,$users['password_hash'])){
        // 成功
        if($users['is_admin'] == 0){
          if($users['is_deleted'] == 0){
            // ECサイトへ
            session_start();
            $_SESSION['user_id'] = $users['user_id'];
            $_SESSION['home_address'] = $users['home_address'];
            $_SESSION['phone_number'] = $users['phone_number'];
            header('Location: ./showUser_items.php');
            exit();
          }
          else{
            // 退会済みのユーザー
            session_start();
            $_SESSION['error_message'] = "ログインに失敗しました。" ;
            header('Location: ./view/loginScreen.php');
            exit();
          }
        }
        else{
          // 管理者サイトへ
          header('Location: ./view/admin_topScreen.php');
          exit();
        }
      }
      else{
        // パスワードが間違っている
        session_start();
        $_SESSION['error_message'] = "パスワードが間違っています" ;
        header('Location: ./view/loginScreen.php');
        exit();
      }
    }
  }
  catch(PDOException $e){
    session_start();
    $_SESSION['error_message'] = "ログインに失敗しました。" ;
    header('Location: ./view/loginScreen.php');
    exit();
  }
?>