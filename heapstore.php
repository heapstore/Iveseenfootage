<html>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<head>
<title>iveseenfootage.com</title>
<link rel="icon" type="image/png" href="img/favicon.png">
<link rel="stylesheet" type="text/css" href="/main.css">
<link href='http://fonts.googleapis.com/css?family=Diplomata+SC' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lobster+Two:400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Mate+SC' rel='stylesheet' type='text/css'>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<script src="http://malsup.github.com/jquery.form.js"></script> 
<script> 
        // wait for the DOM to be loaded 
        $(document).ready(function() { 
		var divstyle = new String();
        divstyle = document.getElementById("settings_updated").style.visibility;
        if(divstyle.toLowerCase()=="visible" || divstyle == "")
        {
            document.getElementById("settings_updated").style.visibility = "hidden";
        }
   
            // bind 'myForm' and provide a simple callback function 
            $('#settings').ajaxForm(function() { 
			document.getElementById("settings_updated").style.visibility = "visible";
                //alert("Your settings are successfully updated"); 
            }); 
        }); 
    </script> 

</head>

<body>


<?php
	require 'menu.php';
?>

<div class='verseright'><a id='logout_link' href='logout'  class='underline'>Logout</a></div>
<div class='verseright' style='margin-top:50px;'>
	<form id="settings" action="pagesettings.php" method="post" >
	<section>Photos per page:</br>
	<select name="photos_on_page" id="photos_on_page"  style="width:60px;">
		<option value="15">15</option>
		<option selected value="30" >30</option>
		<option value="50">50</option>
		<option value="100">100</option>
		<option value="200">200</option>
	</select>
	</section>
	<input type="submit"  value="Apply" style="width:60px;"/>
	</form>
	<div class="set_updated" id="settings_updated">Your settings are updated</div>
</div>

<?php

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']) )
	{
	mysql_connect("heapstore.ru:3306", "kanye", "bigrat90");
	mysql_select_db("heapstore_db");
	$query = mysql_query("SELECT * FROM members WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
	$userdata = mysql_fetch_assoc($query);

	if(($userdata['usr_hash'] !== $_COOKIE['hash']) or ($userdata['id'] !== $_COOKIE['id']))
	{
		printf("<a href='login' class='underline'>What's wrong with cookies? Please login</a>");
		setcookie("id", "", time() - 3600*24*30*12, "/");
		setcookie("hash", "", time() - 3600*24*30*12, "/");
	}
	else //MAIN AREA
	{
		echo"<div class='stuff' >";
		printf("<a href='heapstore' class='underline'>%s</a>",$userdata['usr']);
		echo " </div> ";
		
		//admin heapstore workbench
		if($userdata['id']==1 and $userdata['usr_hash']==$_COOKIE['hash'])
			{
				echo"<div id='dropbox'>
					<span class='message'>Перетащите фотографии сюда для загрузки на сайт<br />
					<i>(фотографии будут добавлены на главную страницу автоматически)</i></span>
				</div>
				<script src='js/jquery.filedrop.js'></script>
				<script src='js/script.js'></script>' ";
			}
		
		$max_id = mysql_query("select max(id) from photos_list; ");
		$max_id=mysql_fetch_array($max_id);
		
		echo"<div class='stuff' >";
		printf("My fav from %s photos",$max_id[0]);
		echo " </div> ";
		
		$photo_query = mysql_query("select photo_fullpath from member_fav where member_id='".$userdata['id']."' and member_name='".$userdata['usr']."' order by id desc; ");
		

		while($photo=mysql_fetch_array($photo_query)) // output photos circle
		{
			echo"<div class='stuff'>";
			echo "<img  src='$photo[0]' ></img>";
			//echo"<div style='margin-top:0px;'><form action='phpscripts/delete_from_fav' method='post'>
			//<input type='submit'  value='&dagger;' /></form></div>";
			echo " </div> ";
		}

		
		
		}
	mysql_close();
}
else printf("<div class='stuff' ><a href='login' class='underline' >What's wrong with cookies? Please login</a></div>");


?>


</body>
</html>