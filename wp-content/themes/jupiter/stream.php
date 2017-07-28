<?php 

$abs_string_arr = explode("\\", dirname( __FILE__ ));
$admin_url=$abs_string_arr[0].'/'.$abs_string_arr[1].'/wp-load.php';
require_once( $admin_url );
$abs_string = implode("/", $abs_string_arr);
global $wpdb;

if($_POST['name']){
	$name = $_POST['name'];
	$name = implode("_", explode(" ", $name));
	$name = implode("_", explode(",", $name));
	$name = implode("_", explode("'", $name));
	$name = implode("_", explode("\"", $name));
	$name = implode("_", explode("\\", $name));
	$email = $_POST['email'];
	$sub_id = $_POST['sub_id'];

	$query = $wpdb->prepare("SELECT * FROM wp_users WHERE user_email='".$_POST['email']."'",'');
	$user = $wpdb->get_results($query);

	if ($user) {
		$upload = $wpdb -> get_results("SELECT * FROM wp_photo_temp WHERE editor_id='".$_SESSION['photo_user']."' order by id desc");

		$result = $wpdb->query("INSERT INTO wp_streams (name, thumbnail, color_id , editor_id, subscriber_id) VALUES ('".$name."', '".$upload[0]->url."', '".$_POST['color']."', '".$_SESSION['photo_user']."', '".$user[0]->user_id."')");
		echo json_encode(array('success'));
	}
	else {
		echo json_encode(array('NO EXIST SUBSCRIBER.'));
	}
}
else
{

	$flag=0; $streams_arr=array();
	foreach ($_POST as $key => $value) {
		if (strstr($key,"streams")){
			$streams_arr[$flag++] = $value;
		}
	}
		
	$upload = $wpdb -> get_results("SELECT * FROM wp_photo_temp WHERE editor_id='".$_SESSION['photo_user']."' order by id desc");
	print_r($upload[0]->url);

	$moment = date('Y-m-d H:i:s');

	for ($i= 0; $i < $flag; $i++) { 
		$sub_id = $wpdb -> get_results("SELECT * FROM wp_streams WHERE id='".$streams_arr[$i]."'");
		$result = $wpdb->query("INSERT INTO wp_photos (stream_id, thumbnail, created_at, subscriber_id, file_name) VALUES ('".$streams_arr[$i]."', '".$upload[0]->url."', '".$moment."', '".$sub_id[0]->subscriber_id."', '".$upload[0]->file_name."')");
	}

	echo json_encode(array('success'));
	  
}


//echo json_encode(array($_POST['name']));
?>
