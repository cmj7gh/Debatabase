create table settings (
       id int unsigned auto_increment primary key,
       `key` tinytext,
       `value` tinytext,
       created datetime default null,
       modified datetime default null
) engine=innodb;

create table users (
       id int unsigned auto_increment primary key,
       first_name tinytext,
       last_name tinytext,
       email tinytext,
       role enum('provie','member','alum','none','officer') default 'none',
       password tinytext,
       created datetime,
       modified datetime
) engine=innodb;

create table provies (
		id int unsigned auto_increment primary key,
		user_id int unsigned,
		service_to_sarge boolean,
		service_to_officer boolean,
		debate_id int unsigned,
		lit_id int unsigned,
		is_active boolean,
		points int unsigned,
		inductions_elligible boolean,
		created datetime,
		modified datetime,
		index(user_id),
		foreign key (user_id) references users(id),
		index(debate_id),
		foreign key (debate_id) references debates(id),
		index(lit_id),
		foreign key (lit_id) references lits(id)
) engine=innodb;

create table meetings (
		id int unsigned auto_increment primary key,
		datetime datetime,
		value int unsigned,
       created datetime,
       modified datetime
) engine=innodb;

create table debates (
		id int unsigned auto_increment primary key,
		meeting_id int unsigned,
		pm_id int unsigned,
		mg_id int unsigned,
		lo_id int unsigned,
		mo_id int unsigned,
		resolution varchar(255),
		votes_gov int unsigned,
		votes_opp int unsigned,
		datetime datetime,
		created datetime,
		modified datetime,
	   	index(meeting_id),
		foreign key (meeting_id) references meetings(id),
		index(pm_id),
		foreign key (pm_id) references users(id),
		index(mg_id),
		foreign key (mg_id) references users(id),
		index(lo_id),
		foreign key (lo_id) references users(id),
		index(mo_id),
		foreign key (mo_id) references users(id)
) engine=innodb;

create table lits (
		id int unsigned auto_increment primary key,
		meeting_id int unsigned,
		user_id int unsigned,
		title varchar(255),
		datetime datetime,
		created datetime,
		modified datetime,
	   	index(meeting_id),
		foreign key (meeting_id) references meetings(id),
		index(user_id),
		foreign key (user_id) references users(id)
) engine=innodb;

create table logs (
       id int unsigned auto_increment primary key,
       user_id int unsigned default 0,
       controller tinytext,
       function tinytext,
       details tinytext,
       theid int unsigned,
       url tinytext,
       data text,
       ipaddr tinytext,
       created datetime,
       index(user_id),
       foreign key (user_id) references users(id)
) engine=innodb;

create table authentications (
       id int unsigned auto_increment primary key,
       user_id int unsigned,
       ipaddr tinytext,
       value tinytext,
       valid boolean,
       created datetime,
       modified datetime,
       index(user_id),
       foreign key (user_id) references users(id)
) engine=innodb;

create table meetings_users (
       id int unsigned auto_increment primary key,
       user_id int unsigned,
       meeting_id int unsigned
) engine=innodb;