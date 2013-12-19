<!--Start Content-->
        <div class="container-fluid">
            <div class="main_container">
                <div class="row-fluid">
                <div class="span9 main_content">
                    <h2 class="title">My Account</h2>
                    <div class="list2">
                    	<ul class="row-fluid">
                        	<li class="span2"><a href="<?=base_url('user/editprofile');?>">
                            	<span class="icon"><img src="<?=base_url('themes/front/images/man_icon.png');?>" alt=""></span>
                                Account Change</a>
                            </li>
                            <li class="span2"><a href="<?=base_url('user/changepassword');?>">
                            	<span class="icon"><img src="<?=base_url('themes/front/images/lock_icon.png');?>" alt=""></span>
                                Change your password</a>
                            </li>
                            <li class="span2"><a href="<?=base_url('user/my_subscription');?>">
                            	<span class="icon"><img src="<?=base_url('themes/front/images/book_icon.png');?>" alt=""></span>
                                Manage your Subscription</a>
                            </li>
                            <li class="span2"><a href="<?=base_url('user/my_subscription');?>">
                            	<span class="icon"><img src="<?=base_url('themes/front/images/heart_icon.png');?>" alt=""></span>
                                Manage Your favorite Store</a>
                            </li>
                            <?php if($this->user_type == 'end_user'){?>
                            <li class="span2"><a href="<?=base_url('user/upload_profile_picture');?>">
                            	<span class="icon"><img src="<?=base_url('themes/front/images/camera.png');?>" alt=""></span>
                               Upload Profile Picture</a>
                            </li>
                            <?php } ?>
                        </ul>
                        <div class="clr"></div>
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
