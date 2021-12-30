<?php
$id = 1;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_REQUEST['contents'])) {
        $contents_ids = $_REQUEST['contents'];
    } else {
        $error['contents'] = 'blank';
    }

    if (isset($_REQUEST['languages'])) {
        $languages_ids = $_REQUEST['languages'];
    } else {
        $error['languages'] = 'blank';
    }
    if ($_REQUEST['study_time'] === '') {
        $error['study_time'] = 'blank';
    }
    if ($_REQUEST['learning_date'] === '') {
        $error['learning_date'] = 'blank';
    }

    if (empty($error)) {
        $created = date("Y-m-d");
        $learning_date = $_REQUEST['learning_date'];
        $time = $_REQUEST['study_time'];
        $comment = $_REQUEST['comment'];
        $stmt = $db->prepare('INSERT INTO learning_log SET comment=:comment, created=:created, learning_time=:learning_time, learning_date=:learning_date, user_id=:id');
        if (!$stmt) {
            die($db->error);
        }
        $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
        $stmt->bindValue(':learning_time', $time, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':learning_date', $learning_date, PDO::PARAM_STR);
        $stmt->bindvalue(':created', date('Y-m-d'), PDO::PARAM_STR);
        $success = $stmt->execute();


        if (!$success) {
            die($db->error);
        } else {
            // コンテンツ、言語のDBを挿入
            $log_id = (int)($db->lastInsertId());
            foreach($contents_ids as $content) {
                $content = (int)$content;
                $stmt = $db->prepare("INSERT INTO contents_connect SET log_id=:log_id, content_id=:content_id");
                $stmt->bindValue(':log_id', $log_id, PDO::PARAM_INT);
                $stmt->bindValue(':content_id', $content, PDO::PARAM_INT);
                $stmt->execute();
            }
            foreach($languages_ids as $language) {
                $language = (int)$language;
                $stmt = $db->prepare("INSERT INTO languages_connect SET log_id=:log_id, language_id=:language");
                $stmt->bindValue(":log_id", $log_id, PDO::PARAM_INT);
                $stmt->bindValue(":language", $language, PDO::PARAM_INT);
                $stmt->execute();
            }
        }
    }
}
