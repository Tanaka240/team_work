<?php
  session_start();

  $omikuji;
  $omikuji_title;
  $omikuji_explanation;
  $today_tea;
  if(isset($_SESSION['omikuji'])){
    $omikuji = $_SESSION['omikuji'];
    $omikuji_title = $_SESSION['omikuji_title'];
    $omikuji_explanation = $_SESSION['omikuji_explanation'];
    $today_tea = $_SESSION['today_tea'];
  }
  else{
    header('Location: ./view/teaGarden_todayTea-inScreen.php');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>茶の庭 TEA GARDEN</title>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="teaGarden_todayTea-outScreen.css">
</head>
<body>
  <?php require './user_header.php' ; ?>

  <main class="container">
    <?php require './user_sidebar.php' ; ?>

    <section class="main-content">
      <div class="fortune-result-area">
        <h1>今日のティー占い結果</h1>

        <div class="result-card daikichi">
          <p class="result-label">本日の運勢</p>

          <h2 class="result-title"><?= $omikuji ?></h2>

          <p class="result-message">
            <span class="message-highlight"><?= $omikuji_title ?></span><br>
            <?= $omikuji_explanation ?>
          </p>

          <div class="recommended-tea">
            <?php foreach($today_tea as $row): ?>
              <h3>おすすめの一杯: <?= $row['item_name'] ?></h3>
              <p class="tea-description">
                <?= $row['explanation'] ?>
              </p>
            <?php endforeach; ?>
          </div>

          <form action="../showUser_productDetail.php" method="post" class="detail-form">
            <?php foreach($today_tea as $row): ?>
              <input type="hidden" name="item_id" value="<?= $row['item_id'] ?>">
              <button type="submit" class="detail-button">
                この商品の詳細を見る
              </button>
            <?php endforeach; ?>
          </form>
        </div>
      </div>
    </section>
  </main>
</body>
</html>