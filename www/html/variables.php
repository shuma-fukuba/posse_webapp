<?php
$contents = $db->query('SELECT * FROM contents');
$contents = $contents->fetchAll();

$languages = $db->query('SELECT * FROM languages');
$languages = $languages->fetchAll();
