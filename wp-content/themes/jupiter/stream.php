<?php 

$abs_string_arr = explode("\\", dirname( __FILE__ ));
$admin_url=$abs_string_arr[0].'/'.$abs_string_arr[1].'/'.$abs_string_arr[2].'/wp-load.php';
require_once( $admin_url );
$abs_string = implode("/", $abs_string_arr);
if($_POST['name']){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$source_type = $_FILES['fileHandler']['type'];
	$type = ".tmp";

	if ( $source_type == "image/jpeg"){	$type = ".jpg";}
	if ( $source_type == "image/png"){ $type = ".png";}
	if ( $source_type == "image/gif"){ $type = ".gif";}
	if ( $source_type == "image/bmp"){ $type = ".bmp";}

	$url = $abs_string."/assets/images/uploads/stream/".$name.$type;
	$thumbnail_url = $abs_string."/assets/images/uploads/stream/".$name.$type;
	$tar_url = 'http://localhost/WordPress-master/wp-content/themes/jupiter/assets/images/uploads/stream/'.$name.$type;

	if (move_uploaded_file($_FILES['fileHandler']['tmp_name'], $url)) {

		$info = getimagesize($url);
		$source_width = $info[0];	$source_height = $info[1];

		switch ($type) {
			case '.png':
				$src_image = imagecreatefrompng($url);
				break;
			case '.gif':
				$src_image = imagecreatefromgif($url);
				break;
			default:
				$src_image = imagecreatefromjpeg($url);
				break;
		}
		$des_ratio = 1;
		
		if ($source_width/$source_height > $des_ratio)
		{
			$src_y = 0; $src_h = $source_height;
			$src_w = (int)($source_height*$des_ratio);
			$src_x = (int)(($source_width - $src_w)/2);
		}
		else 
		{
			$src_x = 0; $src_w = $source_width;
			$src_h = (int)($source_width/$des_ratio);
			$src_y = (int)(($source_height - $src_h)/2);
		}
		$dst_w = 300; $dst_h = 300;
	
		$tar_image = imagecreatetruecolor($dst_w, $dst_h);
		imagecopyresized($tar_image, $src_image, 0, 0, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($tar_image,$thumbnail_url);

		global $wpdb;
		$query = $wpdb->prepare("SELECT * FROM wp_photo_users WHERE email='".$_POST['email']."'",'');
		$user = $wpdb->get_results($query);
		if($user){
			$result = $wpdb->query("INSERT INTO wp_streams (name, thumbnail, color_id , editor_id, subscriber_id) VALUES ('".$name."', '".$tar_url."', '".$_POST['color']."', '".$_SESSION['photo_user']."', '".$user[0]->user_id."')");
			echo json_encode(array('success'));
		}
		echo json_encode(array('NO EXIST SUBSCRIBER'));
	
	} else {
	   echo "Upload failed";
	}
}
else
{
	$source_type = $_FILES['fileHandler']['type'];
	$name = $_FILES['fileHandler']['name'];
	$type = ".tmp";

	if ( $source_type == "image/jpeg"){	$type = ".jpg";}
	if ( $source_type == "image/png"){ $type = ".png";}
	if ( $source_type == "image/gif"){ $type = ".gif";}
	if ( $source_type == "image/bmp"){ $type = ".bmp";}

	$url = $abs_string."/assets/images/uploads/photos/".$name.$type;
	$thumbnail_url = $abs_string."/assets/images/uploads/photos/".$name.$type;
	$tar_url = 'http://localhost/WordPress-master/wp-content/themes/jupiter/assets/images/uploads/photos/'.$name.$type;

	if (move_uploaded_file($_FILES['fileHandler']['tmp_name'], $url)) {



		$info = getimagesize($url);
		$source_width = $info[0];	$source_height = $info[1];

		switch ($type) {
			case '.png':
				$src_image = imagecreatefrompng($url);
				break;
			case '.gif':
				$src_image = imagecreatefromgif($url);
				break;
			default:
				$src_image = imagecreatefromjpeg($url);
				break;
		}
		$des_ratio = 1;
		
		if ($source_width/$source_height > $des_ratio)
		{
			$src_y = 0; $src_h = $source_height;
			$src_w = (int)($source_height*$des_ratio);
			$src_x = (int)(($source_width - $src_w)/2);
		}
		else 
		{
			$src_x = 0; $src_w = $source_width;
			$src_h = (int)($source_width/$des_ratio);
			$src_y = (int)(($source_height - $src_h)/2);
		}
		$dst_w = 600; $dst_h = 600;
	
		$tar_image = imagecreatetruecolor($dst_w, $dst_h);
		imagecopyresized($tar_image, $src_image, 0, 0, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($tar_image,$thumbnail_url);
		
		global $wpdb;
		$moment = date('Y-m-d H:i:s');
		$result = $wpdb->query("INSERT INTO wp_photos (stream_id, thumbnail, created_at) VALUES ('".$_POST['stream_id']."', '".$tar_url."', '".$moment."')");
		echo json_encode(array('success'));
		echo json_encode(array('NO EXIST SUBSCRIBER'));
	  
	} else {
	   echo "Upload failed";
	}
}


//echo json_encode(array($_POST['name']));
?>
