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
//ユーザー判定
if (is_admin($user) === true) {
   $items = get_admin_history($db);
}
//購入履歴データ取得
$items = get_history($db, $user['user_id']);

include_once '../view/history_view.php';