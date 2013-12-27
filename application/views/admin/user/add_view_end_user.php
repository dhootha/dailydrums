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
                <form id="frmAddPage" class="frmAddPage" action="<?php echo base_url('admin/user/register_end_user'); ?>" method="POST" enctype="multipart/form-data" >
                    <input type="hidden" name="page_action" value="register_ens_user" />
                    <div id="home" class="tab-pane active">

                        <label>
                            <span class="required">*</span> 
                            First Name: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('first_name');?></span>
                        </label>
                        <input type="text" name='first_name' id='first_name' value="<?php echo set_value('first_name', ''); ?>" class="input-xlarge">                        
                        <p>&nbsp;</p>
                        
				    <label>
                            <span class="required">*</span> 
                            Last Name: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('last_name');?></span>
                        </label>
                        <input type="text" name='last_name' id='last_name' value="<?php echo set_value('last_name', ''); ?>" class="input-xlarge">                        
                        <p>&nbsp;</p>


					<label>
                            <span class="required">*</span> 
                            Display Name: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('display_name');?></span>
                        </label>
                        <input type="text" name='display_name' id='display_name' value="<?php echo set_value('display_name', ''); ?>" class="input-xlarge">                        
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
                            Re-enter Email: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('retype_email');?></span>
                        </label>
                        <input type="text" name="retype_email" id="retype_email" value="<?php echo set_value('retype_email', ''); ?>" class="inputbox">
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
                            <span class="required"><?php echo form_error('retype_password');?></span>
                        </label>
                        <input type="password" name="retype_password" id="retype_password" value="<?php echo set_value('retype_password', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Zip Code: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('zip');?></span>
                        </label>
                        <input type="text" name="zip" id="zip" value="<?php echo set_value('zip', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>
                        
                        
                        <label>
                            <span class="required">*</span> 
                            Phone: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('phone');?></span>
                        </label>
                        <input type="text" name="phone" id="phone" value="<?php echo set_value('phone', ''); ?>" class="inputbox">
                        <p>&nbsp;</p>

					<label>
                            <span class="required">*</span> 
                            Gender: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('gender');?></span>
                        </label>
                        <input type="radio" name="gender" id="gen_male" value="male" class="inputbox" <?php echo set_radio('gender', 'male', TRUE); ?> > Male
					<input type="radio" name="gender" id="gen_female" value="fmale" class="inputbox" <?php echo set_radio('gender', 'female'); ?> > Female
                        <p>&nbsp;</p>
                                         
                    </div>
                    <div><button type="submit" class="btn" >Submit</button></div>
                </form>
            </div>

        </div>
    </div>
</div>

<?php $this->load->view('admin/admin_include/admin_footer_view'); ?>

