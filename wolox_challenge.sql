create schema wolox_challenge collate latin1_swedish_ci;

create table user
(
	id int auto_increment
		primary key,
	name varchar(180) null,
	email varchar(180) null,
	image varchar(180) null
);

