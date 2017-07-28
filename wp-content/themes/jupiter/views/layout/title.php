<script>var url= location.href;
	var session = sessionStorage.getItem("photo_user");
		if(!session){
			if(!/login/g.test(url))
			location.href = "http://localhost/login";
	}
</script>
<?php

/**
 * template part for Page Title. views/layout
 *
 * @author 		Artbees
 * @package 	jupiter/views
 * @version     5.0.0
 */
global $mk_options;
$align = $title = $subtitle = $shadow_css = '';

$post_id = global_get_post_id();

if (is_singular('product') && $mk_options['woocommerce_single_product_title'] == 'false') return false;

if (is_singular('employees')) return false;

if($view_params['is_shortcode']) return false;

if (mk_get_blog_single_style() == 'bold') return false;


if ($post_id && in_array(get_post_meta($post_id, '_template', true), array(
    'no-title',
    'no-header-title',
    'no-header-title-footer',
    'no-footer-title'
))) {
    return false;
}

if ($post_id && is_page()   &&  $mk_options['page_title_global'] == 'false' ) {
    return false;
}

if ((global_get_post_id() && get_post_meta($post_id, '_enable_slidehsow', true) == 'true') || is_404()) {
    return false;
}


if ($post_id) {
    $custom_page_title = get_post_meta($post_id, '_custom_page_title', true);
    if (!empty($custom_page_title)) {
        $title = $custom_page_title;
    } else {
        $title = get_the_title($post_id);
    }
    $subtitle = get_post_meta($post_id, '_page_introduce_subtitle', true);
    $align    = get_post_meta($post_id, '_introduce_align', true);
} else {
    $title = get_the_title();
}

/* Loads Archive Page Headings */
if (is_archive()) {
    $title = $mk_options['archive_page_title'];
    if (is_category()) {
        $title = single_cat_title('', false);
        $subtitle = strip_tags(category_description());
    } elseif (is_tag()) {
        $subtitle = sprintf(__('Tag Archives for: "%s"', 'mk_framework'), single_tag_title('', false));
    } elseif (is_day()) {
        $subtitle = sprintf(__('Daily Archive for: "%s"', 'mk_framework'), get_the_time('F jS, Y'));
    } elseif (is_month()) {
        $subtitle = sprintf(__('Monthly Archive for: "%s"', 'mk_framework'), get_the_time('F, Y'));
    } elseif (is_year()) {
        $subtitle = sprintf(__('Yearly Archive for: "%s"', 'mk_framework'), get_the_time('Y'));
    } elseif (is_author()) {
        if (get_query_var('author_name')) {
            $curauth = get_user_by('slug', get_query_var('author_name'));
        } else {
            $curauth = get_userdata(get_query_var('author'));
        }
            $subtitle = sprintf( esc_html__( 'Author Archive for: "%s"', 'mk_framework' ), $curauth->nickname );
    } elseif (is_tax()) {
        $term  = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        $title = $term->name;
        $subtitle = strip_tags($term->description);
    }
    if ($mk_options['archive_disable_subtitle'] == 'false' && get_post_type() == 'post') {
        $subtitle = '';
    }

    // Will add the custom post type archive title in archive loop.
    $custom_archive_title = post_type_archive_title('', false);
    if(get_post_type() != 'post' && !empty($custom_archive_title)) {
         $title =  $custom_archive_title;
    }
}

if (function_exists('is_bbpress') && is_bbpress()) {
    if (bbp_is_forum_archive()) {
        $title = bbp_get_forum_archive_title();
    } elseif (bbp_is_topic_archive()) {
        $title = bbp_get_topic_archive_title();
    } elseif (bbp_is_single_view()) {
        $title = bbp_get_view_title();
    } elseif (bbp_is_single_forum()) {
        
        $forum_id        = get_queried_object_id();
        $forum_parent_id = bbp_get_forum_parent_id($forum_id);
        
        $title = bbp_get_forum_title($forum_id);
    } elseif (bbp_is_single_topic()) {
        $topic_id = get_queried_object_id();
        $title    = bbp_get_topic_title($topic_id);
    } elseif (bbp_is_single_user() || bbp_is_single_user_edit()) {
        
        $title = bbp_get_displayed_user_field('display_name');
    }
}

