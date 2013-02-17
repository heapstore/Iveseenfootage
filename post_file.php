<?php
// Helper functions

function exit_status($str){
	echo json_encode(array('status'=>$str));
	exit;
}

function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {

            $code .= $chars[mt_rand(0,$clen)];  
    }
    return $code;
}

function get_extension($file_name){
	$ext = explode('.', $file_name);
	$ext = array_pop($ext);
	return strtolower($ext);
}
// If you want to ignore the uploaded files, 
// set $demo_mode to true;


//let's find latest directory with max number
$dir    = 'storage/';
$list = scandir($dir);
rsort($list);

$fdir = "storage/$list[0]/";
$flist = scandir($fdir);
$fcount = count($flist);

if($fcount==666)
{
	//list[0] - latest directory for now
	$newpage=$list[0]+1;
	if( !mkdir("storage/$newpage")) 
		{
		$error = error_get_last();
		echo $error['message'];
		}
		chmod("storage/$newpage",0775);
}
else $newpage=$list[0];

$upload_dir = "storage/$newpage/";
$allowed_ext = array('jpg','jpeg','png','gif');


if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
	exit_status('Error! Wrong HTTP method!');
}


if(array_key_exists('pic',$_FILES) && $_FILES['pic']['error'] == 0 ){
	
	$pic = $_FILES['pic'];


	if(!in_array(get_extension($pic['name']),$allowed_ext)){
		exit_status('Only '.implode(',',$allowed_ext).' files are allowed!');
	}	
	
	
	$hash = md5(generateCode(6));
	$extension=get_extension($pic['name']);
	$pic['name'] = 'heapstore_'.$hash.'.'. $extension;
	
		$connect=mysql_connect("heapstore.ru:3306", "kanye", "bigrat90");
		mysql_select_db("heapstore_db");
		$query = mysql_query("insert into photos_list (page_number,  photo_filename, date_added) 
												values ('$newpage', '".$pic['name']."', NOW() ); ");
		mysql_close($connect);
	
	
	// Move the uploaded file from the temporary 
	// directory to the uploads folder:
	
	if(move_uploaded_file($pic['tmp_name'], $upload_dir.$pic['name'])){
		chmod($upload_dir.$pic['name'],0775);
		exit_status('File was uploaded successfuly!');
	}
	
}

exit_status('Something went wrong with your upload!');



?>