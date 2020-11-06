<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>購入履歴</title>
    <link rel="stylesheet" href="<?php print(h(STYLESHEET_PATH . 'cart.css')); ?>">
  </head>

  <body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <h1>購入履歴</h1>

    <?php include VIEW_PATH. 'templates/messages.php'; ?>

    <!-- 購入履歴 -->
    <?php if(!empty($items)){ ?>

        <div class="container">
            <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                <th>注文番号</th>
                <th>購入日時</th>
                <th>合計金額</th>
                <th>明細</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($items as $item){ ?>
                <tr>
                <td><?php print($item['order_id']); ?></td>
                <td><?php print($item['purchase_date']); ?></td>
                <td><?php print($item['sum_price']); ?></td>
                <td>
                    <form method="post" action="detail.php">
                    <input type="submit" value="購入明細表示">
                    <input type="hidden" name="order_id" value="<?php print($item['order_id']); ?>">
                    </form>
                </td>
                </tr>
            <?php } ?>
            </tbody>
            </table>
        </div>

    <?php }else{ ?>
    <p>購入履歴がありません。</p>
    <?php } ?>
  </body>
</html>