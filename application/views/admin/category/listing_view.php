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
                <div class="btn-toolbar">
                    <button class="btn btn-primary" onclick="window.location.href='<?php echo base_url('admin/category/add_page');?>'"><strong>+</strong> New Category </button>
                    <div class="btn-group">
                    </div>                    
                </div>
                <table class="table bordered">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Created On</th>
                            <th>Status</th>
                            <th style="width: 76px;">Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>     
                        <?php
                        if(isset($categoriesRS) && $categoriesRS!=false){
                            
                            foreach($categoriesRS as $category){ ?>
                                
                                <tr>
                                    <td><?php echo stripslashes($category->category_name);?></td>
                                    <td><?php echo stripslashes($category->category_slug);?></td>
                                    <td><?php echo $category->created_date?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/category/change_status/category/id/'.$category->category_id)?>">
                                        <img src="<?php echo base_url('themes/admin/images/'. $this->Common_model->show_status($category->category_status) );?>" alt="<?php echo $category->category_status;?>"/>
                                        </a>
                                    </td>
                                    <td>
<!--                                        <a class="viewpane" href="<?php echo base_url('admin/static_pages/view/page/id/'.$pages->page_id)?>" title="View Content">-->
                                       <!-- <a href="javascript:void(0)" onclick="openFancyBox('<?php echo base_url('admin/category/view/page/id/'.$category->category_id)?>');" title="View Content">
                                        
                                            <img src="<?php echo base_url('themes/admin/images/preview.png');?>" width="16"/>
                                        </a> 
                                        |-->
                                        <a href="<?php echo base_url('admin/category/edit_category/category/id/'.$category->category_id)?>" title="Edit Content">
                                            <img src="<?php echo base_url('themes/admin/images/pencil.png');?>" width="16"/>
                                        </a>
                                        |
                                        <a href="javascript:void(0);" role="button" title="Delete Content" onclick="confirm_delete('<?php echo base_url('admin/category/delete/category/id/'.$category->category_id);?>')">
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

