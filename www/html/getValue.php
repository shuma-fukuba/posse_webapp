<?php
require_once dirname(__FILE__) . '/dbconnect.php';

$id = 1;

// その日の時間を取得
$today_time = $db->prepare('SELECT learning_time FROM learning_log WHERE user_id=:user_id AND learning_date=:learning_date');
$today_time->bindValue(':user_id', $id, PDO::PARAM_INT);
$today_time->bindValue(':learning_date', date('Y-m-d'), PDO::PARAM_STR);
$today_time->execute();
$today_time = $today_time->fetch();
$today_time = $today_time['learning_time'];
if ($today_time === NULL) {
    $today_time = 0;
}

// 月間学習時間の取得
$month_time = $db->prepare('SELECT SUM(learning_time) sum_month FROM learning_log WHERE learning_date >= DATE_ADD(NOW(), interval -1 month) AND user_id=:user_id');
$month_time->bindValue(':user_id', $id, PDO::PARAM_INT);
$month_time->execute();
$month_time = $month_time->fetch();
$month_time = $month_time['sum_month'];

//トータル時間の取得
$total_time = $db->prepare('SELECT SUM(learning_time) total FROM learning_log WHERE user_id=:user_id');
$total_time->bindValue(':user_id', $id, PDO::PARAM_INT);
$total_time->execute();
$total_time = ($total_time->fetch())['total'];



$stmt = $db->prepare("SELECT id FROM learning_log WHERE learning_date >= DATE_ADD(NOW(), interval -1 month) AND user_id=:user_id");
$stmt->bindValue(':user_id', $id, PDO::PARAM_INT);
$stmt->execute();

// コンテンツの円グラフ生成のためのデータ取得
$contents_records_arr = [];
for ($i = 0; $i < count($contents); $i++) {
    $contents_connect = $db->prepare("SELECT * FROM contents_connect WHERE  log_id=:log_id");
    // $contents_connect->bindValue(':log_id', );

    // $content_count = ($content_count->fetch())['count'];
    // $contents_records_arr[$contents[$i]['name']] = $content_count;
}


// $languages_records_arr = [];
// for ($i = 0; $i < count($languages); $i++) {
//     $language_count = $db->prepare("SELECT COUNT(*) count FROM learning_log WHERE learning_date >= DATE_ADD(NOW(), interval -1 month) AND languages_id=:language_id AND user_id=:user_id");
//     $language_count->bindValue(':user_id', $id, PDO::PARAM_INT);
//     $language_count->bindValue(':language_id', $i+1, PDO::PARAM_INT);
//     $language_count->execute();
//     $language_count = ($language_count->fetch())['count'];
//     $languages_records_arr[$languages[$i]['name']] = $language_count;
// }


// 合計から書く学習コンテンツの割合を取得し、%にする
// $contents_record_sum = array_sum($contents_records_arr);
// arsort($contents_records_arr);
// $content_key = [];
// $content_value = [];
// foreach ($contents_records_arr as $key=>$value) {
//     $content_key[] = $key;
//     $content_value[] = round(($value / $contents_record_sum) * 100);
// }
// $content_value = json_encode($content_value);


// // 言語のほう
// $langauge_record_sum = array_sum($languages_records_arr);
// arsort($languages_records_arr);
// $language_key = [];
// $language_value = [];
// foreach($languages_records_arr as $key=>$value) {
//     $language_key[] = $key;
//     $language_value[] = round(($value / $langauge_record_sum) * 100);
// }
// $language_value = json_encode($language_value);
