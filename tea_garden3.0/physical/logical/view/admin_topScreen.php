<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>茶の庭 TEA GARDEN</title>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="admin_topScreen.css">
</head>
<body>
  <?php require './admin_header.php' ; ?>

  <main class="container">
    <h1>管理システム</h1>
    
    <form action="../showAdmin_items.php" method="post">
      <button type="submit" id="admin_btn1" class="admin_btn">・商品管理へ</button>
    </form>

    <form action="../showAdmin_users.php" method="post">
      <button type="submit" class="admin_btn">・ユーザー管理へ</button>
    </form>

    <form action="" method="post">
      <button type="submit" class="admin_btn">・注文履歴を確認</button>
    </form>
  </main>
</body>
</html>