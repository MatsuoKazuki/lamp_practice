<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
//セッション開始
session_start();
//リダイレクト
if(is_logined() === true){
  redirect_to(HOME_URL);
}
//トークンの生成
$token = get_csrf_token();

include_once VIEW_PATH . 'login_view.php';