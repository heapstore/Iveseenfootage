<base href="http://iveseenfootage.com/">
<?php
	mysql_connect("heapstore.ru:3306", "kanye", "bigrat90");
	mysql_select_db("heapstore_db");
	$query_shuf = mysql_query("select id from photos_list order by rand() limit 1;");
	$shuf = mysql_fetch_assoc($query_shuf);
	mysql_close();
	
	$a=$shuf['id'];
	header("Location: /post/$a");
?>
