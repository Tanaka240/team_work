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
  <link rel="stylesheet" href="teaGarden_topScreen.css">
</head>
<body>
  <?php require './user_header.php' ; ?>

  <main class="container">
    <?php require './user_sidebar.php' ; ?>

    <section class="main-content">
      <h1>全商品</h1>

      <div class="product-list">
        <?php if(isset($items)): ?>
          <?php foreach($items as $row): ?>
            <div class="product-card">
              <img src="./image/<?= $row['item_img'] ?>" alt="<?= $row['item_name'] ?>" width="200">
              <p class="title">
                <?= $row['item_title'] ?><br><?= $row['item_name'] ?>
              </p>
              <p class="price">¥<?= number_format($row['item_price']) ?><span>（税込）</span></p>
              <form action="../showUser_productDetail.php" method="post">
                <input type="hidden" name="item_id" value="<?= $row['item_id'] ?>">
                <button class="cart-btn">商品詳細</button>
              </form>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </section>
  </main>

  <?php
    if(isset($message)){
      echo "<script>alert('" . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . "');</script>" ;
    }
  ?>
</body>
</html>