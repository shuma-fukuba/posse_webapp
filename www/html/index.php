<?php
require_once dirname(__FILE__) . '/config.php';

// データ取得
$id = 1;
$log = new log($db, $id);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    Token::validate();
    $log->add();
}
// コンテンツの円グラフ生成のためのデータ取得
$contents_key = [];
$contents_value = [];
foreach ($log->contents_circle_data as $data) {
    $contents_key[] = $data['name'];
    $contents_value[] = (int)$data['count'];
}
$contents_value = json_encode($contents_value);

$languages_key = [];
$languages_value = [];
foreach ($log->languages_circle_data as $data) {
    $languages_key[] = $data['name'];
    $languages_value[] = (int)$data['count'];
}
$languages_value = json_encode($languages_value);

// html
include dirname(__FILE__) . '/head.php';
include dirname(__FILE__) . '/header.php';
include dirname(__FILE__) . '/mainTemplate.php';
include dirname(__FILE__) . '/footer.php';
