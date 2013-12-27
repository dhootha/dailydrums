<script type="text/javascript">

function dialogBox(deal_id,status){
   /* if(status=='un')
    $('.text_val').html("<strong>You don't want to miss out the best deals. Do you really want to unsubscribe?</strong>");
    else
    $('.text_val').html("<strong>You don't want to miss out the best deals. Do you want to subscribe?</strong>");    
    $('.overlay').css('display','block');
    $('.pop_message').css('display','block'); */
    $('#deal_id').val(deal_id);
    $('#subs_type').val(status);
    subscribe();
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
		        url: '<?php echo base_url('welcome/suscribeDeal');?>',
		        data: 'status='+status+'&deal_id='+deal_id,
		        success: function(data) {
		               
		               //show_return_message(data); return true; // for check 
		                if(data=='Subscribe'){
		                $('#subscribeDeal_'+deal_id).html('');
		                $('#subscribeDeal_'+deal_id).html('<a class="red font_type1 font16" href="javascript:void(0);" onclick="dialogBox('+deal_id+',\'sub\')">Subscribe</a>');
		                
		                                
		                var msg = "<strong>You have unsubscribed the deal successfully.</strong>";
		                show_return_message(msg);
		                }
		                else{
		                $('#subscribeDeal_'+deal_id).html('');
		                $('#subscribeDeal_'+deal_id).html('<a class="red font_type1 font16" href="javascript:void(0);" onclick="dialogBox('+deal_id+',\'un\')">Unsubscribe</a>');

							 var msg = "<strong>You are subscribed to receive notification from this store in your Daily Drums Inbox.</strong>";
		                show_return_message(msg); 		                
		                }
		        		}       
		   	});
	   }
	   else{
	       window.location.href = "<?php echo base_url('home')?>";
	   }
}

</script>

