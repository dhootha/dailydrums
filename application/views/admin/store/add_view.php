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
                echo $pageName = 'Add Store';
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
                    <button class="btn btn-primary" onclick="window.location.href = '<?php echo base_url('admin/store'); ?>'">
                        <strong>&lt;&lt;</strong> Back To Listing 
                    </button>
                    <div class="btn-group"></div>                    
                </div>
            <div class="well">
                
                <form id="frmAddPage" class="frmAddPage" action="<?php echo base_url('admin/store/add_store'); ?>" method="POST" enctype="multipart/form-data" >
                    <input type="hidden" name="page_action" value="add_store" />
                    <div id="home" >
                    <table>
                    		<tr>
                        	<td width="200">
                            <span class="required">*</span> 
                            User: &nbsp;&nbsp;
                            
                            </td>
                            <td>
	                        <select name="user_id" id="user_id" class="input-xlarge">
	                        	<?php foreach($user as $u){?>
	                        		<option value="<?=$u->id?>"  <?php echo set_select('user_id', $u->id);?> ><?=$u->display_name;?></option>
	                        	<?php } ?>
	                        </select>
	                        <span class="required"><?php echo form_error('user_id');?></span>
	                        <br>
	                        </td>
                         </tr>
                        <tr>
                        	<td width="200">
	                            <span class="required">*</span> 
	                            Store Name: &nbsp;&nbsp;
                            </td>
                            <td>
	                       		<input type="text" name="store_name" id="store_name" class="input-xlarge" value="<?php echo set_value('store_name', '');?>">
		                        <span class="required"><?php echo form_error('store_name');?></span>
		                        <br>
		                      </td>
                         </tr>
                         
                         <tr>
                        	<td>
	                            <span class="required">*</span> 
	                            Address Line1 : &nbsp;&nbsp;
                            </td>
                            <td>
		                        <input type="text" name="address_line1" id="address_line1" class="input-xlarge" value="<?php echo set_value('address_line1', ''); ?>">
		                        <span class="required"><?php echo form_error('address_line1');?></span>
		                        <br>
		                      </td>
                        </tr>
                        
                        <tr>
                        	<td>
	                            <span class="required">*</span> 
	                            Address Line2 : &nbsp;&nbsp;
                            </td>
                            <td>
		                        <input type="text" name="address_line2" id="address_line2" class="input-xlarge" value="<?php echo set_value('address_line2', ''); ?>">
		                        <span class="required"><?php echo form_error('address_line2');?></span>
		                        <br>
		                      </td>
                        </tr>
                        
                        <tr>
                        	<td>
	                            <span class="required">*</span> 
	                            Street : &nbsp;&nbsp;
                            </td>
                            <td>
		                        <input type="text" name="street" id="street" class="input-xlarge" value="<?php echo set_value('street', ''); ?>">
		                        <span class="required"><?php echo form_error('street');?></span>
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
                        	</td>
                        </tr>
                        
                        <tr>
                        	<td>
                            <span class="required">*</span> 
                            State : &nbsp;&nbsp;
                            </td>
                            <td>
                        <input type="text" name="state" id="state" class="input-xlarge" value="<?php echo set_value('state', ''); ?>">
                        <span class="required"><?php echo form_error('state');?></span>
                        <br>
                        </td>
                        </tr>
                        
                        <tr>
                        	<td>
                            <span class="required">*</span> 
                            Zip: &nbsp;&nbsp;
                            </td>
                            <td>
                        <select name="zip" id="zip" class="input-xlarge">
                        	<option value="">Select a city first</option>
                        </select>
                         <span class="required"><?php echo form_error('zip');?></span>
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
                            Website: &nbsp;&nbsp;
                            </td>
                            <td>
                        <input type="text" name="website" id="website" class="input-xlarge" value="<?php echo set_value('website', ''); ?>">
                        <span class="required"><?php echo form_error('website');?></span>
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
                            Choose Tag Words : &nbsp;&nbsp;
                            </td>
                            <td>
                        <input type="text" name="tag_words" id="tag_words" class="input-xlarge" value="<?php echo set_value('tag_words', ''); ?>">
                        <span class="required"><?php echo form_error('tag_words');?></span>
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
								      url: "<?=base_url('admin/store/get_zip')?>",
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

<?php $this->load->view('admin/admin_include/admin_footer_view'); ?>

