creat table project(
    id        int not null auto_increment primary key,
    name      varchar(256) not null comment '用户名',
    info	  varchar(256) null     comment '项目简介',
    creator   int(11)      not null comment '用户id',
    createdAt TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    constraint fk_ou foreign key (creator) references user(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

creat table favorite(
    uid       int(11)   not null comment '用户id',
    pid       int       not null comment '项目id',
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    primary key(userid,projectid),
    constraint fk_uo foreign key (userid) references user(id),
    constraint fk_ou foreign key (projectid) references project(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

creat table follow(
    uid       int(11)   not null comment '用户id',
    followid  int(11)   not null comment '关注用户id',
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    primary key(userid,followid),
    constraint fk_uu foreign key (userid) references user(id),
    constraint fk_fu foreign key (followid) references user(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

creat table contributor(
    uid       int(11) not null comment '用户id',
    pid       int not null     comment '项目id',
    createdAt TIMESTAMP,
    primary key(userid,projectid),
    constraint fk_uo foreign key (userid) references user(id),
    constraint fk_ou foreign key (projectid) references project(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;