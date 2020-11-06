<!DOCTYPE html>
<html lang="ja">
  <head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>購入明細</title>
    <link rel="stylesheet" href="<?php print(h(STYLESHEET_PATH . 'cart.css')); ?>">
  </head>

  <body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <h1>購入明細</h1>

    <!-- メッセージ・エラーメッセージ -->
    <?php include VIEW_PATH. 'templates/messages.php'; ?>

    <!-- 購入明細 -->
    <div class="container">
            <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                <th>注文番号</th>
                <th>購入日時</th>
                <th>合計金額</th>
                </tr>
            </thead>
            <tbody>
        
                <tr>
                <td><?php print(h($items['order_id'])); ?></td>
                <td><?php print(h($items['purchase_date'])); ?></td>
                <td><?php print(h($items['sum_price'])); ?></td>
                </tr>
         
            </tbody>
            </table>
        </div>

    <!-- 購入明細 -->
    <div class="container">
        <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
            <th>商品名</th>
            <th>価格</th>
            <th>購入数</th>
            <th>小計</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($details as $detail){ ?>
            <tr>
            <td><?php print($detail['name']); ?></td>
            <td><?php print($detail['price']); ?></td>
            <td><?php print($detail['amount']); ?></td>
            <td><?php print($detail['subtotal']); ?></td>
            </tr>
        <?php } ?>
        </tbody>
        </table>
    </div>
  </body>
</html>