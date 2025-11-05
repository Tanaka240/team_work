<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>茶の庭 TEA GARDEN</title>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="teaGarden_todayTea-inScreen.css">
</head>
<body>
  <?php require './user_header.php' ; ?>

  <main class="container">
    <?php require './user_sidebar.php' ; ?>

    <section class="main-content">
      <h1>今日のティーを占う</h1>

      <div class="today-tea-guide">
        <p>
          今日の運勢にぴったりの一杯を占ってみませんか？<br>
          新しいお茶との素敵な出会いがあなたを待っています！
        </p>
        <div class="fortune-image-wrapper">
          <img src="./image/fortune_tea_icon.png" alt="ティーカップと星のアイコン" class="fortune-tea-icon">
        </div>
        <form action="../todayTea.php" method="post" class="fortune-form">
          <button type="submit" class="fortune-button">
            今日のティーを占う
          </button>
        </form>
      </div>
    </section>
  </main>
</body>
</html>