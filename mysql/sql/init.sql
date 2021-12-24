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
