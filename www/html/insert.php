<?php
$id = 1;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_REQUEST['contents']) && is_array($_REQUEST['cotnents'])) {
        $contents_ids = $_REQUEST['contents'];
    } else {
        $error['contents'] = 'blank';
    }

    if (isset($_REQUEST['lanugages']) && is_array($_REQUEST['languages'])) {
        $languages_ids = $_REQUEST['languages'];
    } else {
        $error['languages'] = 'blank';
    }
    if ($_REQUEST['time'] === '') {
        $error['time'] = 'blank';
    }
    if ($_REQUEST['learning_date'] === '') {
        $error['learning_date'] = 'blank';
    }

    if (empty($error)) {
        var_dump($contents_ids);
        var_dump($languages_ids);
        // $created = date("Y-m-d");
        // $learning_date = $_REQUEST['learning_date'];
        // $time = $_REQUEST['study-time'];
        // $comment = $_REQUEST['comment'];
        // $stmt = $db->prepare('INSERT INTO learning_log SET comment=:comment, created=:created, learning_time=:learning_time, learning_date=:learning_date, user_id=:id');
        // if (!$stmt) {
        //     die($db->error);
        // }
        // $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
        // $stmt->bindValue(':learning_time', $time, PDO::PARAM_INT);
        // $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        // $stmt->bindValue(':learning_date', $learning_date, PDO::PARAM_STR);
        // $stmt->bindvalue(':created', date('Y-m-d'), PDO::PARAM_STR);
        // $success = $stmt->execute();


        // if (!$success) {
        //     die($db->error);
        // } else {
        //     // コンテンツ、言語のDBを挿入
        //     $log_id = $db->lastInsertId();
        //     foreach($contents_ids as $content) {
        //         $content = (int)$content;
        //         $content_id = $db->prepare("SELECT id FROM contents WHERE id=:id");
        //         $content_id->bindValue(':id', $content, PDO::PARAM_INT);
        //         $content_id->execute();
        //         $content_id = $content_id->fetch();
        //         var_dump($content_id);

        //         $stmt = $db->prepare("INSERT INTO contents_connect SET log_id=:log_id, content_id=:content_id");
        //     }


        //     header('Location: index.php');
        //     exit();
        // }
    }
}
