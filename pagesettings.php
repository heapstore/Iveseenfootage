<?php
if($_POST['photos_on_page']  )
{
$onpage=(int)$_POST['photos_on_page'] ;
setcookie("view", "List", time()+60*60*24*30);
setcookie("view_n", $onpage, time()+60*60*24*30);
}



?>