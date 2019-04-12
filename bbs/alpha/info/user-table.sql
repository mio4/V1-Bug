DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user`(
    `uid` int(8) primary key auto_increment,
    `user_name` varchar(32) unique not null,
    `password` varchar(256) not null,
    `user_email` varchar(32) not null unique,
    `user_kind` int(8) not null,
    `user_regTime` datetime not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;