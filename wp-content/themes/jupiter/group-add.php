<?php
$abs_string_arr = explode("\\", dirname( __FILE__ ));
$admin_url=$abs_string_arr[0].'/'.$abs_string_arr[1].'/'.$abs_string_arr[2].'/wp-load.php';
require_once( $admin_url );

global $wpdb;

$query = $wpdb->prepare("INSERT INTO wp_photo_groups (thumbnail,label, color) VALUES ('http://localhost/WordPress-master/wp-content/uploads/bfi_thumb/1.png','".$_POST['name']."','".$_POST['color']."')",'');
$user = $wpdb->get_results($query);	

echo json_encode(array('success'));

?>