<?php
global $mk_options;

$mk_footer_class = $show_footer = $disable_mobile = $footer_status = '';

$post_id = global_get_post_id();
if($post_id) {
  $show_footer = get_post_meta($post_id, '_template', true );
  $cases = array('no-footer', 'no-header-footer', 'no-header-title-footer', 'no-footer-title');
  $footer_status = in_array($show_footer, $cases);
}

if($mk_options['disable_footer'] == 'false' || ( $footer_status )) {
  $mk_footer_class .= ' mk-footer-disable';
}

if($mk_options['footer_type'] == '2') {
  $mk_footer_class .= ' mk-footer-unfold';
}


$boxed_footer = (isset($mk_options['boxed_footer']) && !empty($mk_options['boxed_footer'])) ? $mk_options['boxed_footer'] : 'true';
$footer_grid_status = ($boxed_footer == 'true') ? ' mk-grid' : ' fullwidth-footer';
$disable_mobile = ($mk_options['footer_disable_mobile'] == 'true' ) ? $mk_footer_class .= ' disable-on-mobile'  :  ' ';
require_once( "modal_display.php");
?>

<section id="mk-footer" class="<?php echo $mk_footer_class; ?>" <?php echo get_schema_markup('footer'); ?> style="background-color: white;">

    <link rel="stylesheet" id="font-awesome-css" href="http://localhost/wp-content/plugins/js_composer_theme/assets/lib/bower/font-awesome/css/font-awesome.min.css?ver=5.1.1" type="text/css" media="all">
    <div class="footer-bar">
		<div class="footer-item streams">
			<a href="http://localhost/streams">
				<div class="vc_icon_element-inner">
					<img src="http://localhost/wp-content/uploads/bfi_thumb/stream.png">
				</div>
				<p class = "footer-text">STREAMS</p>
			</a>
		</div>

		<div class="footer-item groups">
			<a href="http://localhost/groups">
				<div class="vc_icon_element-inner">
					<img src="http://localhost/wp-content/uploads/bfi_thumb/group.png">
				</div>
				<p class = "footer-text">GROUPS</p>
			</a>
		</div>

		<div class="footer-item camera">
			<a href="http://localhost/camera">
				<div class="vc_icon_element-inner">
					<img src="http://localhost/wp-content/uploads/bfi_thumb/camera.png">
				</div>
				<p class = "footer-text">CAMERA</p>
			</a>
		</div>

		<div class="footer-item setting">
			<a href = "http://localhost/setting">
				<div class="vc_icon_element-inner">
					<img src="http://localhost/wp-content/uploads/bfi_thumb/setting.png">
				</div>
				<p class="footer-text">SETTING</p>
			</a>
		</div>
        
    </div>
</section>

<section id="sub-mk-footer" style="display:none;">
	<div class="footer-bar">
		<div class="favorite-cancel sub-footer-cancel">CANCEL</div>
		<div class="favorite-add sub-footer-add">ADD TO</div>
		<div class="favorite-delete sub-footer-recyle"><img src="http://localhost/wp-content/uploads/bfi_thumb/recycle-bin.png"></div>
	</div>
</section>

<script type="text/javascript" src="http://localhost/wp-content/themes/jupiter/assets/js/modal.js"></script>
<script type="text/javascript" src="http://localhost/wp-content/themes/jupiter/assets/js/sub_modal.js"></script>
<script type="text/javascript" src="http://localhost/wp-content/themes/jupiter/assets/js/modal_process.js"></script>
<script type="text/javascript"> 
	jQuery(document).ready(function(){
		console.log(sessionStorage);
		//--modal
		jQuery('.modal').hide();
		jQuery('.modal-container').hide();
		jQuery('.subscriber-modal').hide();
		jQuery('.image-upload').hide();
	});
</script>

</div>
<?php 
    global $is_header_shortcode_added;
    
    if ( $mk_options['seondary_header_for_all'] === 'true' || get_header_style() === '3' || $is_header_shortcode_added === '3' ) {
        mk_get_header_view('holders', 'secondary-menu', ['header_shortcode_style' => $is_header_shortcode_added]); 
    }
?>
</div>

<div class="bottom-corner-btns js-bottom-corner-btns">
<?php
    if ( $mk_options['go_to_top'] != 'false' ) { 
        mk_get_view( 'footer', 'navigate-top' );
    }
    
    if ( $mk_options['disable_quick_contact'] != 'false' ) {
        mk_get_view( 'footer', 'quick-contact' );
    }
    
    do_action('add_to_cart_responsive');
?>
</div>


<?php if ( $mk_options['header_search_location'] === 'fullscreen_search' ) { 
    mk_get_header_view('global', 'full-screen-search');
} ?>

<?php if (!empty($mk_options['body_border']) && $mk_options['body_border'] === 'true') { ?>
    <div class="border-body border-body--top"></div>
    <div class="border-body border-body--left border-body--side"></div>
    <div class="border-body border-body--right border-body--side"></div>
    <div class="border-body border-body--bottom"></div>
<?php } ?>

<footer id="mk_page_footer">
    <?php
    
    wp_footer();

    if( (isset($mk_options['pagespeed-optimization']) and $mk_options['pagespeed-optimization'] != 'false')
     or (isset($mk_options['pagespeed-defer-optimization']) and $mk_options['pagespeed-defer-optimization'] != 'false')) {
    ?>
    <script>
        !function(e){var a=window.location,n=a.hash;if(n.length&&n.substring(1).length){var r=e(".vc_row, .mk-main-wrapper-holder, .mk-page-section, #comments"),t=r.filter("#"+n.substring(1));if(!t.length)return;n=n.replace("!loading","");var i=n+"!loading";a.hash=i}}(jQuery);
    </script>
    <?php } else { ?>
    <script>
        // Run this very early after DOM is ready
        (function ($) {
            // Prevent browser native behaviour of jumping to anchor
            // while preserving support for current links (shared across net or internally on page)
            var loc = window.location,
                hash = loc.hash;

            // Detect hashlink and change it's name with !loading appendix
            if(hash.length && hash.substring(1).length) {
                var $topLevelSections = $('.vc_row, .mk-main-wrapper-holder, .mk-page-section, #comments');
                var $section = $topLevelSections.filter( '#' + hash.substring(1) );
                // We smooth scroll only to page section and rows where we define our anchors.
                // This should prevent conflict with third party plugins relying on hash
                if( ! $section.length )  return;
                // Mutate hash for some good reason - crazy jumps of browser. We want really smooth scroll on load
                // Discard loading state if it already exists in url (multiple refresh)
                hash = hash.replace( '!loading', '' );
                var newUrl = hash + '!loading';
                loc.hash = newUrl;
            }
        }(jQuery));
    </script>
    <?php } ?>


    <?php 
    // Asks W3C Total Cache plugin to move all JS and CSS assets to before body closing tag. It will help getting above 90 grade in google page speed.
    if(isset($mk_options['pagespeed-optimization']) and $mk_options['pagespeed-optimization'] != 'false' and defined('W3TC')) {
        echo "<!-- W3TC-include-js-head -->";
        echo "<!-- W3TC-include-css -->";
    }
    ?>
</footer>
<div class="login-modal" style="display:none;text-align:center;">
    <img class="loading" style="display:none;" />
</div>

</body>
</html>