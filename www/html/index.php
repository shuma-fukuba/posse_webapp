<?php
session_start();
// データベース接続
require_once dirname(__FILE__) . '/dbconnect.php';
// 関数定義
require_once dirname(__FILE__) . '/functions.php';
// データ挿入
require_once dirname(__FILE__) . '/insert.php';
// データ取得
require_once dirname(__FILE__) . '/getValue.php';

// html
include dirname(__FILE__) . '/head.php';
include dirname(__FILE__) . '/header.php';
include dirname(__FILE__) . '/mainTemplate.php';
include dirname(__FILE__) . '/footer.php';
