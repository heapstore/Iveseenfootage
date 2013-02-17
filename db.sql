create table `photos_list` (
  `id` mediumint(16) unsigned NOT NULL auto_increment,
  `page_number` smallint(8) unsigned NOT NULL,
  `photo_filename` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`id`)
);

create table `member_fav` (
  `id` mediumint(16) unsigned NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
   `member_name` varchar(32)  NOT NULL default '',
  `photo_filename` varchar(64) NOT NULL default '',
  `photo_fullpath` varchar(128) NOT NULL default '',
  PRIMARY KEY  (`id`)
) CHARSET=utf8;

insert into member_fav (member_id, member_name, photo_filename) values('".intval($_COOKIE['id'])."' ,'".$userdata['id']."', '".$pic['name']."');

CREATE TABLE `members` (
  `id` int(11) NOT NULL auto_increment,
  `usr` varchar(32)  NOT NULL default '',
  `pass` varchar(32)  NOT NULL default '',
  `usr_hash` varchar(32) NOT NULL, 
  `email` varchar(255)  NOT NULL default '',
  `regIP` varchar(15) NOT NULL default '',
  `dt` datetime NOT NULL default '0000-00-00 00:00:00',
   `last_visit` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `usr` (`usr`)
) CHARSET=utf8;

create table photo_tags (
 `id` int(12) NOT NULL auto_increment,
 `photo_id` mediumint(16) unsigned NOT NULL,
 `tag` varchar(32)  NOT NULL default '',
 PRIMARY KEY  (`id`)
) CHARSET=utf8;

select * from photos_list order by rand() limit 1;
sudo mysqldump -u kanye -P 3306 -h heapstore.ru -p heapstore_db > dump_heapstore_db.txt
select photo_filename from photos_list order by id desc limit 50;

/*JOIN*/
select usr,member_sum_rating from members,car_expert_price where members.usr=car_expert_price.expert_name;

ALTER TABLE table_things DROP col_stuff;
ALTER TABLE `photos_list` ADD  `date_added` datetime NOT NULL default '0000-00-00 00:00:00';


select * from  photos_list as t1 left join photo_tags as t2 on t1.id=t2.photo_id  order by t1.id desc limit 0,10;  

/* tagged view*/
select date_added,page_number,photo_filename from photos_list join photo_tags on photos_list.id=photo_tags.photo_id where photo_tags.tag='gif' order by photos_list.id desc;

set @cnt:=0; select @cnt:=@cnt+1,  id,tag from photo_tags where photo_id=3264;

/* tag count*/
select tag,COUNT(*) as count  from photo_tags group by tag order by count desc;

select * from photos_list order by rand() limit 5;
