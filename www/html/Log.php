<?php

namespace MyApp;

class Log
{
    public function __construct($db, $id, $year, $month)
    {
        $this->db = $db;
        $this->id = $id;
        $this->contents = $this->getContents();
        $this->languages = $this->getLanguages();
        $this->today_time = $this->getDailyTime();
        $this->month_time = $this->getMonthlyTime($year, $month);
        $this->total_time = $this->getTotalTime();
        $this->contents_circle_data = $this->getContentsCircleData();
        $this->languages_circle_data = $this->getLanguagesCircleData();
    }

    public function add() {
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
            $learning_date = $_REQUEST['learning_date'];
            $time = $_REQUEST['study_time'];
            $comment = $_REQUEST['comment'];
            $stmt = $this->db->prepare('INSERT INTO learning_log SET comment=:comment, created=:created, learning_time=:learning_time, learning_date=:learning_date, user_id=:id');
            if (!$stmt) {
                die($this->db->error);
            }
            $stmt->bindValue(':comment', $comment, \PDO::PARAM_STR);
            $stmt->bindValue(':learning_time', $time, \PDO::PARAM_INT);
            $stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);
            $stmt->bindValue(':learning_date', $learning_date, \PDO::PARAM_STR);
            $stmt->bindvalue(':created', date('Y-m-d'), \PDO::PARAM_STR);
            $success = $stmt->execute();


            if (!$success) {
                die($this->db->error);
            } else {
                // コンテンツ、言語のDBを挿入
                $log_id = (int)($this->db->lastInsertId());
                foreach ($contents_ids as $content) {
                    $content = (int)$content;
                    $stmt = $this->db->prepare("INSERT INTO contents_connect SET log_id=:log_id, content_id=:content_id");
                    $stmt->bindValue(':log_id', $log_id, \PDO::PARAM_INT);
                    $stmt->bindValue(':content_id', $content, \PDO::PARAM_INT);
                    $stmt->execute();
                }
                foreach ($languages_ids as $language) {
                    $language = (int)$language;
                    $stmt = $this->db->prepare("INSERT INTO languages_connect SET log_id=:log_id, language_id=:language");
                    $stmt->bindValue(":log_id", $log_id, \PDO::PARAM_INT);
                    $stmt->bindValue(":language", $language, \PDO::PARAM_INT);
                    $stmt->execute();
                }
                header('Location: ' . SITE_URL);
            }
        }
    }

    private function getDailyTime()
    {
        $today_time = $this->db->prepare('SELECT SUM(learning_time) today_time FROM learning_log WHERE user_id=:user_id AND learning_date=:learning_date');
        $today_time->bindValue(':user_id', $this->id, \PDO::PARAM_INT);
        $today_time->bindValue(':learning_date', date('Y-m-d'), \PDO::PARAM_STR);
        $today_time->execute();
        $today_time = $today_time->fetch();
        $today_time = $today_time['today_time'];
        if ($today_time === NULL) {
            $today_time = 0;
        }
        return $today_time;
    }

    // 月間学習時間の取得
    private function getMonthlyTime($year, $month)
    {
        $format = (string)$year . (string)$month;
        $month_time = $this->db->prepare("SELECT SUM(learning_time) sum_month FROM learning_log WHERE DATE_FORMAT(learning_date, '%Y%m')=:yearMonth AND user_id=:user_id");
        $month_time->bindValue(':user_id', $this->id, \PDO::PARAM_INT);
        $month_time->bindValue(':yearMonth', $format, \PDO::PARAM_STR);
        $month_time->execute();
        $month_time = $month_time->fetch();
        $month_time = $month_time['sum_month'];
        if ($month_time === NULL) {
            $month_time = 0;
        }
        return $month_time;
    }

    // トータル学習時間
    private function getTotalTime()
    {
        $total_time = $this->db->prepare('SELECT SUM(learning_time) total FROM learning_log WHERE user_id=:user_id');
        $total_time->bindValue(':user_id', $this->id, \PDO::PARAM_INT);
        $total_time->execute();
        $total_time = ($total_time->fetch())['total'];
        if ($total_time === NULL) {
            $total_time = 0;
        }
        return $total_time;
    }


    private function getContentsCircleData()
    {
        $stmt = $this->db->prepare('SELECT contents.name, count(contents_connect.content_id) count from contents join contents_connect on contents.id=contents_connect.content_id where contents_connect.log_id in (
        select id from learning_log where learning_date >= DATE_ADD(NOW(), interval -1 month) and user_id=:user_id
    ) group by contents_connect.content_id ORDER BY count DESC');

        $stmt->bindValue(':user_id', $this->id, \PDO::PARAM_INT);
        $stmt->execute();
        $values = $stmt->fetchAll();

        // データ整形
        $result = [];
        $sum = array_sum(array_column($values, 'count'));
        foreach ($values as $data) {
            $result[] = array('name' => $data['name'], 'count' => round((int)$data['count'] / $sum * 100));
        }
        return $result;
    }


    private function getLanguagesCircleData()
    {
        $stmt = $this->db->prepare('SELECT languages.name, count(languages_connect.language_id) count from languages join languages_connect on languages.id=languages_connect.language_id where languages_connect.log_id in (
        select id from learning_log where learning_date >= DATE_ADD(NOW(), interval -1 month) and user_id=:user_id
    ) group by languages_connect.language_id ORDER BY count DESC');

        $stmt->bindValue(':user_id', $this->id, \PDO::PARAM_INT);
        $stmt->execute();
        $values = $stmt->fetchAll();

        $result = [];
        $sum = array_sum(array_column($values, 'count'));
        foreach ($values as $data) {
            $result[] = array('name' => $data['name'], 'count' => round((int)$data['count'] / $sum * 100));
        }
        return $result;
    }

    private function getContents() {
        return $this->db->query('SELECT * FROM contents')->fetchAll();
    }

    private function getLanguages() {
        return $this->db->query('SELECT * FROM languages')->fetchAll();
    }

    public function getBarData($year, $month) {
        $format = (string)$year . (string)$month;
        $stmt = $this->db->prepare("SELECT SUM(learning_time) time, learning_date FROM learning_log WHERE DATE_FORMAT(learning_date, '%Y%m')=:yearMonth AND user_id=:id GROUP BY learning_date ORDER BY learning_date ASC");
        $stmt->bindValue(':yearMonth', $format, \PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
