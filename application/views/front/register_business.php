<?php  
$CI =& get_instance();?>

<div class="pop_message align-center popup_popup" style="display:none;" >
        	<h2 class="title">Thank You</h2>
            <div class="content">
            	<p><img src="<?php  echo $CI->config->item('front_link_path').'images/smiley_icon.png';?>" alt=""></p>
                <p class="blue font18"><strong>Thank you for joining us</strong></p>
                <p id="pay">Please check your mail to activate your account</p>
                <p>&nbsp;</p>
                <p><a id="succ_btn" href="#" class="blue_btn2">Thanks</a></p>
            </div>
        </div>
        <div class="overlay" style="display:none;"></div>


<!--Start Content-->
<form name="busines_registration" id="busines_registration">
        <div class="container-fluid">
            <div class="main_container">
                <div class="row-fluid">
                	<span class="span12 top_banner"><img src="<?php  echo $CI->config->item('front_link_path').'images/business-signup_banner.jpg';?>" width="100%" alt=""></span>
                    <h2 class="title">Register to start post your listings</h2>
                    <div class="sign_up">
                        <div class="block">
                            <h3 class="title">Sign-in Information</h3>
                            <div class="row-fluid">
                            	<div class="span2 form_label">First & Last Names</div>
                                <div class="span6"><input type="text" name='name' id='name' value="" class="inputbox "></div><!--error_message_border -->
					<span class="error_message" id="name_error"></span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Email Address</div>
                                <div class="span6"><input type="text" name="email" id="email" value="" class="inputbox"></div>
					<span class="error_message" id="email_error"></span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Re-type Email Address</div>
                                <div class="span6"><input type="text" name="email_again" id="email_again" value="" class="inputbox"></div>
					<span class="error_message" id="email_again_error"></span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Password</div>
                                <div class="span6"><input type="password" name="password" id="password" value="" class="inputbox"></div>
					<span class="error_message" id="password_error"></span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Retype password</div>
                                <div class="span6"><input type="password" name="password_again" id="password_again" value="" class="inputbox"></div>
					<span class="error_message" id="password_again_error"></span>
                                <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div class="block">
                            <h3 class="title">Business Information</h3>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Legal Name</div>
                                <div class="span6"><input type="text" name="business_name" id="business_name" value="" class="inputbox">
					
					<div class="gray">Enter business name if registering for a Business. Enter your name if registering as an individual.</div>
					</div>
					<span class="error_message" id="business_name_error"></span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Email Address</div>
                                <div class="span6"><input type="text" name="business_email" id="business_email" value="" class="inputbox"></div>
					<span class="error_message" id="business_email_error"></span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Re-type Email Address</div>
                                <div class="span6"><input type="text" name="business_email_again" id="business_email_again" value="" class="inputbox"></div>
					<span class="error_message" id="business_email_again_error"></span>
                                <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div class="block">
                            <h3 class="title">Membership Information</h3>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Display Name</div>
                                <div class="span6"><input type="text" name="display_name" id="display_name" value="" class="inputbox">
					
					<div class="gray">Enter business name if registering for a Business. Enter your name if registering as an individual.</div></div>
					<span class="error_message" id="display_name_error"></span>                                
                                <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div class="block">
                            <h3 class="title">Address Information</h3>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Address Line 1<div class="gray">(or company name)</div></div>
                                <div class="span6"><input type="text" name="address_line_1" id="address_line_1" value="" class="inputbox">
					
											<div class="gray">Street address. Enter the address exactly as it appears on your statement. For example, use “Avenue” instead of “Ave” and “Street” instead of “St.”</div></div>
											<span class="error_message" id="address_line_1_error"></span>                                
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Address Line 2<div class="gray">(or company name)</div></div>
                                <div class="span6"><input type="text" name="address_line_2" id="address_line_2" value="" class="inputbox">
					
											<div class="gray">Street address. Enter the address exactly as it appears on your statement. For example, use “Avenue” instead of “Ave” and “Street” instead of “St.”</div></div>
											<span class="error_message" id="address_line_2_error"></span>                                
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">City/Town</div>
                                <div class="span6"><input type="text" name="city" id="city" value="" class="inputbox"></div>
					<span class="error_message" id="city_error"></span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Province/Region/State</div>
                                <div class="span6"><input type="text" name="state" id="state" value="" class="inputbox">
									
											<div class="gray">Avoid using abbreviations like “NJ” instead of “New Jersey”</div></div>
											<span class="error_message" id="state_error"></span>	
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Postal Code/Zip Code</div>
                                <div class="span6"><input type="text" name="zip" id="zip" value="" class="inputbox"></div>
					<span class="error_message" id="zip_error"></span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Country</div>
                                <div class="span6">
						<select name="country" id="country" class="selectbox">
								<option value=''>Select</option>
								<?php 
										for($i=0;$i < count($countryList);$i++) {
								?>
											<option value="<?php echo $countryList[$i]->id; ?>" > <?php echo $countryList[$i]->country_name; ?> </option>
								<?php }
								?>
						</select>
				    </div>
					<span class="error_message" id="country_error"></span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Primary Phone</div>
                                <div class="span6"><input type="text" name="phone_primary" id="phone_primary" value="" class="inputbox">
					
											<div class="gray">Please enter your phone number with <span class="wrong">the area code. (Ex: 555-345-4567) </span> NOTE: Country code or leading zero(0) prefixes are not necessary.</div></div>
											<span class="error_message" id="phone_primary_error"></span>                                
                                <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div class="block">
                            <h3 class="title">Credit Card Information</h3>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Card Name</div>
                                <div class="span6"><input type="text" name="card_name" id="card_name" value="" class="inputbox">
					
					<div class="gray">Enter name as it appears on card.</div></div>
					<span class="error_message" id="card_name_error"></span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Credit Card Number</div>
                                <div class="span6"><input type="text" name="card_number" id="card_number" value="" class="inputbox">
					
					<div class="gray">10 digit number on credit card.</div></div>
					<span class="error_message" id="card_number_error"></span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Security code</div>
                                <div class="span6"><input type="text" name="security_code" id="security_code" value="" class="inputbox">
					
					<div class="gray">3 digit security code on the back of credit card.</div></div>
					<span class="error_message" id="security_code_error"></span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                                <div class="clr">&nbsp;</div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">&nbsp;</div>
                                <div class="span4">You are signing up for Daily Drums – professional Advertisers Pay <a class="gray" href="#">per clicks</a>..</div>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">&nbsp;</div>
                                <div class="span6"><a class="blue_btn1" id="button_submit" href="#">SUBMIT</a></div>
                                <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
            </div>
        </div>
        
