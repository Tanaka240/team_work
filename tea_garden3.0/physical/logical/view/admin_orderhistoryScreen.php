<?php
  session_start();

  $order_history;
  if(!empty($_SESSION['order_history'])){
    $order_history = $_SESSION['order_history'];
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>茶の庭 TEA GARDEN</title>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="admin_orderhistoryScreen.css">
</head>
<body>
  <?php require './admin_header.php' ; ?>

  <main class="container">
    <h1>注文履歴管理システム</h1>

    <form class="search-form" action="../searchAdmin_users.php" method="post">
      <input type="search" name="keyword" placeholder="名前またはe-mailで検索" class="search-input">
    </form>

    <div class="table-container">
      <table border="1">
        <tr>
          <th>購入日</th>
          <th>商品名</th>
          <th>個数</th>
          <th>金額</th>
          <th>商品状況</th>
          <th>処理中</th>
          <th>出荷済み</th>
          <th>配達完了</th>
        </tr>
        <?php foreach($order_history as $row): ?>
          <tr>
            <td><?= $row['order_time'] ?></td>
            <td><?= $row['item_name'] ?></td>
            <td><?= $row['number_of_item'] ?></td>
            <td><?= number_format($row['sum_price']) ?></td>
            <td><?= $row['number_of_item'] ?></td>
            <?php if($row['delivery_status'] == 0): ?>
              <td>処理中</td>
              <?php elseif($row['delivery_status'] == 1): ?>
                <td>出荷済み</td>
                <?php elseif($row['delivery_status'] == 2): ?>
                  <td>配達完了</td>
            <?php endif; ?>


</body>
</html>