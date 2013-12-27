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
                echo $pageName = 'Add Business User';
            else
                echo $pageName;
            ?>
        </h1>
    </div>

    <div class="container-fluid">
        <?php $this->load->view('admin/admin_include/show_alert_view');?>        
        <p>&nbsp;</p>
        <div class="row-fluid">
            <div class="well">
                <div class="btn-toolbar">
                    <button class="btn btn-primary" onclick="window.location.href = '<?php echo base_url('admin/user'); ?>'">
                        <strong>&lt;&lt;</strong> Back To Listing
                    </button>
                    <div class="btn-group"></div>                    
                </div>
                <form id="frmAddPage" class="frmAddPage" action="<?php echo base_url('admin/user/register_business_user'); ?>" method="POST" enctype="multipart/form-data" >
                    <input type="hidden" name="page_action" value="add_basic_user" />
                    <div id="home" class="tab-pane active">
                        
                        <label>
                            <span class="required">*</span> 
                            First & Last Name: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('name');?></span>
                        </label>
                        <input type="text" name='name' id='name' value="<?php echo set_value('name', ''); ?>" class="input-xlarge">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Email Address: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('email');?></span>
                        </label>
                        <input type="text" name="email" id="email" value="<?php echo set_value('email', ''); ?>" class="input-xlarge">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Re-type Email Address: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('email_again');?></span>
                        </label>
                        <input type="text" name="email_again" id="email_again" value="<?php echo set_value('email_again', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Password: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('password');?></span>
                        </label>
                        <input type="password" name="password" id="password" value="<?php echo set_value('password', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Retype password: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('password_again');?></span>
                        </label>
                        <input type="password" name="password_again" id="password_again" value="<?php echo set_value('password_again', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Legal Name: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('business_name');?></span>
                        </label>
                        <input type="text" name="business_name" id="business_name" value="<?php echo set_value('business_name', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Business Email Address: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('business_email');?></span>
                        </label>
                        <input type="text" name="business_email" id="business_email" value="<?php echo set_value('business_email', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Re-type Business Email Address: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('business_email_again');?></span>
                        </label>
                        <input type="text" name="business_email_again" id="business_email_again" value="<?php echo set_value('business_email_again', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Display Name: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('display_name');?></span>
                        </label>
                        <input type="text" name="display_name" id="display_name" value="<?php echo set_value('display_name', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Address Line 1: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('address_line_1');?></span>
                        </label>
                        <input type="text" name="address_line_1" id="address_line_1" value="<?php echo set_value('address_line_1', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required"></span> 
                            Address Line 2: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('address_line_2');?></span>
                        </label>
                        <input type="text" name="address_line_2" id="address_line_2" value="<?php echo set_value('address_line_2', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            City/Town: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('city');?></span>
                        </label>
                        <input type="text" name="city" id="city" value="<?php echo set_value('city', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Province/Region/State: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('state');?></span>
                        </label>
                        <input type="text" name="state" id="state" value="<?php echo set_value('state', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Postal Code/Zip Code: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('zip');?></span>
                        </label>
                        <input type="text" name="zip" id="zip" value="<?php echo set_value('zip', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Country: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('category_logo');?></span>
                        </label>
                        <select name="country" id="country" class="selectbox">
									<option value='' <?php echo set_select('country', '', TRUE); ?> >Select</option>
									<?php 
											for($i=0;$i < count($countryList);$i++) {
									?>
												<option value="<?php echo $countryList[$i]->id; ?>" <?php echo set_select('country', $countryList[$i]->id); ?> > <?php echo $countryList[$i]->country_name; ?> </option>
									<?php }
									?>
								</select>
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Primary Phone: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('phone_primary');?></span>
                        </label>
                        <input type="text" name="phone_primary" id="phone_primary" value="<?php echo set_value('phone_primary', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Card Name: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('card_name');?></span>
                        </label>
                        <input type="text" name="card_name" id="card_name" value="<?php echo set_value('card_name', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Credit Card Number: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('card_number');?></span>
                        </label>
                        <input type="text" name="card_number" id="card_number" value="<?php echo set_value('card_number', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Security Code: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('security_code');?></span>
                        </label>
                        <input type="text" name="security_code" id="security_code" value="<?php echo set_value('security_code', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                    </div>
                    <div><button type="submit" class="btn" >Submit</button></div>
                </form>
            </div>

        </div>
    </div>
</div>

<?php $this->load->view('admin/admin_include/admin_footer_view'); ?>

