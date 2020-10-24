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
//カート内の合計値
$total_price = sum_carts($carts);

include_once VIEW_PATH . 'cart_view.php';