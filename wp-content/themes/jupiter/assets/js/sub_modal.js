	console.log(sessionStorage.getItem('role'));

if(sessionStorage.getItem('role') == 0){

	var current_url = window.location.href;
	var str_arr = current_url.split("/");
	var book_name="";
	jQuery('#mk-footer').hide();
	var fav_flag=0;

	jQuery('#mk-footer').css('height','30px').css('border',0).css('top',jQuery(window).height()-50 +'px');

	jQuery('#header-setting').on('click', function(){

		if(jQuery('.modal').is(':visible'))
		{
			jQuery('.modal').hide();
			jQuery('.modal-container').hide();
			return;
		}
		else {
			jQuery('.modal').show();
			jQuery('.sub-stream-modal').show();
			if (/sub_stream/g.test(url)){
				jQuery('.book-add').hide();
				jQuery('.book-photo-add').hide();
				return;
			}
			if (/sub_book/g.test(url)){
				jQuery('.book-photo-add').hide();
			}
			if (/sub_book_sel/g.test(url)){
				jQuery('.book-photo-add').show();
				jQuery('.book-add').hide();
				return;
			}
			if (/subscriber/g.test(url)){
				jQuery('.book-photo-add').hide();
				jQuery('.book-add').hide();
				return;
			}
	    }
	});
	jQuery('.subitem-stream').on('click',function(){
		location.href="http://localhost/sub_stream";
	});
	jQuery('.subitem-book').on('click', function(){
		location.href="http://localhost/sub_book";
	})
	jQuery('.caption1').each(function(){
		if(jQuery(this).data('favorite') == 1) jQuery(this).show();
	});

	jQuery('.favorite-view').on('click',function(){
		if (jQuery('#sub-mk-footer').is(':visible')){
			jQuery('#sub-mk-footer').hide();
			return;	
		}
		jQuery('#sub-mk-footer').show();
		jQuery('figure').on('click', function (){
			var fav_item = jQuery(this).find('.favorite-check');
			if (jQuery(fav_item).is(':visible') ){
				jQuery(fav_item).hide();
				fav_item.data('check',"0");
			}
			else {
				jQuery(fav_item).show();
				fav_item.data('check',"1");	
			}
		})
	});

	jQuery('.sub-footer-add').on('click' , function(){
		var fav_arr=[];
		jQuery('.favorite-check').each(function(){
			if(jQuery(this).data('check') == "1")
				fav_arr.push(jQuery(this).data("id"));
		});
		console.log(fav_arr);
		jQuery.ajax({
			url: 'http://localhost/wp-content/themes/jupiter/favorite-add.php',
			data: {fav_ids:fav_arr,
				},
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

	jQuery('.sub-footer-recyle').on('click' , function(){
		var unfav_arr=[];
		jQuery('.favorite-check').each(function(){
			if(jQuery(this).data('check') == "1")
				unfav_arr.push(jQuery(this).data("id"));
		});
		console.log(unfav_arr);
		jQuery.ajax({
			url: 'http://localhost/wp-content/themes/jupiter/favorite-add.php',
			data: {unfav_ids:unfav_arr},
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

	jQuery('.book-add-text').on('click', function(){
		book_name=jQuery('#book-add-name input').val();
		console.log(book_name);
		if (book_name==""){
			jQuery('#book-add-name input').addClass('alert');
			return;
		}
		else {
			jQuery('.image-upload').show();
			jQuery('.connect').hide();
		}
	});

	jQuery('.book-photo-add').on('click', function(){
		console.log("photo-add");
		jQuery('.photo-select').show();
		
		console.log(str_arr[4]);
		photo_select.init(str_arr[4]);
	})

	jQuery('.btn-submit').on('click',function(){
		var image = jQuery('.dz-details img').attr('src');
		console.log(image);
		if (image){
			console.log("image");
			jQuery.ajax({
				url: 'http://localhost/wp-content/themes/jupiter/book-add.php',
				data: {name:book_name},
					dataType:'json',
					type: 'POST',
				success: function(data) {
					location.reload();
				}
				,error:function(error){
					console.log(error);
				}
			});
		}
		else window.alert("Select image!");
	});

	jQuery('.btn-photo').on('click', function(){
			if (/sub_book_sel/g.test(url)){
				console.log("add-book-photo");
				var data = new FormData();
				var photos = jQuery('input:checkbox:checked.stream').map(function () {
					return this.name;
				}).get();
				console.log(photos.length);
				for (var i = 0; i < photos.length; i++) {
					console.log(photos[i]);
				}
				data.append('photos', photos);
				data.append('book_id', str_arr[4]);

				jQuery.ajax({
					url: 'http://localhost/wp-content/themes/jupiter/book-photo-add.php',
					data: data,
					contentType: false,
					processData: false,
					type: 'POST',
					success: function(data) {
						console.log(data);
						location.reload();
					}
					,error:function(error){
						console.log(error);
					}
				});
			}
	})

	jQuery('.sub-footer-cancel').on('click', function(){
		jQuery('#mk-sub-footer').hide();
	});
	jQuery('.btn-cancel').on('click', function(){
		jQuery('.image-upload').hide();
		jQuery('.photo-select').hide();
	});
	jQuery('.book-close-text').on('click', function(){
		jQuery('.modal').hide();
		jQuery('.modal-container').hide();
		jQuery('.image-upload').hide();
	});
}

