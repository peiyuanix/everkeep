create database ikeep;
use ikeep;

create table `user` (
userid int auto_increment primary key,
username text default null,
`password` text not null,
email text not null,
createTime timestamp not null default current_timestamp
);

create table mark (
markid int auto_increment primary key,
userid int not null,
markName text not null,
createTime timestamp not null default current_timestamp,
updateTime timestamp not null default current_timestamp on update current_timestamp,
isStart tinyint not null,
isDelete tinyint default 0,

constraint fk_markid_userid foreign key (userid) references  `user`(userid)
);

create table notebook (
notebookid int primary key,
userid int not null,
bookName text not null,
createTime timestamp not null default current_timestamp,
updateTime timestamp not null default current_timestamp on update current_timestamp,
noteNumber int not null default 0,
 
isStart tinyint not null,
isShare tinyint default 0,
isDelete tinyint default 0,

sharedPeople text default null,

constraint fk_notebookid_userid foreign key (userid) references  `user`(userid)
);

create table note (
noteid int primary key,
userid int not null,
content text not null,
createTime timestamp not null default current_timestamp,
updateTime timestamp not null default current_timestamp on update current_timestamp,
markid int default null,
notebookid int default null,
remindTime timestamp default 0,
isStart tinyint not null,
isShare tinyint default 0,
isDelete tinyint default 0,

sharedPeople text default null,

constraint fk_noteid_notebookid foreign key(notebookid) references notebook(notebookid),
constraint fk_noteid_markid foreign key (markid) references mark(markid),
constraint fk_noteid_userid foreign key (userid) references  `user`(userid)
);

create table `comment` (
commentid int primary key,
userid int not null,
noteid int not null,
content text not null,
filename text default null,
ext text default null,
`type` text default null,
filepath text default null, 

constraint fk_commentid_userid foreign key (userid) references  `user`(userid),
constraint fk_commentid_noteid foreign key (noteid) references  note(noteid)
);



