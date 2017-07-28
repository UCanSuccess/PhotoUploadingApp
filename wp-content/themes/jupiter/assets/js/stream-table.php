<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $wpdb;//WHERE post_type='product'

$group = $_GET['group'];

if ($group == -100 ){
	$result = $wpdb->get_results("SELECT * FROM wp_photo_groups WHERE created_at = '".$_SESSION['photo_user']."'");
	echo json_encode(array('aaData'=>$result));
}
else {
	if ($group > -1){

		$stream_id = $wpdb->get_results("SELECT stream_id FROM wp_stream_group WHERE group_id = '".$group."'");

		$stream_result = $wpdb->get_results("SELECT * FROM wp_streams WHERE editor_id = '".$_SESSION['photo_user']."'");

		$stream_arr = array(); $n=0;
		foreach ($stream_result as $key => $value) {
			$flag = 0;
			foreach ($stream_id as $id_key => $id_value) {
				if ($value->id == $id_value->stream_id){
					$flag=1; continue;
				}
			}
			if ($flag == 0) $stream_arr[$n++]=$value;
		}
		//print_r($stream_arr);exit;
		echo json_encode(array ('aaData'=>$stream_arr));
	}
	else {

		$result = $wpdb->get_results("SELECT * FROM wp_streams WHERE editor_id = '".$_SESSION['photo_user']."'");
		echo json_encode(array('aaData'=>$result));
	}

}


?>