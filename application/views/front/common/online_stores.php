 <div class="top_head">
      <h2 class="title red floatleft">ON-LINE STORES</h2>
      <a href="<?php echo base_url('welcome/online_stores');?>" class="floatright">view all <span class="font_type2">+</span></a>
      <div class="clr"></div>                                
  </div>
  <div class="list1 row-fluid">
         <ul>
       <?php
       if(isset($online_deals) && $online_deals!=false){
      
       foreach($online_deals as $deals){ ?>
       
       <li class="span4">
       	<div class="block">
           <div class="img">
           	<!--<div class="img_hover">
               	<span class="icon"><a href="<?php echo site_url('welcome/dealDetails/'.$deals->id);?>"><img src="<?=base_url('themes/front/images/link_icon.png');?>" alt=""></a></span>
               </div> -->
               <?php  
               		if($deals->campaign_type == 'pro')
                  			$file_name = $deals->business_logo;
                  			elseif($deals->campaign_type == 'basic' && $deals->use_logo == '1')
                  						$file_name = $deals->business_logo;
                  						else 
                  							$file_name = $deals->business_image;
               							
            			if($file_name != '')
               				$file_name = base_url('uploads/deal_images/'.$file_name);
               				else
               					 $file_name = base_url('themes/front/images/no-image.jpg');
               ?>
               <img src="<?=$file_name;?>" class="img_245main" alt="">
           </div>
           <h3><a class="blue" href="<?php echo site_url('welcome/dealDetails/'.$deals->id);?>"><?php echo $deals->business_name;?><span class="font24">&#8594;</span></a></h3>
           <p><?php echo substr($deals->business_description,0,50);?>...</p>
          <!-- <div class="social_icons floatleft">
               <a href="#"><img src="<?=base_url('themes/front/images/facebook.jpg');?>" width="16" alt=""> </a>
               <a href="#"><img src="<?=base_url('themes/front/images/twitter.jpg');?>" width="16" alt=""> </a>
               <a href="#"><img src="<?=base_url('themes/front/images/pinterest.jpg');?>" width="16" alt=""> </a>
           </div> -->
           <?php if($this->is_logged_in['user_type']=='end_user'){?>
           <div class="floatright" id="subscribeDeal_<?php echo $deals->id;?>">
           <?php 
           if($this->Common_model->isSubscribe($this->is_logged_in['user_id'],$deals->id)==true){
           ?>
               <a class="red font_type1 font16" href="javascript:void(0);" onclick="dialogBox(<?php echo $deals->id;?>,'un')">Unsubscribe</a>
           <?php } else {?>
               <a class="red font_type1 font16" href="javascript:void(0);" onclick="dialogBox(<?php echo $deals->id;?>,'sub')">Subscribe</a>
           <?php }?>
           </div>
           <?php }?>
           <div class="clr"></div>
           </div>
       </li>
       
       <?php }}else{ ?>
       
           <li class="blue"><strong>No Campaigns Found.</strong></li>
       
   <?php    
   }
   ?>

   </ul>
      <div class="clr"></div>
  </div>
