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
        <?php  echo $this->Common_model->show_info('info_message');?>
        <div class="row-fluid">
            <div class="error"><?php echo validation_errors();?></div>
            <form name="frmChangeDetails" action="<?php echo base_url('admin/welcome/my_account');?>" method="POST" >
                <input type="hidden" name="page_action" id="page_action" value="edit_account" />
                <div class="well">
                    <div><strong>Username</strong></div>
                    <input type="text" name="username" readonly="" value="<?php echo $account_details->username;?>" />

                    <div><strong>E-mail</strong></div>
                    <input type="text" name="email"  value="<?php echo $account_details->email;?>" />

                    <div><strong>Display Name</strong></div>
                    <input type="text" name="display_name"  value="<?php echo $account_details->display_name;?>" />


                    <div><strong>New Password</strong></div>
                    <input type="password" name="new_password"  value="" />

                    <div><strong>Confirm Password</strong></div>
                    <input type="password" name="passconf"  value="" />

                    <p>&nbsp;</p>
                    <div align="left">
                        <input type="submit" class="btn" name="submit"  value="Save" />       

                        <input type="button" class="btn" name="cancel" onclick="window.location.href='<?php echo base_url('admin/welcome/');?>';"  value="Cancel" />        
                    </div>
                </div>    
            </form>
        </div>

    </div>
</div>
<?php $this->load->view('admin/admin_include/admin_footer_view');?>

