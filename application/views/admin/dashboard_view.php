<?php
$this->load->view('admin/admin_include/admin_header_view');
$this->load->view('admin/admin_include/admin_left_nav_view');
?>

<div class="content">

    <div class="header">
        <h1 class="page-title">
            <?php
            if (!isset($pageName))
                echo $pageName = 'Admin Dashboard';
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
                <p>Welcome Admin </p>
                <?php echo date('D, M Y, H:i:s')?>
            </div>
            
        </div>
    </div>
</div>
<?php $this->load->view('admin/admin_include/admin_footer_view');?>

