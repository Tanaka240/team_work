<?php
  session_start();

  $myOrderhistory;
  if(!empty($_SESSION['myOrderhistory'])){
    $myOrderhistory = $_SESSION['myOrderhistory'];
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>茶の庭 TEA GARDEN</title>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="teaGarden_myOrderhistoryScreen.css">
</head>
<body>
  <?php require './user_header.php' ; ?>

  <main class="container no-sidebar">
    <section class="main-content full-width">
      <h1>購入履歴</h1>

      <div class="history-table-container">
        <table>
          <thead>
            <tr>
              <th>購入日</th>
              <th>商品名</th>
              <th>数量</th>
              <th>合計金額（税込）</th>
              <th>配達状況</th>
              <th class="action-column">キャンセル</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($_SESSION['myOrderhistory'])): ?>
              <?php foreach($myOrderhistory as $row): ?>
                <tr>
                  <td data-label="購入日"><?= (new DateTime($row['order_time'])) -> format('Y/m/d') ?></td>
                  <td data-label="商品名"><?= $row['item_name'] ?></td>
                  <td data-label="数量"><?= $row['number_of_item'] ?></td>
                  <td data-label="合計金額">¥<?= number_format($row['sum_price']) ?></td>
                  <?php if($row['delivery_status'] == 0): ?>
                    <td data-label="配達状況" class="status-processing">処理中</td>
                    <td data-label="アクション" class="action-column">
                      <form action="cancel_order.php" method="post" onsubmit="return confirm('本当にこの注文をキャンセルしますか？');">
                        <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
                        <button type="submit" class="cancel-btn">キャンセル</button>
                      </form>
                    </td>
                    <?php elseif($row['delivery_status'] == 1): ?>
                      <td data-label="配達状況" class="status-shipped">出荷済み</td>
                      <td data-label="アクション" class="action-column"></td>
                      <?php elseif($row['delivery_status'] == 2): ?>
                        <td data-label="配達状況" class="status-delivered">配達完了</td>
                        <td data-label="アクション" class="action-column"></td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            <?php endif ?>
            <!-- <tr>
              <td data-label="購入日">2024/10/01</td>
              <td data-label="商品名">【静岡・掛川茶】おもてなしの深むし茶 2袋セット</td>
              <td data-label="数量">1</td>
              <td data-label="合計金額">¥3,340</td>
              <td data-label="配達状況" class="status-shipped">出荷済み</td>
              <td data-label="アクション" class="action-column"></td>
            </tr>
            <tr>
              <td data-label="購入日">2024/09/15</td>
              <td data-label="商品名">【限定】極上煎茶 翠玉 100g</td>
              <td data-label="数量">3</td>
              <td data-label="合計金額">¥3,340</td>
              <td data-label="配達状況" class="status-processing">処理中</td>
              <td data-label="アクション" class="action-column">
                <form action="cancel_order.php" method="post" onsubmit="return confirm('本当にこの注文をキャンセルしますか？');">
                  <input type="hidden" name="order_id" value="ORDER-12345">
                  <button type="submit" class="cancel-btn">キャンセル</button>
                </form>
              </td>
            </tr>
            <tr>
              <td data-label="購入日">2024/08/20</td>
              <td data-label="商品名">抹茶入り玄米茶 ティーバッグ 30P</td>
              <td data-label="数量">2</td>
              <td data-label="合計金額">¥2,100</td>
              <td data-label="配達状況" class="status-delivered">配達完了</td>
              <td data-label="アクション" class="action-column"></td>
            </tr> -->
          </tbody>
        </table>
        <?php if(empty($_SESSION['myOrderhistory'])): ?>
          <p>注文履歴はありません。</p>
        <?php endif; ?>
      </div>
    </section>
  </main>
</body>
</html>