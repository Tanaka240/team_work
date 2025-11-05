<?php
  session_start();
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
  <link rel="stylesheet" href="newLoginScreen.css">
</head>
<body>
  <div class="container">
    <div class="logo">
      <h2>茶の庭</h2>
      <p class="subtitle">- 会員登録 -</p>
    </div>

    <form action="../register_user.php" method="post">
      <label for="name">お名前</label>
      <input type="text" id="name" name="name" required>

      <label for="email">メールアドレス</label>
      <input type="email" id="email" name="email" required>

      <label for="password">パスワード</label>
      <input type="password" id="password" name="password" required>

      <label for="confirm">パスワード（確認）</label>
      <input type="password" id="confirm" name="confirm" required>

      <button type="submit" id="register_btn">登録する</button>
    </form>

    <p class="login-link">すでにアカウントをお持ちの方は <a href="loginScreen.php">こちら</a></p>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function(){
      let passwordInput = document.getElementById("password");
      let confirmInput = document.getElementById("confirm");
      let registerButton = document.getElementById("register_btn");

      // 入力値が変更されるたびに関数を実行
      passwordInput.addEventListener('input', checkPasswords);
      confirmInput.addEventListener('input', checkPasswords);

      registerButton.addEventListener('click', function(event){
        if(registerButton.classList.contains('disabled-btn')){
          // 送信キャンセル
          event.preventDefault();

          // アラート表示
          alert("入力されているパスワードが一致しません");
        }
      });

      function checkPasswords(){
        let password = passwordInput.value ;
        let confirm = confirmInput.value ;

        // パスワードが一致していて、尚且つ空じゃないか
        if((password === confirm) && (password.length > 0)){
          // クラスを削除して有効化
          registerButton.classList.remove('disabled-btn');
        }
        else{
          // クラスを追加して無効化
          registerButton.classList.add('disabled-btn');
        }
      }
    });
  </script>

  <?php
    if(isset($message)){
      echo "<script>alert('" . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . "');</script>" ;
    }
  ?>
</body>
</html>