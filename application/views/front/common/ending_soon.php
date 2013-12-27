<script type="text/javascript" >

$(document).ready( function(){
	//alert("go");
	$("li[id^='endsoon_li#']").each(function(index){
		var id = this.id.split('#').pop(); 
		set_time_for_end(id);
	});
	});


function set_time_for_end(id){
							
						// set the date we're counting down to
						var target_date = $("#endsoon_expire_"+id).val();
												 
						// variables for time units
						var days, hours, minutes, seconds;
						 
						// get tag element
						//var countdown = document.getElementById("countdown");
						 
						// update the tag with id "countdown" every 1 second
						setInterval(function () {
						 
						    // find the amount of "seconds" between now and target
						    var current_date = new Date().getTime();
						    var seconds_left = (target_date - current_date) / 1000;
						 
						    // do some time calculations
						    days = parseInt(seconds_left / 86400);
						    seconds_left = seconds_left % 86400;
						     
						    hours = parseInt(seconds_left / 3600);
						    seconds_left = seconds_left % 3600;
						     
						    minutes = parseInt(seconds_left / 60);
						    seconds = parseInt(seconds_left % 60);
						     
						    //alert('d: '+days+' h: '+hours+' m: '+minutes+' s: '+seconds) ;
						    // format countdown string + set tag value
						    $("#days_"+id).html(days);
						    $("#hours_"+id).html(hours);
						    $("#minutes_"+id).html(minutes);
						    $("#seconds_"+id).html(seconds);
						   						 
						}, 1000);
						
			}
