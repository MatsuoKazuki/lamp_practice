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
//商品一覧を取得
$items = get_all_items($db);
include_once VIEW_PATH . '/admin_view.php';
