<script type="text/javascript" >
					
	function get_city_area(){
		var city = $('#city :selected').text();
		var selected_zip = $('#selected_zip').val();
			//alert(city);
			request = $.ajax({
				      type: 'post',
				      url: "<?=base_url('user/get_zip')?>",
				      data: 'city_name='+city,
					dataType:'json'
				 	 });
			  
			  request.done(function(response) {
			  	//alert(response); 
			  			var zip_data = "<option value=''>Select a city first</option>";
						if(response){
							zip_data = "<option value=''>Select a city area</option>";
							var selected_text = '';
							for(r in response){
								if(selected_zip == response[r].loc_id)
									selected_text = "selected='selected'";
									
								zip_data += "<option value='"+response[r].loc_id+"' "+selected_text+">"+response[r].zip+"</option>"; 
								}
							}
							//alert(zip_data);
						$('#city_area').html(zip_data);
						});
			}

function get_location_of_store(){
		var store = $('#store_name :selected').val();
		if(store != ''){
				request = $.ajax({
					      type: 'post',
					      url: "<?=base_url('user/get_location_of_store')?>",
					      data: 'store_id='+store,
						dataType:'json'
					 	 });
				  
				  request.done(function(response) {
	
				  	$('#address').val(response.street+", "+response.address1+", "+response.address2);
				  	$('#country').val('1');
				  	$('#region').val(response.state);
				  	$('#city').val(response.city);
				  	get_city_area();
				  	setTimeout(function(){ $('#city_area').val(response.zip);},2000);
				  	$('#phone').val(response.phone);
				  	$('#website_url').val(response.website); 
				  	
				  });
			  }
			  else{
			  			alert("Select a store first");
			  			$('#store_name').focus();
			  		 }
			}
			
			
	function checkCampaignData_test(campaign_status){
		
		$('#campaign_status').val(campaign_status);
		
		var from = parseInt(($('#duration_from').val()).split("-").reverse().join(''));
		var to = parseInt(($('#duration_to').val()).split("-").reverse().join(''));
		
		if($('#store_name').val() == ''){
			alert("Please select a store.");
			$('#store_name').focus();
			return false;		
			}
		if($('#category').val() == ''){
			alert("Please select a category.");
			$('#category').focus();
			return false;		
			}
		if($('#title').val() == ''){
			alert("Please provide a title.");
			$('#title').focus();
			return false;		
			}
		if($('#description').val() == ''){
			alert("Please provide a description.");
			$('#description').focus();
			return false;		
			}
		if($('#duration_from').val() == ''){
			alert("Please select campaign duration from.");
			$('#duration_from').focus();
			return false;		
			}
		if($('#duration_to').val() == ''){
			alert("Please select campaign duration to.");
			$('#duration_to').focus();
			return false;		
			}
	/*	if($('#logo').val() == ''){
			alert("Please select a campaignlogo image.");
			$('#logo').focus();
			return false;		
			}
		if($('#img').val() == ''){
			alert("Please select a campaign image.");
			$('#description').focus();
			return false;		
			}  */
		if($('#country').val() == ''){
			alert("Please select a country.");
			$('#country').focus();
			return false;		
			}
		if($('#region').val() == ''){
			alert("Please provide a region.");
			$('#region').focus();
			return false;		
			}
		if($('#city').val() == ''){
			alert("Please select a city.");
			$('#city').focus();
			return false;		
			}
		if($('#city_area').val() == ''){
			alert("Please select a city area.");
			$('#city_area').focus();
			return false;		
			}
		if($('#address').val() == ''){
			alert("Please provide a address.");
			$('#address').focus();
			return false;		
			}
		if($('#phone').val() == ''){
			alert("Please provide phone number.");
			$('#phone').focus();
			return false;		
			}
		if($('#website_url').val() == ''){
			alert("Please provide web site url.");
			$('#website_url').focus();
			return false;		
			}
		
		if((to-from) < 0){
			alert("Please select valid Campaign duration");			
			return false;
			}
	  		
		$('#deal_upload').submit();
		}
		
