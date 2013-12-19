        <!--Start Footer-->
        <div class="footer">
            <div class="container-fluid">
            	<div class="row-fluid">
                    <div class="span4 block1">
                        <h3>Quick Links</h3>
                        <ul>
                            <li><a href="<?php if($this->is_logged_in['user_id']) echo base_url('welcome/main'); else echo base_url();?>">Home</a></li>
                            <li><a href="<?php if($this->is_logged_in['user_id']) echo base_url('welcome/main'); else echo base_url('welcome/pricing');?>">Daily Drum for Business</a></li>
                            <li><a href="<?=base_url('page/id/6')?>">Privacy Policy</a></li>
                            <li><a href="<?=base_url('page/id/7')?>">Help</a></li>
                        </ul>
                        <ul>
                            <li><a href="<?=base_url('page/id/1')?>">About Us</a></li>
                            <li><a href="<?=base_url('page/id/3')?>">Terms of Use</a></li>
                            <li><a href="<?=base_url('welcome/contact_us');?>">Contact Us</a></li>
                        </ul>
                        <div class="clr"></div>
                    </div>
                    <div class="span4 block2">
                        <h3>Get in Touch</h3>
                        <ul>
                            <li><img src="<?=base_url('themes/front/images/mail_icon1.jpg');?>" alt=""> <a href="mailto:info@dailydrums.com">info@dailydrums.com</a></li>
                            <li><img src="<?=base_url('themes/front/images/tel_icon1.jpg');?>" alt=""> +43 512 5164879</li>
                            <li><img src="<?=base_url('themes/front/images/location_icon1.jpg');?>" alt=""> Level 10, 10 Queens Road Melbourne VIC 3004</li>
                        </ul>
                    </div>
                    <div class="span4 block3">
                        <h3>Connect with us</h3>
                        <div class="social_icons">
                        	<a href="http://www.facebook.com" target="_blank" ><img src="<?=base_url('themes/front/images/facebook.jpg');?>" alt=""> </a>
                            <a href="http://www.twitter.com" target="_blank" ><img src="<?=base_url('themes/front/images/twitter.jpg');?>" alt=""> </a>
                            <a href="http://www.pinterest.com" target="_blank" ><img src="<?=base_url('themes/front/images/pinterest.jpg');?>" alt=""> </a>
                        </div>
                        <div class="copy">&copy; 2013-2014 dailydrums.com. All Rights Reserved.</div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Footer-->
    
    </div>
    
    <p id="back-top" style="display: block;">
		<a href="#top"><span></span></a>
	</p>
    
    
    
</body>
</html>