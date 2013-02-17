<?php
mysql_connect("heapstore.ru:3306", "kanye", "bigrat90");
mysql_select_db("heapstore_db");
$query = mysql_query("SELECT * FROM members WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
$userdata = mysql_fetch_assoc($query);
?>