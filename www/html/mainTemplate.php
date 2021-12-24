<main>
    <div class="main-wrapper container">
        <div class="row">
            <div class="main-left main-content col-md">
                <div class="hour-logs row">
                    <div class="hour card col-md" id="today-log">
                        <p class="log-title">Today</p>
                        <h1><?= $today_time; ?></h1>
                        <p class="log-content">hour</p>
                    </div>
                    <div class="hour card col-md" id="month-log">
                        <p class="log-title">Month</p>
                        <h1><?= $month_time; ?></h1>
                        <p class="log-content">hour</p>
                    </div>
                    <div class="hour card col-md" id="total-log">
                        <p class="log-title">Total</p>
                        <h1><?= $total_time; ?></h1>
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


            <div class="main-right main-content col-md">
                <div class="container">
                    <div class="row">
                        <div class="language-circle card col-md">
                            <h1>学習言語</h1>
                            <canvas id="language" class="pie"></canvas>
                            <div class="language-tags">
                                <ul>
                                    <?php
                                    $count = 0;
                                    foreach ($language_key as $language) : ?>
                                        <?php $count++ ?>
                                        <li><span class="languages-tag incircle-tag color-<?= $count ?>" id="<?= $language ?>"><?= $language ?></span></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <div class="contents-circle card col-md">
                            <h1>学習コンテンツ</h1>
                            <canvas id="content-circle" class="pie"></canvas>
                            <div class="content-tags">
                                <ul>
                                    <?php
                                    $count = 0;
                                    foreach ($content_key as $content) : ?>
                                        <? $count++ ?>
                                        <li>
                                            <span class="content-tag incircle-tag color-<?= $count ?>">
                                                <?= $content ?>
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
                <div class="form-the-content">
                    <div class="modal-left modal-container">
                        <div class="datetime-form form-content">
                            <p>学習日</p>
                            <input type="date" class="modal-form" name="learning_date" id="datetime">
                        </div>

                        <div class="laening-contents-form form-content checkbox-form">
                            <p>学習コンテンツ(複数選択可)</p>
                            <?php foreach ($contents as $content) : ?>
                                <label>
                                    <input type="checkbox" class="learning-contents" name="contents[]" value="<?= $content['id'] ?>">
                                    <span class="selectbox">
                                        <span class="checkbox-text">
                                            <span class="checkbox"></span><?= $content['name'] ?></span>
                                    </span>
                                </label>
                            <?php endforeach; ?>
                        </div>

                        <div class="learning-language-form form-content checkbox-form">
                            <p>学習言語（複数選択可）</p>
                            <?php foreach ($languages as $language) : ?>
                                <label>
                                    <input type="checkbox" name="languages[]" value="<?= $language['id'] ?>">
                                    <span class="selectbox">
                                        <span class="checkbox-text">
                                            <span class="checkbox"></span>
                                            <?= $language['name'] ?>
                                        </span>
                                    </span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="modal-right modal-container">
                        <div class="study-time form-content">
                            <p>学習時間</p>
                            <input type="text" inputmode="numeric" name="study-time" class="modal-form">
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