<script type="text/javascript" >

	var pro_plan_price = '';

	$(document).ready( function(){
		$('#button_submit').click(function() {     

				request = $.ajax({
					      type: 'post',
					      url: "<?=base_url('registration/business_registration_submit')?>",
					      data: $('form').serialize(),
						dataType:'json'
					     
					 	 });
				  
				  request.done(function(response) {

							if(response.error_flag == '0')	{
				
									$(".pop_message.align-center").css("display","block");		         // Showing Thank you message
									$('.overlay').css("display","block");											// Back ground overlay black
									
									if(response.price != ''){					       
											$('#pay').html("Press Thanks button to pay...");
											pro_plan_price = response.price;
											
											$('.blue_btn2').addClass('pay_btn');
											$('.pay_btn').removeClass('blue_btn2');
											$('#succ_btn').attr('href',"<?=base_url('registration/pay');?>/"+pro_plan_price);
											}
									/*$('.inputbox, .selectbox').each(function(){				    // Clearing all input and select boxes
											this.value='';			
											});
									$('.error_message').each(function(){  					// clearing all error spans
											$('#'+this.id).html('');		
											});*/
								 	}
									else {
											for(key in response.result.error) {

												$('#'+key+"_error").html('* '+response.result.error[key]);
												$('#'+key+"_error").show();
												$('#'+key).addClass('error_message_border');
												}
										 	}			        
				 	 });
            		});

		/***** 
		**After submit when boxes clicked error span and error class would be hide and removed*** 
		*/
		$('.inputbox, .selectbox').focus(function(){
			
				if( $("#"+this.id+'_error').html() != '' ) {
						
						$(this).removeClass('error_message_border');	
						$("#"+this.id+'_error').hide();	
						}			
				});

		/***** 
		**After submit when boxes are not filluped then show the input box span error and add error class***
		*/

		$('.inputbox, .selectbox').blur(function(){
							 
				if( this.value == '' && $("#"+this.id+'_error').html() != '' ) {

					$(this).addClass('error_message_border');	
					$("#"+this.id+'_error').show();
					}				
				});
				
		/*$('.pay_btn').click(function(){
			alert("hi - "+pro_plan_price);
				//window.location.href = "<?=base_url('registration/pay');?>/"+pro_plan_price;
			});*/

		$('.blue_btn2').click(function(){
					
					$('.pop_message.align-center').fadeOut(1000);
					$('.overlay').fadeOut(1500);
					});
            
            });

</script>
        <!--End Content-->
