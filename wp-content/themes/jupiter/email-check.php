<?php
$abs_string_arr = explode("\\", dirname( __FILE__ ));
$admin_url=$abs_string_arr[0].'/'.$abs_string_arr[1].'/wp-load.php';
require_once( $admin_url );
global $wpdb;

	$email = $_POST['email'];

	$sub_id = $wpdb->get_results("SELECT ID FROM wp_users WHERE user_email = '".$email."'");

	if ($sub_id==array() ) {
		echo json_encode(array('mail_error'));
		return;
	}
	else {
		echo json_encode(array($sub_id[0]->ID));
	}

?>