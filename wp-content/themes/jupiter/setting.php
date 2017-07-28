<?php 

global $wpdb;
$abs_string_arr = explode("\\", dirname( __FILE__ ));
$admin_url=$abs_string_arr[0].'/'.$abs_string_arr[1].'/wp-load.php';
require_once( $admin_url );
$abs_string = implode("/", $abs_string_arr);

	$password = $_POST['password'];
	$phone_number = $_POST['phone_number'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$name = $first_name."_".$last_name;
	$source_type = $_FILES['image']['type'];
	$type = ".tmp";

	if ( $source_type == "image/jpeg"){	$type = ".jpg";}
	if ( $source_type == "image/png"){ $type = ".png";}
	if ( $source_type == "image/gif"){ $type = ".gif";}
	if ( $source_type == "image/bmp"){ $type = ".bmp";}

	$url = $abs_string."/assets/images/uploads/users/".$name.$type;
	$thumbnail_url = $abs_string."/assets/images/uploads/users/".$name.$type;
	$tar_url = 'http://localhost/wp-content/themes/jupiter/assets/images/uploads/users/'.$name.$type;

	if (move_uploaded_file($_FILES['image']['tmp_name'], $url)) {

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
		$result = $wpdb->query( $wpdb->prepare("UPDATE wp_photo_users SET thumbnail='".$tar_url."' WHERE user_id='".$_SESSION['photo_user']."'", '') );

	
	} else {
	   //echo "Upload failed";
	}

	$result = $wpdb->query( $wpdb->prepare("UPDATE wp_photo_users SET name='".$name."', first_name='".$first_name."', last_name='".$last_name."', password='".$password."', phone_number='".$phone_number."' WHERE user_id='".$_SESSION['photo_user']."'", '') );

header('Location: http://localhost/setting/');
?>
