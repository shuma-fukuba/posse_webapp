<?php
// htmlspacialcharsを究極に短く
function h($value) {
    return htmlspecialchars($value, ENT_QUOTES);
}


// その日の時間を取得
function getDailyTime($db, $id) {
    $today_time = $db->prepare('SELECT SUM(learning_time) today_time FROM learning_log WHERE user_id=:user_id AND learning_date=:learning_date');
    $today_time->bindValue(':user_id', $id, PDO::PARAM_INT);
    $today_time->bindValue(':learning_date', date('Y-m-d'), PDO::PARAM_STR);
    $today_time->execute();
    $today_time = $today_time->fetch();
    $today_time = $today_time['today_time'];
    if ($today_time === NULL) {
        $today_time = 0;
    }
    return $today_time;
}


// 月間学習時間の取得
function getMonthlyTime($db, $id) {
    $month_time = $db->prepare('SELECT SUM(learning_time) sum_month FROM learning_log WHERE learning_date >= DATE_ADD(NOW(), interval -1 month) AND user_id=:user_id');
    $month_time->bindValue(':user_id', $id, PDO::PARAM_INT);
    $month_time->execute();
    $month_time = $month_time->fetch();
    $month_time = $month_time['sum_month'];
    if ($month_time === NULL) {
        $month_time = 0;
    }
    return $month_time;
}

// トータル学習時間
function getTotalTime($db, $id) {
    $total_time = $db->prepare('SELECT SUM(learning_time) total FROM learning_log WHERE user_id=:user_id');
    $total_time->bindValue(':user_id', $id, PDO::PARAM_INT);
    $total_time->execute();
    $total_time = ($total_time->fetch())['total'];
    if ($total_time === NULL) {
        $total_time = 0;
    }
    return $total_time;
}


function getContentsCircleData($db, $id) {
    $stmt = $db->prepare('SELECT contents.name, count(contents_connect.content_id) count from contents join contents_connect on contents.id=contents_connect.content_id where contents_connect.log_id in (
        select id from learning_log where learning_date >= DATE_ADD(NOW(), interval -1 month) and user_id=:user_id
    ) group by contents_connect.content_id ORDER BY count DESC');

    $stmt->bindValue(':user_id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $values = $stmt->fetchAll();

    // データ整形
    $result = [];
    $sum = array_sum(array_column($values, 'count'));
    foreach ($values as $data) {
        $result[] =array('name'=>$data['name'], 'count'=>round((int)$data['count'] / $sum * 100));
    }
    return $result;
}


function getLanguagesCircleData($db, $id) {
    $stmt = $db->prepare('SELECT languages.name, count(languages_connect.language_id) count from languages join languages_connect on languages.id=languages_connect.language_id where languages_connect.log_id in (
        select id from learning_log where learning_date >= DATE_ADD(NOW(), interval -1 month) and user_id=:user_id
    ) group by languages_connect.language_id ORDER BY count DESC');

    $stmt->bindValue(':user_id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $values = $stmt->fetchAll();

    $result = [];
    $sum = array_sum(array_column($values, 'count'));
    foreach ($values as $data) {
        $result[] =array('name'=>$data['name'], 'count'=>round((int)$data['count'] / $sum * 100));
    }
    return $result;
}
