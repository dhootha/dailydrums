<script type="text/javascript">

function dialogBox(deal_id,status){
    if(status=='un')
    $('.text_val').html("<strong>You don't want to miss out the best deals. Do you really want to unsubscribe?</strong>");
    else
    $('.text_val').html("<strong>You don't want to miss out the best deals. Do you want to subscribe?</strong>");    
    $('.overlay').css('display','block');
    $('.pop_message').css('display','block');
    $('#deal_id').val(deal_id);
    $('#subs_type').val(status);
}

function show_return_message(msg) {
 	
 		$('.text_val3').html(msg);  
 		$('.overlay').css('display','block');
		$('.pop_message3').css('display','block');
 		}

function hide_success_message(){
	
	   $('.overlay').css('display','none');
      $('.pop_message3').css('display','none');
	  }
	  
function hide_overlay(){
    
    $('.overlay').css('display','none');
    $('.pop_message').css('display','none');
    $('#deal_id').val('');
    $('#subs_type').val('');
}
    
function subscribe(){
   
   $('.overlay').css('display','none');
   $('.pop_message').css('display','none');
   var status = $('#subs_type').val();
   var deal_id = $('#deal_id').val();
   var user_id = '<?php echo $this->is_logged_in['user_id']?>';
   if(user_id!=''){
   
   $.ajax({
        type: "POST",
        url: '<?php echo base_url('welcome/clip_campaign');?>',
        data: 'status='+status+'&clip_id='+deal_id,
        success: function(data) {
        	
        		var msg = "<strong>You have unsubscribed the deal successfully.</strong>";
		      show_return_message(msg);
                
            $('#subscribeDeal_'+deal_id).remove();
        }       
   });
   }
   else{
       window.location.href = "<?php echo base_url('registration_end')?>";
   }
        
   
}

var server_msg = "<?=$this->session->flashdata('action_msg');?>";
$(document).ready( function(){
			if(server_msg)
					show_return_message("<strong>"+server_msg+"</strong>");
			});

</script>

		<div class="pop_message pop_message1 align-center" style="display:none">
            <div class="content">
            	<p>&nbsp;</p>
                <p class="blue font14 text_val"></p>
                <p>&nbsp;</p>
                <p><a href="javascript:void(0);" onclick="subscribe()" class="gray_btn3">Yes</a><span class="space"></span><a class="blue_btn2" href="javascript:void(0);" onclick="hide_overlay()">No</a></p>
                <input type="hidden" id="deal_id" value="">
                <input type="hidden" id="subs_type" value="">
               
            </div>
        </div>    
        <!-- return meaessage -->
        <div class="pop_message3 pop_message4 align-center" style="display:none" id="return message">
            <div class="content">
            	<p>&nbsp;</p>
                <p class="blue font14 text_val3"></p>
                <p>&nbsp;</p>
                <p><a class="blue_btn2" href="javascript:void(0);" onclick="hide_success_message()">Ok</a></p>
                <input type="hidden" id="deal_id" value="">
                <input type="hidden" id="subs_type" value="">
            </div>
        </div>
        <!-- return meaessage --> 
        <div class="overlay" style="display:none"></div>

<!--Start Content-->
        <div class="container-fluid">
            <div class="main_container">
                <div class="row-fluid">
                
<!-- ----------- Page content ---------- -->
                
       <div class="span9 main_content image_content_view">         
                <div class="main_head">
                    	<h2 class="title floatleft">My Clips</h2>
                       <!-- <div class="floatright"><a class="black font18 font_type1" href="#">view all +</a></div> -->
                        <div class="clr"></div>
                    </div>
               <div class="list1 row-fluid">
                        <ul>
                            <?php
                            if(isset($inbox) && $inbox!=false){
                           
                            foreach($inbox as $deals){ ?>
                            
                            <li class="span4" id="subscribeDeal_<?php echo $deals->clip_id;?>">
                            	<div class="block my_sub_img">
                                <div class="img">
                                	  <!-- <div class="img_hover">
                                    	<span class="icon"><a href="<?php echo site_url('welcome/dealDetails/'.$deals->deal_id);?>"><img src="<?=base_url('themes/front/images/link_icon.png');?>" alt=""></a></span>
                                    </div> -->
                                    
                                    <img src="<?= base_url().'uploads/deal_images/'.(($deals->campaign_type == 'pro')?$deals->business_logo:($deals->campaign_type == 'basic' && $deals->use_logo == '1')?$deals->business_logo:$deals->business_image);?>" alt="" class="img_245main">
                                </div>
                                <h3><a href="<?php echo site_url('welcome/dealDetails/'.$deals->id);?>"><?php echo $deals->business_name;?><span class="font24">&#8594;</span></a></h3>
                                <!--  -->
                                <p><?php echo substr($deals->business_description,0,50);?>...</p>
                                <div class="social_icons floatleft">
                                    <a href="#"><img src="<?=base_url('themes/front/images/facebook.jpg');?>" width="16" alt=""> </a>
                                    <a href="#"><img src="<?=base_url('themes/front/images/twitter.jpg');?>" width="16" alt=""> </a>
                                    <a href="#"><img src="<?=base_url('themes/front/images/pinterest.jpg');?>" width="16" alt=""> </a>
                                </div> 
                                <?php if($this->is_logged_in['user_type']=='end_user'){?>
                                <div class="floatright" >
                                    <!-- <//?php 
                                    if($this->Common_model->isSubscribe($this->is_logged_in['user_id'],$deals->deal_id)==true){
                                    ?> -->
                                    <a class="red font_type1 font16" href="javascript:void(0);" onclick="dialogBox(<?php echo $deals->clip_id;?>,'un')">Unsubscribe</a>
                                    <!-- <//?php } else {?>
                                    <a class="red font_type1 font16" href="javascript:void(0);" onclick="dialogBox(<?php echo $deals->deal_id;?>,'sub')">Subscribe</a>
                                    <//?php }?> -->
                                </div>
                                <?php }?>
                                <div class="clr"></div>
                                </div>
                            </li>
                            
                            <?php }}else{ ?>
                            
                                <li class="blue"><strong>No Clips Found.</strong></li>
                            
                        <?php    
                        }
                        ?>

                        </ul>
                        <div class="clr"></div>
                    </div>
                
        </div>        
                
<!-- ----------- Page content ---------- -->                
                
         
 <?php  $this->load->view('front/common/right_menu'); ?>

                <!-- Latest Post Part -->
                
      <?php  $this->load->view('front/common/latest_post'); ?>	
                
                <!-- Latest Post Part -->
                
                <div class="clr"></div>
                </div>
            </div>
        </div>
        <!--End Content-->
