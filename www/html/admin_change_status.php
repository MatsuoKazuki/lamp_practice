<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
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
//
if(is_admin($user) === false){
  redirect_to(LOGIN_URL);
}
//item_idの取得
$item_id = get_post('item_id');
//changes_toの取得
$changes_to = get_post('changes_to');

//ステータス更新
if($changes_to === 'open') { //openの場合
  update_item_status($db, $item_id, ITEM_STATUS_OPEN);
  set_message('ステータスを変更しました。');
}else if($changes_to === 'close'){ //closeの場合
  update_item_status($db, $item_id, ITEM_STATUS_CLOSE);
  set_message('ステータスを変更しました。');
}else {
  set_error('不正なリクエストです。');
}


redirect_to(ADMIN_URL);