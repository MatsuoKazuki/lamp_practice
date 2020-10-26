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

//リダイレクト
if(is_admin($user) === false){
  redirect_to(LOGIN_URL);
}
//パラメーター取得
$token = get_post('token');

//リダイレクト
if(is_valid_csrf_token($token) === false){
  redirect_to(LOGIN_URL);
}
//トークンの破棄
unset($_SESSION["csrf_token"]);
//パラメーター取得
$name = get_post('name');
$price = get_post('price');
$status = get_post('status');
$stock = get_post('stock');
$image = get_file('image');

//商品情報の追加
if(regist_item($db, $name, $price, $stock, $status, $image)){
  set_message('商品を登録しました。');
}else {
  set_error('商品の登録に失敗しました。');
}


redirect_to(ADMIN_URL);