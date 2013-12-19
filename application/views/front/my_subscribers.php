
<link href="<?=base_url('themes/thirdparty_js/dataTable/demo_table.css');?>" rel="stylesheet">
<script type="text/javascript" language="javascript" src="<?=base_url('themes/thirdparty_js/dataTable/jquery.dataTables.js');?>"></script>


<script type="text/javascript" charset="utf-8">
 jq = jQuery.noConflict();
			 jq(document).ready(function() {
				 jq('#active_subscribers_table').dataTable( {
					"sPaginationType": "full_numbers",
					"bLengthChange": false,
		         "bFilter": false,
		         "bSort": false,
		         "bInfo": false,
		         "bAutoWidth": false,
		         "iDisplayLength": 10
				   });
				
				jq('#pending_subscribers_table').dataTable( {
					"sPaginationType": "full_numbers",
					"bLengthChange": false,
		         "bFilter": false,
		         "bSort": false,
		         "bInfo": false,
		         "bAutoWidth": false,
		         "iDisplayLength": 10
		         });
			});
		</script>

<!--Start Content-->
        <div class="container-fluid">
            <div class="main_container">
                <div class="row-fluid">
                
                <div class="span9 main_content">
                    <h2 class="title">Manage Subscribers</h2>
                    <div class="contact_form campaign_form">
                    	<div class="block">
                            <h2 class="title"><span id="selected_store_header">Loding...</span> : <span id="selected_tab_header">Pending Requests</span></h2>
									
									
									<!-- Action Message Section Start-->
									<?php if( $this->session->flashdata( 'action_msg' ) ){?>
									 <div class="row-fluid">
                            	<div class="span3 form_label">&nbsp;</div>
                                	<div class="span4"><div class="<?=($this->session->flashdata('action') == '0')?'error_message':'success_message1';?>" id="action_msg"><?=$this->session->flashdata('action_msg');?>&nbsp;</div></div>
                                <div class="clr"></div>
                            </div>    
                            <?php } ?>
                            <!-- Action Message Section End-->   
                            
                                                 
                            <div class="row-fluid">
                            	<div class="span3">
                            		<?php if($stores){ 
                            						$store_actv_flag     = '0';
                            						$selected_store_name = $stores[0]->store_name;
                            		?>
                            			<ul class="links links1">
                            				<?php foreach($stores as $store){ ?>
                            						<li <?php if($requested_store_id == $store->store_id) { $selected_store_name = $store->store_name; echo "class=active"; } ?> ><a href="<?=base_url('user/my_subscribers/store/'.$store->store_id)?>"><?=$store->store_name;?></a></li>
                            				<?php } ?>
                                    </ul>
                            		<?php } else{ echo "No Stores found";}?>
                                	<input type="hidden" id="selected_store_name" value="<?=$selected_store_name;?>">
                               </div>
                                
                                <div class="span9">
                                    <ul class="tab">
                                        <li id="active_subscriber_tab" <?php if($selected_tab == 'a') echo "class='active'"; ?> ><a href="#">Active Subscribers</a></li>
                                        <li id="pending_subscriber_tab" <?php if($selected_tab == 'p') echo "class='active'"; ?> ><a href="#">Pending Requests</a></li>
                                    </ul>
                                    <div class="clr"></div>
                                    
                                    
                                    <!-- ACTIVE REQUEST START  -->
                                    
                                    <div id="active_subscriber_container" <?php if($selected_tab == 'p') echo "style='display:none;'" ?> class="content_tab">
                                    	<?php if( $active_subscribers != false ){ ?>
		                                    			<form name="active_subcribers_form" action="<?=base_url('user/remove_subscribers/store/'.$requested_store_id)?>" method="post">																																																																																																																																																																																																														
																			<table cellpadding="0" cellspacing="0" border="0" class="display" id="active_subscribers_table">
																				<thead>
																					<tr><td></td></tr>
																				</thead>
																				<tbody>
																				<?php foreach( $active_subscribers as $as ) {?> 
																					<tr>
																						<td><input name="active_subscriber[]" id="sub_active_id_<?=$as->subscription_id;?>" type="checkbox" value="<?=$as->subscription_id;?>"> <?=$as->display_name;?></td>
																					</tr>
																				<?php } ?>
																				  </tbody>
																				</table>      
																					<p class="align-right main_table_remove"><input type="button" onclick="make_remove();" value="Remove" class="red_btn1"></p>             	
				                                        </form>
				                                        <div class="holder" id="pagn"></div>
						                                       				                                        
                                        <?php } else { echo "<h2 style='color:red;'>No active subscribers found.</h2>"; }?>
                                    </div>
                                    <!-- ACTIVE REQUEST END  -->
                                    
                                    <div class="clr"></div>
                                    
                                    
                                    
                                    <!-- PENDING REQUEST START  -->
                                    
                                    <div id="pending_subscriber_container"  <?php if($selected_tab == 'a') echo"style='display:none;'"; ?> class="content_tab">
                                    	<?php if( $pending_subscribers != false ){?>
                                    	<form name="pending_subcribers_form" action="<?=base_url('user/confirm_subscribers/store/'.$requested_store_id)?>" method="post">
		                                    	<p class="align-right"><a onclick="return confirm_subscribers();" class="subscribe_icon" href="#">Confirm Subscriber</a></p>
		                                    	<table id="pending_subscribers_table"  cellpadding="0" cellspacing="0" border="0" class="display" >
                                    			      			<thead>
																			<tr><td></td></tr>
																	</thead>
																	<tbody>
																		<?php foreach( $pending_subscribers as $ps ) {?>
																			<tr>
																				<td><input name="pending_subscriber[]" type="checkbox" id="sub_pending_id<?=$ps->subscription_id;?>" value="<?=$ps->subscription_id;?>"> <?=$ps->display_name;?></td>
																			</tr>
																		<?php } ?>
																	</tbody>
		                                    	</table>
                                    			<div class="holder pending-holder" id="pagn"></div>
		                                    	</form>
                                        <?php }else{  echo "<h2 style='color:red;'>No pending subscribers found.</h2>"; } ?>
                                    </div>
                                    <!-- PENDING REQUEST  END -->
                                    
                                    
                                    <div class="clr"></div>
                                </div>
                                <div class="clr"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
		 <?php  $this->load->view('front/common/right_menu'); ?>

                <div class="clr"></div>
                </div>
            </div>
        </div>
 <!--End Content-->

