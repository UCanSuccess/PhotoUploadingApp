<?php 

include_once($_SERVER['DOCUMENT_ROOT'].'/wp-config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-includes/wp-db.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-includes/pluggable-deprecated.php');

$username = $_POST['email']; $password=$_POST['password'];

	_deprecated_function( __FUNCTION__, '2.5.0', 'wp_signon()' );
	global $error;

	$user = wp_authenticate($username, $password);

	if ( ! is_wp_error($user) ){
		if ($user->wp_capabilities['editor']==1){
			$role = 1;
		}
		else if ($user->wp_capabilities['subscriber']==1){
			$role = 0;
		}

		$query = $wpdb->prepare("SELECT * FROM wp_photo_users WHERE user_id='".$user->ID."'",'');
		$result = $wpdb->get_results($query);
		if (!isset($result[0]->user_id)){
			$name = $user->first_name." ".$user->last_name;
			$query = $wpdb->prepare("INSERT INTO wp_photo_users (user_id, name, email, first_name, last_name, role) VALUES ('".$user->ID."', '".$name."', '".$user->user_email."', '".$user->first_name."', '".$user->last_name."', '".$role."')",'');
			$insert_result = $wpdb->get_results($query);
		}

		$_SESSION['photo_user'] = $user->ID;
		$_SESSION['role'] = $role;

		echo json_encode(array('id'=>$user->ID,'role'=>$role));
		return;
	}

	echo json_encode(array('result'=>'fail', 'error'=>$user->get_error_message()));

?>
