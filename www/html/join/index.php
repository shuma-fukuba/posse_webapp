<?php
function h($value) {
    return htmlspecialchars($value, ENT_QUOTES);
}

$form = [];
$error = [];
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    if ($form['name'] === '') {
        $error['name'] = 'blank';
    }
    $form['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if ($form['email'] == '') {
        $error['email'] = 'blank';
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html>
