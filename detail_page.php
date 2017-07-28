<?php global $photo_info;global $stream_info;?>

<div class="wpb_row vc_row vc_row-fluid  mk-fullwidth-false  attched-false  js-master-row" style="text-align:center;margin:0!important;background:white;border-top:1px solid;border-bottom:1px solid;padding-left:10px;padding-right:10px;">

	<div class="wpb_column column_container  _ height-full detail_nav_part">
		<img src="http://localhost/wp-content/uploads/bfi_thumb/visit_count.png"><?php echo " ".$photo_info[0]->visit_count;?> places visited
	</div>

	<div class="wpb_column column_container  _ height-full detail_read_part">
		<div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-left">
			<div class="vc_icon_element-inner vc_icon_element-color-blue vc_icon_element-size-md">
				<span class="vc_icon_element-icon fa fa-th photo-view grid-view"></span>
			</div>
		</div>
	</div>

	<div class="wpb_column column_container  _ height-full detail_read_part">
		<div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
			<div class="vc_icon_element-inner vc_icon_element-color-blue vc_icon_element-size-md">
				<span class="vc_icon_element-icon fa fa-list-ul list-view"></span>
			</div>
		</div>
	</div>

	<div class="wpb_column column_container  _ height-full detail_read_part">
		<div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-right">
			<div class="vc_icon_element-inner vc_icon_element-color-blue vc_icon_element-size-md">
				<span class="vc_icon_element-icon fa fa-heart-o favorite-view"></span>
			</div>
		</div>
	</div>
</div>

<div class="wpb_row vc_row-fluid mk-fullwidth-false attched-false js-master-row">
	<?php global $wpdb;
		$sql = $wpdb->prepare("select * from wp_photos where stream_id='".$photo_info[0]->stream_id."' order by created_at desc", '');
		$results = $wpdb->get_results($sql);
		$comp_date = explode(" ",$photo_info[0]->created_at);
		$comp = $comp_date[0];
		$arr = array();
		foreach($results as $key=>$result){
			$dates = explode(" " ,$result->created_at);
			$day = $dates[0];
			if($comp == $day){
				array_push($arr,$result);
			}
		}
		foreach($arr as $key=>$row){
			$date = explode(" ", $row->created_at );
			$day = $date[0];
			$days = explode("-",$day);
			switch($days[1]){
			case "1": $month = "January";break;
			case "2": $month = "February";break;
			case "3": $month = "March";break;
			case "4": $month = "April";break;
			case "5": $month = "May";break;
			case "6": $month = "June";break;
			case "7": $month = "July";break;
			case "8": $month = "August";break;
			case "9": $month = "September";break;
			case "10": $month = "October";break;
			case "11": $month = "November";break;
			case "12": $month = "December";break;
		}
		$display_date = $month." ".$days[2]." ".$days[0];
	?>
	<div class="vc_col-sm-3 wpb_column column_container _ height-full content-image grid"  data-favorite="<?php echo $row->favorite;?>">
		<div class="wpb_single_image wpb_content_element vc_align_left">
			<figure class="wpb_wrapper vc_figure">
				<a class="going-to-location" href = "#">
					<div class="vc_single_image-wrapper vc_box_border_grey">
						<img class="vc_single_image-img attachment-thumbnail" src="<?php echo $row->thumbnail; ?>" srcset=""<?php echo $row->thumbnail?>" 150w, "<?php echo $row->thumbnail?>" 1024w" alt="" width="100%"/>
					</div>	
					<div style="position: absolute;left:16%;bottom: 56px;">
						<img src="http://localhost/wp-content/uploads/bfi_thumb/favorite.png">
					</div>
				</a>
			</figure>
			<div id="text-block-2" class="mk-text-block ">
				<div style="padding-left:15px;color:grey;"><?php echo $display_date;?></div>
			</div>
		</div>
	</div>

	<?php }?>
</div>