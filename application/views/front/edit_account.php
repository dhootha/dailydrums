<!--Start Content-->
        <div class="container-fluid">
            <div class="main_container">
                <div class="row-fluid">
                <div class="span9 main_content">
                    <h2 class="title">My Account Information</h2>
                    <div class="change_password">
                    	<div class="block">
                            <h2 class="title blue">Change your name or e-mail address</h2>
					
				                <div class="row-fluid">
                            	<div class="span3 form_label">&nbsp;</div>
                                	<div class="span4"><div class="success_message1" id="action_msg"><?=$action_msg;?>&nbsp;</div></div>
                                <div class="clr"></div>
                            </div>

				<form name="update_profile" action="<?=base_url('user/updateprofile');?>" method="post">
				<input type="hidden" name="user_id" value="<?=$user_id?>" >
                             <div class="row-fluid">
                            	<div class="span3 form_label">First Name:</div>
                                	<div class="span4"><input type="text" name="first_name" id="first_name" value="<?=$firstname?>" class="inputbox"></div>
					<span class="error_message" id="form_error_first_name"><?=form_error('first_name');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span3 form_label">Last Name:</div>
                                <div class="span4"><input type="text" name="last_name" id="last_name" value="<?=$lastname?>" class="inputbox"></div>
				     <span class="error_message" id="form_error_last_name"><?=form_error('last_name');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span3 form_label">E-Mail Address:</div>
                                <div class="span4"><input type="text" name="business_email" id="business_email" value="<?=$business_email?>" class="inputbox"></div>
					<span class="error_message" id="form_error_business_email"><?=form_error('business_email');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span3 form_label">Mobile Phone Number:</div>
                                <div class="span4"><input type="text" maxlength="15" name="primary_phone" id="primary_phone" value="<?=$primary_phone?>" class="inputbox"></div>
					<span class="error_message" id="form_error_primary_phone"><?=form_error('primary_phone');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span3 form_label">Zip Code:</div>
                                <div class="span4"><input type="text" maxlength="10" name="zip" id="zip" value="<?=$zip?>" class="inputbox"></div>
					<span class="error_message" id="form_error_zip"><?=form_error('zip');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                                <div class="floatleft"><a class="blue_btn1" href="<?=base_url('user/profile');?>">BACK</a></div>
                                <div class="floatright"><a class="blue_btn1" id="save"  href="#">Save</a></div>
                            </div>
                            <div class="clr"></div>
                        </div>
                        
                    </div>
                </div>
		</form>
                
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

					$('#save').click(function(){

								var first_name = $('#first_name').val();
								var last_name = $('#last_name').val();
								var business_email = $('#business_email').val();
								var primary_phone = $('#primary_phone').val();
								var zip = $('#zip').val();
								var error_flag = false; 
								var space_regex = /^[a-zA-Z0-9][a-zA-Z0-9]+$/;
								if( !first_name.match( space_regex ) ) {

										$('#form_error_first_name').html("* Provide First Name Properly");
										$('#first_name').addClass('error_message_border');
										error_flag = true;
									}
								if( !last_name.match( space_regex ) ) {

										$('#form_error_last_name').html("* Provide Last Name Properly");
										$('#last_name').addClass('error_message_border');
										error_flag = true;
									}
								if( business_email == '' ) {

										$('#form_error_business_email').html("* Provide Legal Email Id Properly");
										$('#business_email').addClass('error_message_border');
										error_flag = true;
									}
									else {

											var re = /^[_a-z]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/;

										 	if( !business_email.match( re ) ) {
									     	   		
												$('#form_error_business_email').html("* Provide Valid Email Id.");
												$('#usiness_email').addClass('error_message_border');
												error_flag = true;
												}	
										  }
								if( !primary_phone.match( space_regex) ) {

										$('#form_error_primary_phone').html("* Provide Primary Phone");
										$('#primary_phone').addClass('error_message_border');
										error_flag = true;
									}
									else{
											if( isNaN(primary_phone) ||  primary_phone.length < 10  ) {
											
													$('#form_error_primary_phone').html("* Provide Primary Phone Properly");
													$('#primary_phone').addClass('error_message_border');	
													error_flag = true;
												}
										}
								if( !zip.match( space_regex) ) {

										$('#form_error_zip').html("* Provide Zip");
										$('#zip').addClass('error_message_border');
										error_flag = true;
									}

								if( !error_flag ) {

										document.update_profile.submit();
										}
							});
			});

</script>


