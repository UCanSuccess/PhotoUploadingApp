<?php 

$abs_string_arr = explode("\\", dirname( __FILE__ ));
$admin_url=$abs_string_arr[0].'/'.$abs_string_arr[1].'/wp-load.php';
require_once( $admin_url );
$abs_string = implode("/", $abs_string_arr);
global $wpdb;

	$book_id = $_POST['book_id'];
	$photos_str=$_POST['photos'];
	$photos_arr=explode(",", $photos_str);

	for ($i= 0; $i < count($photos_arr) ; $i++) {
		$result = $wpdb->query("INSERT INTO wp_book_photo (book_id, photo_id, user_id) VALUES ('".$book_id."', '".$photos_arr[$i]."', '".$_SESSION['photo_user']."')");
	}

	echo json_encode(array('success'));
	  
?>
