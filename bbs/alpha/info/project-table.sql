DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project`(
    `pid`           int(8) primary key auto_increment,
    `project_owner` varchar(32) not null references `user`(`user_name`),
    `project_name`  varchar(32) not null,
    `project_reward`int(8) not null,
    `project_photo` varchar(128),
    `project_info`  text not null,
    `project_kind`  varchar(1) not null,
    `project_createTime` date not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment`(
    `cid`           int(32) primary key auto_increment,
    `pid`           int(8)  not null references `project`(`pid`),
    `uid`           int(8)  not null references `user`(`uid`),
    `comment_time`  datetime not null,
    `comment_info`  text not null,
    `comment_thumbs_up` int(8) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `reply`;
CREATE TABLE IF NOT EXISTS `reply`(
    `rid`           int(32) primary key auto_increment,
    `cid`           int(8)  not null references `comment`(`cid`),
    `uid`           int(8)  not null references `user`(`uid`),
    `reply_time`  datetime not null,
    `reply_info`  text not null,
    `reply_thumbs_up` int(8) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `projectDeveloper`;
CREATE TABLE IF NOT EXISTS `projectDeveloper`(
    `pid`           int(8) primary key references `project`(`pid`),
    `uid`           int(8) primary key references `user`(`uid`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
