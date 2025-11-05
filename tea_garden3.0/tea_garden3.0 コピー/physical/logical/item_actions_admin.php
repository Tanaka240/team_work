<?php
  // データベースの情報を取得
  require_once '../db_config.php' ;

  // admin_productScreen.phpから送信された値を格納
  $item_title = $_POST['item_title'];
  $item_name = $_POST['item_name'];
  $type = $_POST['type'];
  $origin = $_POST['origin'];
  $explanation = $_POST['explanation'];
  $item_price = $_POST['item_price'];
  $command = $_POST['command'];
  $item_id ;
  if(isset($_POST['item_id'])){
    $item_id = $_POST['item_id'];
  }
  $is_deleted ;
  if(isset($_POST['is_deleted'])){
    $is_deleted = $_POST['is_deleted'];
  }

  try{
    // データベースに接続
    $connect = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8' ;
    $pdo = new PDO($connect, DB_USER, DB_PASSWORD);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 処理の分岐(追加、更新)
    switch($command){
      case 'insert':
        if(is_uploaded_file($_FILES['item_img']['tmp_name'])){
          $file = './view/image/'.basename($_FILES['item_img']['name']);
          $item_img = basename($_FILES['item_img']['name']);

          if(move_uploaded_file($_FILES['item_img']['tmp_name'],$file)){
            $sql_insert = $pdo -> prepare('insert into items(item_title,item_name,type,origin,explanation,item_price,item_img)values(?,?,?,?,?,?,?)');
            $sql_insert -> bindValue(1,$item_title,PDO::PARAM_STR);
            $sql_insert -> bindValue(2,$item_name,PDO::PARAM_STR);
            $sql_insert -> bindValue(3,$type,PDO::PARAM_STR);
            $sql_insert -> bindValue(4,$origin,PDO::PARAM_STR);
            $sql_insert -> bindValue(5,$explanation,PDO::PARAM_STR);
            $sql_insert -> bindValue(6,$item_price,PDO::PARAM_INT);
            $sql_insert -> bindValue(7,$item_img,PDO::PARAM_STR);
            $sql_insert -> execute();

            // 成功
            header('Location: ./showAdmin_items.php');
            exit();
          }
          else{
            header('Location: ./showAdmin_items.php');
            exit();
          }
        }
      break;

      case 'update':
        if(is_uploaded_file($_FILES['item_img']['tmp_name'])){
          $file = './view/image/'.basename($_FILES['item_img']['name']);
          $item_img = basename($_FILES['item_img']['name']);

          if(move_uploaded_file($_FILES['item_img']['tmp_name'],$file)){
            $sql_update = $pdo -> prepare('update items set item_title=?, item_name=?, type=?, origin=?, explanation=?, item_price=?, item_img=?, is_deleted=? where item_id=?');
            $sql_update -> bindValue(1,$item_title,PDO::PARAM_STR);
            $sql_update -> bindValue(2,$item_name,PDO::PARAM_STR);
            $sql_update -> bindValue(3,$type,PDO::PARAM_STR);
            $sql_update -> bindValue(4,$origin,PDO::PARAM_STR);
            $sql_update -> bindValue(5,$explanation,PDO::PARAM_STR);
            $sql_update -> bindValue(6,$item_price,PDO::PARAM_INT);
            $sql_update -> bindValue(7,$item_img,PDO::PARAM_STR);
            $sql_update -> bindValue(8,$is_deleted,PDO::PARAM_INT);
            $sql_update -> bindValue(9,$item_id,PDO::PARAM_INT);
            $sql_update -> execute();

            // 成功
            header('Location: ./showAdmin_items.php');
            exit();
          }
          else{
            header('Location: ./showAdmin_items.php');
            exit();
          }
        }
        else{
          $sql_update = $pdo -> prepare('update items set item_title=?, item_name=?, type=?, origin=?, explanation=?, item_price=?, is_deleted=? where item_id=?');
          $sql_update -> bindValue(1,$item_title,PDO::PARAM_STR);
          $sql_update -> bindValue(2,$item_name,PDO::PARAM_STR);
          $sql_update -> bindValue(3,$type,PDO::PARAM_STR);
          $sql_update -> bindValue(4,$origin,PDO::PARAM_STR);
          $sql_update -> bindValue(5,$explanation,PDO::PARAM_STR);
          $sql_update -> bindValue(6,$item_price,PDO::PARAM_INT);
          $sql_update -> bindValue(7,$is_deleted,PDO::PARAM_INT);
          $sql_update -> bindValue(8,$item_id,PDO::PARAM_INT);
          $sql_update -> execute();

          // 成功
          header('Location: ./showAdmin_items.php');
          exit();
        }
    }
  }
  catch(PDOException $e){
    header('Location: ./showAdmin_items.php');
    exit();
  }
?>