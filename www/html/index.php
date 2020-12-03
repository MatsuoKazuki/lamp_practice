<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
$page=1;
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

//総件数の取得
$all_item = get_all_item($db);
//dd($all_item['COUNT(*)']);

//総ページ数の計算
$pages = ceil($all_item['COUNT(*)']/8);
//dd($pages);

//該当ページの商品取得、表示するページ数を引数で渡す
$get_page = get_get('page');
if($get_page !== '') {
  $page = $get_page;
} 
$offset = ($page-1)*8;
//dd($get_page);
//dd($offset);
$items = get_pagenation($db ,$offset);

//dd($items);
//商品一覧の取得

//$items = get_open_items($db);

//ソートを取得
$sort = get_post('sort');
if($sort === ''){
  $sort =get_get('sort');
}
if($sort === 'new') {
  $items = get_items_new_arrival($db,$offset);
}else if($sort === 'cheap') {
  $items = get_items_cheap_price($db,$offset);
}else if($sort === 'high') {
  $items = get_items_high_price($db,$offset);
}else{
  $items = get_items_new_arrival($db,$offset);
}
//トークンの生成
$token = get_csrf_token();


include_once VIEW_PATH . 'index_view.php';