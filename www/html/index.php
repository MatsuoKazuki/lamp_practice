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
//商品一覧の取得
/*
$items = get_open_items($db);
*/
//ソートを取得
$sort = get_post('sort');
if($sort === 'new') {
  $items = get_items_new_arrival($db);
}else if($sort === 'cheap') {
  $items = get_items_cheap_price($db);
}else if($sort === 'high') {
  $items = get_items_high_price($db);
}else{
  $items = get_items_new_arrival($db);
}
//トークンの生成
$token = get_csrf_token();


include_once VIEW_PATH . 'index_view.php';