<?php $CI =& get_instance();?>
<script type="text/javascript">

$(document).ready(function(){
			var ret_msg        = "<?=preg_replace('/^\s+|\n|\r|\s+$/m', '<br>',$this->session->flashdata('ret_msg'));?>";
			var ret_msg_type   = "<?=$this->session->flashdata('ret_action');?>";

			if(ret_msg && ret_msg_type){
					if(ret_msg_type == '0'){
							var img_smily = "<img height='40' width='40' src=<?php  echo $CI->config->item('front_link_path').'images/sad_smiley.png';?> alt=''>";
							$('#ret_msg').addClass('error_message');
							}
							else{
									var img_smily = "<img src=<?php  echo $CI->config->item('front_link_path').'images/smiley_icon.png';?> alt=''>";
									$('#ret_msg').addClass('success_message1');
								  }
							$('#ret_msg').html(ret_msg);
							$('#ret_smily').html(img_smily);
							$('#return_message').show();
							$('.overlay').show();
					}
			});


function printFrame(id) {
		window.print();
}
	function submit_review(){

		if($('#title').val() == "")
			{
			alert("Please provide a title.");
			$('#title').focus();
			return false;
			}
		if($('#comment').val() =="")
			{
			alert("Please provide comment.");
			$('#comment').focus();
			return false;
			}
		document.review.submit();
		}
</script>
<!-- return meaessage -->
<div class="pop_message3 pop_message4 align-center" style="display:none" id="return_message">
    <div class="content" >
        <p id='ret_smily'>&nbsp;</p>
        <p id='ret_msg'>&nbsp;</p>
        <p><a class="blue_btn2" href="javascript:void(0);" onclick="javascript: $('#return_message').hide(); $('.overlay').hide(); ">Ok</a></p>
    </div>
