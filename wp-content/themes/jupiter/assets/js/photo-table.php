<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $wpdb;//WHERE post_type='product'

$book = $_GET[book];

	$photo_id = $wpdb->get_results("SELECT photo_id FROM wp_book_photo WHERE book_id = '".$book."'");

	$photo_result = $wpdb->get_results("SELECT * FROM wp_photos WHERE favorite=1");

	$photo_arr = array(); $n=0;
	foreach ($photo_result as $key => $value) {
		$flag = 0;
		foreach ($photo_id as $id_key => $id_value) {
			if ($value->photo_id == $id_value->photo_id){
				$flag=1; continue;
			}
		}
		if ($flag == 0) $photo_arr[$n++]=$value;
	}
	//print_r($stream_arr);exit;
	echo json_encode(array ('aaData'=>$photo_arr));

?>