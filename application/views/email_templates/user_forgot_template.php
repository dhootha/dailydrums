<?php $this->load->view('email_templates/email_header');?>
<h4>Password Reset Request</h4>
<p>    
Hello  <?php echo $username; ?>, <br/><br/>

A new password was requested by you on <strong><?php echo date('d M, Y');?></strong> at <em><?php echo date('H:i:s');?> Hrs</em>. <br />

To complete the request please click <a href="<?php echo $change_password_link; ?>" >- Reset Password</a>. <br/><br/> 

Please note : If you did not make this request ignore the email; no changes have been made.     

</p>
<?php $this->load->view('email_templates/email_footer');?>