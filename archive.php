<html>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<head>
<title>Heapstore - Archive</title>
<base href="http://heapstore.ru/"/>
<link rel="icon" type="image/png" href="img/favicon.png">
<link rel="stylesheet" type="text/css" href="/main.css">
<link href='http://fonts.googleapis.com/css?family=Diplomata+SC' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lobster+Two:400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Mate+SC' rel='stylesheet' type='text/css'>

<link rel="stylesheet" type="text/css" href="css/paginator3000.css" />
<script type="text/javascript" src="js/paginator3000.js"></script>

<style>
.img-archive{
	width: 20%;
position: relative;
overflow: hidden;
max-height: 246px;
float: left;
}
.img-archive img{border-radius: 50%;}




.top{
width:20%;
margin-top: 18px;
margin-bottom: 18px;
}
.top a{font-size: 16px; margin-left: 3%;}
.top img {margin-left: 5px;}
#total_pages {
position: relative;
top: -142px;
width: 100px;
padding: 10px 10px;
background: 
#EFEEF3;
text-align: right;
color: 
#666;
}
</style>
<base href="http://heapstore.ru/">
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
<div class="top" style="position:fixed;padding: 20px 20px 20px 20px;background: white;z-index:666;">
<!--<a href="/"><img src="/img/eye.png" alt="" width="20" height="20" border="0" hspace="5"></a>-->
<a href="/">Home page</a>
</div>




<?php
mysql_connect("heapstore.ru:3306", "kanye", "bigrat90");
mysql_select_db("heapstore_db");

$max_id = mysql_query("select max(id) from photos_list; ");
$max_id=mysql_fetch_array($max_id);

$step=80;

if($max_id['max(id)'] % $step == 0)
	$number_of_pages=intval($max_id['max(id)'] / $step) ;
else
	$number_of_pages = intval($max_id['max(id)'] / $step) +1;

if( isset($_GET['skip']) )
	{
	$skip_t=(int)$_GET['skip'] - 1;
	$skip=$skip_t * $step;
	}
else $skip=0;

$q_skip = mysql_query("select * from photos_list order by id desc limit $skip,$step ;");

$i=0;
while($skip_photo = mysql_fetch_assoc($q_skip))
			{
			$page_number[$i] = $skip_photo['page_number'];
			$photo_filename[$i] = $skip_photo['photo_filename'];
			$photo_id[$i] = $skip_photo['id'];
			$i++;
			}
$j=0;

	while($j < $i)
	{
		printf("<div class=\"img-archive\">
        		<a href=\"/post/%s\"><img src=\"http://heapstore.ru/storage/%s/%s\" width=480px/></a>
        		</div>
				", $photo_id[$j],$page_number[$j], $photo_filename[$j]);
		$j++;
	}
			
			echo"</br><div class='paginator' id='paginator_example'></div>";
			printf("
				<script type='text/javascript'>
				paginator_example = new Paginator(
				'paginator_example', // id контейнера, куда ляжет пагинатор
				%s, // общее число страниц
				15, // число страниц, видимых одновременно
				%s, // номер текущей страницы
				\"archive/\"
				);
				</script>
			", $number_of_pages,  $skip/$step+1);
			printf("<div id='total_pages'>
			<strong>%s</strong></br>
			<span>photos</span>
			</div>",$max_id['max(id)'] );
			

?>
</br></br></br>
</body>

</html>