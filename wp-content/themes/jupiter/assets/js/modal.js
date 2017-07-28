
var url= location.href;

	var width = jQuery(window).width();
	var height = jQuery(window).height();
	var datatable_flag = 0;

	jQuery('.modal').css('height',parseInt(height-63)+"px");

	var unactive_url='http://localhost/wp-content/uploads/bfi_thumb/header-setting.png';
	jQuery('.modal').on('click', function(){
		console.log("modal"); //return;
		jQuery(this).hide();
		jQuery('.modal-container').hide();
		jQuery('.image-upload').hide();
		jQuery('#header-setting').attr('src', unactive_url);
	})

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
		    jQuery('#mk-footer').show();
		    jQuery('.favorite-check').each(function(){
		        if(jQuery(this).data('favorite') == 1) jQuery(this).show();
		    });
	    }
	});

	// jQuery('.loading').css('background-image', 'url("http://localhost/wp-content/themes/jupiter/assets/images/loading3.gif")')

	// jQuery('img.favorite-toggle').on('click',function(){
	//     if(!jQuery('.favorite-view').hasClass('photo-view'))
	//         return;
	//     var element = jQuery(this).parent().find("div.favorite-check");
	//     if (element.data('favorite') == "1"){
	//         element.data('favorite',"0");
	//         element.hide();
	//     }
	//     else{
	//         element.data('favorite',"1");
	//         element.show();
	//     }
	//     console.log(element.data('id')+"/"+element.data('favorite'));

	// });

	if(sessionStorage.getItem('role') == 1){

		// footer item action effect
			if(/streams/g.test(url) || /category/g.test(url) || /photos/g.test(url) || /detail/g.test(url) )
				jQuery('#mk-footer div.streams').css('background-color', '#44a9fc');
			if(/groups/g.test(url) || /group_sel/g.test(url))
				jQuery('#mk-footer div.groups').css('background-color', '#44a9fc');
			if(/camera/g.test(url))
				jQuery('#mk-footer div.camera').css('background-color', '#44a9fc');
			if(/setting/g.test(url))
				jQuery('#mk-footer div.setting').css('background-color', '#44a9fc');
		// footer effect

		jQuery('.group-color div.wpb_single_image').css('height',jQuery('.group-color div.wpb_single_image').width()+'px');
		  
		jQuery('#header-setting').on('click', function(){

			if(jQuery('.modal').is(':visible') || jQuery('.group-modal').is(':visible') || jQuery('.subscriber-stream-modal').is(':visible'))
			{
				jQuery('.modal').hide();
				jQuery('.modal-container').hide();
				return;
			}
			else {
				jQuery('.modal').show();

				if(/streams/g.test(url) || /groups/g.test(url)){
					jQuery('.stream-modal').show();
					jQuery('.connect').hide();
					if (/streams/g.test(url)){
						jQuery('.group-add').hide();
						jQuery('.group-delete').hide();
					}
					else {
						jQuery('.stream-add-title').html('ADD NEW GROUP').addClass('group-add');
						jQuery('.stream-add').addClass('group-add');
						jQuery('.stream-delete').hide();
						jQuery('.email-input').hide();
					}
					return;
				}
				if (/category/g.test(url)){
					jQuery('.select-mode').show();
					return;
				}
		    }
		});

		jQuery('.upload').on('click', function(){
			jQuery('.image-upload').show();
			if (datatable_flag==0){
				stream_select.init(-1);
				datatable_flag=1;
			}
			else datatable_flag = 1;
		})

		jQuery('.color-sign').each(function(){
		    jQuery(this).css('right',parseInt(jQuery(this).parents('div.content-image').css('padding-right'))+20+'px');
		});
		
		jQuery('.palette-color').on('click',function(){
		    jQuery('.palette-color.active').removeClass('active');
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
			}
			else
			{
			    if(jQuery('.name-input input').val() == ''){
			        jQuery('.name-input input').addClass('alert');
			        flag ++;
			    }
			    if(jQuery('.email-input input').val() == ''){
			        jQuery('.email-input input').addClass('alert');
			        flag ++;
			    }
			    var sub_email = jQuery('.email-input input').val();
				jQuery.ajax({
					url: 'http://localhost/wp-content/themes/jupiter/email-check.php',
					data: {email:sub_email},
			        dataType:'json',
			        type: 'POST',
			        success: function(data) {
			        	if (data[0] == "mail_error"){
			        		window.alert("Email error!");
			        		jQuery('.email-input input').addClass('alert');
			        		flag++;
			        	}
			        	else {
			        		jQuery('#email_id').val(data[0]);
			        	}
			        }
			        ,error:function(error){
			            console.log(error);
			        }
			    });


			}
		    if(flag>0) return;
		    else {
			    // FormDropzone.init();
				jQuery('.image-upload').show();

				if (/groups/g.test(url)){
					console.log("group-modal");
					jQuery('.connect').hide();
				}
		    }

		});

		// delete streams
		jQuery('.stream-delete').on('click', function(){
		    //console.log("stream-delete");
		    jQuery('.image-upload-modal').fadeIn(500);
		    jQuery('.modal-container').hide();
		    jQuery('.image-upload').fadeIn(500);
		    jQuery('.image-upload-title').hide();
		    jQuery('.image-upload-input').hide();
		    jQuery('.image_select').hide();
		    jQuery('.connect').show();
		    jQuery('.btn-submit').addClass("stream-delete");
		    jQuery('.connect').css('margin-top', '-15px');

		    var current_url = window.location.href;
		    var str_arr = current_url.split("/");
		    console.log(str_arr[4]);
		    stream_select.init(str_arr[4]);
		})

		// delete groups
		jQuery('.group-delete').on('click', function(){
		    console.log("group-delete");

		    jQuery('.image-upload-modal').fadeIn(500);
		    jQuery('.modal-container').hide();
		    jQuery('.image-upload').fadeIn(500);
		    jQuery('.image-upload-title').hide();
		    jQuery('.image-upload-input').hide();
		    jQuery('.image_select').hide();
		    jQuery('.connect').show();
		    jQuery('.btn-submit').addClass("group-delete");
		    // jQuery('.connect').css('margin-top', '-60px');

		    var current_url = window.location.href;
		    var str_arr = current_url.split("/");
		    // console.log(-100);
		    stream_select.init(-100);
		})

		// add-stream-group
		jQuery('.add-stream-group').on('click', function (){
			if (jQuery('.image-upload-modal').is(':visible')){
				console.log("visible");
				jQuery('.image-upload-modal').fadeOut(500);
			}
			else {
		        console.log("add-stream-group");
				jQuery('.image-upload-modal').fadeIn(500);
				jQuery('.modal-container').hide();
				jQuery('.image-upload').fadeIn(500);
				jQuery('.image-upload-title').hide();
				jQuery('.image-upload-input').hide();
				jQuery('.image_select').hide();
				// jQuery('.connect').css('margin-top', '-60px');

				var current_url = window.location.href;
				var str_arr = current_url.split("/");
				console.log(str_arr[4]);
				stream_select.init(str_arr[4]);
			}
		})

		jQuery('.name-input input').on('keypress',function(){
		    jQuery(this).removeClass('alert');
		});
		jQuery('.email-input input').on('keypress',function(){
		    jQuery(this).removeClass('alert');
		});
		//add streams 

		// modal hide

		jQuery('.stream-cancel').on('click',function(){
		    jQuery('.mk-header').css('z-index',301);
		    jQuery('.modal').hide();
		    jQuery('.modal-container').hide();
		    jQuery('.image-upload').hide();
		    jQuery('#header-setting').attr('src',unactive_url);
		});

		jQuery('.btn-cancel').on('click',function(){
			jQuery('.image-upload').hide();
		});

		jQuery('.web-cam').on('click',function(){
		    jQuery('.mk-header').css('z-index',301);
		    jQuery('.image-upload-modal,.modal').fadeOut(500);
		    jQuery('#header-setting').attr('src',unactive_url);
		});

		jQuery('.vc_icon_element-icon').on('click',function(){
		    jQuery('.photo-view').removeClass('photo-view');
		    jQuery(this).addClass('photo-view');
		});

		jQuery('#mk-footer .favorite-cancel').on('click' , function(){
		    jQuery('.grid-view').trigger('click');
		});
	}
