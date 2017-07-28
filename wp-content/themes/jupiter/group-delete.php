<?php
$abs_string_arr = explode("\\", dirname( __FILE__ ));
$admin_url=$abs_string_arr[0].'/'.$abs_string_arr[1].'/wp-load.php';
require_once( $admin_url );

global $wpdb;

$query = $wpdb->prepare("DELETE FROM wp_photo_groups WHERE id='".$_POST['id']."'",'');
$user = $wpdb->get_results($query);	

echo json_encode(array('success'));

?>