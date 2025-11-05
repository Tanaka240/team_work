<?php
  session_start();
  $users ;
  if(isset($_SESSION['users'])){
    $users = $_SESSION['users'];
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
  <link rel="stylesheet" href="admin_userManagementScreen.css">
</head>
<body>
  <?php require './admin_header.php' ; ?>

  <main class="container">
    <h1>ユーザー管理システム</h1>

    <form class="search-form" action="../searchAdmin_users.php" method="post">
      <input type="search" name="keyword" placeholder="名前またはe-mailで検索" class="search-input">
    </form>

    <div class="table-container">
      <table border="1">
        <tr>
          <th>ユーザーID</th>
          <th>ユーザー名</th>
          <th>メールアドレス</th>
          <th>住所</th>
          <th>電話番号</th>
          <th>登録日</th>
          <th>削除(削除済=1)</th>
          <th>ユーザー復旧</th>
          <th>ユーザー削除</th>
        </tr>
        <?php foreach($users as $row): ?>
          <tr>
            <td><?= $row['user_id'] ?></td>
            <td><?= $row['user_name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['home_address'] ?></td>
            <td><?= $row['phone_number'] ?></td>
            <td><?= $row['created_at'] ?></td>
            <td><?= $row['is_deleted'] ?></td>
            <td>
              <form action="../user_actions_admin.php" method="post">
                <input type="hidden" name="command" value="restoration">
                <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                <input type="submit" value="復旧">
              </form>
            </td>
            <td>
              <form action="../user_actions_admin.php" method="post">
                <input type="hidden" name="command" value="delete">
                <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                <input type="submit" value="削除">
              </form>
            </td>
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