if (function_exists('is_woocommerce') && is_woocommerce() && !empty($post_id)) {
    ob_start();
    woocommerce_page_title();
    $title = ob_get_clean();
}

if (function_exists('is_woocommerce') && is_woocommerce()) {
    $title = __('Shop', 'mk_framework');

    if (is_archive() || is_singular('product')) {
        $title = (isset($mk_options['woocommerce_category_page_title']) && !empty($mk_options['woocommerce_category_page_title'])) ? $mk_options['woocommerce_category_page_title'] : $title;
    }
    if( is_product_category() ) {
        $title = ($mk_options['woocommerce_use_category_title'] == 'true') ? single_cat_title('', false) :  $title;
    }
    if ( is_product_tag() ) {
        $title = ($mk_options['woocommerce_use_category_title'] == 'true') ? single_tag_title('', false) :  $title;
    }
    if( is_product() ) {
        $title = ($mk_options['woocommerce_use_product_title'] == 'true') ? get_the_title() :  $title;
    }
}

/* Loads Search Page Headings */
if (is_search()) {
    $title     = $mk_options['search_page_title'];
    $subtitle = sprintf(__('Search Results for: "%s"', 'mk_framework'), stripslashes(strip_tags(get_search_query())));
    
    if ($mk_options['search_disable_subtitle'] == 'false') {
        $subtitle = '';
    }
}
if ($mk_options['page_title_shadow'] == 'true') {
    $shadow_css = 'mk-drop-shadow';
}

$align = !empty($align) ? $align : 'left';

/**
 * Filter title / subtitle in the page header.
 *
 * @since 5.5
 *
 * @param string $title / $subtitle
 */
$title    = apply_filters( 'mk_theme_page_header_title', $title );
$subtitle = apply_filters( 'mk_theme_page_header_subtitle', $subtitle );

