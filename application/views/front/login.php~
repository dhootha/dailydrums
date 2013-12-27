<!--Start Content-->


<!---------- Start Forgotten password part ------------>

		<div class="pop_message align-center" style="display:none;" >
        	<h2 class="title blue font18">Forget password?</h2>
        	
            <div class="content" id="forget_content">
            	<p>Enter Your Email <input type="email" name="forget_email" id="forget_email" class="forgotpass inputbox" > </p>
                <p>&nbsp;</p>
                <p><a href="#" class="blue_btn2" id="forget_submit">Submit</a>&nbsp;<a id="cancel" href="#" class="blue_btn2">Cancel</a></p>
            </div>
            
            <div class="content" id="forget_msg" style="display:none;">
            	<p>&nbsp;</p>
            	<p>Please check your mail to change the password</p>
            	<p>&nbsp;</p>
            	<p><a href="#" class="blue_btn2" id="cancel1">&nbsp;&nbsp;OK&nbsp;&nbsp;</a></p>
            </div>
            
        </div>
        <div class="overlay" style="display:none;"></div>
        
<!---------- End Forgotten password part ------------>


        <div class="container-fluid">
            <div class="main_container">
            	<h2 class="title">Daily Drums is your platform to directly connect with your customer</h2>
                <div class="row-fluid basic_register">
                    <div class="span8">
                    	<div class="register_block">
                        	<h4 class="blue">Register</h4>
                            <div class="row-fluid">
                            	<div class="span6">
                                    <ul class="bullet3">
                                        <li>Unlimited Postings</li>
                                        <li>Unlimited Postings</li>
                                    </ul>
                                    <ul class="bullet4">
                                        <li><a class="blue" href="#">Pricing</a></li>
                                        <li><a class="blue" href="#">Sample Posting</a></li>
                                    </ul>
                                    <a href="<?=base_url('welcome/proceed_basic_register')?>" class="blue_btn1">Business Basic</a>
                                </div>
                                <div class="span6">
                                    <ul class="bullet3">
                                        <li>Unlimited Postings</li>
                                        <li>Unlimited Postings</li>
                                         <li>Unlimited Postings</li>
                                        <li>Unlimited Postings</li>
                                    </ul>
                                    <ul class="bullet4">
                                        <li><a class="blue" href="#">Pricing</a></li>
                                        <li><a class="blue" href="#">Sample Posting</a></li>
                                    </ul>
                                    <a href="<?=base_url('welcome/proceed_pro_register');?>" class="red_btn1">Business Pro</a>
                                </div>
                                <div class="clr"></div>
                                <p class="align-center">Need an answer? We are just a call away-</p>
                                <p class="align-center"><span class="red">1-800-000-0000</span><span class="space"></span><a class="blue" href="#">Contact Us</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="span4">
                    	<div class="login_block">
                        	<div class="seperator"><img src="<?=base_url('themes/front/images/accounnt_seperator.gif');?>" alt=""></div>
                        	<h4 class="blue">Returning Customer</h4>
                            <div class="form">
				<form name="login_form" id="login_form" action="<?=base_url('user/login');?>" method="post">
					<div class="<?php if( $this->session->flashdata('action') == '1' ) echo 'success_message1'; else echo 'error_message'; ?>" id="form_error"><?php echo $this->session->flashdata('action_msg');?>&nbsp;</div>
                            	<p>E-Mail Address:<br><input type="text" name="daily_drums_user_id" id="daily_drums_user_id" class="inputbox" value="<?=$last_email?>" placeholder="abc@example.com"></p>
                                	<p>Password:<br><input type="password" name="daily_drums_password" id="daily_drums_password"  class="inputbox" value="<?=$last_password?>"></p>
                            </form>
					<p><a class="black" style="cursor:pointer;" id="forget_password">Forgotten Password</a></p>
                            </div>
                            <p><a href="#" class="blue_btn1" id="submit">Login</a></p>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
            </div>
        </div>
        <!--End Content-->

<script type="text/javascript" >
		
		//$x = jQuery.noconflict();
		$(document).ready( function(){

				var server_error = "<?=$login_error;?>"; 
				if( server_error != '' )
					$('#form_error').html(server_error);
				//else				
					//$('#form_error').html('&nbsp;');

				$('.inputbox').focusin(function(){

						$(this).removeClass('error_message_border');	
						$('#form_error').html('&nbsp;');
						});	

				$('#submit').click(function() {
					
					//alert('hi');return true;
					
						$('#form_error').addClass('error_message');
						var mail_id = $('#daily_drums_user_id').val();

						if($('#daily_drums_user_id').val() == '' ) {
								
								$('#form_error').html("Please Provide The Email Id.");
								$('#daily_drums_user_id').addClass('error_message_border');
								
								return false;	
								}
								else {
										var re = /^[_a-z]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/;

									 	if( !mail_id.match( re ) ) {
								     	   		$('#form_error').html("Please Provide The Valid Email.");
											$('#daily_drums_user_id').addClass('error_message_border');
											return false;
											}											
									}

						if($('#daily_drums_password').val() == '' ) {
								
								$('#form_error').html('Please Provide The Password');
								$('#daily_drums_password').addClass('error_message_border');
								return false;	
								}

						document.login_form.submit();
						});	
						
						
// \\\\\\\\\\\\\\\\\\\\\\\START FORGET PASSWORD SECTION \\\\\\\\\\\\\\\\\\\\\\\\\\

	$('#forget_content').css('display','block');

					$('#forget_password').click(function(){
													
													$('.pop_message').css('display','block');
													$('.overlay').css('display','block');
									});
					
					$("#cancel,#cancel1").click(function() {
						
									$('.pop_message').css('display','none');
									$('.overlay').css('display','none');
									
									$('#forget_msg').css('display','none');
									$('#forget_content').css('display','block');					
								});
			
					$('#forget_submit').click(function(){
						
								var email = $('#forget_email').val();	
							 
							 	if( email == '' ) {
							 	
								 		alert("Provide Your Email");
								 		$('#forget_email').focus();
								 		return false;
								 	}
								 	else {

											request = $.ajax({
													      type: 'post',
													      url: "<?=base_url('user/forget_password')?>",
													      data: "email="+email,
															dataType:'json'
												 	 });
											  
											 request.done(function(response) {
															console.log(response);
															if(response.flag == '0') {
																
																	alert(response.msg);	
																}
																else{
																			
																			$('#forget_content').css('display','none');	
																			$('#forget_msg').css('display','block');																
																	}
													});	
									}					
						});
						
// \\\\\\\\\\\\\\\\\\\\\\\END FORGET PASSWORD SECTION \\\\\\\\\\\\\\\\\\\\\\\\\\						
						
							
				});
</script>
