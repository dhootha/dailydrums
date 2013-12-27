<!--Start Content-->
        <div class="container-fluid">
            <div class="main_container">
                <div class="row-fluid">
                		
                	<div class="span9 main_content">
                    <h2 class="title">My Campaigns</h2>
              <div class="contact_form campaign_form">
              			
                    	<div class="block">
                    	<h2 class="title"><?=$view_page;?></h2>
                    		<?php if(!empty($deals)){?>
                            
                            <div class="data_table">
                                <div class="row-fluid">
                                    <div class="head">
                                        <div class="span2">Edit</div>
                                        <div class="span4">Name</div>
                                        <div class="span2">Date</div>
                                        <div class="span2">Analytic</div>
                                        <div class="span2 last">Status</div>
                                        <div class="clr"></div>
                                    </div>
                                    
                                </div>
                                <?php foreach($deals as $deal){ ?>
                                <div class="row-fluid">
                                    <div class="rows">
                                        <div class="span2"><a class="edit_icon" href="<?=base_url('user/edit_campaign/'.$deal->id);?>">Edit</a></div>
                                        <div class="span4"><?=$deal->business_name;?></div>
                                        <div class="span2"><?=date('d/m/Y',strtotime($deal->created_date));?></div>
                                        <div class="span2">View Analytic</div>
                                        <div class="span2"><?php if($deal->status == '1') echo "Active"; elseif($deal->status == '0') echo "Inactive"; elseif($deal->status == '2') echo "Saved"; elseif($deal->status == '3') echo "Scheduled";?></div>
                                        <div class="clr"></div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <?php } else  echo"No Campaigns found.";?>
                        </div>
                        
                    </div>
                </div>
                
		 <?php  $this->load->view('front/common/right_menu'); ?>
                                
                <div class="clr"></div>
                </div>
            </div>
        </div>
        <!--End Content-->

<script type="text/javascript">

	/*	$(document).ready( function(){

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
			});*/

</script>