<?php
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {

            $code .= $chars[mt_rand(0,$clen)];  
    }
    return $code;

}
?>
<div id="logo"><a href="/" style="border-bottom:0px;"><img src="http://iveseenfootage.com/img/logo_666.png"></a></div>
<div id="menu">

	<div class="menu_container" style="margin-left: -20px;">
	<!--<div class="quadro"></div>-->
	
			<div id="div_first">
			<ul>
				<!--<h2>heapstore</h2>-->
				<li><a href="footage" class="underline" style="background-color: red;">I'VE SEEN FOOTAGE</a></li>
				<li><a href="shuffle" class="underline">Shuffle</a></li>
				<!--<li><a href="best" class="underline">Best of everything</a></li>-->
				<!--<li><a href="trash" class="underline">Trash</a></li>-->
				<!--<li><a  style="text-decoration: line-through" class="underline">My archive</a></li>-->
				<!--<h2>about</h2>-->
				<li><a href="tagged" class="underline">Tagged</a></li>
				<li><a href="about" class="underline">About</a></li>
				
				<li><a href="archive" class="underline">Archive</a></li>
				<li><p style="color:#CFCFCF;"><script type='text/javascript' src='http://st2.freeonlineusers.com/on4.php?id=1230371'> </script> users online</p></li>
			</ul>
			</div>

			
			
			<?php
				if (isset($_COOKIE['id']) and isset($_COOKIE['hash']) )
				{
				echo"<div id='div_third'><ul>";
					mysql_connect("localhost", "kanye", "bigrat90");
					mysql_select_db("heapstore_db");
					$query = mysql_query("SELECT * FROM members WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
					$userdata = mysql_fetch_assoc($query);

					if(($userdata['usr_hash'] !== $_COOKIE['hash']) or ($userdata['id'] !== $_COOKIE['id']))
					{
					/*
						printf("<li><a href='login' class='underline'>Login</a></li>");
						setcookie("id", "", time() - 3600*24*30*12, "/");
						setcookie("hash", "", time() - 3600*24*30*12, "/");
						*/
					}
					else
					{
						mysql_query("UPDATE members SET last_visit=now()  WHERE id='".$userdata['id']."'  ;");
						printf("<li><a href='heapstore' class='underline'>%s</a></li>",$userdata['usr']);
						//printf("<li><div id='drop'><p>Drop image here to add to favourites</div></li>");
						
						
					}
				echo"</ul></div>";
				mysql_close();
				}
				//else echo"<li><a href='login' class='underline'>Login</a></li>";
				
				?>

	</div>
</div> <!-- menu div end -->

<!--<script>

		function cancel(e) {
		  if (e.preventDefault) e.preventDefault(); // required by FF + Safari
		  e.dataTransfer.dropEffect = 'copy'; // tells the browser what drop effect is allowed here
		  return false; // required by IE
		}

		function entities(s) {
		  var e = {
			'"' : '"',
			'&' : '&',
			'<' : '<',
			'>' : '>'
		  };
		  return s.replace(/["&<>]/g, function (m) {
			return e[m];
		  });
		}

		var getDataType = document.querySelector('#text');
		var drop = document.querySelector('#drop');

		// Tells the browser that we *can* drop on this target
		addEvent(drop, 'dragover', cancel);
		addEvent(drop, 'dragenter', cancel);

		addEvent(drop, 'drop', function (e) {
		  if (e.preventDefault) e.preventDefault(); // stops the browser from redirecting off to the text.
			
			/*MY SCRIPT*/
			
			var img_source=e.dataTransfer.getData('Text');
			var xmlString='img_src='+img_source;
			
			if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
				 xmlhttp.onreadystatechange=function()
				{
					  if (xmlhttp.readyState==4 && xmlhttp.status==200)
						{
						document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
						}
				}
			xmlhttp.open("GET","user_add_to_fav.php?q="+img_source,true);
			xmlhttp.send();
			
		  /*MY SCRIPT END*/
		  
		 /*s var ul = drop.querySelector('ul');

		  if (ul.firstChild) {
			ul.insertBefore(li, ul.firstChild);
		  } else {
			ul.appendChild(li);
		  }*/
		  
		  return false;
		});
</script>-->
