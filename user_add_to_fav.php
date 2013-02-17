<?php 
$q=$_GET["q"];
	
	require 'db_user.php';
	
	
	if(getimagesize ($q)!=NULL)
	{

	
		$q_name=basename($q);
		$query = mysql_query("insert into member_fav (member_id, member_name, photo_filename,photo_fullpath) values('".$userdata['id']."','".$userdata['usr']."', '".$q_name."' ,'".$q."');");
	}
	
	mysql_close();


?>