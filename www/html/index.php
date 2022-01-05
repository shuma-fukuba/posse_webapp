<?php
use MyApp\Log;
use MyApp\Token;
require_once dirname(__FILE__) . '/config.php';

// データ取得
if (isset($_REQUEST['year']) && is_numeric($_REQUEST['year'])) {
    $year = $_REQUEST['year'];
} else {
    $year = date('Y');
}
if (isset($_REQUEST['month']) && is_numeric($_REQUEST['month'])) {
    $month = $_REQUEST['month'];
} else {
    $month = date('m');
}

$next_month = $month + 1;
$next_year = $year;
$pre_month = $month - 1;
$pre_year = $year;

if($pre_month < 1) {
    $pre_month = 12;
    $pre_year--;
}
if ($next_month > 12) {
    $next_month = 1;
    $next_year++;
}

$id = 1;
$log = new log($db, $id, $year, $month);
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

$bar = $log->getBarData($year, $month);


// html
include dirname(__FILE__) . '/head.php';
include dirname(__FILE__) . '/header.php';
include dirname(__FILE__) . '/mainTemplate.php';
include dirname(__FILE__) . '/footer.php';
