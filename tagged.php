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
		
<!-- Including the HTML5 Uploader plugin -->
<script src="js/jquery.filedrop.js"></script>
<script src="js/h5utils.js"></script>
<script>
function clearText(thefield){
if (thefield.defaultValue==thefield.value)
thefield.value = ""
} 
</script>
</head>

<body>

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
?>



<?php

if(!empty($_GET["t"])) 
	{

	$tag=$_GET["t"];
	mysql_connect("localhost", "kanye", "bigrat90");
	mysql_select_db("heapstore_db");
		$q_tagged = mysql_query("select photos_list.id,date_added,page_number,photo_filename 
													from photos_list join photo_tags on photos_list.id=photo_tags.photo_id 
													where photo_tags.tag='".$tag."' 
													order by photos_list.id desc;");
													
		printf("<div class='center' style=\"margin-top:-20px;\" id=\"shadow\"><div  id='wrapper_center' style=\"position:fixed;\">		
		<div style=\"padding: 20px 20px 20px 20px; background:#FFEDB5;\">
		<a href=\"/tagged\">Tagged</a>: %s
		</div></div></div>",$tag);
	while($tagged = mysql_fetch_assoc($q_tagged))
			{
			
				echo"<div class='center' >";
				printf("<a href='/post/%s'><img id=\"shadow\" src='http://iveseenfootage.com/storage/%s/%s'></img></a>",$tagged['id'],$tagged['page_number'], $tagged['photo_filename']);
				echo"</div>";
				$onpage++;
			}
	mysql_close();
	exit;
	}
	
mysql_connect("localhost", "kanye", "bigrat90");
mysql_select_db("heapstore_db");	
$q_taglist = mysql_query("select tag,COUNT(*) as count  from photo_tags group by tag order by count desc;");
mysql_close($q_taglist);		
echo "<div class='center' style=\"margin-top:-20px;\" id=\"shadow\"><div  id='wrapper_center'>";		
echo"<div style=\"padding:30px;background:white;\"> Top 25 tags</div>";								
echo"<table class=\"chart\"><tbody>";	
$tagcount=1;	
$default_width=95;
$width=0;
$tagsmaxnum=0;
$i=0;

while($taglist_fetch = mysql_fetch_assoc($q_taglist))
{
	$tags[$i]=$taglist_fetch['tag'];
	$count[$i]=$taglist_fetch['count'];
	$i++;
}
//remember number of tags
$number_of_tags=$i;

$i=0;

//lastfm style chatbars
while($i<25)
{
	if($i==0) 
		{ 
			$width=$default_width; 
			$tagsmaxnum= $count[$i]; 
		} 
	else $width=intval($count[$i] / $tagsmaxnum * $default_width ) ;
	
	echo"<tr>";
	printf("<td class=\"positionCell\">%s</td>",$i+1);
	printf("<td class=\"subjectCell\" title=\"\"><div><a  href=\"tagged/%s\">%s</a></div></td>",$tags[$i],$tags[$i]);
	printf("<td class=\"chartbarCell\"><div style=\"width: $width%%;\" class=\"chartbar\"><a href=\"tagged/%s\"><span>%s</span></a></div> </td>",$tags[$i],$count[$i]);
	echo"</tr>";
	$i++;
}
echo"</tbody></table>";				


//tags
$i=0;
echo"<div style=\"padding:30px;\"> All tags</div>
	<div style=\"padding:0px 30px 60px;\"> ";

while($i<$number_of_tags)
{
	printf("<a style=\"margin-right: 7px;\" href=\"tagged/%s\">%s</a> ", $tags[$i],$tags[$i]);
	$i++;
}
echo "</div>
</div></div>";
?>



<!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter14451052 = new Ya.Metrika({id:14451052, webvisor:true}); } catch(e) {} }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/14451052" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
</body>



</html>