<div class="email-content-wrapper">

            
            <div class="email-msg-body"> 
            
            
			            <?php $this->load->view('email_templates/email_header');?>
							<h4>Successfully Registered</h4>
							<p>    
							Hello  <?php echo $username; ?>, <br/><br/>
							
							You have been registered successfully on <strong><?php echo date('d M, Y');?></strong> at <em><?php echo date('H:i:s');?> Hrs</em>. <br />
							<?php if(isset($extra_msg) && $extra_msg != ''){ echo $extra_msg; } ?>
							To activete your account please click the link <a style="color:#137BFF;" href="<?php echo $activation_link; ?>" >- Activate</a>. <br/><br/> 
							
							     
							
							</p>
							<?php $this->load->view('email_templates/email_footer');?>