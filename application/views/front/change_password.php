<!--Start Content-->
        <div class="container-fluid">
            <div class="main_container">
                <div class="row-fluid">
                <div class="span9 main_content">
                    <h2 class="title">Change Password</h2>
				
                    <div class="change_password">
                    	<div class="block">
                            <h2 class="title blue">Your Password</h2>

				<div class="row-fluid">
                            	<div class="span3 form_label">&nbsp;</div>
                                	<div class="span4"><div class="success_message1" id="action_msg">&nbsp;</div></div>
                                <div class="clr"></div>
                            </div>
				<form name="change_password" action="<?=base_url('user/updatepassword');?>" method="post">
				<input type="hidden" name="user_id" value="<?=$user_id?>" >
                            <div class="row-fluid">
                            	<div class="span3 form_label">Old Password:</div>
                                <div class="span5"><input type="password"  name="old_password" id="old_password" value="" class="inputbox"></div>
					<span class="error_message" id="form_error_old_password"><?=form_error('old_password');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span3 form_label">New Password:</div>
                                <div class="span5"><input type="password"   name="new_password" id="new_password"  value="" class="inputbox"></div>
					<span class="error_message" id="form_error_new_password"><?=form_error('new_password');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span3 form_label">Confirm Password:</div>
                                <div class="span5"><input type="password" name="new_password_again" id="new_password_again" value="" class="inputbox"></div>
					<span class="error_message" id="form_error_new_password_again"><?=form_error('new_password_again');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
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

								var old_password = $('#old_password').val();
								var new_password = $('#new_password').val();
								var new_password_again = $('#new_password_again').val();
								var space_regex = /^[a-zA-Z0-9][a-zA-Z0-9]+$/;
								var error_flag = false;

								if( !old_password.match( space_regex ) ) {

										$('#form_error_old_password').html("* Provide Old Password");
										$('#old_password').addClass('error_message_border');
										error_flag = true;
									}
								if( !new_password.match( space_regex ) ) {

										$('#form_error_new_password').html("* Provide New Password");
										$('#new_password').addClass('error_message_border');
										error_flag = true;
									}
									else if( new_password.trim().length < 8 ) {

											$('#form_error_new_password').html("* Password Must Be 8 Charecter Long");
											$('#new_password').addClass('error_message_border');
											error_flag = true;
										}
								if( !new_password_again.match( space_regex ) ) {

										$('#form_error_new_password_again').html("* Provide Confirmation Password ");
										$('#new_password_again').addClass('error_message_border');
										error_flag = true;
									}
									else if( new_password_again.trim().length < 8 ) {
	
											$('#form_error_new_password_again').html("* Password Must Be 8 Charecter Long ");
											$('#new_password_again').addClass('error_message_border');
											error_flag = true;
										}
									

								if( !error_flag ) {

										document.change_password.submit();
										}

							});

			});
</script>

