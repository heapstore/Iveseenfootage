<html>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<head>
<title>iveseenfootage.com</title>
<base href="http://iveseenfootage.com/"/>
<link rel="icon" type="image/png" href="img/favicon.png">
<link rel="stylesheet" type="text/css" href="/main.css">
<link href='http://fonts.googleapis.com/css?family=Diplomata+SC' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lobster+Two:400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Mate+SC' rel='stylesheet' type='text/css'>

<script src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
<script src="js/jquery.filedrop.js"></script>
<script src="js/h5utils.js"></script>

<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="js/ajax.js"></script>
<script src="http://jquery.offput.ca/js/jquery.timers.js"></script>
<script type="text/javascript" src="js/jquery.timer.js"></script>


<link rel="stylesheet" type="text/css" href="css/paginator3000.css" />
<script type="text/javascript" src="js/paginator3000.js"></script>
<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="http://userapi.com/js/api/openapi.js?49"></script>

<script type="text/javascript">
  VK.init({apiId: 3014045, onlyWidgets: true});

$(document).ready(function() {
  $(window).scroll(function () {
	var offset = $("body").scrollTop(),
	h = $('#logo img').height();

  	$('#menu').css("opacity", 1 - 2*offset/1000);
  	
});
});



</script>

</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter19098340 = new Ya.Metrika({id:19098340,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/19098340" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->



<?php
require 'menu.php';

	mysql_connect("localhost", "kanye", "bigrat90");
	mysql_select_db("heapstore_db");
	
	// Post section
	if( isset($_GET['post']) )
	{
		$post_num=$_GET['post'];
		$getpost_q = mysql_query("select * from photos_list where id='".$post_num."'  ;");
		if(mysql_num_rows($getpost_q) )
		{
		$getpost=mysql_fetch_array($getpost_q);
		printf("<div  id='wrapper_right'>iveseenfootage.com/post/%s</div>", $post_num);
		
		printf("<div class='center' ><img id=\"shadow\" src='http://iveseenfootage.com/storage/%s/%s'></img></div>",$getpost['page_number'], $getpost['photo_filename']);
		}
		else printf("<div class='stuff' >I cannot find this post. Please check my <a href='archive'>archive</a>.</div>",$post_num);

		echo"<div style=\"margin: 100px 20% 2px 20%\"><hr class=\"l1\"></div></br>";
		printf("
			<div style=\"position:relative;top:2px;padding-bottom: 40px;\">
			<table style=\"margin:0 auto;\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"addthis_table\">
			<tbody><tr valign=\"top\">
			<td>
				<div style=\"margin-top: 1px\"><span style=\"float:left;font-size:11px;\">Share this link:</span></div>
			</td>
			<td style=\"padding-left:10!important\">
				<div class=\"fb-like\" data-href=\"iveseenfootage.com/post/%s\" data-send=\"false\" data-layout=\"button_count\" data-width=\"150\" data-show-faces=\"false\" data-font=\"arial\"></div>
			</td>
			<td style=\"padding-left:0!important\">
				<div id=\"vk_like\"></div>
				<script type=\"text/javascript\">
				VK.Widgets.Like(\"vk_like\", {type: \"mini\", height: 20});
				</script>
			</td>
			<td>
			<a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-via=\"DirtyDirtyTrip\">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=\"//platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}}(document,\"script\",\"twitter-wjs\");</script>
			</td>
			</tr>
			</tbody></table>
			</div>
			", $post_num);
		exit;
	}
	
	$max_id = mysql_query("select max(id) from photos_list; ");
	$max_id=mysql_fetch_array($max_id);
	
	if(isset($_POST['tag'] ) and isset($_POST['photo_id']))
		mysql_query("insert into photo_tags (photo_id, tag) 
								values( '".$_POST["photo_id"]."',   '".$_POST["tag"]."' ) ;
								");

	
	if(isset($_COOKIE['view']) and $_COOKIE['view']=='List')
			$step=$_COOKIE['view_n'];
	else $step =15;
		
	//Paginator values calculate
		if($max_id['max(id)'] % $step == 0)
		$number_of_pages=intval($max_id['max(id)'] / $step) ;
	else
		$number_of_pages = intval($max_id['max(id)'] / $step) +1;

	if( isset($_GET['page']) )
		{
		$skip_t=(int)$_GET['page'] - 1;
		$skip=$skip_t * $step;
		}
	else $skip=0;

	$onpage=1; //circle iterator
	
	$q_skip = mysql_query("select * from photos_list order by id desc limit $skip,$step ;");
	
	if($_COOKIE['id']=="1")
		{
		$q_heapstore = mysql_query("SELECT * FROM members WHERE id = 1;");
		$checkheapstore = mysql_fetch_assoc($q_heapstore);
		}
	
	
	
	while($skip_photo = mysql_fetch_assoc($q_skip))
	{
		$p_id=$skip_photo['id'];
		$q_tag = mysql_query(" select tag from photo_tags where photo_id=$p_id;");

		if($checkheapstore['usr_hash'] == $_COOKIE['hash'] and $checkheapstore['usr_hash']!=0)
		{
			echo"<div class='verseright' style='margin-top:100px;'>Tag:";
			echo"<form id='edittags' action='' method='post' >";
			printf("<input name='photo_id' type='hidden' value='%s'/>", $skip_photo['id']);
			echo"<input type='text'  name='tag'/></br>";
			echo"<input type='submit'  value='Apply' style='width:60px;'/>";
			printf("</form><a style='cursor:pointer;' onclick='deletePhoto(%s);'>Удалить фото</a></div>",$skip_photo['id']);
		}
		//show tag
		echo"<p class='verseright' style='padding-top:20px;'>";
	while($p_tag = mysql_fetch_assoc($q_tag))
		{
			printf("<a class='tag' href='tagged/%s'>%s</a>&nbsp ",$p_tag['tag'],$p_tag['tag']);
			
		
		}
		echo"</p>";
		
		
	
		printf("<div class='center' id='%s'>",$skip_photo['id']);
		
		
		printf("<a href='/post/%s'><img id='shadow'  src='http://iveseenfootage.com/storage/%s/%s'></img></a>",$skip_photo['id'],$skip_photo['page_number'], $skip_photo['photo_filename']);
		printf("</div>");
		$onpage++;
	}

echo"</br><div class='paginator' id='paginator_example'></div>";
			printf("
				<script type='text/javascript'>
				paginator_example = new Paginator(\"paginator_example\", %s, 15, %s, \"\");
				</script>
			", $number_of_pages,  $skip/$step+1);
			
	
mysql_close();

?>



<!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter14451052 = new Ya.Metrika({id:14451052, webvisor:true}); } catch(e) {} }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/14451052" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
</body>



</html>