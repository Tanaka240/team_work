<?php
  session_start();
  $user_id ;
  if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
  }
  $item ;
  if(isset($_SESSION['item'])){
    $item = $_SESSION['item'];
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>茶の庭 TEA GARDEN</title>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="teaGarden_productDetailScreen.css">
</head>
<body>
  <?php require './user_header.php' ; ?>

  <main class="container">
    <?php require './user_sidebar.php' ; ?>

    <section class="main-content">
      <h1>商品詳細</h1>

      <div class="product-detail-wrapper">
        <?php foreach($item as $row): ?>
          <div class="product-image">
            <img src="image/<?= $row['item_img'] ?>" alt="" width="400">
          </div>

          <div class="product-info">
            <h3 class="product-title"><?= $row['item_title'] ?></h3>
            <p class="product-name"><?= $row['item_name'] ?></p>
            <p class="product-origin">産地: <?= $row['origin'] ?></p>
            <p class="product-price">
              ¥<?= number_format($row['item_price']) ?><span>（税込）</span>
            </p>
            <div class="product-description">
              <h3>商品説明</h3>
              <p>
                <?= $row['explanation'] ?>
              </p>
            </div>

            <form class="purchase-form">
              <input type="hidden" name="user_id" value="<?= $user_id ?>">
              <input type="hidden" name="item_id" id="item_id" value="<?= $row['item_id'] ?>">
              <input type="hidden" name="item_price" id="item_price" value="<?= $row['item_price'] ?>">
              <div class="quantity-selector">
                <label for="quantity">数量:</label>
                <select id="quantity" name="number_of_item" required>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                </select>
              </div>

              <button type="button" class="buy-btn" id="buyButton">購入する</button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  </main>

  <script src="../update_shipping_status.js"></script>
</body>
</html>