echo '<section id="mk-page-introduce" class="intro-' . esc_attr( $align ) . '">';
echo '<div class="mk-grid">';
if (!empty($title)) {
    $url = $_SERVER['REQUEST_URI'];
    echo '<a href="http://localhost/" title="Wordpress">
            <img class="mk-desktop-logo dark-logo" title="Just another WordPress site" alt="Just another WordPress site" src="http://localhost/wp-content/uploads/2017/05/logo.png" style="width:35px;float:left;padding-right:30px;"></a>';
    if(preg_match("/category/", $url))
    {
        $match = preg_split('/category\//', $url );
        //header('Location: http://localhost/category');
        //print_r( $match );
        
        global $stream_id;
        $stream_id = $match[1];

		global $wpdb;
		$sql = $wpdb->prepare('select * from wp_streams where id='.$stream_id, '');
		$stream_info = $wpdb->get_results( $sql );?>

		<div class="page-title category-image">
			<img src="<?php echo $stream_info[0]->thumbnail;?>" class="profile_image_" style="width:35px;border-radius:50%"/>
		</div>
		<div class="category-title">
			<font style="font-size:24px;"><?php echo  $stream_info[0]->name; ?></font>
		</div>
		<div class="header-menu">
			<a href="http://localhost/setting"><h1 class="page-title photo-header"> Setting </h1></a>
			<a href="http://localhost/camera"><h1 class="page-title photo-header"> Camera </h1></a>
			<a href="http://localhost/groups"><h1 class="page-title photo-header"> Groups </h1></a>
			<a href="http://localhost/streams"><h1 class="page-title photo-header title_blue"> Streams </h1></a>
		</div>
		<img src="http://localhost/wp-content/uploads/bfi_thumb/header-setting.png" id="header-setting" class="add-photo">
	<?php }
    
    if(preg_match("/photos/", $url))
    {
        $match = preg_split('/photos\//', $url );
        
        global $category_id;
        $category_id = $match[1];

        global $wpdb;
        $sql = $wpdb->prepare('select * from wp_photo_category where category_id='.$category_id, '');
        $category_info = $wpdb->get_results( $sql );
        //print_r($user_info);
        echo '<h1 class="page-title vc_col-sm-6 ' . esc_attr( $shadow_css ) . '" style="padding:0;width:50%;text-align:left;float:left;margin:0;font-size:32px;letter-spacing:0;"><img src="' . $category_info[0]->thumbnail . '" class="profile_image_" style="width:10%;border-radius:50%;"/>&nbsp;&nbsp;' . esc_html( $category_info[0]->name ) . '</h1>';
        
        echo '
            <img src="http://localhost/wp-content/uploads/bfi_thumb/header-setting.png" id="header-setting" style="margin-left: 58px;">
            ';
    }

    if(preg_match("/detail/", $url))
    {
        if(preg_match("/subscriber/", $url))
        {
            $match = preg_split('/detail\//', $url );

            global $stream_info;
            $stream_id = $match[1];

            global $wpdb;
            $sql = $wpdb->prepare('UPDATE `wp_streams` SET `visit_count` = `visit_count` + 1 WHERE `id` = '.$stream_id, '');
            $wpdb->get_results( $sql );

            // $sql = $wpdb->prepare('SELECT * from wp_photos where photo_id='.$photo_id, ''); 
            // $photo_info = $wpdb->get_results( $sql );

            // $stream_id = $photo_info[0]->stream_id;

            $sql = $wpdb->prepare('SELECT * from wp_streams where id='.$stream_id, ''); 
            $stream_info = $wpdb->get_results( $sql );?>
			<div class="stream-info">
				<div class="stream-info-image">
					<img class="profile_image sub-detail" src= "<?php echo $stream_info[0]->thumbnail; ?>"/>
				</div>
				<div style="clear:both;"></div>
				<div class="stream-info-text">
					<?php echo $stream_info[0]->name;?>
				</div>
			</div>

            
            <img src="http://localhost/wp-content/uploads/bfi_thumb/header-setting.png" id="header-setting" class="header_setting" style="position: absolute;right: 20px;top: 20px;">
        
        <?php }
        else
        {
            $match = preg_split('/detail\//', $url );
            
            global $photo_info;
            global $stream_info;
            $photo_id = $match[1];

            global $wpdb;
            $sql = $wpdb->prepare('UPDATE `wp_photos` SET `visit_count` = `visit_count` + 1 WHERE `photo_id` = '.$photo_id, '');
            $wpdb->get_results( $sql );

            $sql = $wpdb->prepare('SELECT * from wp_photos where photo_id='.$photo_id, ''); 
            $photo_info = $wpdb->get_results( $sql );

            $stream_id = $photo_info[0]->stream_id;

            $sql = $wpdb->prepare('SELECT * from wp_streams where id='.$stream_id, ''); 
            $stream_info = $wpdb->get_results( $sql );?>
            
            <img class="profile_image sub-detail" src= "<?php echo $photo_info[0]->thumbnail; ?>"/>
			<div class="category-title">
				<font style="font-size:24px;"><?php echo  $stream_info[0]->name; ?></font>
			</div>

			<div class="header-menu">
				<a href="http://localhost/setting"><h1 class="page-title photo-header"> Setting </h1></a>
				<a href="http://localhost/camera"><h1 class="page-title photo-header"> Camera </h1></a>
				<a href="http://localhost/groups"><h1 class="page-title photo-header"> Groups </h1></a>
				<a href="http://localhost/streams"><h1 class="page-title photo-header title_blue"> Streams </h1></a>
			</div>
            
            <img src="http://localhost/wp-content/uploads/bfi_thumb/header-setting.png" id="header-setting" class="header_setting">
        <?php }
    }
    
    if (preg_match("/streams/", $url)) {?>
			<div class="header-menu">
				<a href="http://localhost/setting"><h1 class="page-title photo-header"> Setting </h1></a>
				<a href="http://localhost/camera"><h1 class="page-title photo-header"> Camera </h1></a>
				<a href="http://localhost/groups"><h1 class="page-title photo-header"> Groups </h1></a>
				<a href="http://localhost/streams"><h1 class="page-title photo-header title_blue"> Streams </h1></a>
			</div>
			<img src="http://localhost/wp-content/uploads/bfi_thumb/header-setting.png" id="header-setting">
    <?php }

	if (preg_match("/groups/", $url))
	{
	    
	    if (is_singular('product')) {
	        echo '<h2 class="page-title vc_col-sm-6 ' . esc_attr( $shadow_css ) . '" style="padding:10px;width:75%;text-align:center;float:left;margin:0;">' . esc_html( $title ) . '</h2>';
	    }
	    else {?>
			<div class="header-menu">
				<a href="http://localhost/setting"><h1 class="page-title photo-header"> Setting </h1></a>
				<a href="http://localhost/camera"><h1 class="page-title photo-header"> Camera </h1></a>
				<a href="http://localhost/groups"><h1 class="page-title photo-header title_blue"> Groups </h1></a>
				<a href="http://localhost/streams"><h1 class="page-title photo-header"> Streams </h1></a>
			</div>
	   <?php }?>
        <img src="http://localhost/wp-content/uploads/bfi_thumb/header-setting.png" class="header-groups" id="header-setting">
	<?php }
	if (preg_match("/group_sel/", $url))
	{
	    
	    if (is_singular('product')) {
	        echo '<h2 class="page-title vc_col-sm-6 ' . esc_attr( $shadow_css ) . '" style="padding:10px;width:75%;text-align:center;float:left;margin:0;">' . esc_html( $title ) . '</h2>';
	    }
	    else {?>
			<div class="header-menu">
				<a href="http://localhost/setting"><h1 class="page-title photo-header"> Setting </h1></a>
				<a href="http://localhost/camera"><h1 class="page-title photo-header"> Camera </h1></a>
				<a href="http://localhost/groups"><h1 class="page-title photo-header title_blue"> Groups </h1></a>
				<a href="http://localhost/streams"><h1 class="page-title photo-header"> Streams </h1></a>
			</div>
	   <?php }?>
	    <img src="http://localhost/wp-content/uploads/bfi_thumb/header-setting.png" class="add-stream-group" id="header-setting">
	<?php }

	if (preg_match("/setting/", $url))
	{
	    if (is_singular('product')) {
	        echo '<h2 class="page-title vc_col-sm-6 ' . esc_attr( $shadow_css ) . '" style="padding:10px;width:75%;text-align:center;float:left;margin:0;">' . esc_html( $title ) . '</h2>';
	    }
	    else {?>
			<div class="header-menu">
				<a href="http://localhost/setting"><h1 class="page-title photo-header title_blue"> Setting </h1></a>
				<a href="http://localhost/camera"><h1 class="page-title photo-header"> Camera </h1></a>
				<a href="http://localhost/groups"><h1 class="page-title photo-header"> Groups </h1></a>
				<a href="http://localhost/streams"><h1 class="page-title photo-header"> Streams </h1></a>
			</div>
	   <?php }?>
	    <img src="http://localhost/wp-content/uploads/bfi_thumb/header-setting.png" class="add-stream-group" id="header-setting">
	<?php }

    if (preg_match("/camera/", $url))
    {
        if (is_singular('product')) {
            echo '<h2 class="page-title vc_col-sm-6 ' . esc_attr( $shadow_css ) . '" style="padding:10px;width:75%;text-align:center;float:left;margin:0;">' . esc_html( $title ) . '</h2>';
        }
        else {?>
            <div class="header-menu">
                <a href="http://localhost/setting"><h1 class="page-title photo-header"> Setting </h1></a>
                <a href="http://localhost/camera"><h1 class="page-title photo-header title_blue"> Camera </h1></a>
                <a href="http://localhost/groups"><h1 class="page-title photo-header"> Groups </h1></a>
                <a href="http://localhost/streams"><h1 class="page-title photo-header"> Streams </h1></a>
            </div>
       <?php }?>
        <img src="http://localhost/wp-content/uploads/bfi_thumb/header-setting.png" class="add-stream-group" id="header-setting">
    <?php }

	if (preg_match("/sub_stream/", $url) || preg_match("/sub_book/", $url)) {?>
			<div class="header-menu sub-title">
				<?php if (preg_match("/sub_stream/", $url)) echo "Stream"; else echo "Book";?>
			</div>
			<img src="http://localhost/wp-content/uploads/bfi_thumb/header-setting.png" id="header-setting">
	<?php }

}

if (!empty($subtitle)) {
    echo '<div class="page-subtitle">';
    echo esc_html( $subtitle );
    echo '</div>';
}
if ($mk_options['disable_breadcrumb'] == 'true') {
    if (get_post_meta($post_id, '_disable_breadcrumb', true) != 'false') {
        
        mk_get_view('layout', 'breadcrumb');
    }
}

echo '<div class="clearboth"></div></div></section>';
