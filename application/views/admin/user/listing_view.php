<?php
/**
 * Static page listing
 */
$this->load->view('admin/admin_include/admin_header_view');
$this->load->view('admin/admin_include/admin_left_nav_view');
?>

<script type="text/javascript" >

		function submit_user_type(){
			window.location = "<?=base_url('admin/user/home');?>" + "/" + $('#user_type').val();
			}

		function add_new_user(){
			window.location = "<?=base_url('admin/user/add_user');?>" + "/" + $('#add_user_type').val();
			}
</script>

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
        		   <!--  <div class="btn-toolbar">
                    <button class="btn btn-primary" onclick="window.location.href = '<?php echo base_url('admin/user/add_user'); ?>'">
                        <strong>&lt;&lt;</strong> Add Business User
                    </button>
                    <div class="btn-group"></div>                    
                </div> -->
                
                <div class="btn-toolbar">
                    <select name="add_user_type" id="add_user_type"">
								<option value="business_basic" <?=($selcted_user == 'business_basic')?'selected=selected':'';?>>Business Basic</option>   
								<option value="business_pro" <?=($selcted_user == 'business_pro')?'selected=selected':'';?>>Business Pro</option> 
								<option value="end_user" <?=($selcted_user == 'end_user')?'selected=selected':'';?>>End User</option>                  
                    </select>
				<button class="btn btn-primary" style="margin-bottom:10px;" onclick="add_new_user();" onclick="window.location.href = '<?php echo base_url('admin/user/add_user'); ?>'">
                        <strong>+ </strong>Add
                    </button>
                    <div class="btn-group"></div> 

				<span style="float:right;" >
				<button class="btn btn-primary" style="margin-bottom:10px;" onclick="submit_user_type();" onclick="window.location.href = '<?php echo base_url('admin/user/add_user'); ?>'">
                        View<strong> - </strong>
                    </button>
				<select name="user_type" id="user_type" >
								<option value="all" selected="selected">All</option>  
								<option value="business_basic" <?=($selcted_user == 'business_basic')?'selected=selected':'';?>>Business Basic</option>   
								<option value="business_pro" <?=($selcted_user == 'business_pro')?'selected=selected':'';?>>Business Pro</option> 
								<option value="end_user" <?=($selcted_user == 'end_user')?'selected=selected':'';?>>End User</option>                  
                    </select>
				</span>
				<div class="btn-group"></div>                        
                </div>


            <div class="well">
                
                <table class="table bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
					   <th>Display Name</th>
                            <th>Type</th>
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
                                    <td><?php echo stripslashes($user->firstname.' '.$user->lastname);?></td>
							<td><?php echo stripslashes($user->display_name);?></td>
                                    <td><?php if($user->user_type == 'business_basic') echo"Business(Basic)"; elseif($user->user_type == 'business_pro') echo"Business(Pro)"; else echo"End user";?></td>
                                    <td><?php echo $user->created_date?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/user/change_status/user/id/'.$user->id)?>">
                                        <img src="<?php echo base_url('themes/admin/images/'. $this->Common_model->show_status($user->status) );?>" alt="<?php echo $user->status;?>"/>
                                        </a>
                                    </td>
                                    <td  width="150px;">
<!--                                        <a class="viewpane" href="<?php echo base_url('admin/static_pages/view/page/id/'.$pages->page_id)?>" title="View Content">-->
                                       <a href="javascript:void(0)" onclick="openFancyBox('<?php echo base_url('admin/user/view/user/id/'.$user->id)?>');" title="View Content">
                                        
                                            <img src="<?php echo base_url('themes/admin/images/preview.png');?>" title="View" width="16" style="margin-right:15px;"/>
                                            
                                        </a>
                                        <?php if($user->user_type == 'end_user'){?>
                                        	<a class="sub_but" href="<?php echo base_url('admin/user/subscriptions/'.$user->id)?>" title="View all subscriptions"  ><!--<img src="<?php echo base_url('themes/admin/images/subscribe.png');?>" title="View all subscriptions" width="16">-->Subscriptions</a>
                                        <?php }else{?>
									<a class="sub_but" href="<?php echo base_url('admin/store/by_user/'.$user->id)?>" title="View all subscriptions"  ><!--<img src="<?php echo base_url('themes/admin/images/subscribe.png');?>" title="View all subscriptions" width="16">-->Stores</a>
								<?php } ?>
                                        <!--|
                                        <a href="<?php echo base_url('admin/category/edit_category/category/id/'.$user->id)?>" title="Edit Content">
                                            <img src="<?php echo base_url('themes/admin/images/pencil.png');?>" width="16"/>
                                        </a>
                                        |
                                        <a href="javascript:void(0);" role="button" title="Delete Content" onclick="confirm_delete('<?php echo base_url('admin/category/delete/category/id/'.$user->id);?>')">
                                            <img src="<?php echo base_url('themes/admin/images/trash_delete.png');?>"  width="16"/>
                                        </a>-->
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

