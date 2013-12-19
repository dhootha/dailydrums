<?php $CI =& get_instance();?>
<script type="text/javascript">

		function editInformation(activePopupClass) {
					if($('#return_info').css('display') != 'none')
						hide_popup('return_info');
						
					$('.overlay,.'+activePopupClass).show();					
					}
					
		function hide_popup(activePopupClass) {
					$('.overlay,.'+activePopupClass).hide();
					}

		$(document).ready(function(){
			
			var ret_action_form = "<?=$this->session->flashdata('action_form');?>";
			var ret_msg        = "<?=preg_replace('/^\s+|\n|\r|\s+$/m', '<br>',$this->session->flashdata('action_msg'));?>";
			var ret_msg_type   = "<?=$this->session->flashdata('action');?>";
			
			var ret_title = 'Sign-in Information';
			
			if(ret_action_form == 'business_info')
				ret_title = 'Business Information';
				else if(ret_action_form == 'address_info')
					ret_title = 'Address Information';
					else if(ret_action_form == 'membership_info')
						ret_title = 'Membership Information';
						else if(ret_action_form == 'card_info')
							ret_title = 'Card Information';
			
			//alert("ret_action_form = "+ret_action_form+", ret_msg = "+ret_msg+", ret_msg_type = "+ret_msg_type);
			
			if(ret_action_form && ret_msg && ret_msg_type){
				
				if(ret_msg_type == '0'){  // For error message
					var ret_msg_btn = "<a href='javascript:void(0);' onclick=editInformation('"+ret_action_form+"') class='blue_btn2'>Edit</a><span class='space'></span><a class='gray_btn3' href='javascript:void(0);' onclick=hide_popup('return_info') >Cancel</a>";
									
					var img_smily = "<img height='40' width='40' src=<?php  echo $CI->config->item('front_link_path').'images/sad_smiley.png';?> alt=''>";
					$('#ret_msg_title').html(ret_title);	
					$('#img_smily').html(img_smily);				
					$('#ret_msg_btn').html(ret_msg_btn);
					$('#ret_msg').html(ret_msg);
					$('#ret_msg').addClass('error_message');	
					editInformation('return_info');
					}				
					else{  // For success message
							var img_smily = "<img src=<?php  echo $CI->config->item('front_link_path').'images/smiley_icon.png';?> alt=''>";
							var ret_msg_btn = "<a class='blue_btn2' href='javascript:void(0);' onclick=hide_popup('return_info') >Ok</a>";
							$('#ret_msg_title').html(ret_title);	
							$('#img_smily').html(img_smily);
							$('#ret_msg_btn').html(ret_msg_btn);
							$('#ret_msg').html(ret_msg);
							$('#ret_msg').addClass('success_message1');	
							editInformation('return_info');				  
						  }				
				}
			});
			
		function update_sign_info() {
					if($('#user_name').val() == '') {
						alert("Enter Your Full Name.");
						$('#user_name').focus();
						return false;
						}
				   if($('#email').val() == '') {
						alert("Enter Your Email.");
						$('#email').focus();
						return false;
						}
						else{
								var re = /^[_a-z]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/;
							 	if( !$('#email').val().match( re ) ) {
									alert("Provide Valid Email Id.");
									$('#email').focus();
									return false;
									}	
							   }
			      if($('#password').val() == '') {
						alert("Enter Your Password.");
						$('#password').focus();
						return false;
						}
						else if($('#password').val().length < 8) {
								alert("Password Should Be Minimum 8 Charecters Long.");
								$('#password').focus();
								return false;
								}
								else if($('#confirm_password').val() == '') {
									alert("Enter Your Password Again.");
									$('#confirm_password').focus();
									return false;
									}
									else if( $('#confirm_password').val() != $('#password').val() ){
										alert("Both the password Not Matched.");
										$('#confirm_password').val('');
										$('#confirm_password').focus();
										return false;
										} 
				    document.sign_form.submit();
			}
			
		function update_business_info(){
					if($('#legal_name').val() == ''){
						alert("Enter Your Legal Name.");
						$('#legal_name').focus();
						return false;							
						}	
					if($('#business_email').val() == '') {
						alert("Enter Your Business Eemail.");
						$('#business_email').focus();
						return false;
						}
						else{
								var re = /^[_a-z]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/;
							 	if( !$('#business_email').val().match( re ) ) {
									alert("Provide Valid Business Email Id.");
									$('#business_email').focus();
									return false;
									}	
							   }	
					document.business_form.submit();
			}
			
		function update_membership_info(){
					if($('#display_name').val() == '')	{
						alert("Enter Your Display Name.");
						$('#display_name').focus();
						return false;							
						}	
					document.membership_form.submit();
			}
		
		function update_address_info(){
					if($('#address_line1').val() == '')	{
						alert("Enter Your Address Line 1.");
						$('#address_line1').focus();
						return false;							
						}	
					if($('#address_line2').val() == '')	{
						alert("Enter Your Address Line 2.");
						$('#address_line2').focus();
						return false;							
						}
					if($('#city').val() == '')	{
						alert("Enter Your City.");
						$('#city').focus();
						return false;							
						}
					if($('#state').val() == '')	{
						alert("Enter Your State.");
						$('#state').focus();
						return false;							
						}
					if($('#zip').val() == '')	{
						alert("Enter Your Zip.");
						$('#zip').focus();
						return false;							
						}
					if($('#country').val() == '') {
						alert("Select Your Country.");
						$('#country').focus();
						return false;							
						}
					if($('#primary_phone').val() == '') {
						alert("Enter Your Primary Phone.");
						$('#primary_phone').focus();
						return false;							
						}
						else{
								if(isNaN($('#primary_phone').val()) && ($('#primary_phone').val().length < 10) && ($('#primary_phone').val() > 14)){
									alert("Enter Valid Primary Phone.");
									$('#primary_phone').focus();
									return false;
												}
							  }
					document.address_form.submit();
			}
		
		function update_card_info(){
			if($('#card_name').val() == '')	{
				alert("Enter Your Card Name.");
				$('#card_name').focus();
				return false;							
				}	
			if($('#cc_number').val() == '' || $('#cc_number').val().length < 10)	{
				alert("Enter Your Credit Card Number Properly.");
				$('#cc_number').focus();
				return false;							
				}
			if($('#security_code').val() == '')	{
				alert("Enter Your Security Code.");
				$('#security_code').focus();
				return false;							
				}	
			document.card_form.submit();
			}
