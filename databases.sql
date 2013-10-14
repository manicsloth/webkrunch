drop database nordic;
/* removes database from previously running script, database will not actually delete because the csv files are stored in the directory but the tables are cleared and database is emptied*/

create database nordic;

use nordic;

create table members(id int(5) primary key, fname varchar(20), mnames varchar(60), sname varchar(50), address1 varchar(50), address2 varchar(50), address3 varchar(50), town varchar(20), postcode varchar(10),hsform enum('y','n'), workshopcomp date, credits int, hsform varchar(100));

create table walks(id int primary key, location varchar(50), meet varchar(50), directions text, details text, dogs enum('y','n','d'), wtime varchar(10), distance varchar (10), imageurl varchar(100), url varchar(100));

create table dates (wdate date, id int, unqid int primary key, ids varchar (100), walkercount int);


load data infile 'walks.csv' into table walks fields terminated by ';' optionally enclosed by "'";

drop user 'administrator'@'localhost';
drop user 'user'@'localhost';

/* Gets rid of users created through previously running script */

create user 'administrator'@'localhost' identified by PASSWORD '*FF36DBC565BB04E7D8FE1EBED429F801576CD46E';
/* Password hash key entered for security reasons when used in real world applications. Obtained using SELECT PASSWORD('parad1Gm') */
create user 'user'@'localhost' identified by PASSWORD '*5C652FDF58997ABAB33B496B6066287165328BAC';
														/* password n0rDic */

grant all on nordic.* to 'administrator'@'localhost';



grant select, update (wdate, ids, count), insert on nordic.dates to "user"@'localhost';
grant select on nordic.* to 'user'@'localhost';









