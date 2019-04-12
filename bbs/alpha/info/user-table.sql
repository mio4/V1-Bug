create table `user`(
    `uid` int(8) primary key auto_increment,
    `username` varchar(32) unique not null,
    `password` varchar(256) not null,
    `email` varchar(32) not null unique,
    `type` int(8) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;