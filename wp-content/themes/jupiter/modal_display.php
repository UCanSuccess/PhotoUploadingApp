<div class='modal'>
</div>
	<div class='modal-container stream-modal'>
		<div class='stream-add stream-add-title'>ADD NEW STREAM</div>
		<div class='modal-arrow'>
			<img class='modal-arrow-img' src='http://localhost/wp-content/uploads/bfi_thumb/modal-arrow.png'>
		</div>
		<div class='modal-input name-input'>
			<input type='text' placeholder='Input name'/><font style="font-size:20px;">A</font>
		</div>
		<?php 
			global $wpdb;
			$sql=$wpdb->prepare('select * from wp_colors','');
			$palette=$wpdb->get_results($sql);
		?>

		<div class="awe-color-palette count-<?php echo count($palette); ?>">
			<div class="palette">
				<div class="color-group">
				<?php foreach( $palette as $color ) { ?>
					<div class="palette-color" style="background-color: <?php echo '#'.$color->color_hex; ?>;" data-id="<?php echo $color->id?>"></div>
				<?php } ?>
				</div>
				<div class="palette-custom">CUSTOM</div>
			</div>
		</div>
		<div class="modal-input email-input">
			<input type="text" placeholder="Subscriber email"/>
			<img src="http://localhost/wp-content/uploads/bfi_thumb/email-image.png">
			<input type="hidden" name="email_id" id="email_id">
		</div>
		<div class="stream-delete delete">REMOVE STREAM</div>
		<div class="group-delete delete">REMOVE GROUP</div>
		<div>
			<div class="stream-add add-text">ADD</div>
			<div class="stream-cancel close-text">CLOSE</div>
		</div>
	</div>

<div class='subscriber-modal'>
	<div class='modal-container subscriber-stream-modal'>
		<div class='stream-add' style='text-align:center;padding:15px;border-top-left-radius:11px;'>
			<div>REMOVE STREAMS</div>
			<img src='http://localhost/wp-content/uploads/bfi_thumb/group-modal-arrow.png' style='position:absolute;right:3%;top:-10px;'>
		</div>
		<div class='signout' style='text-align:center;padding:15px;border-bottom-left-radius:11px;border-bottom-right-radius:11px;'>SIGN OUT</div>
	</div>
</div>

	<div class='modal-container select-mode'>
		<div class='modal-arrow'>
			<img class='modal-arrow-img' src='http://localhost/wp-content/uploads/bfi_thumb/modal-arrow.png'>
		</div>
		<div class='web-cam'>TAKE PHOTO NOW</div>
		<div class='upload' style='text-align:center;padding:15px;'>UPLOAD YOUR IMAGE</div>
	</div>
	<div class='image-upload'>
		<div class='image_select' style='width:200px; height:200px;margin:0 auto 20px auto;'>
			<form action='http://localhost/wp-content/themes/jupiter/upload_image.php' class='dropzone' id='my-dropzone'>
			</form>
		</div>
		<div class='connect part'>
			<h4>Select Streams</h4>
			<table class='table table-striped table-bordered table-hover' id='stream_table' name='stream-check'>
				<thead>
					<th>Image</th><th>Name</th><th>Select</th>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<div style='margin-top:40px;'>
			<button class='btn btn-cancel image-upload-btn'>CANCEL</button>
			<button class='btn btn-submit image-upload-btn' style='background-color:#44a9fc;margin-left:20%'>SUBMIT</button>
		</div>
	</div>

<div class="sub-stream-modal modal-container">
	<div class='modal-arrow'>
		<img class='modal-arrow-img' src='http://localhost/wp-content/uploads/bfi_thumb/modal-arrow.png'>
	</div>
	<div class='subitem subitem-stream'>STREAM</div>
	<div class="subelement book-add">
		<div class='book-add-text'>Add new book</div>
		<div id="book-add-name">
			<input type='text' placeholder='Input name'/>
		</div>
		<div class="book-delete">Remove book</div>
		<div class="add-close">
			<div class="book-add-text">Add</div>
			<div class="book-close-text">Close</div>
		</div>
	</div>
	<div class="subelement book-photo-add">Photo Add</div>
	<div class='subitem subitem-book'>BOOK</div>
</div>

<div class="photo-select modal-container">
	<h4 style="background-color:#44a9fc;">Select photos</h4>
	<table class='table table-striped table-bordered table-hover' id='photo_table' name='photo-check'>
		<thead>
			<th>Image</th><th>Name</th><th>Select</th>
		</thead>
		<tbody></tbody>
	</table>
	<div style="clear:both;"></div>
	<div style='margin-top:40px;'>
		<button class='btn btn-cancel image-upload-btn'>CANCEL</button>
		<button class='btn btn-photo image-upload-btn' style='background-color:#44a9fc;margin-left:20%'>SUBMIT</button>
	</div>
</div>
