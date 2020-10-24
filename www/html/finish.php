<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
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
//カート内の商品情報
$carts = get_user_carts($db, $user['user_id']);
//商品購入できない場合
if(purchase_carts($db, $carts) === false){
  set_error('商品が購入できませんでした。');
  redirect_to(CART_URL);
} 
//合計値
$total_price = sum_carts($carts);

include_once '../view/finish_view.php';