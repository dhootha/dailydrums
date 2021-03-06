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
                    <button class="btn btn-primary" onclick="window.location.href='<?php echo base_url('admin/deals/create_deal');?>'"><strong>+</strong> Add Basic Campaign </button>
						  <button class="btn btn-primary" onclick="window.location.href='<?php echo base_url('admin/deals/create_pro_deal');?>'"><strong>+</strong> Add Pro Campaign </button>                    
                    <div class="btn-group">
                    </div>                    
                </div>
            <div class="well">
                	
                <table class="table bordered">
                    <thead>
                        <tr>
                        	 <th>Campaign name</th>
                        	 <th>Category</th>
                            <th>User Name</th>
                            <th>Campaign Type</th>
                            <th>Created On</th>
                            <th>Status</th>
                            <th style="width: 76px;">Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>     
                        <?php
                        if(isset($userRS) && $userRS!=false){
                            
                            foreach($userRS as $user){ ?>
                                
                                <tr>
                                		<td><?php echo stripslashes($user->business_name);?></td>
                                		<td><?php echo stripslashes($user->category_name);?></td>
                                    <td><?php echo stripslashes($user->display_name);?></td>
                                    <td><?php if($user->campaign_type == 'basic') echo" Campaign Basic"; else echo"Campaign Pro";?></td>
                                    <td><?php echo $user->created_date?></td>
                                    <td>
                                      <a href="<?php echo base_url('admin/deals/change_status/deal/id/'.$user->id)?>">
                                        <img src="<?php echo base_url('themes/admin/images/'. $this->Common_model->show_status($user->status) );?>" alt="<?php echo $user->status;?>"/>
                                        </a>
                                      <!--  <//?php if($user->status=='1') echo 'Active'; else echo 'Inactive';?> -->
                                        
                                    </td>
                                    <td  width="150px;">
<!--                                        <a class="viewpane" href="<?php echo base_url('admin/static_pages/view/page/id/'.$pages->page_id)?>" title="View Content">-->
                                       <a href="javascript:void(0)" onclick="openFancyBox('<?php echo base_url('admin/user/deal_details/'.$user->id)?>');" title="View">
                                        
                                            <img src="<?php echo base_url('themes/admin/images/preview.png');?>" title="View" width="16" style="margin-right:15px;"/>
                                            
                                        </a>
                                        <?php if($user->user_type == 'end_user'){?>
                                        <a style="font-size:8px;" href="<?php echo base_url('admin/user/subscriptions/'.$user->id)?>" ><img src="<?php echo base_url('themes/admin/images/subscribe.png');?>" title="subscription" width="16"></a>
                                        <?php }?>
                                        |
                                        <?php $edit_path = /*($user->campaign_type == 'pro')?"admin/deals/edit_pro_deal/deal/id/":*/"admin/deals/edit_deal/deal/id/";?>
                                        <a href="<?php echo base_url($edit_path.$user->id)?>" title="Edit Content">
                                            <img src="<?php echo base_url('themes/admin/images/pencil.png');?>" width="16"/>
                                        </a>
                                        |
                                        <a href="javascript:void(0);" role="button" title="Delete Content" onclick="confirm_delete('<?php echo base_url('admin/deals/delete/deal/id/'.$user->id);?>')">
                                            <img src="<?php echo base_url('themes/admin/images/trash_delete.png');?>"  width="16"/>
                                        </a>
                                    </td>
                                </tr>   
                            <?php
                            }                            
                        }else{ ?>
                            <tr>
                                <td colspan="4">No records found</td>
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