<script type="text/javascript" >

		$(document).ready( function(){
			
			$('#selected_store_header').text($('#selected_store_name').val());
		    
			$('#city').change(function() {     
							var city = $('#city :selected').text();
							request = $.ajax({
								      type: 'post',
								      url: "<?=base_url('user/get_zip')?>",
								      data: 'city_name='+city,
									dataType:'json'
								 	 });
							  
							  request.done(function(response) {
							  			var zip_data = "<option value=''>Select a city first</option>";
										if(response){
											zip_data = "<option value=''>Select a zip</option>";
											for(r in response){
												zip_data += "<option value='"+response[r].loc_id+"'>"+response[r].zip+"</option>"; 
												}
											}
										$('#zip').html(zip_data);
										});
						});
						
				$('#active_subscriber_tab').click(function(){
								//$('#pagn').hide();
								$('#active_subscriber_tab').addClass('active');
								$('#pending_subscriber_tab').removeClass('active');
								$('#selected_tab_header').text('Active Subscribers');
								$('#pending_subscriber_container').hide();//('slide', {direction: 'left'}, 200);
								$('#active_subscriber_container').show('slide', {direction: 'right'}, 500);
								/*$("div.holder").jPages({
								    containerID : "active_subscribers_list",
								    perPage: 10
							  	});*/
								return false;
					   });
				$('#pending_subscriber_tab').click(function(){
					
								$('#pending_subscriber_tab').addClass('active');
								$('#active_subscriber_tab').removeClass('active');
								$('#selected_tab_header').text('Pending Requests');
								$('#active_subscriber_container').hide();//('slide', {direction: 'right'}, 200);
								$('#pending_subscriber_container').show('slide', {direction: 'left'}, 500);
								/*$("div.pending-holder").jPages({
								    containerID : "pending_subscribers_list",
								    perPage: 10
							  	}); */
								return false;
					   });	
				
			});
			
			function make_remove(){  
					var isCheckedSub = '';
					$('input[id^=sub_active]').each(function(){
						
							if(this.checked == true) isCheckedSub = 'checked';
						});
					if(isCheckedSub != '')
						document.active_subcribers_form.submit();
						else {
								alert("Please select a subscriber");
								return false;
								}
					}
					
			 function confirm_subscribers(){
			 		var isCheckedSub = '';
					$('input[id^=sub_pending]').each(function(){
						
							if(this.checked == true) isCheckedSub = 'checked';
						});
					if(isCheckedSub != '')
						document.pending_subcribers_form.submit();
						else {
								alert("Please select a subscriber");
								return false;
								}
			 		}
  
</script>


        