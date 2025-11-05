<?php
  session_start();
  $message ;
  if(isset($_SESSION['success_message'])){
    $message = $_SESSION['success_message'];

    unset($_SESSION['success_message']);
  }
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
  <link rel="stylesheet" href="loginScreen.css">
</head>
<body>
  <div class="container">
    <div class="logo">
      <h2>茶の庭</h2>
      <p class="subtitle">- ログイン -</p>
    </div>

    <form action="../loginProcess.php" method="post">
      <label for="email">メールアドレス</label>
      <input type="email" id="email" name="email" required>

      <label for="password">パスワード</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">ログイン</button>
    </form>

    <p class="login-link">新規会員登録は <a href="newLoginScreen.php">こちら</a></p>
  </div>

  <?php
    if(isset($message)){
      echo "<script>alert('" . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . "');</script>" ;
    }
  ?>
</body>
</html>