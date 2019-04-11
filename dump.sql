create schema if not exists crud_db collate latin1_swedish_ci;

create table if not exists products
(
	id int auto_increment
		primary key,
	title varchar(225) not null,
	description text not null
);

create table if not exists users
(
	id int(10) auto_increment
		primary key,
	email varchar(255) not null,
	password varchar(255) not null,
	constraint users_email_uindex
		unique (email)
);

