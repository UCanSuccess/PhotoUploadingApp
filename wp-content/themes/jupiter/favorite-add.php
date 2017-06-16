<?php
$abs_string_arr = explode("\\", dirname( __FILE__ ));
$admin_url=$abs_string_arr[0].'/'.$abs_string_arr[1].'/'.$abs_string_arr[2].'/wp-load.php';
require_once( $admin_url );
global $wpdb;
if($_POST['fav_ids']){
	foreach ($_POST['fav_ids'] as $key => $photo_id) {
		$sql = $wpdb->prepare('UPDATE `wp_photos` SET `favorite` = 1 WHERE `photo_id` = '.$photo_id, '');
		$wpdb->get_results( $sql );
	}
}

if($_POST['unfav_ids']){
	foreach ($_POST['unfav_ids'] as $key => $photo_id) {
		$sql = $wpdb->prepare('UPDATE `wp_photos` SET `favorite` = 0 WHERE `photo_id` = '.$photo_id, '');
		$wpdb->get_results( $sql );
	}
}


echo json_encode(array('success'));
?>