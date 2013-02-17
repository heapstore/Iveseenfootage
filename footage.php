<html>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<head>
<title>iveseenfootage.com</title>
<link rel="icon" type="image/png" href="img/favicon.png">
<link rel="stylesheet" type="text/css" href="/main.css">
<link href='http://fonts.googleapis.com/css?family=Diplomata+SC' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lobster+Two:400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Mate+SC' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Megrim' rel='stylesheet' type='text/css'>

<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="js/ajax.js"></script>
<script src="http://jquery.offput.ca/js/jquery.timers.js"></script>
<script type="text/javascript" src="js/jquery.timer.js"></script>

<style>
.center a{margin: 0 7px;}
.logoes{
margin:30px;
}
.stuff img{max-width:400px;}
.count {width:50%; font-size:340pt; margin-left:200px;font-family: 'Megrim', cursive;}
#backwards {font-size:150pt; text-align: right;}

</style>
<script>

</script>
</head>

<body onload="getPhotos();">
<?php
require 'menu.php';
?>
<div id="photo_container" style="margin:0px; position:absolute;width:80%;margin: -20px 0px 0px 0px;">
<div class="count"></div>
</div>
<div style="float: right;position: relative;z-index: 1;width:500px;">
	<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F61222733&amp;color=ff00fb&amp;auto_play=true&amp;show_artwork=true"></iframe>
	<div id="backwards"></div>
</div>

<script>
var count = 6;
var timer = 
	$.timer(
		function() {
			$('.count').html(--count);
			if(count == 0) timer.pause();
		},
		1000,
		true
	);
</script>

</body>


</html>