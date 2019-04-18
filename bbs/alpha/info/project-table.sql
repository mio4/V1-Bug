DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project`(
    `pid`           int(8) primary key auto_increment,
    `project_owner` int(8) not null references `user`(`uid`),
    `project_name`  varchar(32) not null,
    `project_reward`int(8) not null,
    `project_photo` varchar(128),
    `project_info`  text not null,
    `project_kind`  int(8) not null,
    `particitan_max` int(8) not null,
    `project_createTime` date not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `project_star`(

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


-- 为了实现一个用户能够关注多个项目，一个项目能够被多个用户关注的"多对多关系"设计的中间表
DROP TABLE IF EXISTS `user_star_project`
CREATE TABLE `user_star_project`(
    `up_id` int(8) auto_increment,
    `uid` int(8) not null,
    `pid` int(8) not null,
    PRIMARY KEY(`up_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE user_project ADD CONSTRAINT u_fk FOREIGN KEY(uid) REFERENCES user(uid);
ALTER TABLE user_project ADD CONSTRAINT p_fk FOREIGN KEY(pid) REFERENCES project(pid);
-- 测试添加数据
insert into user (uid,user_name,password,user_email,user_kind,user_regTime) values (10,10,10,10,10,'2019-04-16');
insert into project(pid,project_owner,project_name,project_reward,project_info,project_kind,project_createTime) values (10,10,10,10,10,1,'2019-04-16');
insert into user_project (uid,pid) values (10,10);

DROP TABLE IF EXISTS `projectDeveloper`;
CREATE TABLE IF NOT EXISTS `projectDeveloper`(
    `pid`           int(8) primary key references `project`(`pid`),
    `uid`           int(8) primary key references `user`(`uid`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
