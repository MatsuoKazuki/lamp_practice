<?php
require_once '../conf/const.php';
require_once MODEL_PATH. 'functions.php';
require_once MODEL_PATH. 'users.php';
require_once MODEL_PATH. 'items.php';
require_once MODEL_PATH. 'carts.php';
require_once MODEL_PATH. 'histories.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}
//DB接続
$db = get_db_connect();
//ユーザー情報取得
$user = get_login_user($db);
//購入履歴データ取得
$carts = get_history($db, $user['user_id']);

//明細画面へpostで送るための
$order_id = get_post('order_id');

include_once '../view/history_view.php';