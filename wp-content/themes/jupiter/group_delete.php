<?php 

$abs_string_arr = explode("\\", dirname( __FILE__ ));
$admin_url=$abs_string_arr[0].'/'.$abs_string_arr[1].'/wp-load.php';
require_once( $admin_url );
global $wpdb;

	$streams_arr=explode(",", $_POST['streams']);
	//print_r($streams_arr);

	for ($i=0; $i < count($streams_arr); $i++) { 
		// print_r("INSERT INTO wp_stream_group (stream_id, group_id) VALUES ('".$streams_arr[$i]."', '".$group_id."')");

		$query = $wpdb->prepare("DELETE FROM wp_photo_groups WHERE id='".$streams_arr[$i]."'",'');
		$user = $wpdb->get_results($query);
	}
	// exit;
	echo json_encode(array('success'));
?>