</script>

<!-- ############## Popups START ############## -->

	<!-- Return info part popup start-->
        <div class="return_info align-center" style="display:none">
            <div class="content">
                <p class="blue font14 title"><b id="ret_msg_title"></b></p>
                <p id="img_smily"></p>
                <p id="ret_msg"></p>
                <p id="ret_msg_btn"></p>
            </div>
        </div> 
 	<!-- Return info part popup end--> 

	<!-- Signin info part popup start-->
        <div class="sign_info align-center" style="display:none">
            <div class="content">
                <p class="blue font14 title"><b>Edit Sign-in Information&nbsp;&nbsp;</b></p>
                <p>&nbsp;</p>
                <form name="sign_form" action="<?=base_url('user/update_sign_info')?>" method="post">
                <p>
                	<div class="sign_field"><span>Name : </span><span><input type="text" name="user_name" id="user_name" value="<?=$userData->firstname." ".$userData->lastname;?>" /></span></div>
                	<div class="sign_field"><span>Email : </span><span><input type="text" name="email" id="email" value="<?=$userData->email;?>"/></span></div>
                	<div class="sign_field"><span>Password : </span><span><input type="password" name="password" id="password" /></span></div>
                	<div class="sign_field"><span>Confirm Password : </span><span><input type="password" name="confirm_password" id="confirm_password" /></span></div>
                </p>
                <p><a href="javascript:void(0);" onclick="update_sign_info()" class="blue_btn2">Update</a><span class="space"></span><a class="gray_btn3" href="javascript:void(0);" onclick="hide_popup('sign_info')">Cancel</a></p>
					</form>
            </div>
        </div> 
 	<!-- Signin info part popup end-->   
 	    
 	<!-- Business info part popup start-->      
        <div class="business_info align-center" style="display:none">
            <div class="content">
                <p class="blue font14 title"><b>Edit Business Information&nbsp;&nbsp;</b></p>
                <p>&nbsp;</p>
                <form name="business_form" action="<?=base_url('user/update_business_info')?>" method="post">
                <p>
                	<div class="sign_field"><span>Legal Name : </span><span><input type="text" name="legal_name" id="legal_name" value="<?=$userData->legal_name;?>" /></span></div>
                	<div class="sign_field"><span>Email : </span><span><input type="text" name="business_email" id="business_email" value="<?=$userData->business_email;?>"/></span></div>
                </p>
                <p><a href="javascript:void(0);" onclick="update_business_info()" class="blue_btn2">Update</a><span class="space"></span><a class="gray_btn3" href="javascript:void(0);" onclick="hide_popup('business_info')">Cancel</a></p>
					</form>
            </div>
        </div> 
 	<!-- Business info part popup end-->   
 	<!-- Business info part popup start-->      
        <div class="membership_info align-center" style="display:none">
            <div class="content">
                <p class="blue font14 title"><b>Edit Membership Information&nbsp;&nbsp;</b></p>
                <p>&nbsp;</p>
                <form name="membership_form" action="<?=base_url('user/update_membership_info')?>" method="post">
                <p>
                	<div class="sign_field"><span>Display Name : </span><span><input type="text" name="display_name" id="display_name" value="<?=$userData->display_name;?>" /></span></div>
                </p>
                <p><a href="javascript:void(0);" onclick="update_membership_info()" class="blue_btn2">Update</a><span class="space"></span><a class="gray_btn3" href="javascript:void(0);" onclick="hide_popup('membership_info')">Cancel</a></p>
					</form>
            </div>
        </div> 
 	<!-- Business info part popup end-->   
 	<!-- Business info part popup start-->      
        <div class="address_info align-center" style="display:none; margin-top:-200px; ">
            <div class="content">
                <p class="blue font14 title"><b>Edit Address Information&nbsp;&nbsp;</b></p>
                <p>&nbsp;</p>
                <form name="address_form" action="<?=base_url('user/update_address_info')?>" method="post">
                <p>
                	<div class="sign_field"><span>Address Line 1 : </span><span><input type="text" name="address_line1" id="address_line1" value="<?=$userData->address_two;?>" /></span></div>
                	<div class="sign_field"><span>Address Line 2 : </span><span><input type="text" name="address_line2" id="address_line2" value="<?=$userData->address_two;?>"/></span></div>
                	<div class="sign_field"><span>City/Town : </span><span><input type="text" name="city" id="city" value="<?=$userData->city;?>"/></span></div>
                	<div class="sign_field"><span>Province/Region/State : </span><span><input type="text" name="state" id="state" value="<?=$userData->state;?>" /></span></div>
						<div class="sign_field"><span>Postal Code/Zip Code : </span><span><input type="text" name="zip" id="zip" value="<?=$userData->zip;?>" /></span></div>
						<div class="sign_field"><span>Country : </span>
														 <span>
														 		<select name="country" id="country" class="selectbox">
																		<option value=''>Select</option>
																		<?php foreach($countryList as $country) { ?>
																				<option value="<?php echo $country->id; ?>" <?=($country->id == $userData->country_id)?'selected=selected':'';?> > <?php echo $country->country_name; ?> </option>
																		<?php } ?>
																</select>
														 </span>
						</div>
						<div class="sign_field"><span>Primary Phone : </span><span><input type="text" name="primary_phone" id="primary_phone" value="<?=$userData->primary_phone;?>" /></span></div>               
                </p>
                <p><a href="javascript:void(0);" onclick="update_address_info()" class="blue_btn2">Update</a><span class="space"></span><a class="gray_btn3" href="javascript:void(0);" onclick="hide_popup('address_info')">Cancel</a></p>
					</form>
            </div>
        </div> 
 	<!-- Business info part popup end-->   
 	<!-- Business info part popup start-->      
        <div class="card_info align-center" style="display:none">
            <div class="content">
                <p class="blue font14 title"><b>Edit Credit-Card Information&nbsp;&nbsp;</b></p>
                <p>&nbsp;</p>
                <form name="card_form" action="<?=base_url('user/update_card_info')?>" method="post">
                <p>
                	<div class="sign_field"><span>Card Name : </span><span><input type="text" name="card_name" id="card_name" value="<?=$userData->card_name;?>" /></span></div>
                	<div class="sign_field"><span>Credit Card Number : </span><span><input type="text" name="cc_number" id="cc_number" value="<?=$userData->cc_number;?>"/></span></div>
                	<div class="sign_field"><span>Security Code : </span><span><input type="password" name="security_code" id="security_code" /></span></div>
                </p>
                <p><a href="javascript:void(0);" onclick="update_card_info()" class="blue_btn2">Update</a><span class="space"></span><a class="gray_btn3" href="javascript:void(0);" onclick="hide_popup('card_info')">Cancel</a></p>
					</form>
            </div>
        </div> 
 	<!-- Business info part popup end-->   
        
        <div class="overlay" style="display:none"></div>
        
