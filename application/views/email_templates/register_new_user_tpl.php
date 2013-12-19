<?php $this->load->view('email_templates/email_header');?>
<h4>Welcome to <a href="<?php echo base_url()?>">Brainyax!</a></h4> 
<p>   
Thank you for registering. Please click on the link below to authenticate your account. 
You will then have access in to the amazing world of <a href="<?php echo base_url();?>">Brainyax</a>. <br/>

<h4>Your Login credentials are as follows: </h4> 

    <strong>Username: </strong>:<?php echo $username;?> <br/>
    <strong>Password: </strong><?php echo $password;?> <br/><br/>
    
    For security reasons of your account please click <a href="<?php echo $activation_link; ?>">here</a> to activate your account. <br/>
    
    If you unable to access the link above, just copy and paste the following link into your web browser: <br/>
    <?php echo $activation_link; ?>
    
</p>

<?php $this->load->view('email_templates/email_footer');?>