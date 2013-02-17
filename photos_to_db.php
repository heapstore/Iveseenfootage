

<?php


 function rrmdir($dir) { 
   if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
       } 
     } 
     reset($objects); 
     rmdir($dir); 
   } 
 } 
function test()
{
/*$dir    = 'storage/';
$list = scandir($dir);
rsort($list);

printf("%s", $list[0]);*/

/*
if( !mkdir("storage/testing"))
	{
	
	$error = error_get_last();
    echo $error['message'];
	}*/
	
	/*FILE DELETE*/
	//ftp://www@107.22.184.12/var/www/html/storage/103/batt0%20(11)%20-%20:>?8O.jpg
	
	/*if( !unlink('storage/103/batt0 (5).jpg'))
	{
	$error = error_get_last();
    echo $error['message'];
	}*/
	
	/*if( !rmdir('storage/10000'))
	{
	$error = error_get_last();
    echo $error['message'];
	}*/
	

	

}

function insert_all_photos()
{
	/*connect to db*/

	$dblocation = "heapstore.ru:3306";
	$dbname = "heapstore_db";
	$dbuser = "kanye";
	$dbpasswd = "bigrat90";
	$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
	if (!@mysql_select_db($dbname, $dbcnx))
	{
		echo("<P>В настоящий момент база данных недоступна, поэтому
		корректная работа php-скрипта невозможна.</P>" );
		exit();
	}
	else {
	printf("Starting...");
				/*get photos list*/
					$dir    = 'storage/';
					$list = scandir($dir);
					$count = count($list);
					rsort($list);

					$j=1;
					while($j<$count-1)
					{
						$fdir = "storage/$j/";
						$flist = scandir($fdir);
						rsort($fdir);
						$fcount = count($flist);
						$i=2;
						//printf("</br></br></br></br></br></br>[PAGE: %s]", $j);
							while($i<=$fcount-1)
							{
							//printf("[Photo_number: %s]",$i);
							//printf("[Photo_name: %s]",$flist[$i]);
							$req = mysql_query("insert into photos_list (page_number,  photo_filename) values ('$j',  '$flist[$i]'); ");	
							
							if(!$req)
							{
								echo "<p><b>Error: ".mysql_error()."</b></p>";
								exit();
							}

							//$response = mysql_fetch_array($req);
							
									
							$i++;
							}
						$j++;
						}
						printf("  Insert operation done.");

			}

}

function insert_new_photos($page)
{
	/*connect to db*/

	$dblocation = "heapstore.ru:3306";
	$dbname = "heapstore_db";
	$dbuser = "kanye";
	$dbpasswd = "bigrat90";
	$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
	if (!@mysql_select_db($dbname, $dbcnx))
	{
		echo("<P>В настоящий момент база данных недоступна, поэтому
		корректная работа php-скрипта невозможна.</P>" );
		exit();
	}
	else {
		printf("Starting...");
		$fdir = "storage/$page/";
		$flist = scandir($fdir);
		rsort($fdir);
		$fcount = count($flist);
		$i=2;
		//printf("</br></br></br></br></br></br>[PAGE: %s]", $j);
		while($i<=$fcount-1)
		{
			//printf("[Photo_number: %s]",$i);
			//printf("[Photo_name: %s]",$flist[$i]);
			$i_t=$i-1;
			$req = mysql_query("insert into photos_list (page_number,  photo_filename) values ('$page',  '$flist[$i]'); ");	
			
			if(!$req)
			{
				echo "<p><b>Error: ".mysql_error()."</b></p>";
				exit();
			}

			
					
			$i++;
		}
		printf("  Insert operation done.");
		
	}
}

insert_all_photos();



/*
create table `photos_list` (
  `id` mediumint(16) unsigned NOT NULL auto_increment,
  `page_number` smallint(8) unsigned NOT NULL,
  `page_name` varchar(32) default '',
  `photo_number_on_page` smallint(8) unsigned,
  `photo_tag` varchar(32) default '',
  `photo_filename` varchar(63) NOT NULL default '',
  PRIMARY KEY  (`id`)
);

insert into car_expert_value (username, car_id, expert_value) values('expert1', 1, 250);

insert into photos_list (page_number, photo_number_on_page, photo_filename) values ($, $, $);
grant usage on *.* to kanye identified by 'bigrat90';

grant all privileges on heapstore_db.* to kanye;

*/
?>
 
