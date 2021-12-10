<?
$contents = ['N予備校', 'ドットインストール', 'POSSE課題'];
$contents_name = ['n-Yobi', 'dot', 'posse'];
$languages = ['HTML', 'CSS', 'JavaScript', 'PHP', 'Laravel', 'SQL', 'SHELL', '情報システム基礎知識(その他)'];
$languages_name = ['html', 'css', 'js', 'php', 'lara', 'sql', 'shell', 'other'];
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSSE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="./js/chart.js"></script>
    <script src="./js/script.js" type="text/javascript"></script>
</head>

<body>
    <header>
        <div class="header-container">
            <div class="header-left">
                <div class="header-logo">
                    <img src="#" alt="POSSE">
                    <span>4th week</span>
                </div>
            </div>
            <div class="header-right">
                <button class="btn log-btn" id="open-modal">記録・投稿</button>
            </div>
        </div>
    </header>

    <main>
        <div class="main-wrapper container">
            <div class="row">
                <div class="main-left main-content">
                    <div class="hour-logs row">
                        <div class="hour card col-md" id="today-log">
                            <p class="log-title">Today</p>
                            <h1>3</h1>
                            <p class="log-content">hour</p>
                        </div>
                        <div class="hour card col-md" id="month-log">
                            <p class="log-title">Month</p>
                            <h1>120</h1>
                            <p class="log-content">hour</p>
                        </div>
                        <div class="hour card col-md" id="total-log">
                            <p class="log-title">Total</p>
                            <h1>1348</h1>
                            <p class="log-content">hour</p>
                        </div>
                    </div>

                    <div class="bar-graph card">
                        <div class="bar" style="height: 165px;"></div>
                        <div class="bar" style="height: 200px;"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </div>
                </div>


                <div class="main-right main-content">
                    <div class="language-circle card">
                        <h1>学習言語</h1>
                        <canvas id="language" class="pie"></canvas>
                        <div class="language-tags">
                            <ul>
                                <?
                                $count = 0;
                                foreach ($languages as $language) : ?>
                                    <? $count++ ?>
                                    <li><span class="languages-tag incircle-tag color-<? echo $count ?>" id="<?php echo $language ?>"><?php echo $language ?></span></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="contents-circle card">
                        <h1>学習コンテンツ</h1>
                        <canvas id="content-circle" class="pie"></canvas>
                        <div class="content-tags">
                            <ul>
                                <?
                                $count = 0;
                                foreach ($contents as $content) : ?>
                                    <? $count++ ?>
                                    <li>
                                        <span class="content-tag incircle-tag color-<? echo $count ?>">
                                            <? echo $content ?>
                                        </span>
                                    </li>
                                <? endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-bottom">
                <div class="pages">
                    <a href="#">&lt;</a><span>2020年 10月</span><a href="#">&gt;</a>
                </div>
            </div>
        </div>

        <div class="modal" id="modal">
            <div class="modal-bg close-modal"></div>
            <div class="container card" id="modal-content">
                <form class="modal-wrapper container" method="post" action="">
                    <div class="form-the-content">
                        <div class="modal-left modal-container">
                            <div class="datetime-form form-content">
                                <p>学習日</p>
                                <input type="date" class="modal-form" name="datetime" id="datetime">
                            </div>

                            <div class="laening-contents-form form-content checkbox-form">
                                <p>学習コンテンツ(複数選択可)</p>
                                <?php foreach ($contents as $content) : ?>

                                    <label>
                                        <input type="checkbox" class="learning-contents" name="contents" value="<?php echo $content ?>">
                                        <span class="selectbox">
                                            <span class="checkbox-text">
                                                <span class="checkbox"></span><?php echo $content ?></span>
                                        </span>
                                    </label>

                                <?php endforeach; ?>
                            </div>

                            <div class="learning-language-form form-content checkbox-form">
                                <p>学習言語（複数選択可）</p>
                                <?php foreach ($languages as $language) : ?>
                                    <label>
                                        <input type="checkbox" name="language" id="<?php echo $language ?>" value="<?php echo $language ?>">
                                        <span class="selectbox">
                                            <span class="checkbox-text">
                                                <span class="checkbox"></span><? echo $language ?></span>
                                        </span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="modal-right modal-container">
                            <div class="study-time form-content">
                                <p>学習時間</p>
                                <input type="text" name="study-time" class="modal-form">
                            </div>
                            <div class="twitter form-content">
                                <p>Twitter用コメント</p>
                                <textarea name="twitter" cols="30" rows="10" class="modal-form"></textarea>
                                <label><input type="checkbox" name="twitter-share" value="share"><span class="checkbox"></span>Twitterにシェアする
                                </label>
                            </div>
                        </div>
                        <div class="close-modal" id="close-modal">×</div>
                    </div>
                    <div class="submit">
                        <button class="btn log-btn">記録、投稿</button>
                    </div>
                </form>
            </div>
        </div>

    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script src="./js/script.js" type="text/javascript"></script>
</body>

</html>