<!-- ############## Popups END ############## -->

<!--Start Content-->
        <div class="container-fluid">
            <div class="main_container">
                <div class="row-fluid">
                		
                	<div class="span9 main_content">
                	
                			<!-- <//?php if($this->session->flashdata('action_msg') != '') { ?>
	                			<div class="row-fluid">
	                            	<div class="span3 form_label"></div>
	                                	<div ><div class="<?=($this->session->flashdata('action') == '0')?'error_message':'success_message1';?>" id="action_msg"><?=$this->session->flashdata('action_msg');?>&nbsp;</div></div>
	                                <div class="clr"></div>
	                        </div> 
                        <//?php } ?>-->
                        
                        <div class="block">
                            <h3 class="title">Sign-in Information&nbsp;&nbsp;<a href="javascript:void(0);" onclick="return editInformation('sign_info');"><img src="<?=base_url('themes/front/images/edit_icon1.png');?>" width="14" height="16" border="0"></a></h3>
                      <div class="row-fluid">
                            	<div class="span2 form_label">Name</div>
                                <div class="span6" id="sign_name"><?=$userData->firstname." ".$userData->lastname;?></div>
                              <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Email Address</div>
                                <div class="span6" id="sign_email"><?=$userData->email;?></div>
                              <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                              <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Password</div>
                                <div class="span6">**********</div>
                              <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                        </div>