</script> 
 
 <div class="latest_post latest_post1">
     <div class="head">
         <h2 class="title floatleft">ENDING SOON</h2>
         <a href="<?php echo base_url('welcome/ending_soon');?>" class="floatright">view all +</a>
         <div class="clr"></div>                                
     </div>
     <div class="list1 row-fluid">
         <ul>
         
         <?php for($i=0;$i<4;$i++){ ?>
             <li class="span3" id="endsoon_li#<?=$endsoon_deals[$i]->id;?>">
             	<input type="hidden" id="endsoon_expire_<?=$endsoon_deals[$i]->id;?>" value="<?=strtotime(implode('-',array_reverse(explode('-',$endsoon_deals[$i]->duration_to))).' 11:59:59 pm')*1000;?>" />
             	<div class="block block1">
                     <div class="img">
                     <?php  
                     		if($endsoon_deals[$i]->campaign_type == 'pro')
	                     			$file_name = $endsoon_deals[$i]->business_logo;
	                     			elseif($endsoon_deals[$i]->campaign_type == 'basic' && $endsoon_deals[$i]->use_logo == '1')
	                     						$file_name = $endsoon_deals[$i]->business_logo;
	                     						else 
	                     							$file_name = $endsoon_deals[$i]->business_image;
                     							
                  			if($file_name != '')
	                  				$file_name = base_url('uploads/deal_images/'.$file_name);
	                  				else
	                  					 $file_name = base_url('themes/front/images/no-image.jpg');
                     ?>
                     <img src="<?=$file_name ;?>" class="img_245main" alt="">
                     </div>
                     <div class="info">
                         <h3><a class="blue" href="<?php echo site_url('welcome/dealDetails/'.$endsoon_deals[$i]->id);?>"><?php echo $endsoon_deals[$i]->business_name;?><span class="font24">&#8594;</span></a></h3>
                         <p class="gray"><?php echo substr($endsoon_deals[$i]->business_description,0,25);?>...</p>
                        <!-- <p><strong><?php echo substr($endsoon_deals[$i]->business_description,0,50);?>...</strong></p>
                         <p class="gray">Multiple Locations (4.1 miles)</p>
                         <div class="floatleft">
                             <span class="old_price">$26.95</span><br>
                             <strong class="font14 blue">$13</strong>
                         </div> 
                         <div class="floatright"><a class="red font_type1 font16" href="#">Unsubscribe</a></div>-->
                         <?php if($this->is_logged_in['user_type']=='end_user'){?>
                                <div class="floatright" id="subscribeDeal_<?php echo $endsoon_deals[$i]->id;?>">
                                <?php 
                                if($this->Common_model->isSubscribe($this->is_logged_in['user_id'],$endsoon_deals[$i]->id)==true){
                                ?>
                                    <a class="red font_type1 font16" href="javascript:void(0);" onclick="dialogBox(<?php echo $endsoon_deals[$i]->id;?>,'un')">Unsubscribe</a>
                                <?php } else {?>
                                    <a class="red font_type1 font16" href="javascript:void(0);" onclick="dialogBox(<?php echo $endsoon_deals[$i]->id;?>,'sub')">Subscribe</a>
                                <?php }?>
                                </div>
                         <?php }?>
                         <div class="clr"></div>
                     </div>
                     <div class="row-fluid">
                     	<div class="range_time">
                             <div class="span3 align-center">
                             	<div class="info1">
                                     <span id="days_<?=$endsoon_deals[$i]->id;?>" class=" font_type1 font18 ">05</span><br><!---->
                                     <span>DAYS</span>
                                 </div>
                             </div>
                             <div class="span3 align-center">
                             	<div class="info1">
                                     <span class="colan">:</span>
                                     <span id="hours_<?=$endsoon_deals[$i]->id;?>" class="font_type1 font18">05</span><br>
                                     <span>HRS</span>
                                 </div>
                             </div>
                             <div class="span3 align-center">
                             	<div class="info1">
                                     <span class="colan">:</span>
                                     <span id="minutes_<?=$endsoon_deals[$i]->id;?>" class="font_type1 font18">05</span><br>
                                     <span>MNTS</span>
                                 </div>
                             </div>
                             <div class="span3 align-center">
                             	<div class="info1">
                                     <span class="colan">:</span>
                                     <span id="seconds_<?=$endsoon_deals[$i]->id;?>" class="font_type1 font18">05</span><br>
                                     <span>SECS</span>
                                 </div>
                             </div>
                             <div class="clr"></div>
                         </div>
                     </div>
                 </div>
             </li>
          <?php } ?>
            <!-- <li class="span3">
             	<div class="block block1">
                     <div class="img"><img src="<?=base_url('themes/front/images/img1.png');?>" width="100%" alt=""></div>
                     <div class="info">
                         <h3><a href="#" class="blue">Up to 55% Off at Premier Car Wash</a></h3>
                         <p><strong>Premier Car Wash</strong></p>
                         <p class="gray">Multiple Locations (4.1 miles)</p>
                         <div class="floatleft">
                             <span class="old_price">$26.95</span><br>
                             <strong class="font14 blue">$13</strong>
                         </div>
                         <div class="floatright"><a class="red font_type1 font16" href="#">Unsubscribe</a></div>
                         <div class="clr"></div>
                     </div>
                     <div class="row-fluid">
                     	<div class="range_time">
                             <div class="span3 align-center">
                             	<div class="info1">
                                     <span class="font_type1 font18">05</span><br>
                                     <span>DAYS</span>
                                 </div>
                             </div>
                             <div class="span3 align-center">
                             	<div class="info1">
                                     <span class="colan">:</span>
                                     <span class="font_type1 font18">05</span><br>
                                     <span>HRS</span>
                                 </div>
                             </div>
                             <div class="span3 align-center">
                             	<div class="info1">
                                     <span class="colan">:</span>
                                     <span class="font_type1 font18">05</span><br>
                                     <span>MNTS</span>
                                 </div>
                             </div>
                             <div class="span3 align-center">
                             	<div class="info1">
                                     <span class="colan">:</span>
                                     <span class="font_type1 font18">05</span><br>
                                     <span>SECS</span>
                                 </div>
                             </div>
                             <div class="clr"></div>
                         </div>
                     </div>
                 </div>
             </li>
             <li class="span3">
             	<div class="block block1">
                     <div class="img"><img src="<?=base_url('themes/front/images/img1.png');?>" width="100%" alt=""></div>
                     <div class="info">
                         <h3><a href="#" class="blue">Up to 55% Off at Premier Car Wash</a></h3>
                         <p><strong>Premier Car Wash</strong></p>
                         <p class="gray">Multiple Locations (4.1 miles)</p>
                         <div class="floatleft">
                             <span class="old_price">$26.95</span><br>
                             <strong class="font14 blue">$13</strong>
                         </div>
                         <div class="floatright"><a class="red font_type1 font16" href="#">Unsubscribe</a></div>
                         <div class="clr"></div>
                     </div>
                     <div class="row-fluid">
                     	<div class="range_time">
                             <div class="span3 align-center">
                             	<div class="info1">
                                     <span class="font_type1 font18">05</span><br>
                                     <span>DAYS</span>
                                 </div>
                             </div>
                             <div class="span3 align-center">
                             	<div class="info1">
                                     <span class="colan">:</span>
                                     <span class="font_type1 font18">05</span><br>
                                     <span>HRS</span>
                                 </div>
                             </div>
                             <div class="span3 align-center">
                             	<div class="info1">
                                     <span class="colan">:</span>
                                     <span class="font_type1 font18">05</span><br>
                                     <span>MNTS</span>
                                 </div>
                             </div>
                             <div class="span3 align-center">
                             	<div class="info1">
                                     <span class="colan">:</span>
                                     <span class="font_type1 font18">05</span><br>
                                     <span>SECS</span>
                                 </div>
                             </div>
                             <div class="clr"></div>
                         </div>
                     </div>
                 </div>
             </li>
             <li class="span3">
             	<div class="block block1">
                     <div class="img"><img src="<?=base_url('themes/front/images/img1.png');?>" width="100%" alt=""></div>
                     <div class="info">
                         <h3><a href="#" class="blue">Up to 55% Off at Premier Car Wash</a></h3>
                         <p><strong>Premier Car Wash</strong></p>
                         <p class="gray">Multiple Locations (4.1 miles)</p>
                         <div class="floatleft">
                             <span class="old_price">$26.95</span><br>
                             <strong class="font14 blue">$13</strong>
                         </div>
                         <div class="floatright"><a class="red font_type1 font16" href="#">Unsubscribe</a></div>
                         <div class="clr"></div>
                     </div>
                     <div class="row-fluid">
                     	<div class="range_time">
                             <div class="span3 align-center">
                             	<div class="info1">
                                     <span class="font_type1 font18">05</span><br>
                                     <span>DAYS</span>
                                 </div>
                             </div>
                             <div class="span3 align-center">
                             	<div class="info1">
                                     <span class="colan">:</span>
                                     <span class="font_type1 font18">05</span><br>
                                     <span>HRS</span>
                                 </div>
                             </div>
                             <div class="span3 align-center">
                             	<div class="info1">
                                     <span class="colan">:</span>
                                     <span class="font_type1 font18">05</span><br>
                                     <span>MNTS</span>
                                 </div>
                             </div>
                             <div class="span3 align-center">
                             	<div class="info1">
                                     <span class="colan">:</span>
                                     <span class="font_type1 font18">05</span><br>
                                     <span>SECS</span>
                                 </div>
                             </div>
                             <div class="clr"></div>
                         </div>
                     </div>
                 </div>
             </li> -->
         </ul>
         <div class="clr"></div>
     </div>
 </div>
