<?php
/**
 * Static page adding
 */
$this->load->view('admin/admin_include/admin_header_view');
$this->load->view('admin/admin_include/admin_left_nav_view');
?>
<!-- TinyMCE -->
<script type="text/javascript" src="<?php echo base_url('themes/thirdparty_js/tiny_mce/tiny_mce.js'); ?>"></script>
<script type="text/javascript">
    tinyMCE.init({
        mode: "textareas",
// ===========================================
// Set THEME to ADVANCED
// ===========================================
        theme: "advanced",
// ===========================================
// INCLUDE the PLUGIN
// ===========================================

        plugins: "jbimages,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
// ===========================================
// Set LANGUAGE to EN (Otherwise, you have to use plugin's translation file)
// ===========================================

        language: "en",
        theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
// ===========================================
// Put PLUGIN'S BUTTON on the toolbar
// ===========================================

        theme_advanced_buttons2: "jbimages,advimage,image,cleanup,help,code,|,cut,copy,paste,pastetext,pasteword,|,fontselect,fontsizeselect",
        theme_advanced_toolbar_location: "top",
        theme_advanced_toolbar_align: "left",
        theme_advanced_statusbar_location: "bottom",
        theme_advanced_resizing: true,
// ===========================================
// Set RELATIVE_URLS to FALSE (This is required for images to display properly)
// ===========================================
        document_base_url: "<?php echo base_url(); ?>",
        convert_urls: true,
        relative_urls: false,
		valid_elements : '*[*]',
        remove_script_host: false

    });
		    

</script>

