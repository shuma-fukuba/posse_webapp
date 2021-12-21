<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_REQUEST['contents'] == NULL) {
        $error['contents'] = 'blank';
    }
    if ($_REQUEST['languages'] == NULL) {
        $error['languages'] = 'blank';
    }
    if (!isset($_REQUEST['time'])) {
        $error['time'] = 'blank';
    }
    if (empty($error)) {
        $contents = implode(',', $_REQUEST['contents']);
        $languages = implode(',', $_REQUEST['languages']);
        $created = date("Y-m-d");
        $time = $_REQUEST['study-time'];
        $comment = $_REQUEST['comment'];

        $stmt = $db->prepare('INSERT INTO learning_log SET contents=:contents, languages=:languages, comment=:comment, learning_time=:learning_time, id=:id');

        if (!$stmt) {
            die($db->error);
        }

        $stmt->bindValue(':contents', $contents, PDO::PARAM_STR);
        $stmt->bindValue(':languages', $languages, PDO::PARAM_STR);
        $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
        $stmt->bindValue(':learning_time', $time, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        echo "挿入成功";

        if (!$success) {
            die($db->error);
        } else {
            echo 'Inserting was successed!';
        }
    }
}