</script>
<!--Start Content-->

<div class="container-fluid">
  <div class="main_container">
    <div class="row-fluid">
      <div class="span9 main_content">
        <h2 class="title">Create New Campaign
				<?php if($this->session->flashdata('action_msg')){ ?>
        				<span class="<?=($this->session->flashdata('action') == '0')?'error_message':'blue';?>" style="text-align: left; font-size:15px; padding-left: 50px;">
        					<?=$this->session->flashdata('action_msg');?>
        				</span>
        		<?php }?>	        
        </h2>
       
       
       <!--  <?php /* if($this->session->flashdata('action_msg')){ ?>
        <div class="row-fluid">
          <div class="span3 form_label">&nbsp;</div>
          <div class="span4">
            <div class="<?=($this->session->flashdata('action') == '0')?'error_message':'success_message1';?>" id="action_msg">
              <?=$this->session->flashdata('action_msg');?>
              &nbsp;</div>
          </div>
          <div class="clr"></div>
        </div>
        <?php } */ ?> -->
        
        
        <div class="contact_form campaign_form"> <!-- selectForm  -->
       
          <form name="deal_upload" id="deal_upload" action="<?=base_url('user/campaign_basic_update');?>"  method="post"  enctype="multipart/form-data">
            <input type="hidden" name="campaign_status" id="campaign_status" value="" />
            <input type="hidden" name="check_img" value="" />
            <input type="hidden" name="check_logo" value="" />
            <input type="hidden" name="deal_id" id="deal_id" value="<?=$deal_details->id; ?>" >
            <div class="block">
              <h2 class="title">General Information</h2>
              <div class="row-fluid">
                <div class="span2 form_label">Store Name</div>
                <div class="span8">
                  <select name="store_name" id="store_name" class="creat_camp_select">
                    <option value="">Select a store</option>
                    <?php foreach($stores as $store){?>
                    <option value="<?=$store->store_id;?>" <?php if($deal_details->store_id == $store->store_id) echo "selected=selected"; echo set_select('store_name', $store->store_id);?> >
                    <?=$store->store_name;?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
                <span class="error_message" id="form_error_first_name">
                <?=form_error('store_name');?>
                &nbsp;</span>
                <div class="clr"></div>
              </div>
              <div class="row-fluid">
                <div class="span2 form_label">Category Name</div>
                <div class="span8">
                  <select name="category" id="category" class="creat_camp_select">
                    <option value="">Select a category</option>
                    <?php foreach($categories as $category){?>
                    <option value="<?=$category->category_id?>" <?php if($deal_details->category_id == $category->category_id) echo "selected=selected"; echo set_select('category', $category->category_id);?> >
                    <?=$category->category_name;?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
                <span class="error_message" id="form_error_first_name">
                <?=form_error('category');?>
                &nbsp;</span>
                <div class="clr"></div>
              </div>
              <div class="row-fluid">
                <div class="span2 form_label">Title </div>
                <div class="span8">
                  <input name="title" id="title" type="text" value="<?php echo set_value('title', $deal_details->business_name); ?>" class="inputbox">
                </div>
                <span class="error_message" id="form_error_first_name">
                <?=form_error('title');?>
                &nbsp;</span>
                <div class="clr"></div>
              </div>
              <div class="row-fluid">
                <div class="span2 form_label">Description </div>
                <div class="span8">
                  <textarea class="textarea" name="description" id="description" rows="6" cols="5"><?php echo set_value('description', $deal_details->business_description); ?></textarea>
                </div>
                <span class="error_message" id="form_error_last_name">
                <?=form_error('description');?>
                &nbsp;</span>
                <div class="clr"></div>
              </div>
              <div class="row-fluid">
                <div class="span2 form_label">Duration </div>
                <div class="span8">
                  <div class="row-fluid">
                    <div class="span2 form_label">From</div>
                    <div class="span4">
                      <input type="text" readonly="readonly" name="duration_from" id="duration_from"  value="<?php echo set_value('duration_from', $deal_details->duration_from) ?>" class="inputbox inputbox1" >
                    </div>
                    <div class="span2 form_label">To</div>
                    <div class="span4">
                      <input type="text" readonly="readonly" name="duration_to" id="duration_to" value="<?php echo set_value('duration_to', $deal_details->duration_to); ?>" class="inputbox inputbox1">
                    </div>
                    <span class="error_message" id="form_error_first_name">
                    <?=form_error('duration_from');?>
                    &nbsp;</span> <span class="error_message" id="form_error_first_name">
                    <?=form_error('duration_to');?>
                    &nbsp;</span>
                    <div class="clr"></div>
                  </div>
                </div>
                <div class="clr"></div>
              </div>
              <div class="clr"></div>
            </div>
            <div class="block">
              <h2 class="title">Photos</h2>
              <div class="row-fluid">
              		<div class="span2 form_label">Current Logo </div>
	              <div>
	              		<img style="height:100px; margin-left:20px; max-width:250px; border:1px rgb(214, 214, 214) solid;" src="<?=($deal_details->business_logo != '')?base_url('uploads/deal_images/'.$deal_details->business_logo):base_url('themes/front/images/no-image.jpg');?>" alt="No Image Found" >
	              </div>
              </div>
              <div class="row-fluid">
                <div class="span2 form_label">Logo</div>
                <div class="span8 file-wrapper">
                  <input type="file" name="logo" id="logo" value="" class="">
                  <span class="file-holder"></span> <span class="button">Choose File</span>
                  <div class="selectForm">
                    <div class="floatleft w75p">
                      <div class="floatleft checkbox_text">
                        <input type="checkbox" name="use_logo" id="use_logo" value="use" <?php if($deal_details->use_logo == '1') echo "checked=true"; ?> >
                        <span>Use Logo</span></div>
                      <div class="floatright gray">Size should be 232x147px</div>
                    </div>
                  </div>
                  <div class="clr"></div>
                </div>
                <span class="error_message" id="form_error_first_name">
                <?=form_error('check_logo');?>
                &nbsp;</span>
                <div class="clr"></div>
              </div>
              <div class="row-fluid">
              		<div class="span2 form_label">Current Image </div>
	              <div>
	              		<img style="height:100px; margin-left:20px; max-width:250px; border:1px rgb(214, 214, 214) solid;" src="<?=($deal_details->business_image != '')?base_url('uploads/deal_images/'.$deal_details->business_image):base_url('themes/front/images/no-image.jpg');?>" alt="No Image Found" >
	              </div>
              </div>
              <div class="row-fluid">
                <div class="span2 form_label">Upload Images</div>
                <div class="span8 file-wrapper">
                  <input type="file" name="img" id="img" value="" class="">
                  <span class="file-holder"></span> <span class="button">Choose File</span>
                  <div class="floatleft w75p">
                    <div class="floatright gray">Maximum size should be 761x364px</div>
                  </div>
                  <div class="clr"></div>
                </div>
                <span class="error_message" id="form_error_first_name">
                <?=form_error('check_img');?>
                &nbsp;</span>
                <div class="clr"></div>
              </div>
              <div class="clr"></div>
            </div>
            <div class="block">
              <h2 class="title">Listing Location</h2>
              <p class="align-right"><a class="blue" onclick="get_location_of_store();" href="javascript:void(0);">Insert from My Store</a></p>
              <div class="row-fluid">
                <div class="span2 form_label">Country</div>
                <div class="span8">
                  <select name="country" id="country" class="creat_camp_select">
                    <option value="">Select a country</option>
                    <?php foreach($country as $con){?>
                    <option value="<?=$con->id?>" <?php if($deal_details->country == $con->id) echo "selected=selected"; echo set_select('country','');?> >
                    <?=$con->country_name;?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
                <span class="error_message" id="form_error_first_name">
                <?=form_error('country');?>
                &nbsp;</span>
                <div class="clr"></div>
              </div>
              <div class="row-fluid">
                <div class="span2 form_label">Region</div>
                <div class="span8">
                  <input type="text" name="region" id="region" class="inputbox" value="<?php echo set_value('region', $deal_details->region); ?>">
                </div>
                <span class="error_message" id="form_error_first_name">
                <?=form_error('region');?>
                &nbsp;</span>
                <div class="clr"></div>
              </div>
              <div class="row-fluid">
                <div class="span2 form_label">City</div>
                <div class="span8">
                  <select name="city" id="city" onchange="get_city_area();" class="creat_camp_select">
                    <option value="">Select a city</option>
                    <?php foreach($city as $c){?>
                    <option value="<?=$c->loc_id?>" <?php if($deal_details->city == $c->loc_id) echo "selected=selected"; echo set_select('city','');?> >
                    <?=$c->city;?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
                <span class="error_message" id="form_error_first_name">
                <?=form_error('city');?>
                &nbsp;</span>
                <div class="clr"></div>
              </div>
              <div class="row-fluid">
                <div class="span2 form_label">City Area</div>
                <div class="span8">
                  <select name="city_area" id="city_area" class="creat_camp_select">
                    <option value="">Select a city first</option>
                  </select>
                  <input type="hidden" name="selected_zip" id="selected_zip" value="<?=$deal_details->city_area;?>" >
                </div>
                <span class="error_message" id="form_error_first_name">
                <?=form_error('city_area');?>
                &nbsp;</span>
                <div class="clr"></div>
              </div>
              <div class="row-fluid">
                <div class="span2 form_label">Address</div>
                <div class="span8">
                  <input type="text" name="address" id="address" class="inputbox" value="<?php echo set_value('address', $deal_details->address); ?>" >
                </div>
                <span class="error_message" id="form_error_first_name">
                <?=form_error('address');?>
                &nbsp;</span>
                <div class="clr"></div>
              </div>
              <div class="row-fluid">
                <div class="span2 form_label">Phone Number</div>
                <div class="span8">
                  <input type="text" name="phone" id="phone" class="inputbox" value="<?php echo set_value('phone',$deal_details->phone); ?>">
                </div>
                <span class="error_message" id="form_error_first_name">
                <?=form_error('phone');?>
                &nbsp;</span>
                <div class="clr"></div>
              </div>
              <div class="row-fluid">
                <div class="span2 form_label">Website URL</div>
                <div class="span8">
                  <input type="text" name="website_url" id="website_url" class="inputbox" value="<?php echo set_value('website_url', $deal_details->website); ?>">
                </div>
                <span class="error_message" id="form_error_first_name">
                <?=form_error('website_url');?>
                &nbsp;</span>
                <div class="clr"></div>
              </div>
              <div class="row-fluid">
                <div class="span2 form_label">&nbsp;</div>
                <div class="span8">
                  <input type="button" name="post" value="Post" onclick="checkCampaignData_test('post')" class="blue_btn1">
                  <input type="button" value="Save for Later" onclick="checkCampaignData_test('save')" class="red_btn1">
                  <input type="button" value="Schedule" onclick="checkCampaignData_test('schedule')" class="gray_btn1">
                </div>
                <div class="clr"></div>
              </div>
              <div class="clr"></div>
            </div>
          </form>   
        </div>
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

<script type="text/javascript" >
		$(document).ready( function(){
			
			// ----- Datepicker code			
			//$.noConflict();
		   // $(function() {
		        $("#duration_from,#duration_to").datepicker({
		            changeMonth: true,
		            yearRange: '2013:2050',
		            //defaultDate: new Date(1985, 00, 01),
		            defaultDate: new Date(),
		            showButtonPanel: true,
		            dateFormat: 'dd-mm-yy',
		            changeYear: true
		        });
		   // });
        // ----- Datepicker code  
        
        get_city_area();
      }); 
 </script>
        	

