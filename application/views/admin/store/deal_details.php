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
                echo $pageName = 'Deals In Store';
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
                    <button class="btn btn-primary" onclick="window.location.href='<?php echo base_url('admin/store');?>'"><strong><<</strong> Back To Listing </button>
                    <div class="btn-group">
                    </div>                    
                </div>
                <table class="table bordered">
                    <thead>
                        <tr>
                            <th>Campaign Name </th>
                            <th>Campaign Description </th>
                            <th>Created Date </th>
                             <!--<th>View</th> -->
                        </tr>
                    </thead>
                    
                    <tbody>     
                        <?php
                        if(isset($userRS) && $userRS!=false){
                           
                            foreach($userRS as $user){ ?>
                                
                                <tr>
                                    <td width="25%"><?php echo $user->business_name;?></td>
                                    <td width="50%"><?php echo $user->business_description;?></td>
                                    <td width="25%"><?php echo date('d M Y H:i:s', strtotime($user->created_date))?></td>
                                    
                                     <!--<td><a href="javascript:void(0)" onclick="openFancyBox('<?php echo base_url('admin/user/deal_details/'.$user->id)?>');" title="View Content">
                                        <img src="<?php echo base_url('themes/admin/images/preview.png');?>" width="16"/>
                                        </a>
                                    </td> -->
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

