<!DOCTYPE html>
<html <?php echo language_attributes();?> >
<head>
    <?php wp_head(); ?>

    <link rel="stylesheet" type="text/css" href="http://localhost/wp-content/plugins/awesome-color-palettes/awesome-color-palettes.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/wp-content/themes/jupiter/assets/stylesheet/dataTables.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/wp-content/themes/jupiter/assets/stylesheet/modal.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/wp-content/themes/jupiter/assets/stylesheet/dropzone.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/wp-content/themes/jupiter/assets/stylesheet/main.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/wp-content/themes/jupiter/assets/stylesheet/sub.css">
	<script type="text/javascript" src="http://localhost/wp-content/themes/jupiter/assets/js/dataTables.js"></script>
	<script type="text/javascript" src="http://localhost/wp-content/themes/jupiter/assets/js/stream_select.js"></script>
	<script type="text/javascript" src="http://localhost/wp-content/themes/jupiter/assets/js/photo_select.js"></script>
	<script src="http://localhost/wp-content/themes/jupiter/assets/js/dropzone.js"></script>
	<script src="http://localhost/wp-content/themes/jupiter/assets/js/form-dropzone.js"></script>
</head>

<body <?php body_class(mk_get_body_class(global_get_post_id())); ?> <?php echo get_schema_markup('body'); ?> data-adminbar="<?php echo is_admin_bar_showing() ?>">

	<?php
		// Hook when you need to add content right after body opening tag. to be used in child themes or customisations.
		do_action('theme_after_body_tag_start');
	?>

	<!-- Target for scroll anchors to achieve native browser bahaviour + possible enhancements like smooth scrolling -->
	<div id="top-of-page"></div>

		<div id="mk-boxed-layout">

			<div id="mk-theme-container" <?php echo is_header_transparent('class="trans-header"'); ?>>

				<?php mk_get_header_view('styles', 'header-'.get_header_style());