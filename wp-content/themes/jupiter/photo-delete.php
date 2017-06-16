<?php
$abs_string_arr = explode("\\", dirname( __FILE__ ));
$admin_url=$abs_string_arr[0].'/'.$abs_string_arr[1].'/'.$abs_string_arr[2].'/wp-load.php';
require_once( $admin_url );
global $wpdb;

if($_POST['del_ids']){
	foreach ($_POST['del_ids'] as $key => $photo_id) {
		$sql = $wpdb->prepare('DELETE FROM `wp_photos` WHERE `photo_id` = '.$photo_id, '');
		$wpdb->get_results( $sql );
	}
}

echo json_encode(array('success'));
?>