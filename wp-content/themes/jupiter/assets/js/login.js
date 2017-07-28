jQuery(document).ready(function(){
	jQuery('input[name=email]').on('keypress',function(){
		jQuery(this).removeClass('alert');
	});

	jQuery('input[name=password]').on('keypress',function(){
		jQuery(this).removeClass('alert');
	});
	var flag;
	jQuery('.login').on('click',function(){
		flag=0;
		if(jQuery('input[name=email]').val()=="") {flag++;jQuery('input[name=email]').addClass('alert'); console.log("email");}
		if(jQuery('input[name=password]').val()=="") {flag++;jQuery('input[name=password]').addClass('alert');}
		if(flag == 0) {
			jQuery('.login-modal').show();
			//jQuery('.login_image img').attr('src', 'http://localhost/wp-content/themes/jupiter/assets/images/loading_back.png');
			jQuery.ajax({
				url: 'wp-content/themes/jupiter/login.php',
				data: {email:jQuery('input[name=email]').val(),password:jQuery('input[name=password]').val()},
				dataType:"json",
				type: 'POST',
				success: function(data) {
					// jQuery('.login-modal').hide();
					// jQuery('.login_image img').attr('src', 'http://localhost/wp-admin/images/new-logo.png');
					var image_url = 'http://localhost/wp-admin/images/new-logo.png';
					if(data.result == "empty" )	{
						jQuery('input[name=email]').val('').addClass('alert');
						jQuery('input[name=password]').val('').addClass('alert'); console.log("empty");
						jQuery('.login-modal').hide();
						jQuery('.login_image img').attr('src', image_url);
					}
					else if(data.result == "fail" )	{
						jQuery('input[name=password]').val('').addClass('alert'); console.log("fail");
						jQuery('.login-modal').hide();
						jQuery('.login_image img').attr('src', image_url);
					}
					else if(data.result == "role_error"){
						console.log("role_error");
						jQuery('.login-modal').hide();
						jQuery('.login_image img').attr('src', image_url);
					}
					else { console.log("success");
						sessionStorage.setItem('photo_user',data['id']);
						sessionStorage.setItem('role',data['role']);
						console.log(sessionStorage);
						if (data['role']==1) location.href='http://localhost/streams';
						else location.href='http://localhost/sub_stream/';
					}
				},
				error:function(error){
					console.log(error);
				}
			});
		}
	});
});