<span id="countdown"></span>
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
        <div class="top_prom"> 
            <!--  Outer wrapper for presentation only, this can be anything you like --> 
            <script src="<?=base_url('images/bjqs-1.3.min.js');?>"></script>
            <link rel="stylesheet" href="<?=base_url('images/bjqs.css');?>">
            <link rel="stylesheet" href="<?=base_url('images/demo.css');?>">
            
            <style>
            #banner-slide{
            	margin-bottom:8px !important;
            }
            .main-div{
            height:190px;
            padding:4px;
            margin-left: 29px;
            margin-top:10px;
            margin-bottom:2px;
            overflow:hidden;
            border:0 !important;
            text-align:center!important;
            
        }
        
        .main-div img{
            height:170px;
        }
        
    	.imgholder{
    		border-right:1px solid #CCC !important:
    	}
            </style>
            <div id="banner-slide" class="banner-slide_main"> 
                <ul class="bjqs">
				<?php for($i=0;$i<count($slider_deals);$i++){ 
							if($slider_deals[$i]->campaign_type == 'pro')
                  			$file_name = $slider_deals[$i]->business_logo;
                  			elseif($slider_deals[$i]->campaign_type == 'basic' && $slider_deals[$i]->use_logo == '1')
                  						$file_name = $slider_deals[$i]->business_logo;
                  						else 
                  							$file_name = $slider_deals[$i]->business_image;
               							
            			if($file_name != '')
               				$file_name = base_url('uploads/deal_images/'.$file_name);
               				else
               					 $file_name = base_url('themes/front/images/no-image.jpg');
				?>
                    <li>
                        <div class="s_content main-div">
                            <div class="s_content_inn">
                                <div class="s_content_inn_holder">
                                    <div class="s_content_inn_text">
                                    	<h2><span><?php echo (strlen($slider_deals[$i]->business_name)>16)?substr($slider_deals[$i]->business_name,0,13).'...':$slider_deals[$i]->business_name;?></span></h2>
                                        <h4><?php echo (strlen($slider_deals[$i]->business_description)>40)?substr($slider_deals[$i]->business_description,0,37).'...':$slider_deals[$i]->business_description;?></h4>
                                        <h5><a href="<?=base_url('welcome/dealDetails/'.$slider_deals[$i]->id)?>" class="blue">Shop now</a></h5>
                                    </div>
                                    <div class="s_content_inn_img imgholder"> <img src="<?php echo base_url('uploads/deal_images/'.$slider_deals[$i]->business_logo);?>" title="Automatically generated caption" > </div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <div class="s_content_inn">
                                <div class="s_content_inn_holder">
                                    <div class="s_content_inn_text">
								<?php
											if($slider_deals[$i]->campaign_type == 'pro')
											   			$file_name = $slider_deals[$i]->business_logo;
											   			elseif($slider_deals[$i]->campaign_type == 'basic' && $slider_deals[$i]->use_logo == '1')
											   						$file_name = $slider_deals[$i]->business_logo;
											   						else 
											   							$file_name = $slider_deals[$i]->business_image;
													
										  			if($file_name != '')
															$file_name = base_url('uploads/deal_images/'.$file_name);
															else
																 $file_name = base_url('themes/front/images/no-image.jpg');
											++$i;
								?>
                                    	<h2><?php echo (strlen($slider_deals[$i]->business_name)>16)?substr($slider_deals[$i]->business_name,0,13).'...':$slider_deals[$i]->business_name;?> <span></span></h2>
                                        <h4><?php echo (strlen($slider_deals[$i]->business_description)>40)?substr($slider_deals[$i]->business_description,0,37).'...':$slider_deals[$i]->business_description;?></h4>
                                        <h5><a href="<?=base_url('welcome/dealDetails/'.$slider_deals[$i]->id)?>" class="blue">Shop now</a></h5>
                                    </div>
                                    <div class="s_content_inn_img imgholder"> <img src="<?php echo base_url('uploads/deal_images/'.$slider_deals[$i]->business_logo);?>" title="Automatically generated caption"> </div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                    </li>
				<?php } ?>
                  <!--  <li>
                        <div class="s_content main-div">
                            <div class="s_content_inn">
                                <div class="s_content_inn_holder">
                                    <div class="s_content_inn_text">
                                    	<h2>Kindle <span>Fire Hd</span></h2>
                                        <h4>The ultimate<br />
                                        HD exprience</h4>
                                        <h5><a href="#" class="blue">Shop now</a></h5>
                                    </div>
                                    <div class="s_content_inn_img imgholder"> <img src="http://192.168.1.50/dailydrums/uploads/deal_images/031e78efda935308b17ac3f54b42174f.jpg" title="Automatically generated caption" > </div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <div class="s_content_inn">
                                <div class="s_content_inn_holder">
                                    <div class="s_content_inn_text">
                                    	<h2>Kindle <span>Fire Hd</span></h2>
                                        <h4>The ultimate<br />
                                        HD exprience</h4>
                                        <h5><a href="#" class="blue">Shop now</a></h5>
                                    </div>
                                    <div class="s_content_inn_img imgholder"> <img src="http://192.168.1.50/dailydrums/uploads/deal_images/1988b958c3b043b67380f6f4edd33b6d.jpg" title="Automatically generated caption"> </div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                    </li> -->
                </ul>
                <!-- end Basic jQuery Slider --> 
            </div>
   <script class="secret-source">
        jQuery(document).ready(function($) {
          
          $('#banner-slide').bjqs({
            animtype      : 'slide',
            height        : 185,
            width         : 1100,
            hoverpause      : true, 
            animspeed       : 10000,  
            responsive    : true,
            randomstart   : true,
            showmarkers:false,
            centermarkers:false,
		  nexttext : "<img src='<?=base_url('themes/front/images/left_arrow.png');?>'>",
		  prevtext : "<img src='<?=base_url('themes/front/images/back_arrow1.png');?>'>"
          });
          
        });
      </script> 
            
            <!-- End outer wrapper --> 
        </div>
        <div class="row-fluid" style="padding-top:20px;">
            <div class="span9 main_content">
                <h1 class="title">Now Trending...</h1>
                
                <!-- In Stores Part -->
                
                <?php  $this->load->view('front/common/in_stores'); ?>
                
                <!-- In Stores Part --> 
                
                <!-- Neighborhood Part -->
                
                <?php  $this->load->view('front/common/neighborhood'); ?>
                
                <!-- Neighborhood Part --> 
                
                <!-- On-line Stores Part -->
                
                <?php  $this->load->view('front/common/online_stores'); ?>
                
                <!-- On-line Stores Part --> 
                
            </div>
            <?php  $this->load->view('front/common/right_menu'); ?>
            
            <!-- Latest Post Part -->
            
            <?php  $this->load->view('front/common/latest_post'); ?>
            
            <!-- Latest Post Part --> 
            
            <!-- Ending Soon Part -->
            
            <?php  $this->load->view('front/common/ending_soon'); ?>
            
            <!-- Ending Soon Part -->
            
            <div class="clr"></div>
        </div>
    </div>
</div>
<!--End Content--> 

