<?php

function connect_to_serv()
{
	$con = mysql_connect('localhost', 'kanye', 'bigrat90');
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("heapstore_db", $con);
	mysql_set_charset( 'utf8' );

	return $con;
}

// load save and return data to javascript
if (isset($_REQUEST['getphotos'])) 
{
	$con = connect_to_serv();
	$arrayJSON = array();
	$sql = "select * from photos_list order by rand() limit 930;";
	$result = mysql_query($sql);

	while ($row = mysql_fetch_assoc($result)) {
		array_push($arrayJSON, $row);


	}

	echo json_encode($arrayJSON);
	mysql_close($con);
}

// load save and return data to javascript
if (isset($_REQUEST['deletephoto'])) 
{
	$pid = $_REQUEST['deletephoto'];

	$con = connect_to_serv();
	$sql = "delete from photos_list where id = '".$pid."';";
	$result = mysql_query($sql);
	mysql_close($con);
}

?>