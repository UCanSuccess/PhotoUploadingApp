<?php 

$abs_string_arr = explode("\\", dirname( __FILE__ ));
$admin_url=$abs_string_arr[0].'/'.$abs_string_arr[1].'/wp-load.php';
require_once( $admin_url );
$abs_string = implode("/", $abs_string_arr);


	$photo = $wpdb -> get_results("SELECT MAX(id) FROM wp_photo_temp");
	if (!isset($pthoto)) $photo_id = 1;
	else $photo_id = $photo[0]->ID + 1;
	
	$editor_id = $_SESSION['photo_user'];
	//$name = $_FILES['file']['name'];
	
	$path_info = pathinfo($_FILES['file']['name']);
	$ext = $path_info['extension'];
	$name = $path_info['filename'];
	$name = implode("_", explode(" ", $name));
	$name = implode("_", explode(",", $name));
	$name = implode("_", explode("'", $name));
	$name = implode("_", explode("\"", $name));
	$name = implode("_", explode("\\", $name));
	
	$file_name = $name."_".$photo_id."_".$editor_id.".".$ext;

	$url = $abs_string."/assets/images/uploads/temp_upload/".$file_name;
	$thumbnail_url = $abs_string."/assets/images/uploads/temp_upload/".$file_name;
	$tar_url = "http://localhost/wp-content/themes/jupiter/assets/images/uploads/temp_upload/".$file_name;

	$source_type = $_FILES['file']['type'];
	$type = ".tmp";

	if ( $source_type == "image/jpeg"){	$type = ".jpg";}
	if ( $source_type == "image/png"){ $type = ".png";}
	if ( $source_type == "image/gif"){ $type = ".gif";}
	if ( $source_type == "image/bmp"){ $type = ".bmp";}

	print_r($name.", ".$url); 
	if (move_uploaded_file($_FILES['file']['tmp_name'], $url)) {
		print_r($url);

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

		$result = $wpdb->query("INSERT INTO wp_photo_temp (editor_id, url, file_name) VALUES ('".$_SESSION['photo_user']."', '".$tar_url."', '".$file_name."')");
		print_r($tar_url);

		//echo json_encode(array('success'));
	  
	}

?>
