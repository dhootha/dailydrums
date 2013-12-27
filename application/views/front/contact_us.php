<!--Start Content-->
<div class="clr"></div>
        <div class="container-fluid">
            <div class="main_container">
                <div class="row-fluid">
                <div class="span9 main_content">
                    <h2 class="title">Contact Us</h2>
                    <div class="top_banner">
                    	<div class="img"><img src="<?=base_url('themes/front/images/contact_img.jpg');?>" width="100%" alt=""></div>
                    </div>
                    <div class="contact_btm">
                    	<div class="row-fluid">
                        	<div class="span3">
                            	<h2 class="title blue"><img src="<?=base_url('themes/front/images/address_icon1.jpg');?>" alt=""> Address:</h2>
                                <p class="gray">Level 10, 10 Queens Road Melbourne VIC 3004</p>
                            </div>
                            <div class="span3">
                            	<h2 class="title blue"><img src="<?=base_url('themes/front/images/tel_icon2.jpg');?>" alt=""> Telephone:</h2>
                                <p class="gray">US: 1-866-000-0000<br>Other: 1-408-000-0000</p>
                            </div>
                            <div class="span3">
                            	<h2 class="title blue"><img src="<?=base_url('themes/front/images/working_icon2.jpg');?>" alt=""> Working Hours:</h2>
                                <p class="gray">Our agents are available <br>7 days a week, from <br>5 AM - 10 PM Pacific time.</p>
                            </div>
                            <div class="span3">
                            	<h2 class="title blue"><img src="<?=base_url('themes/front/images/email_icon1.jpg');?>" alt=""> Email:</h2>
                                <p class="gray">info@dailydrums.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="contact_form">
                    	<div class="block">
                    	
                    			<form name="contactus" id="contactus" method="post" action="<?=base_url('welcome/contactus_submit');?>">
                            <h2 class="title">Contact Form</h2>
                            
                            <div class="<?=($this->session->flashdata('action'))?'success_message1':'error_message';?>" id="action_msg"><?=$this->session->flashdata('action_msg');?>&nbsp;</div>
                            
                            <div class="row-fluid">
                            	<div class="span3 form_label">Your name (optional)</div>
                                <div class="span8">
                                		<span class="error_message"><?=form_error('u_name');?></span>
                                		<input type="text" name="u_name" id="u_name" value="" class="inputbox">
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span3 form_label">E-mail </div>
                                <div class="span8">
                                		<span class="error_message"><?=form_error('email');?></span>
                                		<input type="text" name="email" id="email" value="" class="inputbox">
                                		</div>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span3 form_label">Subject (optional)</div>
                                <div class="span8">
                                		<span class="error_message"><?=form_error('subject');?></span>
                                		<input type="text" name="subject" id="subject" value="" class="inputbox">
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span3 form_label">Message</div>
                                <div class="span8">
                                		<span class="error_message"><?=form_error('message');?></span>
                                		<textarea class="textarea" name="message" id="message" rows="5" cols="10"></textarea>
                                		</div>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span3 form_label">&nbsp;</div>
                                <div class="span5"><a class="blue_btn1" href="#">CONTINUE</a></div>
                                <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                            
                           </form>
                        </div>
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
    
    
<script type="text/javascript" >

	$(document).ready( function(){
		$('.blue_btn1').click(function() {  
		
					document.contactus.submit();
				});
		});
</script>