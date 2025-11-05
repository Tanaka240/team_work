<?php
  // データベースの情報を取得
  require_once './db_config2.php' ;
  // データベースに接続
  $connect = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8' ;
  $pdo2 = new PDO($connect, DB_USER, DB_PASSWORD);
  $pdo2 -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // ここから下にPHPを記述
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>茶の庭 TEA GARDEN</title>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="guideToDrinkingTea.css">
</head>
<body>
  <?php require './user_header.php' ; ?>

  <main class="container">
    <?php require './user_sidebar.php' ; ?>

    <section class="main-content">
      <!-- ここに記述 -->
      <h1>お茶ガイド</h1>
      <!-- tanaka  -->
      <h2>お茶のおすすめの飲み方</h2>
      <!-- 少し説明分を入れる  -->

      <!-- 表の方式で画像を使いながら入れ方を伝える  -->
       <!-- 例  -->
       <?php
        echo "<table border='1'>";
        echo "<tr><th>名前</th><th>年齢</th><th>職業</th></tr>";
        echo "<tr><td>山田太郎</td><td>28</td><td>エンジニア</td></tr>";
        echo "<tr><td>佐藤花子</td><td>34</td><td>デザイナー</td></tr>";
        echo "</table>";
        ?>
      <!-- ooga  -->
    </section>
  </main>
</body>
</html>