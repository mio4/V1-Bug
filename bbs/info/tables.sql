DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user`(
	`id` int(11) primary key auto_increment,
	`username` varchar(30) comment '用户名',
	`password` varchar(256) comment '加密后的密码',
	`type` int(11) NOT NULL comment '用户类型',
	`email`	varchar(20) comment '邮箱'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;