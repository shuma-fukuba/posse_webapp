<main>
    <div class="container-fluid" id="main">
        <button class="btn phone-btn log-btn" id="ph-open-modal">記録・投稿</button>
        <div class="row" id="main-wrapper">
            <div class="main-left main-content col">
                <div class="container">
                    <div class="hour-logs row">
                        <div class="hour card col" id="today-log">
                            <p class="log-title">Today</p>
                            <h1><?= $log->today_time; ?></h1>
                            <p class="log-content">hour</p>
                        </div>
                        <div class="hour card col" id="month-log">
                            <p class="log-title">Month</p>
                            <h1><?= $log->month_time; ?></h1>
                            <p class="log-content">hour</p>
                        </div>
                        <div class="hour card col" id="total-log">
                            <p class="log-title">Total</p>
                            <h1><?= $log->total_time; ?></h1>
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
            </div>

            <div class="main-right main-content col-md">
                <div class="container">
                    <div class="row">
                        <div class="language-circle card col">
                            <h1>学習言語</h1>
                            <canvas id="language" class="pie"></canvas>
                            <div class="language-tags">
                                <ul>
                                    <?php
                                    $count = 0;
                                    foreach ($languages_key as $language) : ?>
                                        <?php $count++ ?>
                                        <li>
                                            <span class="languages-tag incircle-tag color-<?= $count ?>">
                                                <?= Utils::h($language) ?>
                                            </span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <div class="contents-circle card col">
                            <h1>学習コンテンツ</h1>
                            <canvas id="content-circle" class="pie"></canvas>
                            <div class="content-tags">
                                <ul>
                                    <?php
                                    $count = 0;
                                    foreach ($contents_key as $content) : ?>
                                        <? $count++ ?>
                                        <li>
                                            <span class="content-tag incircle-tag color-<?= $count ?>">
                                                <?= Utils::h($content) ?>
                                            </span>
                                        </li>
                                    <? endforeach ?>
                                </ul>
                            </div>
                        </div>
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
            <!-- ローディング画面 -->
            <div id="loader">
                <div class="spinner"></div>
            </div>
            <!-- フォーム  -->
            <form class="modal-wrapper container" method="post" action="">
                <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']); ?>">
                <div class="form-the-content row">
                    <div class="modal-left modal-container col-md">
                        <div class="datetime-form form-content">
                            <p>学習日</p>
                            <input type="date" class="modal-form" name="learning_date" id="datetime">
                        </div>

                        <div class="laening-contents-form form-content checkbox-form">
                            <p>学習コンテンツ(複数選択可)</p>
                            <?php foreach ($log->contents as $content) : ?>
                                <label>
                                    <input type="checkbox" class="learning-contents" name="contents[]" value="<?= Utils::h($content['id']) ?>">
                                    <span class="selectbox">
                                        <span class="checkbox-text">
                                            <span class="checkbox"></span><?= Utils::h($content['name']) ?></span>
                                    </span>
                                </label>
                            <?php endforeach; ?>
                        </div>

                        <div class="learning-language-form form-content checkbox-form">
                            <p>学習言語（複数選択可）</p>
                            <?php foreach ($log->languages as $language) : ?>
                                <label>
                                    <input type="checkbox" name="languages[]" value="<?= Utils::h($language['id']) ?>">
                                    <span class="selectbox">
                                        <span class="checkbox-text">
                                            <span class="checkbox"></span>
                                            <?= Utils::h($language['name']) ?>
                                        </span>
                                    </span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="modal-right modal-container col-md">
                        <div class="study-time form-content">
                            <p>学習時間</p>
                            <input type="text" inputmode="numeric" name="study_time" class="modal-form">
                        </div>
                        <div class="twitter form-content">
                            <p>Twitter用コメント</p>
                            <textarea name="comment" cols="30" rows="10" class="modal-form"></textarea>
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
