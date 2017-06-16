
<div class="awe-color-palette count-<?php echo count($palette); ?>">

	<div class="palette">
	<?php foreach( $palette as $color ) { ?>
		<div class="color" style="border-radius: 50%;background-color: #<?php echo $color->color_hex; ?>;"><!-- <span>#<?php echo $color; ?></span> --></div>
	<?php } ?>
	</div>

</div>
<script>
jQuery(document).ready(function(){
	var height = parseInt(jQuery('.color').css('height'));
	var width = parseInt(jQuery('.color').css('width'));
	var temp = (height > width)? width-2 : height-2;
	var padding_left = (width - temp)/2 + "px";
	var padding_top = (height - temp)/2 + "px";
	jQuery('.color').css('padding-top',padding_top).css('padding-right',padding_left).css('padding-left',padding_left).css('width',temp+'px').css('height',temp+'px');
	console.log(height);
	console.log(width);
});
</script>
