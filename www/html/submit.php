<?php
require_once dirname(__FILE__) . '/dbconnect.php';
$contents = implode(',', $_REQUEST['contents']);
$languages = implode(',', $_REQUEST['languages']);
$created = date('now');
$time = $_REQUEST['study-time'];
$comment = $_REQUEST['comment'];

$stmt = $db->prepare('insert into posse_webapp set contents=:contents, languages=:languages, created=:created, time=:time, comment=:comment');
