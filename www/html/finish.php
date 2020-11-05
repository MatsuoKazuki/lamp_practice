<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'histories.php';
//セッション開始
session_start();
//
if(is_logined() === false){
  redirect_to(LOGIN_URL);
}
//DB接続
$db = get_db_connect();
//ログインユーザーの取得
$user = get_login_user($db);

//パラメーター取得
$token = get_post('token');
//リダイレクト
if(is_valid_csrf_token($token) === false){
  redirect_to(LOGIN_URL);
}
//トークンの破棄
unset($_SESSION["csrf_token"]);


//カート内の商品情報
$carts = get_user_carts($db, $user['user_id']);
//商品購入できない場合
if(purchase_carts($db, $carts) === false){
  set_error('商品が購入できませんでした。');
  redirect_to(CART_URL);
} 
//合計値
$total_price = sum_carts($carts);

//購入履歴テーブルにuser_idと合計額を追加 ($db $user['user_id'] $total_price $carts[]) 関数名：regist_history_transaction
//購入明細テーブルに注文番号・itemID・購入時価格・購入数量を追加  

if(regist_history_transaction($db, $carts,$user['user_id'] ,$total_price) === false){
  set_error('購入履歴テーブルに追加できませんでした。');
  redirect_to(CART_URL);
}

include_once '../view/finish_view.php';