<div class="block">
                            <h3 class="title">Business Information&nbsp;&nbsp;<a href="javascript:void(0);" onclick="return editInformation('business_info');"><img src="<?=base_url('themes/front/images/edit_icon1.png');?>" width="14" height="16" border="0"></a></h3>
<div class="row-fluid">
                            	<div class="span2 form_label">Legal Name</div>
                                <div class="span6" id="business_name"><?=$userData->legal_name;?></div>
                              <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                           	  <div class="span2 form_label">Email Address</div>
                                <div class="span6" id="business_email"><?=$userData->business_email;?></div>
                              <div class="clr"></div>
                            </div>
                          </div>
<div class="block">
                            <h3 class="title">Membership Information&nbsp;&nbsp;<a href="javascript:void(0);" onclick="return editInformation('membership_info');"><img src="<?=base_url('themes/front/images/edit_icon1.png');?>" width="14" height="16" border="0"></a></h3>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Display Name</div>
                                <div class="span6" id="membership_name"><?=$userData->display_name;?></div>
                          </div>
                            <div class="clr"></div>
                        </div>
                        <div class="block">
                            <h3 class="title">Address Information&nbsp;&nbsp;<a href="javascript:void(0);" onclick="return editInformation('address_info');"><img src="<?=base_url('themes/front/images/edit_icon1.png');?>" width="14" height="16" border="0"></a></h3>
                            <div class="row-fluid">
                           	  <div class="span2 form_label">Address Line 1<div class="gray"></div>
                           	  </div>
                                <div class="span6" id="address_one"><?=$userData->address_one;?> </div>
                              <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                           	  <div class="span2 form_label">Address Line 2<div class="gray"></div>
                           	  </div>
                                <div class="span6" id="address_two"><?=$userData->address_two;?> </div>
                              <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">City/Town</div>
                                <div class="span6" id="address_city"><?=$userData->city;?></div>
                              <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Province/Region/State</div>
                                <div class="span6" id="address_state"><?=$userData->state;?></div>
                              <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Postal Code/Zip Code</div>
                                <div class="span6" id="address_zip"><?=$userData->zip;?></div>
                              <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Country</div>
                                <div class="span6" id="address_country"><?=$userData->country_name;?></div>
                              <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Primary Phone</div>
                                <div class="span6" id="address_phone"><?=$userData->primary_phone;?></div>
                              <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div class="block">
                            <h3 class="title">Credit Card Information&nbsp;&nbsp;<a href="javascript:void(0);" onclick="return editInformation('card_info');"><img src="<?=base_url('themes/front/images/edit_icon1.png');?>" width="14" height="16" border="0"></a></h3>
<div class="row-fluid">
                            	<div class="span2 form_label">Card Name</div>
                                <div class="span6" id="card_name"><?=$userData->card_name;?></div>
            <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Credit Card Number</div>
                                <div class="span6" id="card_number"><?=$userData->cc_number;?></div>
                              <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span2 form_label">Security code</div>
                                <div class="span4">*** <br>
                                  <br>
                                  <br>
                              </div>
                              <div class="clr"></div>
                            </div>
                            <div class="row-fluid"></div>
                          <div class="clr"></div>
                        </div>
                  </div>
                
		 <?php  $this->load->view('front/common/right_menu'); ?>
                                
                <div class="clr"></div>
                </div>
            </div>
        </div>
        <!--End Content-->

