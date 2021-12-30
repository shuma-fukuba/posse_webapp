<?php
require_once dirname(__FILE__) . '/dbconnect.php';

$id = 1;

$contents = $db->query('SELECT * FROM contents');
$contents = $contents->fetchAll();

$languages = $db->query('SELECT * FROM languages');
$languages = $languages->fetchAll();

$today_time = getDailyTime($db, $id);
$month_time = getMonthlyTime($db, $id);
$total_time = getTotalTime($db, $id);

// コンテンツの円グラフ生成のためのデータ取得
$contents_circle_data = getContentsCircleData($db, $id);
$contents_key = [];
$contents_value = [];
foreach ($contents_circle_data as $data) {
    $contents_key[] = $data['name'];
    $contents_value[] = (int)$data['count'];
}
$contents_value = json_encode($contents_value);

$languages_circle_data = getLanguagesCircleData($db, $id);
$languages_key = [];
$languages_value = [];
foreach ($languages_circle_data as $data) {
    $languages_key[] = $data['name'];
    $languages_value[] = (int)$data['count'];
}

$languages_value = json_encode($languages_value);
