<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
//セッション開始
session_start();
//
if(is_logined() === true){
  redirect_to(HOME_URL);
}
//ネームの取得
$name = get_post('name');
//パスワード取得
$password = get_post('password');
//パスワード確認用の取得
$password_confirmation = get_post('password_confirmation');
//DB接続
$db = get_db_connect();
//ユーザー登録処理
try{
  $result = regist_user($db, $name, $password, $password_confirmation);
  if( $result=== false){
    set_error('ユーザー登録に失敗しました。');
    redirect_to(SIGNUP_URL);
  }
}catch(PDOException $e){
  set_error('ユーザー登録に失敗しました。');
  redirect_to(SIGNUP_URL);
}

set_message('ユーザー登録が完了しました。');
login_as($db, $name, $password);
redirect_to(HOME_URL);