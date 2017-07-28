<?php
$abs_string_arr = explode("\\", dirname( __FILE__ ));
$admin_url=$abs_string_arr[0].'/'.$abs_string_arr[1].'/wp-load.php';
require_once( $admin_url );
global $wpdb;

	$name = $_POST['name'];
	$name = implode("_", explode(" ", $name));
	$name = implode("_", explode(",", $name));
	$name = implode("_", explode("'", $name));
	$name = implode("_", explode("\"", $name));
	$name = implode("_", explode("\\", $name));

	$upload = $wpdb -> get_results("SELECT * FROM wp_photo_temp WHERE editor_id='".$_SESSION['photo_user']."' order by id desc");
	$query = $wpdb->prepare("INSERT INTO wp_photo_book (thumbnail,name, user_id) VALUES ('".$upload[0]->url."','".$name."', '".$_SESSION['photo_user']."')",'');
	$user = $wpdb->get_results($query);	

	echo json_encode(array('success'));
?>