</div>
<div class="overlay" style="display:none"></div>
<!-- return meaessage -->
<!--Start Content-->
        <div class="container-fluid">
            <div class="main_container">
                <div class="row-fluid">
                <div class="span9 main_content">
                
                <?php if(!empty($dealDetails)){?>
                	<div class="main_head">
                    	<h2 class="title floatleft">Deal Details</h2>
					<?php if($dealDetails->campaign_type == 'pro'){?>
					 <div class="floatright pad_t15">
							<a class="blue" href="javascript:return void(0);" onclick="return printFrame('pro_iframe');">Print Deal <img src="<?php echo base_url('themes/front/images/print_icon.png');?>" alt=""></a>
							<span class="space">|</span>
							<?php if(($logged_in) && $this->user_type == 'end_user'){?>
								<a class="black" href="<?=base_url('user/inbox');?>">Back to Inbox</a></div>
							<?php }else{ ?>
								<a class="black" href="<?=base_url('welcome/main')?>">Back to Home</a></div>
							<?php } ?>
					<?php } else{ ?>
                        <div class="floatright pad_t15"><strong><span class="blue1">Offer Vaild From: </span> <?php echo date('d M Y ',strtotime($dealDetails->duration_from));?> <span class="blue1"> To </span><?php echo date('d M Y ',strtotime($dealDetails->duration_to));?></strong></div>
					<?php }?>                        
					<div class="clr"></div>
                  </div>
				<?php if($dealDetails->campaign_type == 'basic'){?>
				          <div class="main_head1">
							<div class="floatleft"><strong class="call_icon1"><?=$dealDetails->phone?></strong></div>
							<div class="floatright dropdown1">
						         	<a class="blue" href="javascript:return void(0);">Mark as</a>
						             <div class="dropdown1_rel">
						             	<a href="<?=base_url('welcome/report_deal/Spam/'.$dealDetails->id);?>">Spam</a>
						                 <a href="<?=base_url('welcome/report_deal/Misclassified/'.$dealDetails->id);?>">Misclassified</a>
						                 <a href="<?=base_url('welcome/report_deal/Duplicated/'.$dealDetails->id);?>">Duplicated</a>
						                 <a href="<?=base_url('welcome/report_deal/Expired/'.$dealDetails->id);?>">Expired</a>
						             </div>
				              </div>
				              <div class="clr"></div>
				          </div>
				<?php } ?>
                    <h3 class="title floatleft"><?php echo $dealDetails->business_name;?></h3>
                    <div class="clr"></div>
                    <?php if($dealDetails->campaign_type == 'pro'){?>
                    
                    				<iframe id="pro_url_page" name="pro_url_page" src="<?=$dealDetails->campaign_url;?>" width="100%" height="1000"></iframe>
                    <?php } ?>
                    <?php if($dealDetails->campaign_type == 'basic'){?>
                    <div class="address1">
                        <?php if(isset($dealDetails->address)){?>
                        <div class="row-fluid">
                    		<div class="span3"><img src="<?php echo base_url('themes/front/images/location_icon2.png');?>" class="floatleft" alt=""> ADDRESS</div>
                            <div class="span9"><?php echo $dealDetails->address;?></div>
                            <div class="clr"></div>
	                    </div>
                        <?php }?>
                        <?php if(isset($dealDetails->landmarks)){?>
                        <div class="row-fluid">
                    		<div class="span3"><img src="<?php echo base_url('themes/front/images/train_icon1.png');?>" class="floatleft" alt=""> landmark</div>
                            <div class="span9"><?php echo $dealDetails->landmarks;?></div>
                            <div class="clr"></div>
	                    </div>
                        <?php }?>
                        <?php if(isset($dealDetails->website)){?>
                        <div class="row-fluid">
                    		<div class="span3"><img src="<?php echo base_url('themes/front/images/location_icon2.png');?>" class="floatleft" alt=""> Website</div>
                            <div class="span9"><?php echo $dealDetails->website;?></div>
                            <div class="clr"></div>
	                    </div>
                        <?php }?>
                        <?php if(isset($dealDetails->timings)){?>
                        <div class="row-fluid">
                    		<div class="span3"><img src="<?php echo base_url('themes/front/images/location_icon2.png');?>" class="floatleft" alt=""> Timings</div>
                            <div class="span9"><?php echo $dealDetails->timings;?></div>
                            <div class="clr"></div>
	                    </div>
                        <?php }?>
                        <?php /* if(isset($dealDetails->display_name)){?>
                    	<div class="row-fluid">
                    		<div class="span3"><img src="<?php echo base_url('themes/front/images/location_icon2.png');?>" class="floatleft" alt=""> Created By</div>
                            <div class="span9"><?php echo $dealDetails->display_name;?></div>
                            <div class="clr"></div>
	                    </div>
                        <?php } */ ?>
                        <?php /* if(isset($dealDetails->category_name)){?>
                        <div class="row-fluid">
                    		<div class="span3"><img src="<?php echo base_url('themes/front/images/train_icon1.png');?>" class="floatleft" alt=""> Category</div>
                            <div class="span9"><?php echo $dealDetails->category_name;?></div>
                            <div class="clr"></div>
	                    </div>
                        <?php }  */ ?>     
            

                        <div class="row-fluid" >
                    		<div class="span7" ><img src="<?php echo base_url().'uploads/deal_images/'.$dealDetails->business_image;?>" alt=""></div>
						 <div class="span5">
							<p><img src="<?php echo base_url('themes/front/images/map_icon.jpg');?>" alt=""> <strong>Map</strong></p>
							<p><img src="http://maps.googleapis.com/maps/api/staticmap?center=<?=$dealDetails->zip_id;?>&zoom=13&zoom=13&size=300x250&maptype=roadmap&&markers=color:red%7Ccolor:red%7Clabel:C%7C<?=$dealDetails->lat;?>,<?=$dealDetails->long;?>&sensor=false" width="100%" alt=""></p>
						</div>
                            <div class="clr"></div>
	                    </div>
                        
                    </div>
                    
                    <?php } ?> <!-- For Basic -->
                    
                    <p><?php echo $dealDetails->business_description;?></p>

				<?php if($this->session->flashdata('action_msg')){?>             					
				 					<div class="row-fluid">
                            		<div class="span3 form_label"></div>
                                	<div class="span7"><div class="<?=($this->session->flashdata('action') == '0')?'error_message':'success_message1';?>" id="action_msg"><?=$this->session->flashdata('action_msg');?></div></div>
                                <div class="clr"></div>
                            </div>
             		<?php } ?>
				<?php if(($logged_in) && $this->user_type == 'end_user'){ ?>
				<form name="review" id="review" action="<?=base_url('welcome/save_review');?>" method="post" enctype="multipart/form-data">
                    <div class="contact_form comments">
                    	<div class="block">
                            <p class="uppercase font14"><strong>Comments</strong></p>
                            <div class="">
                            	<p>Leave your comment (spam and offensive messages will be removed)</p>
                                <div class="row-fluid">
                                	<div class="span3">Title:</div>
                                    <div class="span7">
									<input type="text" name="title" id="title" value="" class="inputbox">
									<input type="hidden" name="deal_id" id="deal_id" value="<?=$dealDetails->id;?>">
									<span class="error_message" id="form_error_primary_phone"><?=form_error('title');?>&nbsp;</span>
									<span class="error_message" id="form_error_primary_phone"><?=form_error('deal_id');?>&nbsp;</span>
							</div>
                                    <div class="clr"></div>
                                </div>
                                <div class="row-fluid">
                                	<div class="span3">Comments:</div>
                                    <div class="span7">
									<textarea rows="5" name="comment" id="comment" class="textarea" cols="10"></textarea>
									<span class="error_message" id="form_error_primary_phone"><?=form_error('comment');?>&nbsp;</span>
							</div>
                                    <div class="clr"></div>
                                </div>
                                <div class="row-fluid">
                                	<div class="span3">&nbsp;</div>
                                    <div class="span7"><input type="button" onclick="return submit_review()" value="Publish Review" class="blue_btn1"></div>
                                    <div class="clr"></div>
                                </div>
                            </div>
                        </div>
                    </div> 
				</form>
				<?php } ?>
				          <?php if($reviews){ ?>
				          		<div class="comment_list">
				          	<p class="uppercase">User Reviews for <strong><?=$dealDetails->business_name;?></strong></p>
				          	<div class="row-fluid">
				              		<?php foreach($reviews as $rev){ ?>
											<div class="block">
										   	<div class="span2"><img src="<?=base_url('themes/front/images/man_icon.png');?>" width="100%" alt=""></div>
										       <div class="span10">
										       	<p class="font16"><?=$rev->display_name;?></p>
										           <p class="gray"><?=$rev->tot_reviews;?> Reviews / <?=$rev->tot_subscription?> Followers</p>
										           <p class="gray"><?php echo date('d M Y',strtotime($rev->created_date)); ?></p>
										       </div>
										       <div class="clr"></div>
										       <div class="body">
										       	<p><?=$rev->title;?></p>
										           <p><?=$rev->comment;?></p>
										       </div>
										       <div class="row-fluid">
										       <div class="span8"></div>
										       <div class="span4 align-right share_icon_div"> Share : 
<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo base_url('welcome/dealDetails/'.$dealDetails->id); ?>" data-count="none">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div> 
										       </div>
										   </div>
								<?php } ?>
				              </div>
				          </div>

						<?php } ?>
                    <?php } else{ ?>
                    
                    		<div class="main_head">
		                    	<h2 class="title floatleft">Deal Details</h2>
		                        <div class="clr"></div>
		                  </div>
		                  <span class="blue"><h3>No data found</h3></span>
		               <?php } ?>
                    
                </div>
         
 <?php  $this->load->view('front/common/right_menu'); ?>
                
                <div class="clr"></div>
<?php if($dealDetails->campaign_type == 'pro'){?>
<!-- Latest Post Part -->
       
       <?php  $this->load->view('front/common/latest_post'); ?>
       
       <!-- Latest Post Part --> 
<?php } ?>
                </div>
            </div>
        </div>
        <!--End Content-->
       
