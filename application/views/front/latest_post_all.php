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
                
                	<div class="main_head">
                    	<h2 class="title red floatleft">Latest Posts</h2>
					                  
					<div class="clr"></div>
                  </div>
				          <?php if($reviews){ ?>
				          		<div class="comment_list">
				          	
				          	<div class="row-fluid">
				              		<?php foreach($reviews as $rev){ ?>
											<div class="block"><a name="<?=$rev->review_id;?>"></a>
															<?php if($rev->photo ==null) 
																				$user_photo = "themes/front/images/no_image3.jpg"; 
																			else 
																				$user_photo = "uploads/user_img/".$rev->photo; ?>
										   	<div class="span2" style="width:20%; float:left; height:auto;"><img src="<?=base_url($user_photo);?>" height="100" width="100%" alt=""></div>
										       <div class="span10" style="width:70%; float:left;">
										       	<p class="font16"><?=$rev->display_name;?> commented on  <a class="blue" href="<?php echo base_url('welcome/dealDetails/'.$rev->deal_id);?>"><?=$rev->business_name;?><span class="font24">&#8594;</span></a></p>
										           <p class="gray"><?=$rev->tot_reviews;?> Reviews / <?=$rev->tot_subscription?> Followers</p>
										           <p class="gray"><?php echo date('d M Y',strtotime($rev->created_date)); ?></p>
										       </div>
															<div class="clr"></div>
										       <div class="body">
										       	<div style="padding-top:10px;"><?=$rev->title;?></div>
										           <div style="padding-top:10px;"><?=$rev->comment;?></div>
										       </div>
										       <div class="row-fluid">
										       <div class="span8"></div>
										       <div class="span4 align-right share_icon_div"> Share : &nbsp;
    <a href="https://twitter.com/share" data-url="https://twitter.com/" class="twitter-share-button" data-related="jasoncosta" data-lang="en" data-size="large" data-count="none">Tweet</a>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>	</div> 
										       </div>
										   </div>
											
								<?php } ?>
				              </div>
				          </div>

						<?php } ?>
                </div>
         
 <?php  $this->load->view('front/common/right_menu'); ?>
                
                <div class="clr"></div>

                </div>
            </div>
        </div>
        <!--End Content-->
       
