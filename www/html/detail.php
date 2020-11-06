<?php
require_once '../conf/const.php';
require_once MODEL_PATH. 'functions.php';
require_once MODEL_PATH. 'user.php';
require_once MODEL_PATH. 'item.php';
require_once MODEL_PATH. 'cart.php';
require_once MODEL_PATH. 'histories.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}
//DB接続
$db = get_db_connect();
//ユーザー情報取得
$user = get_login_user($db);


$order_id = get_post('order_id');
//購入履歴データ取得
$items = get_history_by_order_id($db, $order_id);
//dd($items);
//dd($order_id);
$details = get_detail($db, $order_id);

//dd($details);

include_once '../view/detail_view.php';