<?php 

$abs_string_arr = explode("\\", dirname( __FILE__ ));
$admin_url=$abs_string_arr[0].'/'.$abs_string_arr[1].'/'.$abs_string_arr[2].'/wp-load.php';
require_once( $admin_url );

global $wpdb;
$query = $wpdb->prepare("SELECT * FROM wp_photo_users WHERE email='".$_POST['email']."'",'');
$result = $wpdb->get_results($query);
foreach ($result as $key => $row) {
	if($row->password == $_POST['password']){
		//session_start();
		$_SESSION['photo_user'] = $row->user_id;
		$_SESSION['role'] = $row->role;
		echo json_encode(array('id'=>$row->user_id,'role'=>$row->role));
		return;
	}
	
}
if(!$result){
	echo json_encode(array('result'=>'empty'));
	return;
}
else
echo json_encode(array('result'=>'fail'));

?>
