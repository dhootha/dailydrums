<!--Start Content-->
        <div class="container-fluid">
            <div class="main_container">
                <div class="row-fluid">
                <div class="span9 main_content">
                    <h2 class="title">Create Store <span style="color:red"><span></h2>
                    <div class="change_password">
                    	<div class="block">
				
             <?php if($this->session->flashdata('action_msg')){?>             					
				 					<div class="row-fluid">
                            		<div class="span3 form_label"></div>
                                	<div class="span7"><div class="<?=($this->session->flashdata('action') == '0')?'error_message':'success_message1';?>" id="action_msg"><?=$this->session->flashdata('action_msg');?></div></div>
                                <div class="clr"></div>
                            </div>
             <?php } ?>

				<form name="create_store" action="<?=base_url('user/save_store');?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="page_action" value="save_store" >
                             <div class="row-fluid">
                            	<div class="span3 form_label">Store Name: <span class="error_message">*</span></div>
                                	<div class="span7"><input type="text" name="store_name" id="store_name" value="<?= set_value('store_name', '');?>" class="inputbox"></div>
											<span class="error_message" id="form_error_first_name"><?=form_error('store_name');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            
                            <div class="row-fluid">
                            	<div class="span3 form_label">Address Line1: <span class="error_message">*</span></div>
                                <div class="span7"><input type="text" name="address_line1" id="address_line1" value="<?php echo set_value('address_line1', ''); ?>" class="inputbox"></div>
				     <span class="error_message" id="form_error_last_name"><?=form_error('address_line1');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span3 form_label">Address Line2: <span class="error_message">*</span></div>
                                <div class="span7"><input type="text" name="address_line2" id="address_line2" value="<?php echo set_value('address_line2', ''); ?>" class="inputbox"></div>
					<span class="error_message" id="form_error_business_email"><?=form_error('address_line2');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span3 form_label">Street: <span class="error_message">*</span></div>
                                <div class="span7"><input type="text" name="street" id="street" value="<?php echo set_value('street', '');?>" class="inputbox"></div>
					<span class="error_message" id="form_error_primary_phone"><?=form_error('street');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            
                            <div class="row-fluid">
                            	<div class="span3 form_label">City: <span class="error_message">*</span></div>
                                <div class="span7">
                                		<select name="city" id="city" class="inputbox">
				                        	<option value="">Select a city</option>
				                        	<?php foreach($city as $c){?>
				                        		<option value="<?=$c->loc_id?>" <?php echo set_select('city', $c->loc_id);?> ><?=$c->city;?></option>
				                        	<?php } ?>
				                        </select>
                                </div>
											<span class="error_message" id="form_error_primary_phone"><?=form_error('city');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            
                            
                            <div class="row-fluid">
                            	<div class="span3 form_label">State: <span class="error_message">*</span></div>
                                <div class="span7"><input type="text" name="state" id="state" value="<?php echo set_value('state', ''); ?>" class="inputbox"></div>
					<span class="error_message" id="form_error_primary_phone"><?=form_error('state');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            
                            
                            <div class="row-fluid">
                            	<div class="span3 form_label">Zip: <span class="error_message">*</span></div>
                                <div class="span7">
												<select name="zip" id="zip" class="inputbox">
				                        	<option value="">Select a city first</option>
				                        </select>                                
                                </div>
										<span class="error_message" id="form_error_primary_phone"><?=form_error('zip');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            
                            
                            <div class="row-fluid">
                            	<div class="span3 form_label">Phone: <span class="error_message">*</span></div>
                                <div class="span7"><input type="text" name="phone" id="phone" value="<?php echo set_value('phone', ''); ?>" class="inputbox"></div>
					<span class="error_message" id="form_error_primary_phone"><?=form_error('phone');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            
                            
                            <div class="row-fluid">
                            	<div class="span3 form_label">Website: <span class="error_message">*</span></div>
                                <div class="span7"><input type="text" name="website" id="website" value="<?php echo set_value('website', ''); ?>" class="inputbox"></div>
					<span class="error_message" id="form_error_primary_phone"><?=form_error('website');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            
                            
                            <div class="row-fluid">
                            	<div class="span3 form_label">Logo: <span class="error_message">*</span></div>
                                <div class="span7 file-wrapper logo_input">
												<input type="file" name="logo" id="logo" value="" class=""><span class="file-holder"></span> <span class="button">Choose File</span>
                                <div class="clr"></div>
                                
                                </div>
										<span class="error_message" id="form_error_zip"><?=form_error('logo');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            
                            <div class="row-fluid">
                            	<div class="span3 form_label">Chose Tag Words: <span class="error_message">*</span></div>
                                <div class="span7"><input type="text" name="tag_words" id="tag_words" value="<?php echo set_value('tag_words', '');?>" class="inputbox"></div>
					<span class="error_message" id="form_error_primary_phone"><?=form_error('tag_words');?>&nbsp;</span>
                                <div class="clr"></div>
                            </div>
                            
                            
                           <!-- <div class="row-fluid">
                                <div class="floatleft"><a class="blue_btn1" href="<?=base_url('user/profile');?>">BACK</a></div>
                                <div class="floatright"><a class="blue_btn1" id="save"  href="#" onclick="document.deal_upload.submit();">Submit</a></div>
                            </div> -->
                            
                            <div class="row-fluid">
                            	<div class="span3 form_label">&nbsp;</div>
                                <div class="span7"><input type="button" value="Save" class="blue_btn1" id="save"  href="#" onclick="document.create_store.submit();"></div>
                                <div class="clr"></div>
                            </div>

                            <div class="clr"></div>
                        </div>
                        
                    </div>
                </div>
		</form>
                
		 <?php  $this->load->view('front/common/right_menu'); ?>

                <div class="clr"></div>
                </div>
            </div>
        </div>
 <!--End Content-->

<script type="text/javascript" >
		    

		$(document).ready( function(){
			
			// ----- Datepicker code			
			//$.noConflict();
		   // $(function() {
		       /* $("#duration_from,#duration_to").datepicker({
		            changeMonth: true,
		            yearRange: '2013:2050',
		            //defaultDate: new Date(1985, 00, 01),
		            defaultDate: new Date(),
		            showButtonPanel: true,
		            dateFormat: 'dd-mm-yy',
		            changeYear: true
		        });*/
		   // });
        // ----- Datepicker code  
		    
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
						
				/*$('#user_id').change(function() {     
							var user_id = $('#user_id').val();
							request = $.ajax({
								      type: 'post',
								      url: "<?=base_url('admin/deals/get_stores')?>",
								      data: 'user_id='+user_id,
									dataType:'json'
								 	 });
							  
							  request.done(function(response) {
							  			var store_data = "<option value=''>Select a user first</option>";
										if(response){
											store_data = "<option value=''>Select a store</option>";
											for(r in response){
												store_data += "<option value='"+response[r].store_id+"'>"+response[r].store_name+"</option>"; 
												}
											}
										$('#store_name').html(store_data);
										});
						});*/
			});
  
</script>

