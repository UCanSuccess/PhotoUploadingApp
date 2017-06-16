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

?>

<section id="mk-footer-unfold-spacer"></section>

<section id="mk-footer" class="<?php echo $mk_footer_class; ?>" <?php echo get_schema_markup('footer'); ?> style="background-color: white;">

    <link rel="stylesheet" id="font-awesome-css" href="http://localhost/WordPress-master/wp-content/plugins/js_composer_theme/assets/lib/bower/font-awesome/css/font-awesome.min.css?ver=5.1.1" type="text/css" media="all">
    <?php if ($_SESSION['role']=='1'){?>
    <div class="wpb_row vc_row-fluid  mk-fullwidth-false  attched-false     js-master-row " style="padding:0;box-shadow:inset 0 1px 0 grey, 0 0 2px 1px grey;">
            
                
        <div class="streams" style="width:25%;float:left;padding:0 auto;height:64px;">
            <a href="http://localhost/WordPress-master/streams" style="cursor: pointer;">
                <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
                    <div class="vc_icon_element-inner vc_icon_element-color-blue vc_icon_element-size-md vc_icon_element-style- vc_icon_element-background-color-grey" style="text-align: center;height:45px;">
                        <!-- <span class="vc_icon_element-icon fa fa-television"></span> -->
                        <img src="http://localhost/WordPress-master/wp-content/uploads/bfi_thumb/stream.png" style="padding-top:18px">
                    </div>
                    <br><font style="font-size: 8px;">STREAMS</font>
                </div>

               <!--  <div style="text-align:center">
                    Streams
                    
                </div> -->
            </a>
        </div>

        <div class="groups" style="width:25%;float:left;height:64px;">
            <a href="http://localhost/WordPress-master/groups" style="cursor: pointer;">
                <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
                    <div class="vc_icon_element-inner vc_icon_element-color-blue vc_icon_element-size-md vc_icon_element-style- vc_icon_element-background-color-grey" style="text-align: center;height:45px;">
                        <!-- <span class="vc_icon_element-icon fa fa-connectdevelop"></span> -->
                        <img src="http://localhost/WordPress-master/wp-content/uploads/bfi_thumb/group.png" style="padding-top:18px">
                    </div><br><font style="font-size: 8px;">GROUPS</font>
                </div>
            </a>
        </div>

        <div class="camera" style="width:25%;float:left;height:64px;">
            <a href="groups" style="cursor: pointer;">
                <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
                    <div class="vc_icon_element-inner vc_icon_element-color-blue vc_icon_element-size-md vc_icon_element-style- vc_icon_element-background-color-grey" style="text-align: center;height:45px;">
                        <!-- <span class="vc_icon_element-icon fa fa-circle-thin"></span> -->
                        <img src="http://localhost/WordPress-master/wp-content/uploads/bfi_thumb/camera.png" style="padding-top:18px">
                    </div><br><font style="font-size: 8px;">CAMERA</font>
                </div>
            </a>
        </div>

        <div class="setting" style="width:25%;float:left;padding:0 auto;height:64px;">
            <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
                <div class="vc_icon_element-inner vc_icon_element-color-blue vc_icon_element-size-md vc_icon_element-style- vc_icon_element-background-color-grey" style="text-align: center;height:45px;">
                    <!-- <span class="vc_icon_element-icon fa fa-square-o"></span> -->
                    <img src="http://localhost/WordPress-master/wp-content/uploads/bfi_thumb/setting.png" style="padding-top:18px">
                </div><br><font style="font-size: 8px;">SETTING</font>
            </div>
        </div>
        
    </div>
    <?php } else {?>
    <div style="width: 100%;height: 52px;background-color: #44a9fc;padding-top:15px;padding-bottom:8px;color:white;">
    <div class="favorite-cancel" style="position: absolute;left:15px;top:15px;">CANCEL</div>
    <div class="favorite-add" style="margin-left:25%;width: 50%;text-align:center;float: left;">ADD TO</div>
    <div class="favorite-delete" style="position: absolute;right: 15px;top:15px;"><img src="http://localhost/WordPress-master/wp-content/uploads/bfi_thumb/recycle-bin.png"></div>
    </div>
    <?php }?>

    <style type="text/css">
        .content-image
        {
            width:50% !important;
            margin-bottom: 0;
            float:left;
            padding-left:20px;
            padding-right:20px;
        }
        .content-image.grid:nth-of-type(2n)
        {
            padding-left:10px;
            padding-right:20px;
        }
        .content-image.grid:nth-of-type(2n+1)
        {
            padding-right:10px;
            padding-left:20px;
        }
        .content-image .caption1
        {
            left:14%;
        }

        .content-image .caption2
        {
            left:25%;
        }
        .content-image.grid:nth-of-type(2n+1) .caption
        {
            left:25%;
        }

        .content-image.grid:nth-of-type(2n) .caption
        {
            left:20%;
        }

        .content-image.grid:nth-of-type(2n+1) .caption1
        {
            left:16%;
        }

        .content-image.grid:nth-of-type(2n) .caption1
        {
            left:10%;
        }

        .content-image.grid:nth-of-type(2n+1) .caption2
        {
            left:28%;
        }

        .content-image.grid:nth-of-type(2n) .caption2
        {
            left:22%;
        }


        .photo-header{
            width:50%;
        }
        
        .theme-page-wrapper .theme-content:not(.no-padding){
            padding:0 !important;
        }
        .wpb_content_element{
            margin-bottom: 0;
        }
        p{
            margin-bottom: 0;
        }
        .hover{
            background-color: #44a9fc;
        }
        #theme-page{
            padding-bottom: 71px!important;
        }
        .photo-view{
            color:#44a9fc !important;    
        }
        .full-image{
            width: 100% !important;
        }
        #header-setting{
            position:absolute;
            right:3%;
            top:23px;
        }
        #mk-theme-container{
            background: #f3f3f3!important;
        }
        body{
            width: 375px!important;
            margin: 0 auto;
        }
        #mk-footer{
            width: 375px!important;
        }
        .theme-page-wrapper{
            padding: 0!important;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="http://localhost/WordPress-master/wp-content/plugins/awesome-color-palettes/awesome-color-palettes.css">
    <script type="text/javascript"> 
        jQuery(document).ready(function(){

            console.log(sessionStorage);
            //--modal

            var url= location.href;
            if(sessionStorage.getItem('role') == 0){
                jQuery('#mk-footer').hide();
            }

            if(/streams/g.test(url) || /category/g.test(url) || /photos/g.test(url) || /detail/g.test(url) )
                jQuery('#mk-footer div.streams').css('background-color', '#44a9fc');
            if(/groups/g.test(url) )
                jQuery('#mk-footer div.groups').css('background-color', '#44a9fc');

            if(/login/g.test(url))
                jQuery('#mk-footer').hide();

            var html = "<div class='modal' style='display:none;background-color: rgba(0,0,0,0.2);position: absolute;top:63px;width:100%;height;100%;'><div class='modal-container' style='margin-top:10px;width:94%;background:#f2f2f2;margin-left:3%;border-radius:11px;color:black;'><div class='stream-add' style='text-align:center;padding:15px;background:#44a9fc;border-top-left-radius:11px;'>ADD NEW STREAM</div><div class='modal-arrow'><img src='http://localhost/WordPress-master/wp-content/uploads/bfi_thumb/modal-arrow.png' style='position:absolute;right:3%;top:-10px;'></div><div class='name-input' style='width:100%;padding:15px;text-align:center;'><input type='text' placeholder='INPUT YOUR NAME' style='border:#f2f2f2;text-align:center;background:#f2f2f2;font-size:14px;padding:0;'/></div>";
            <?php 
                global $wpdb;
                $sql=$wpdb->prepare('select * from wp_colors','');
                $palette=$wpdb->get_results($sql);
                

            ?>

            html +='<div class="awe-color-palette count-<?php echo count($palette); ?>"><div class="palette" style="background-color:rgba(242,242,242,0.6);">';
            <?php foreach( $palette as $color ) { ?>
                html +='<div class="color" style="border-radius: 50%;background-color: #<?php echo $color->color_hex; ?>;" data-id="<?php echo $color->id?>"></div>';
            <?php } ?>
            html += '<div style="font-size:14px;color:black;margin-left:80%;">CUSTOM</div></div></div><div class="email-input" style="border-radius:11px;padding:15px;text-align:center;background-color:#ccc;margin: 0 2%;"><input type="text" placeholder="ENTER EM ALY ADDRESS" style="border:#f2f2f2;text-align:center;background:rgba(204,204,204,0.6);font-size:14px;padding:0;width:80%;color:#999999;opacity: 0.6;"/><img src="http://localhost/WordPress-master/wp-content/uploads/bfi_thumb/email-image.png" style="position: absolute;right: 13%;top: 200px;"></div><div class="stream-cancel" style="text-align:center;padding:15px;">CLOSE</div></div></div>';

            jQuery('#theme-page').append(html);
            
            var html = "<div class='group-modal' style='display:none;background-color: rgba(0,0,0,0.2);position: absolute;top:63px;width:100%;height;100%;'><div class='modal-container' style='margin-top:10px;width:94%;background:#f2f2f2;margin-left:3%;border-radius:11px;color:black;'><div class='stream-add' style='text-align:center;padding:15px;border-top-left-radius:11px;'><div>ADD NEW GROUP</div><img src='http://localhost/WordPress-master/wp-content/uploads/bfi_thumb/group-modal-arrow.png' style='position:absolute;right:3%;top:-10px;'></div><div class='name-input' style='width:100%;padding:15px;text-align:center;'>REMOVE YOUR GROUP</div><div class='signout' style='text-align:center;padding:15px;border-bottom-left-radius:11px;border-bottom-right-radius:11px;'>SIGN OUT</div></div></div>";


            jQuery('#theme-page').append(html);

            var html = "<div class='subscriber-stream-modal' style='display:none;background-color: rgba(0,0,0,0.2);position: absolute;top:63px;width:100%;height;100%;'><div class='modal-container' style='margin-top:10px;width:94%;background:#f2f2f2;margin-left:3%;border-radius:11px;color:black;'><div class='stream-add' style='text-align:center;padding:15px;border-top-left-radius:11px;'><div>REMOVE STREAMS</div><img src='http://localhost/WordPress-master/wp-content/uploads/bfi_thumb/group-modal-arrow.png' style='position:absolute;right:3%;top:-10px;'></div><div class='signout' style='text-align:center;padding:15px;border-bottom-left-radius:11px;border-bottom-right-radius:11px;'>SIGN OUT</div></div></div>";

            jQuery('#theme-page').append(html);

            var html = "<div class='image-upload-modal' style='display:none;background-color: rgba(0,0,0,0.6);position: absolute;width:100%;height;100%;z-index:5;'><div class='modal-container select-mode' style='margin-top:50px;width:60%;background:#f2f2f2;margin-left:20%;border-radius:11px;color:black;'><div class='web-cam' style='text-align:center;padding:15px;background:#44a9fc;border-top-left-radius:11px;border-top-right-radius:11px;'>TAKE PHOTO NOW</div><div class='upload' style='text-align:center;padding:15px;'>UPLOAD YOUR IMAGE</div></div><div class='image-upload' style='display:none;width:70%;background:#f2f2f2;margin-left:15%;border-radius:11px;color:black;position:absolute;top:40px;padding:20px;text-align:center;'><h3 style='text-align:center;'>UPLOAD YOUR IMAGE</h3><hr><br><input type='file' name='image' style=''/><br><br><button class='btn btn-cancel' style='padding: 5px;border-radius: 5px;'>CANCEL</button><button class='btn btn-submit' style='padding: 5px;border-radius: 5px;background-color:#44a9fc;margin-left:20%'>SUBMIT</button></div>";

            jQuery('#theme-page').append(html);

            jQuery('.modal , .image-upload-modal').css('top','63px').css('height',jQuery('#theme-page').css('height'));

            //--modal end

            var width = jQuery(window).width();
            if(jQuery('#wpadminbar').is(':visible'))
            {
                jQuery('#wpadminbar').hide();
                jQuery('body').css('margin-top', parseInt((width-375)/45 -49) + 'px');
            }
            jQuery('.mk-header').css("background-color", "white");
            jQuery('.vc_icon_element').css('margin',0);
            jQuery('#mk-footer').css('border-top','7px solid #eaeaea');
            jQuery('#mk-header-1').prepend("<div style='width:100%;height:6px;background:rgb(68,169,252);'></div>");

            jQuery('#mk-breadcrumbs').hide();

            jQuery('header').css('position','fixed').css('z-index',13).css('width',"375px");
            jQuery('.mk-main-wrapper-holder').css('margin-top','63px');
            jQuery('#mk-footer').css('position','fixed').css('z-index',100);
            jQuery('#mk-footer').css('top',jQuery(window).height()-71 +'px');
            
            if(!/login/g.test(url))
                jQuery('.theme-page-wrapper').css('background','#f3f3f3').css('height',jQuery(window).height() +'px');

            jQuery('.modal , .image-upload-modal, .group-modal, .subscriber-stream-modal').css('top','63px').css('height',jQuery('#theme-page').css('height'));

            jQuery('.group-color div.wpb_single_image').css('height',jQuery('.group-color div.wpb_single_image').width()+'px');
              
            if(sessionStorage.getItem('role') == 0)
            {
                jQuery('#mk-footer').css('height','30px').css('border',0).css('top',jQuery(window).height()-50 +'px');
            }
            

            jQuery(window).on('resize',function(){
                width = jQuery(window).width();
                jQuery('body').css('margin-top', parseInt((width-375)/45 -49) + 'px');
                jQuery('#mk-footer').css('top',jQuery(window).height()-71 +'px');

                jQuery('.group-color div.wpb_single_image').css('height',jQuery('.group-color div.wpb_single_image').width()+'px');

                if(!/login/g.test(url))
                    jQuery('.theme-page-wrapper').css('height',jQuery(window).height() +'px').css('background','#f3f3f3');
                
                jQuery('.modal , .image-upload-modal , .group-modal, .subscriber-stream-modal').css('top','63px').css('height',jQuery('#theme-page').css('height'));
                jQuery('.color-sign').each(function(){
                    jQuery(this).css('right',parseInt(jQuery(this).parents('div.content-image').css('padding-right'))+20+'px');
                });
                
                if(sessionStorage.getItem('role') == 0)
                {
                    jQuery('#mk-footer').css('height','30px').css('border',0).css('top',jQuery(window).height()-50 +'px');
                }

            });
            jQuery('.mk-breadcrumbs-inner.dark-skin').hide();

            jQuery('#header-setting').on('click', function(){

                if(jQuery('.modal').is(':visible') || jQuery('.group-modal').is(':visible') || jQuery('.subscriber-stream-modal').is(':visible') || jQuery('.image-upload-modal').is(':visible'))
                {
                    jQuery('.modal').hide();
                    jQuery('.group-modal').hide();
                    jQuery('.subscriber-stream-modal').hide();
                    jQuery('.image-upload-modal').hide();
                    return;
                }

                if(/groups\/color/g.test(url))
                {
                    jQuery('.mk-header').css('z-index','13');
                    jQuery('.group-modal').fadeIn(500);
                    return;
                }
                if(/subscriber\/detail/g.test(url))
                {
                    
                    jQuery('.group-modal').fadeIn(500);
                    jQuery('.group-modal .stream-add div').html('SELECT PHOTOS');
                    jQuery('.group-modal .name-input').html('REMOVE PHOTOS');   
                    return;
                }

                if(/detail/g.test(url)){
                    return;
                }

                if(jQuery(this).hasClass('add-photo')){
                    jQuery('.image-upload-modal').fadeIn(500);
                    return;
                }
                if(sessionStorage.getItem('role') == 0)
                {
                    jQuery('.mk-header').css('z-index','13');
                    jQuery('.subscriber-stream-modal').fadeIn(500);
                    return;
                }

                jQuery('.mk-header').css('z-index','13');
                jQuery('.modal').fadeIn(500);
                jQuery(this).attr('src','http://localhost/WordPress-master/wp-content/uploads/bfi_thumb/header-setting-active.png');

                
                if(jQuery(this).hasClass('header-groups'))
                {
                    jQuery('.modal .stream-add').html('ADD NEW GROUP').addClass('group-add'); 
                    jQuery('.email-input').hide();  
                }


                else
                {
                    jQuery('.modal .stream-add').html('ADD NEW STREAM');  
                    jQuery('.group-add').removeClass('group-add'); 
                    jQuery('.email-input').show();
                }

            });

            jQuery('.color-sign').each(function(){
                jQuery(this).css('right',parseInt(jQuery(this).parents('div.content-image').css('padding-right'))+20+'px');
            });

            jQuery('.color').css('margin-top','3px').css('margin-bottom',0).css('margin-right',0).css('margin-left','8px').css('width','18px').css('height','18px');
            jQuery('.color').on('click',function(){
                jQuery('.color.active').removeClass('active');
                jQuery(this).addClass('active');
            });

            //add streams
            jQuery('.stream-add').on('click',function(){
                var flag = 0;
                if(jQuery(this).hasClass('group-add')){
                    if(jQuery('.name-input input').val() == ''){
                        jQuery('.name-input input').addClass('alert');
                        flag ++;
                    }

                    if(flag>0) return;
                    jQuery.ajax({
                        url: '../wp-content/themes/jupiter/group-add.php',
                        data: {name:jQuery('.name-input input').val() , color:jQuery('.color.active').data('id')},
                        dataType:'json',
                        type: 'POST',
                        success: function(data) {
                            location.reload();
                        }
                        ,error:function(error){
                            console.log(error);
                        }
                    });
                    return;
                }
                else
                {
                    if(jQuery('.name-input input').val() == ''){
                        jQuery('.name-input input').addClass('alert');
                        flag ++;
                    }
                    if(jQuery('.email-input input').val() == ''){
                        jQuery('.email-crop-input input').addClass('alert');
                        flag ++;
                    }
                    if(flag>0) return;
                }

                    
                jQuery('.image-upload-modal').fadeIn(500);

            });
            jQuery('.name-input input').on('keypress',function(){
                jQuery(this).removeClass('alert');
            });
            jQuery('.email-input input').on('keypress',function(){
                jQuery(this).removeClass('alert');
            });
            //add streams 

            jQuery('.stream-cancel').on('click',function(){
                jQuery('.mk-header').css('z-index',301);
                jQuery('.modal').fadeOut(500);
                jQuery('#header-setting').attr('src','http://localhost/WordPress-master/wp-content/uploads/bfi_thumb/header-setting.png');
            });

            jQuery('.group-modal > div > div').on('mousemove',function(){
                jQuery('.hover').removeClass('hover');
                jQuery('.stream-add img').attr('src','http://localhost/WordPress-master/wp-content/uploads/bfi_thumb/group-modal-arrow.png');

                jQuery(this).addClass('hover');
                if(jQuery('.stream-add').hasClass('hover'))
                    jQuery('.stream-add img').attr('src','http://localhost/WordPress-master/wp-content/uploads/bfi_thumb/modal-arrow.png');
            });

            jQuery('.group-modal > div > div:nth-child(2)').on('click',function(){
                jQuery('.mk-header').css('z-index',301);
                jQuery('.group-modal').fadeOut(500);
                jQuery('#header-setting').attr('src','http://localhost/WordPress-master/wp-content/uploads/bfi_thumb/header-setting.png');
                jQuery('img.group-delete-image').show();
            });

            jQuery('.signout').on('click',function(){
                console.log('signout');
                sessionStorage.removeItem('photo_user');
                sessionStorage.removeItem('role');
                jQuery('.mk-header').css('z-index',301);
                
                location.href = 'http://localhost/WordPress-master/login';
            });
            jQuery('.web-cam').on('click',function(){
                jQuery('.mk-header').css('z-index',301);
                jQuery('.image-upload-modal,.modal').fadeOut(500);
                jQuery('#header-setting').attr('src','http://localhost/WordPress-master/wp-content/uploads/bfi_thumb/header-setting.png');
            });
            jQuery('.upload').on('click',function(){
                jQuery('.image-upload').fadeIn(700);
            });
            jQuery('.btn-cancel').on('click',function(){
                jQuery('.image-upload').fadeOut(300);
            });

            jQuery('.vc_icon_element-icon').on('click',function(){
                jQuery('.photo-view').removeClass('photo-view');
                jQuery(this).addClass('photo-view');
            });

            jQuery('.grid-view').on('click',function(){
                jQuery('.full-image').removeClass('full-image');
                jQuery('.content-image').addClass('grid');
                if(sessionStorage.getItem('role') == 1){jQuery('.content-image').show(); return;}
                jQuery('#mk-footer').hide();
                jQuery('.favorite-check').hide();
            });

            jQuery('.list-view').on('click',function(){
                jQuery('.vc_col-sm-3').addClass('full-image');
                jQuery('.content-image').removeClass('grid');
                if(sessionStorage.getItem('role') == 1){jQuery('.content-image').show(); return;}
                jQuery('#mk-footer').hide();
                jQuery('.favorite-check').hide();
            });

            jQuery('.favorite-view').on('click',function(){
                console.log(sessionStorage);
                if(sessionStorage.getItem('role') == 1){
                    jQuery('.content-image[data-favorite = 0]').hide();
                    return;
                }
                jQuery('#mk-footer').show();
                jQuery('.favorite-check').each(function(){
                    if(jQuery(this).data('favorite') == 1) jQuery(this).show();
                });
            });

            jQuery('img.favorite-toggle').on('click',function(){
                if(!jQuery('.favorite-view').hasClass('photo-view'))
                    return;
                var element = jQuery(this).parent().find("div.favorite-check");
                if (element.data('favorite') == "1"){
                    element.data('favorite',"0");
                    element.hide();
                }
                else{
                    element.data('favorite',"1");
                    element.show();
                }
                console.log(element.data('id')+"/"+element.data('favorite'));

            });

            jQuery('#mk-footer .favorite-cancel').on('click' , function(){
                jQuery('.grid-view').trigger('click');
            });

            jQuery('#mk-footer .favorite-add').on('click' , function(){
                var fav_arr=[];
                var unfav_arr=[];
                jQuery('.favorite-check').each(function(){
                    if(jQuery(this).data('favorite') == "1")
                        fav_arr.push(jQuery(this).data("id"));
                    else
                        unfav_arr.push(jQuery(this).data("id"));
                });
                jQuery.ajax({
                    url: '../../wp-content/themes/jupiter/favorite-add.php',
                    data: {fav_ids:fav_arr,
                        unfav_ids:unfav_arr},
                    dataType:'json',
                    type: 'POST',
                    success: function(data) {
                        location.reload();
                    }
                    ,error:function(error){
                        console.log(error);
                    }
                });
            });

            jQuery('#mk-footer .favorite-delete').on('click' , function(){
                var del_arr = new Array();
                jQuery('.favorite-check').each(function(){
                    if(jQuery(this).data('favorite') == "1")
                        del_arr.push(jQuery(this).data("id"));
                });
                jQuery.ajax({
                    url: '../../wp-content/themes/jupiter/photo-delete.php',
                    data: {del_ids:del_arr},
                    dataType:'json',
                    type: 'POST',
                    success: function(data) {
                        location.reload();
                    }
                    ,error:function(error){
                        console.log(error);
                    }
                });
            });

            var files;
            
            jQuery('.group-delete-image').on('click',function(){
                
                var group_id = jQuery(this).data('id');
                
                jQuery.ajax({
                    url: '../wp-content/themes/jupiter/group-delete.php',
                    data: {id:group_id},
                    dataType:'json',
                    type: 'POST',
                    success: function(data) {
                        location.reload();
                    }
                    ,error:function(error){
                        console.log(error);
                    }
                });
            });

            jQuery('.btn-submit').on('click',function(){
                
                var data = new FormData();
                var input = jQuery('input[type=file]');
                files = (input.get(0).files) ? input.get(0).files[0] : null;
                if(files){
                    data.append('fileHandler', files);
                    if(/category\//g.test(url)){
                        data.append('stream_id',RegExp["$'"]);
                    }
                    else
                    {
                        data.append('name', jQuery('.name-input input').val());
                        data.append('email', jQuery('.email-input input').val());
                        data.append('color', jQuery('.color.active').data('id'));
                    }
                    jQuery.ajax({
                        url: 'http://localhost/Wordpress-master/wp-content/themes/jupiter/stream.php',
                        data: data,
                        contentType: false,
                        processData: false,
                        type: 'POST',
                        success: function(data) {
                            location.reload();
                        }
                        ,error:function(error){
                            console.log(error);
                        }
                    });
                }
                else
                    alert("FILE IS NOT SELECTED!");
                
            });

        }); 
    </script>
    <!-- <?php if($mk_options['disable_footer'] == 'true' && !$footer_status) : ?>
    <div class="footer-wrapper<?php echo $footer_grid_status;?>">
        <div class="mk-padding-wrapper">
            <?php mk_get_view('footer', 'widgets'); ?>
            <div class="clearboth"></div>
        </div>
    </div>
    <?php endif;?>
    <?php if ( $mk_options['disable_sub_footer'] == 'true' && ! $footer_status ) { 
        mk_get_view( 'footer', 'sub-footer', false, ['footer_grid_status' => $footer_grid_status] ); 
    } ?> -->
</section>
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
</body>
</html>