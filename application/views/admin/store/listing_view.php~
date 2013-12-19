<?php
/**
 * Static page listing
 */
$this->load->view('admin/admin_include/admin_header_view');
$this->load->view('admin/admin_include/admin_left_nav_view');
?>

<div class="content">

    <div class="header">
        <h1 class="page-title">
            <?php
            if (!isset($pageName))
                echo $pageName = 'Add Campaign';
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
                    <button class="btn btn-primary" onclick="window.location.href='<?php echo base_url('admin/store/create_store');?>'"><strong>+</strong> Add Store </button>
                    <div class="btn-group">
                    </div>                    
                </div>
            <div class="well">
                	
                <table class="table bordered">
                    <thead>
                        <tr>
                        	 <th>Store name</th>
                            <th>User Name</th>
                            <th>User Type</th>
                            <!--<th>Created On</th> -->
                            <th>Status</th>
                            <th style="width: 35%; text-align:center;">Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>     
                        <?php
                        if(isset($userRS) && $userRS!=false){
                            
                            foreach($userRS as $user){  ?>
                                
                                <tr>
                                		<td><?php echo stripslashes($user->store_name);?></td>
                                    <td><?php echo stripslashes($user->display_name);?></td>
                                    <td><?php if($user->user_type == 'business_basic') echo"Business-Basic"; elseif($user->user_type == 'business_pro') echo"Business-Pro"; else echo "Admin";?></td>
                                    <!-- <td><?php echo $user->created_date?></td> -->
                                    <td>
                                      <a href="<?php echo base_url('admin/store/change_status/store/id/'.$user->store_id)?>">
                                        <img src="<?php echo base_url('themes/admin/images/'. $this->Common_model->show_status($user->status) );?>" alt="<?php echo $user->status;?>"/>
                                        </a>
                                      <!--  <//?php if($user->status=='1') echo 'Active'; else echo 'Inactive';?> -->
                                    </td>
                                    <td>
                                       <!--<a class="viewpane" href="<?php echo base_url('admin/store/view/store/id/'.$user->store_id)?>" title="View Content">-->
                                       <a href="javascript:void(0)" onclick="openFancyBox('<?php echo base_url('admin/store/view/store/id/'.$user->store_id)?>');" title="View">
                                        
                                            <img src="<?php echo base_url('themes/admin/images/preview.png');?>" title="View" width="16" style="margin-right:15px;"/>
                                            
                                        </a>
                                        |
                                        <?php $edit_path = /*($user->campaign_type == 'pro')?"admin/deals/edit_pro_deal/deal/id/":*/"admin/store/edit_store/store/id/";?>
                                        <a href="<?php echo base_url($edit_path.$user->store_id)?>" title="Edit Content">
                                            <img src="<?php echo base_url('themes/admin/images/pencil.png');?>" width="16"/>
                                        </a>
                                        |
                                        <a href="javascript:void(0);" role="button" title="Delete Content" onclick="confirm_delete('<?php echo base_url('admin/store/delete/store/id/'.$user->store_id);?>')">
                                            <img src="<?php echo base_url('themes/admin/images/trash_delete.png');?>"  width="16"/>
                                        </a>
                                        |
                                       <!-- <//?php if($user->user_type == 'end_user'){?> -->
                                        <a class="sub_but" href="<?php echo base_url('admin/store/subscriptions/'.$user->store_id)?>" title="View all subscriptions"  ><!--<img src="<?php echo base_url('themes/admin/images/subscribe.png');?>" title="View all subscriptions" width="16">-->Subscribers</a>
                                       <!-- <//?php }?> -->
                                       |
                                        <a class="deals_but" href="<?php echo base_url('admin/store/deals_by_store/'.$user->store_id)?>" title="View all deals of this store"  ><!--<img src="<?php echo base_url('themes/admin/images/subscribe.png');?>" title="View all subscriptions" width="16">-->Campaigns</a>
                                    </td>
                                </tr>   
                            <?php
                            }                            
                        }else{ ?>
                            <tr>
                                <td colspan="6">No records found</td>
                            </tr>
                        <?php    
                        }
                        ?>
                                               
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>

<?php $this->load->view('admin/admin_include/admin_footer_view');?>