<!-- /TinyMCE -->
<div class="content">

    <div class="header">
        <h1 class="page-title">
            <?php
            if (!isset($pageName))
                echo $pageName = 'Add Pro Campaign';
            else
                echo $pageName;
            ?>
        </h1>
    </div>

    <div class="container-fluid">
        <?php $this->load->view('admin/admin_include/show_alert_view');?>        
        <p>&nbsp;</p>
        <div class="row-fluid">
        			<div class="btn-toolbar">
                    <button class="btn btn-primary" onclick="window.location.href = '<?php echo base_url('admin/deals'); ?>'">
                        <strong>&lt;&lt;</strong> Back To Listing 
                    </button>
                    <div class="btn-group"></div>                    
                </div>
            <div class="well">
                
                <form id="frmAddPage" class="frmAddPage" action="<?php echo base_url('admin/deals/add_pro_deal'); ?>" method="POST" enctype="multipart/form-data" >
                    <input type="hidden" name="page_action" value="add_pro_deal" />
                    <div id="home" >
                    <table>
                    		<tr>
                        	<td width="200">
                            <span class="required">*</span> 
                            Campaign By: &nbsp;&nbsp;
                            </td>
                            <td>
	                        <select name="user_id" id="user_id" class="input-xlarge">
	                        	<?php foreach($user as $u){?>
	                        		<option value="<?=$u->id?>" <?php echo set_select('user_id', $u->id); ?> ><?=$u->display_name;?></option>
	                        	<?php } ?>
	                        </select>
	                        <span class="required"><?php echo form_error('store_name');?></span>
	                        <br>
	                        </td>
                         </tr>
                        <tr>
                        	<td width="200">
                            <span class="required">*</span> 
                            Store Name: &nbsp;&nbsp;
                            
                            </td>
                            <td>
                       
	                        <select name="store_name" id="store_name" class="input-xlarge">
	                        		<option value="">Select a store</option>
	                        	 <?php foreach($stores as $store){?>
	                        		<option value="<?=$store->store_id?>" <?php echo set_select('store_name', $store->store_id);?> ><?=$store->store_name;?></option>
	                        	<?php } ?> 
	                        </select>
	                        <span class="required"><?php echo form_error('store_name');?></span>
	                        <br>
	                        </td>
                         </tr>
                         
                       <!-- <input type="text" name="store_name" id="store_name" class="input-xlarge" value=""> -->
                        <tr>
                        	<td>
                            <span class="required">*</span> 
                            Title: &nbsp;&nbsp;
                            </td>
                            <td>
                            
                            
                        		<input type="text" name="title" id="title" class="input-xlarge" value="<?php echo set_value('title', ''); ?>">
                        		<span class="required"><?php echo form_error('title');?></span>
                        		<br>
                        		</td>
                        </tr>
                        
                        <tr>
                        	<td>
                            <span class="required">*</span> 
                            Campaign under: &nbsp;&nbsp;
                            </td>
                            <td>
                            		<select name="campaign_under" id="campaign_under" class="input-xlarge">
			                        		<option value="1"  <?php echo set_select('campaign_under', '1');?> >In Stores</option>
			                        		<option value="2"  <?php echo set_select('campaign_under', '2');?>>Neighborhood</option>
			                        		<option value="3"  <?php echo set_select('campaign_under', '3');?>>Online</option>
			                        </select>
                        		
                        		<span class="required"><?php echo form_error('campaign_under');?></span>
                        		<br>
                        		</td>
                        </tr>
                        
                        <tr>
                        	<td>
                            <span class="required">*</span> 
                            Category Name: &nbsp;&nbsp;
                            </td>
                            <td>
                            
                       
                        <select name="category" id="category" class="input-xlarge">
                        		<option value="">Select a category</option>
                        	<?php foreach($categories as $category){?>
                        		<option value="<?=$category->category_id?>" <?php echo set_select('category', $category->category_id);?> ><?=$category->category_name;?></option>
                        	<?php } ?>
                        </select>
                        <span class="required"><?php echo form_error('category');?></span>
                        <br>
                        <!-- <input type="text" name="category_name" id="category_name" class="input-xlarge" value=""> -->
                        </td>
                        </tr>
                        
                        <tr>
                        	<td>
                            <span class="required">*</span> 
                            Campaign Description: &nbsp;&nbsp;
                            </td>
                            <td>
                            
                        
                        <input type="text" name="description" id="description" class="input-xlarge" value="<?php echo set_value('description', ''); ?>">
                        <span class="required"><?php echo form_error('description');?></span>
                        <br>
                        </td>
                        </tr>
                        
                        <tr>
                        	<td>
                            <span class="required">*</span> 
                            Duration: &nbsp;&nbsp;
                            </td>
                            <td>
                        From <input type="text" name="duration_from" id="duration_from" class="input-xlarge" value="<?php echo set_value('duration_from', ''); ?>">&nbsp;&nbsp;
								<span class="required"><?php echo form_error('duration_from');?></span>   <br>                     
                        To &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="duration_to" id="duration_to" class="input-xlarge" value="<?php echo set_value('duration_to', ''); ?>">
                        <span class="required"><?php echo form_error('duration_to');?></span>
								<br>                        
                        </td>
                        </tr>
                        
                                                
                        <tr>
                        	<td>
                            <span class="required">*</span> 
                            Logo: &nbsp;&nbsp;
                            </td>
                            <td>
                        <input type="file" name="logo" id="logo" class="input-xlarge">
                        <span class="required"><?php echo form_error('logo');?></span>
                        <br>
                        </td>
                        </tr>
                        
                        <tr>
                        	<td>
                            <span class="required">*</span> 
                            Campaign Url: &nbsp;&nbsp;
                            </td>
                            <td>
                        <input type="text" name="campaign_url" id="campaign_url" class="input-xlarge" value="<?php echo set_value('campaign_url', ''); ?>">
                        <span class="required"><?php echo form_error('campaign_url');?></span>
                        <br>
                        </td>
                        </tr>
                        
                        <tr>
                        	<td>
                            <span class="required">*</span> 
                            Country: &nbsp;&nbsp;
                            </td>
                            <td>
                            
                        <select name="country" id="country" class="input-xlarge">
                        	<option value="">Select a country</option>
                        	<?php foreach($country as $con){?>
                        		<option value="<?=$con->id?>" <?php echo set_select('country', $con->id);?> ><?=$con->country_name;?></option>
                        	<?php } ?>
                        </select>
                            
                        <!--<input type="text" name="country" id="country" class="input-xlarge" value=""> -->
                         <span class="required"><?php echo form_error('country');?></span>
                        <br>
                        </td>
                        </tr>
                        
                        <tr>
                        	<td>
                            <span class="required">*</span> 
                            Region: &nbsp;&nbsp;
                            </td>
                            <td>
                        <input type="text" name="region" id="region" class="input-xlarge" value="<?php echo set_value('region', ''); ?>">
                        <span class="required"><?php echo form_error('region');?></span>
                        <br>
                        </td>
                        </tr>
                        
                        
                        <tr>
                        	<td>
                            <span class="required">*</span> 
                            City: &nbsp;&nbsp;
                            </td>
                            <td>
                        
                        <select name="city" id="city" class="input-xlarge">
                        	<option value="">Select a city</option>
                        	<?php foreach($city as $c){?>
                        		<option value="<?=$c->loc_id?>" <?php echo set_select('city', $c->loc_id);?> ><?=$c->city;?></option>
                        	<?php } ?>
                        </select>
                         <span class="required"><?php echo form_error('city');?></span>
                        <br>
                        <!-- <input type="text" name="city" id="city" class="input-xlarge" value=""> -->
                        </td>
                        </tr>
                        
                        <tr>
                        	<td>
                            <span class="required">*</span> 
                            City Area: &nbsp;&nbsp;
                            </td>
                            <td>
                        <select name="city_area" id="city_area" class="input-xlarge">
                        	<option value="">Select a city first</option>
                        </select>
                         <span class="required"><?php echo form_error('city_area');?></span>
                        <br>
                       <!-- <input type="text" name="city_area" id="city_area" class="input-xlarge" value=""> -->
                       </td>
                       </tr>
                        
                        <tr>
                        	<td>
                            <span class="required">*</span> 
                            Address : &nbsp;&nbsp;
                            </td>
                            <td>
                        <input type="text" name="address" id="address" class="input-xlarge" value="<?php echo set_value('address', ''); ?>">
                        <span class="required"><?php echo form_error('address');?></span>
                        <br>
                        </td>
                        </tr>
                        
                        <tr>
                        	<td>
                            <span class="required">*</span> 
                            Phone: &nbsp;&nbsp;
                            </td>
                            <td>
                        <input type="text" name="phone" id="phone" class="input-xlarge" value="<?php echo set_value('phone', ''); ?>">
                        <span class="required"><?php echo form_error('phone');?></span>
                        <br>
                        </td>
                        </tr>
                        
                        <tr>
                        	<td>
                            <span class="required">*</span> 
                            Website Url: &nbsp;&nbsp;
                            </td>
                            <td>
                        <input type="text" name="website_url" id="website_url" class="input-xlarge" value="<?php echo set_value('website_url', ''); ?>">
                        <span class="required"><?php echo form_error('website_url');?></span>
                        <br>
                        </td>
                        </tr>
                     </table>
                       
                    </div>
                    <div><button type="submit" class="btn" >Submit</button></div>
                </form>
            </div>

        </div>
    </div>
</div>

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
			$('#city').change(function() {     
							var city = $('#city :selected').text();
							request = $.ajax({
								      type: 'post',
								      url: "<?=base_url('admin/deals/get_zip')?>",
								      data: 'city_name='+city,
									dataType:'json'
								 	 });
							  
							  request.done(function(response) {
							  			var zip_data = "<option value=''>Select a city first</option>";
										if(response){
											zip_data = "<option value=''>Select a city area</option>";
											for(r in response){
												zip_data += "<option value='"+response[r].loc_id+"'>"+response[r].zip+"</option>"; 
												}
											}
										$('#city_area').html(zip_data);
										});
						});
						
				$('#user_id').change(function() {     
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
						});
			});		
</script>

<?php $this->load->view('admin/admin_include/admin_footer_view'); ?>

