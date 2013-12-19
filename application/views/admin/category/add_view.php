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
    
    function make_slug() {

			var category_name = $('#category_name').val();    	
			category_name = category_name.replace(/[`~!@#$%^&*()|+\_\s=?;:'",.<>\{\}\[\]\\\/]/gi, '-').replace( /\-+/g, '-' );
    		$('#category_slug').val(category_name);
    		}
</script>

<!-- /TinyMCE -->
<div class="content">

    <div class="header">
        <h1 class="page-title">
            <?php
            if (!isset($pageName))
                echo $pageName = 'Add Category';
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
                    <button class="btn btn-primary" onclick="window.location.href = '<?php echo base_url('admin/category/home'); ?>'">
                        <strong>&lt;&lt;</strong> Back To Listing
                    </button>
                    <div class="btn-group"></div>                    
                </div>
                <form id="frmAddPage" class="frmAddPage" action="<?php echo base_url('admin/category/add_page'); ?>" method="POST" enctype="multipart/form-data" >
                    <input type="hidden" name="page_action" value="add_page" />
                    <div id="home" class="tab-pane active">
                        <label>
                            <span class="required">*</span> 
                            Category Name: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('page_title');?></span>
                        </label>
                        <input type="text" name="category_name" onkeyup="make_slug();" id="category_name" class="input-xlarge" value="">
                        
                        <p>&nbsp;</p>
                        
                         <label>
                            <span class="required">*</span> 
                            Category Slug: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('page_title');?></span>
                        </label>
                        <input type="text" name="category_slug" id="category_slug" class="input-xlarge" value="" readonly="true">
                        
                        <p>&nbsp;</p>
                        
                        <label>
                            <span class="required">*</span> 
                            Category Logo: &nbsp;&nbsp;
                            <span class="required"><?php echo form_error('category_logo');?></span>
                        </label>
                        <input type="file" name="category_logo" id="category_logo" class="input-xlarge" >
                      
                        
                        <p>&nbsp;</p>
                    </div>
                    <div><button type="submit" class="btn" >Submit</button></div>
                </form>
            </div>

        </div>
    </div>
</div>

<?php $this->load->view('admin/admin_include/admin_footer_view'); ?>

