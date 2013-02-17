<?php
if($_POST['view']=='List'  )
{
	$onpage=(int)$_POST['photos_on_page'] ;
	setcookie("view", "List", time()+60*60*24*30);
	setcookie("view_n", $onpage, time()+60*60*24*30);
}
if($_POST['view']=='Pages'  )
{
	setcookie("view", "Pages", time()+60*60*24*30);
	setcookie("view_n", "", time()+60*60*24*30);
}
if(isset($_POST['photo_tag']) )
{
	
}
?>