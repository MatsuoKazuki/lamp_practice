<?php
//ファイル読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';





// 購入履歴へINSERT
function insert_history($db, $user, $total_price){
    $sql = "
      INSERT INTO
        purchase_history(
          user_id,
          sum_price
        )
      VALUES(:user_id, :sum_price)
    ";
    $array=array(':user_id' => $user, ':sum_price' => $total_price);

    return execute_query($db, $sql, $array);
  }
  
  // 購入明細にINSERT
  function insert_detail($db, $order_id, $item_id, $price, $amount){
    $sql = "
      INSERT INTO
        purchase_details(
          order_id,
          item_id,
          price,
          amount
        )
      VALUES(:order_id,:item_id,:price,:amount)
    ";
    $array=array(':order_id' => $order_id, ':item_id' => $item_id, ':price' => $price, ':amount' => $amount);

    return execute_query($db, $sql, $array);
  }


//regist_history_transaction関数定義
function regist_history_transaction($db, $carts, $user_id, $total_price){

      // 購入後、カートの中身削除&在庫変動&購入履歴・明細にデータを挿入
      $db->beginTransaction();

      if(insert_history($db, $user_id, $total_price) === true) {
        $order_id = $db->lastInsertId();
        foreach($carts as $cart){
            if(insert_detail($db, $order_id, $cart['item_id'], $cart['price'], $cart['amount'])===false){
                $db->rollback();
                return false;
            }
        }
        $db->commit();
        return true;
      }
        $db->rollback();
        return false;
        
 
}

// ユーザ毎の購入履歴
/*
function get_history($db, $user_id){
    $sql = "
      SELECT
        purchase_histories.order_id,
        purchase_histories.purchase_date,
        purchase_history.sum_price
      FROM
        purchase_history
      JOIN
        purchase_details
      ON
        purchase_history.order_id = purchase_details.order_id
      WHERE
        purchase_history.user_id = :user_id
    ";
    $array=array(':user_id' => $user_id);
    return fetch_all_query($db, $sql, $array);
}

// ユーザ毎の購入明細
/*
function get_detail($db, $order_id){
    $sql = "
      SELECT
        purchase_details.price,
        purchase_details.amount,
        purchase_details.created,
        purchase_details.item_id,
        SUM(purchase_details.price * purchase_details.amount) AS subtotal
    ";
    return fetch_all_query($db, $sql, );
}
*/