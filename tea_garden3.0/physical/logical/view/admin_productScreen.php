<?php
  session_start();
  $items ;
  if(isset($_SESSION['items'])){
    $items = $_SESSION['items'];
  }
  $message ;
  if(isset($_SESSION['error_message'])){
    $message = $_SESSION['error_message'];

    unset($_SESSION['error_message']);
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>茶の庭 TEA GARDEN</title>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="admin_productScreen.css">
</head>
<body>
  <?php require './admin_header.php' ; ?>

  <main class="container">
    <h1>商品管理システム</h1>

    <form class="search-form" action="../searchAdmin_items.php" method="post">
      <input type="search" name="keyword" placeholder="商品名検索" class="search-input">
    </form>

    <div class="table-container">
      <table border="1">
        <tr>
          <th>商品ID</th>
          <th>商品タイトル</th>
          <th>商品名</th>
          <th>ジャンル</th>
          <th>産地</th>
          <th>商品説明</th>
          <th>価格(税込)</th>
          <th>商品画像</th>
          <th>削除(削除済=1)</th>
          <th>更新</th>
        </tr>
        <tr>
          <form action="../item_actions_admin.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="command" value="insert">
            <td></td>
            <td><input type="text" name="item_title" required></td>
            <td><input type="text" name="item_name" required></td>
            <td><input type="text" name="type" required></td>
            <td><input type="text" name="origin" required></td>
            <td><input type="text" name="explanation" required></td>
            <td><input type="text" name="item_price" required></td>
            <td><input type="file" name="item_img" accept=".jpeg, .jpg, .png, image/jpeg, image/png" required></td>
            <td></td>
            <td><input type="submit" value="追加"></td>
          </form>
        </tr>
        <?php foreach($items as $row): ?>
          <tr>
            <form action="../item_actions_admin.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="command" value="update">
              <input type="hidden" name="item_id" value="<?= $row['item_id'] ?>">
              <td><?= $row['item_id'] ?></td>
              <td><input type="text" name="item_title" value="<?= $row['item_title'] ?>" required></td>
              <td><input type="text" name="item_name" value="<?= $row['item_name'] ?>" required></td>
              <td><input type="text" name="type" value="<?= $row['type'] ?>" required></td>
              <td><input type="text" name="origin" value="<?= $row['origin'] ?>" required></td>
              <td><input type="text" name="explanation" value="<?= $row['explanation'] ?>" required></td>
              <td><input type="text" name="item_price" value="<?= $row['item_price'] ?>" required></td>
              <td>
                <input type="file" name="item_img" accept=".jpeg, .jpg, .png, image/jpeg, image/png">
                <?php if(!$row['item_img'] == NULL): ?>
                  <img src="./image/<?= $row['item_img'] ?>" width="50" height="50">
                <?php endif; ?>
              </td>
              <td><input type="text" name="is_deleted" value="<?= $row['is_deleted'] ?>" required></td>
              <td><input type="submit" value="更新"></td>
            </form>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </main>

  <?php
    if(isset($message)){
      echo "<script>alert('" . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . "');</script>" ;
    }
  ?>
</body>
</html>