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
		        url: '<?php echo base_url('welcome/suscribeDeal');?>',
		        data: 'status='+status+'&deal_id='+deal_id,
		        success: function(data) {
		               
		                if(data=='Subscribe'){
		                $('#subscribeDeal_'+deal_id).html('');
		                $('#subscribeDeal_'+deal_id).html('<a class="red font_type1 font16" href="javascript:void(0);" onclick="dialogBox('+deal_id+',\'sub\')">Subscribe</a>');
		                
		                                
		                var msg = "<strong>You have unsubscribed the deal successfully.</strong>";
		                show_return_message(msg);
		                }
		                else{
		                $('#subscribeDeal_'+deal_id).html('');
		                $('#subscribeDeal_'+deal_id).html('<a class="red font_type1 font16" href="javascript:void(0);" onclick="dialogBox('+deal_id+',\'un\')">Unsubscribe</a>');

							 var msg = "<strong>You have successfully subscribed the deal.</strong>";
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
                
                <div class="span9 main_content">
                     <h2 class="title"><?=$static_data->page_title;?></h2>
                  	<!--<h3 class="red align-center">&nbsp;</h3>-->
                  	
                  	<!--------- Page containt ---------->
                  	<p>
                  		 <?=$static_data->page_content;?>
                  	</p>
                  	
                  	<!-- --------- Page containt ------>
                  	
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
