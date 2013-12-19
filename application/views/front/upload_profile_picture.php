<!--Start Content-->
        <div class="container-fluid">
            <div class="main_container">
                <div class="row-fluid">
                <div class="span9 main_content">
                    <h2 class="title">Upload Profile Picture</h2>
				
                    <div class="change_password">
                    	<div class="block">
                            <h2 class="title blue">Your Profile Picture</h2>

				<div class="row-fluid">
                            	<div class="span3 form_label">&nbsp;</div>
                                	<div class="span4" style="width:300px !important;"><div class="success_message1" id="action_msg" style="width:300px !important;">&nbsp;</div></div>
                                <div class="clr"></div>
                            </div>
				<form name="upload_profile_picture" action="<?=base_url('user/upload_profile_picture_submit');?>" method="post" enctype="multipart/form-data" >
                            <div class="row-fluid">
				                  	<div class="span3 form_label">Current Picture:</div>
								<?php if($user->photo ==null) 
												$user_photo = "themes/front/images/no_image2.jpg"; 
											else 
												$user_photo = "uploads/user_img/".$user->photo;
								 ?>
				                    <div class="span5" style="text-align:center;" ><img style="width:200px; height:150px;" src="<?=base_url($user_photo);?>" alt="User Photo"></div>					
                            </div>
                            <div class="row-fluid">
		                       	  <div class="span3 form_label">Upload New Picture:</div>
							  <div class="span7 file-wrapper logo_input">
												<input type="file" name="pic" id="pic" value="" class=""><span class="file-holder"></span><span class="button">Choose File</span>
				                 					<span class="error_message" id="form_error_pic"><?=form_error('pic');?>&nbsp;</span>
												 <div class="clr"></div>				                      
				                  </div>
                            </div>
                         
					    <div class="row-fluid">
				                  <div class="floatleft"><a class="blue_btn1" href="<?=base_url('user/profile');?>">BACK</a></div>
				                  <div class="floatright"><a class="blue_btn1" id="save" href="#">Save</a></div>
		                   </div>

                        </div>
                     </form>
                    </div>
                </div>

		<?php  $this->load->view('front/common/right_menu'); ?>

                <!-- Latest Post Part -->
                
      <?php  $this->load->view('front/common/latest_post'); ?>	
                
                <!-- Latest Post Part -->
                
                <div class="clr"></div>
                </div>
            </div>
        </div>
        <!--End Content-->

<script type="text/javascript">

		$(document).ready( function(){

					$('.inputbox').focusin(function(){

						$(this).removeClass('error_message_border');	
						$('.error_message').html('&nbsp;');
						});
				
					var server_action_msg = '<?=$action_msg;?>';	
					var server_error_msg   = '<?=$error_msg;?>';

					if( server_action_msg != '' ){

								$('#action_msg').append(server_action_msg);
								//$('#action_msg').addClass('success_message1');
						}
					if( server_error_msg != '' ){

								$('#action_msg').append(server_error_msg);
								$('#action_msg').removeClass('success_message1');
								$('#action_msg').addClass('error_message');
						}
					

					$('#save').click(function(){

								var pic = $('#pic').val();
								/*var new_password = $('#new_password').val();
								var new_password_again = $('#new_password_again').val();*/
							//	var space_regex = /^[a-zA-Z0-9][a-zA-Z0-9]+$/; 
								var error_flag = false;

								if( pic == "" ) {
										$('#form_error_pic').html("* Select your profile photo.");
										$('#pic').addClass('error_message_border');
										error_flag = true;
									}
							//	alert(pic); alert(error_flag);
								if( !error_flag ) {
										document.upload_profile_picture.submit();
										}
							});

			});
</script>

