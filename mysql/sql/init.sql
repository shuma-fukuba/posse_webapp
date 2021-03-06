create table contents (
    id INT(10) NOT NULL AUTO_INCREMENT,
    name text(100) NOT NULL,
    PRIMARY KEY (id)
);

create table languages (
    id INT(10) NOT NULL AUTO_INCREMENT,
    name text(100) NOT NULL,
    PRIMARY KEY (id)
);


insert into contents (NULL, 'N予備校'), (NULL, 'ドットインストール'), ('POSSE課題');

insert into languages VALUES (NULL, 'HTML'), (NULL, 'CSS'), (NULL, 'JavaScript'), (NULL, 'PHP'), (NULL, 'Laravel'), (NULL, 'SQL'), (NULL, 'SHELL');


create table contents_connect(
    id int(10) not null AUTO_INCREMENT,
    log_id int(10) not null,
    content_id int(10) not null,
    PRIMARY KEY (id)
);


create table languages_connect(
    id int(10) not null AUTO_INCREMENT,
    log_id int(10) not null,
    language_id int(10) not null,
    PRIMARY KEY (id)
);

-- とりま30日分のコンテンツ数を持ってくる
select count(*) from contents_connect
where log_id in (
    select id from learning_log where user_id=1 and learning_date >= DATE_ADD(NOW(), interval -1 month)
);

select content_id, count(content_id) from contents_connect where log_id in (
    select id from learning_log where user_id=1 and learning_date >= DATE_ADD(NOW(), interval -1 month)
) group by content_id


select contents.name, count(contents_connect.content_id) count from contents join contents_connect on contents.id=contents_connect.content_id where contents_connect.log_id in (
    select id from learning_log where user_id=1 and learning_date >= DATE_ADD(NOW(), interval -1 month)
) group by contents_connect.content_id;


SELECT languages.name, count(languages_connect.language_id) count from languages join languages_connect on languages.id=languages_connect.language_id where languages_connect.log_id in (
        select id from learning_log where learning_date >= DATE_ADD(NOW(), interval -1 month) and user_id=1
    ) group by languages_connect.language_id ORDER BY count DESC;


SELECT SUM(learning_time) time, CONVERT(VARCHAR, learning_date, 23) learning_date FROM learning_log WHERE DATE_FORMAT(learning_date, '%Y%m')='202112' AND user_id=1 GROUP BY learning_date ORDER BY learning_date ASC;
