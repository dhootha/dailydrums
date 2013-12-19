<!--Start Content-->

        <div class="container-fluid">
            <div class="main_container">
            	<h2 class="title">Daily Drums is your platform to directly connect with your customer</h2>
                <div class="row-fluid">
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
                                    <a href="<?=base_url('registration')?>" class="blue_btn1">Business Basic</a>
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
                                    <a href="#" class="red_btn1">Business Pro</a>
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
                        	<h4 class="blue">Reset Password</h4>
                            <div class="form">
										<form name="reset_password_form" id="reset_password_form" action="<?=base_url('user/password_reset');?>" method="post">
											<span class="<?php if( $this->session->flashdata('action') == '1' ) echo 'success_message1'; else echo 'error_message'; ?>" id="form_error">&nbsp;<?=$this->session->flashdata('action_msg');?></span>
						                            	<p>New Password:<br><input type="password" name="new_password" id="new_password" class="inputbox" value="" placeholder=""></p>
						                              <p>Retype Password:<br><input type="password" name="new_password_again" id="new_password_again"  class="inputbox" value=""></p>
                            							<input type="hidden" name="encoded_email" id="encoded_email" value="<?=$encoded_email;?>">
                            	</form>
                            </div>
                            <p><a href="#" class="blue_btn1" id="submit">RESET</a></p>
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
			
						$('#submit').click(function(){
							
									var new_password = $('#new_password').val();
									var retype_password = $('#new_password_again').val();
									var space_regex = /^[a-zA-Z0-9][a-zA-Z0-9]+$/;
									
									if( !new_password.match( space_regex ) ) {
										
												$('#new_password').addClass('error_message_border');
												alert("Provide New Password.");
												$('#new_password').focus();
												return false;
											}
											else if( new_password.length < 8 ){
											
														$('#new_password_again').addClass('error_message_border');
														alert("Password Must Be 8 Charecter Long.");
														$('#new_password_again').focus();
														return false;
													}
													else if( !retype_password.match( space_regex ) ) {
													
																$('#new_password_again').addClass('error_message_border');
																alert("Retype Password Again.");
																$('#new_password_again').focus();
																return false;
															}
															else if( new_password != retype_password ) {
															
																	$('#new_password_again').addClass('error_message_border');
																	alert("Both The Password Not Matched.");
																	$('#new_password_again').focus();
																	return false;
																}
										document.reset_password_form.submit();
								});
						
						$('.inputbox').focus(function(){
							
								$(this).removeClass('error_message_border');
							});
			});
			
	</script>