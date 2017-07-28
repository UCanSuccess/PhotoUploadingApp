
if(sessionStorage.getItem('role') == 1){
	jQuery('#mk-footer .favorite-delete').on('click' , function(){
	    var del_arr = new Array();
	    jQuery('.favorite-check').each(function(){
	        if(jQuery(this).data('favorite') == "1")
	            del_arr.push(jQuery(this).data("id"));
	    });
	    jQuery.ajax({
	        url: 'http://localhost/wp-content/themes/jupiter/photo-delete.php',
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

	jQuery('.group-delete-image').on('click',function(){
	    
	    var group_id = jQuery(this).data('id');
	    
	    jQuery.ajax({
	        url: 'http://localhost/wp-content/themes/jupiter/group-delete.php',
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
		var streams=jQuery('input:checkbox:checked.stream').map(function () {
			return this.name;
		}).get();
		console.log(streams.length);
		for (var i = 0; i < streams.length; i++) {
			console.log(streams[i]);
		}

	    if (jQuery(this).hasClass('stream-delete')){
	        console.log("stream-delete");
	        data.append('streams', streams);

	        jQuery.ajax({
	            url: 'http://localhost/wp-content/themes/jupiter/stream_delete.php',
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

	    if (jQuery(this).hasClass('group-delete')){
	        console.log("group-delete");
	        data.append('streams', streams);

	        jQuery.ajax({
	            url: 'http://localhost/wp-content/themes/jupiter/group_delete.php',
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

	    var image = jQuery('.dz-details img').attr('src');
	    console.log(image);

	    if(image){
	    	console.log("image");
	        // data.append('fileHandler', files);
	        if(/category\//g.test(url)){
	            data.append('stream_id',RegExp["$'"]);
				for (var i = 0; i < streams.length; i++) {
				    data.append("streams_"+i, streams[i]);
				    console.log(streams[i]);
				}
	        }
	        else
	        {
				data.append('name', jQuery('.name-input input').val());
				data.append('email', jQuery('.email-input input').val());
				data.append('sub_id', jQuery('#email_id').val());
				data.append('color', jQuery('.color.active').data('id'));
				data.append('streams', streams);
	        }


	        if (url.indexOf('groups') != -1){
				console.log("group-add");
				jQuery.ajax({
				    url: 'http://localhost/wp-content/themes/jupiter/group-add.php',
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
				return;
	        }
	        else {
	        	console.log("stream-add");
				jQuery.ajax({
					url: 'http://localhost/wp-content/themes/jupiter/stream.php',
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
				return;
	        }

	    }
	    else {
	    	console.log("no_image");
	    	if (url.indexOf("group_sel")){
				var current_url = window.location.href;
				var str_arr = current_url.split("/");
	    		console.log("group_sel"+str_arr[4]);
	    		data.append('streams', streams);
	    		data.append('group_id', str_arr[4]);

				jQuery.ajax({
					url: 'http://localhost/wp-content/themes/jupiter/stream_group.php',
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
	        else alert("FILE IS NOT SELECTED!");
	    }
	});
}