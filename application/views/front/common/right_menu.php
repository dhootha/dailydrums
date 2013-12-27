<?php if( $logged_in ) {?>

                <div class="span3 sidebar">
                
              <?php if($this->is_logged_in['user_type'] != 'end_user'){?> <!--  for business user -->
              
              		 <?php if($active_class == 'store' ){ ?>  <!-- For create store blue button -->
								<div class="block">
		                    	<a href="<?=base_url('user/create_store')?>" class="blue_btn2">Create your store</a>
		                    </div>
                	<?php }else{ ?>
                		<div class="block">
		                    	<a href="<?=base_url('user/create_campaign')?>" class="blue_btn2">Create a campaign</a>
		                    </div>
                	<?php }?>
                	
                    <div class="block">
                        <h2 class="title blue">Account</h2>   
                        <ul class="links">
                            <li ><a href="<?=base_url('user/my_campaign')?>">My Campaigns</a>
                            		<?php if($active_class == 'my_campaigns' ){ ?>
                            			<ul class="links">
		                                    <li <?php if($active_sub_class == 'all' || $active_sub_class == '' ) echo"class='active'"; ?> ><a href="<?=base_url('user/my_campaign')?>">All</a></li>
		                                    <li <?php if($active_sub_class == 'drafts' ) echo"class='active'"; ?> ><a href="<?=base_url('user/my_campaign/drafts')?>">Drafts</a></li>
		                                    <li <?php if($active_sub_class == 'scheduled' ) echo"class='active'"; ?> ><a href="<?=base_url('user/my_campaign/scheduled')?>">Scheduled</a></li>
		                                    <li <?php if($active_sub_class == 'active' ) echo"class='active'"; ?> ><a href="<?=base_url('user/my_campaign/active')?>">Active</a></li>
                                		</ul>
                            		<?php } ?>
                            </li>
                            <li <?php if($active_class == 'analytic' ) echo "class='active'";?>><a href="<?=base_url('user/analytics')?>">Analytic</a></li>
                            <li <?php if($active_class == 'store' ) echo "class='active'";?>><a href="<?=base_url('user/create_store')?>">My Stores</a></li>
                            <li <?php if($active_class == 'my_subscribers' ) echo "class='active'";?>><a href="<?=base_url('user/my_subscribers')?>">My Subscribers</a></li>
                            <li <?php if($active_class == 'my_account' ) echo "class='active'";?>><a href="<?=base_url('user/my_account');?>">My Account</a></li>
                            <li <?php if($active_class == 'logout' ) echo "class='active'";?>><a href="<?=base_url('user/logout');?>">Logout</a></li>
                        </ul>
                        
              <?php }else{ ?>  <!--  for End user -->
              
              			<div class="block">
                        <h2 class="title blue">Account</h2>
              				<ul class="links">
                            <li <?php if($active_class == 'inbox' ) echo "class='active'";?>><a href="<?=base_url('user/inbox')?>">Inbox</a></li>
                            <li <?php if($active_class == 'clipits' ) echo "class='active'";?>><a href="<?=base_url('user/my_clips')?>">Clip Its</a></li>
                            <li <?php if($active_class == 'mysubscription' ) echo "class='active'";?>><a href="<?=base_url('user/my_subscription');?>">My Subscriptions</a></li>
                            <li <?php if($active_class == 'drumsbeat' ) echo "class='active'";?>><a href="<?=base_url('welcome/main');?>">Drums Beats</a></li>
                            <li <?php if($active_class == 'myaccount' ) echo "class='active'";?>><a href="<?=base_url('user/profile');?>">My Account</a></li>
                            <li <?php if($active_class == 'logout' ) echo "class='active'";?>><a href="<?=base_url('user/logout');?>">Logout</a></li>
                        </ul>
              
              <?php } ?>
                    </div>
                </div>
              
			
		<?php } else {?>
			
			<div class="span3 sidebar">
		             <!--<div class="block">
		                 <h2 class="title blue"><a class="title blue" href="<?=base_url('welcome/pricing')?>" style="margin-right:30px;">Register</a> <a class="title blue" href="<?=base_url('user');?>">Login</a></h2>
							  <div class="join_form">
							  <h4>To subscribe the deals please sign up in Daily Drums</h4>
                       <p class="align-center"><input type="button" value="SIGN UP" onclick="window.location='<?=base_url("home")?>'" class="signup_btn"></p>
                       </div>
						 </div> -->
			</div>

		<?php } ?>
