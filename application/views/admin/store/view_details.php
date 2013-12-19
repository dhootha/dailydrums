<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Admin</title>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="RAHUL" >
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('themes/admin/css/stylesheet.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('themes/admin/css/admin_theme.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('themes/front/css/base.css'); ?>">
        
            <style type="text/css">
                .pagetitle{ background: #fafafa; padding:5px; font-size:13px; color:#444; padding: 0 5px}
                .pagetitle h2,.page-content1 span {display: inline-block; font-size: 16px; color:#333; width: 20%; font-weight: normal; margin: 0 }
                .page-content1 { padding: 5px;margin-top: 2px}
                .page-content1  { display: inline-block; width: 97%; vertical-align: top; max-height: 420px; overflow: auto; background: transparent; }
                .page-content1 img { display: inline-block; float:left; margin: 0 5px 5px 0}
                .table_content_table{
						background-color: #eee;
						border: 1px solid #ccc;  
						width:100%;                
                }
                .table_content_table tr td{
						padding: 3px 15px;
						border:1px solid #ccc;      
                }
                .table_content_table tr td{
						padding: 3px 15px;
						border:1px solid #ccc; 
						   
                }
                tr:nth-child(2n+1) {
					  background-color: #fff;  
					}
					tr:nth-child(odd) {
					  background-color: #fff;  
					}
            </style>
        
    </head>
 
    <body> 
        
        <!-- <div class="pagetitle"><h2>User Name</h2>   <?= $user->firstname." ".$user->lastname;?></div> -->
        <div class="page-content1"><span>Store Details</span>  
        <hr>
        
				<table border="0" cellpadding="0" cellspacing="0" class="table_content_table">
					<tr>
						<td width="200">User:</td>
						<td> <?= $store->display_name;?></td>					
					</tr>
					
					<tr>
						<td>Store Name :</td>
						<td> <?= $store->store_name;?></td>					
					</tr>	
					<tr>
                      <td> Address Line1 :</td>
                      <td> <?= $store->address1;?></td>					
              </tr>	
              <tr>
                      <td> Address Line2 :</td>
                      <td> <?= $store->address2;?></td>					
              </tr>	
              <tr>
                      <td> Street :</td>
                      <td> <?= $store->street;?></td>					
              </tr>
              <tr>
                      <td> City :</td>
                      <td> <?= $store->city_name;?></td>					
              </tr>
              <tr>
                      <td> State :</td>
                      <td> <?= $store->state;?></td>					
              </tr>
              <tr>
                      <td> Zip :</td>
                      <td> <?= $store->zip_val;?></td>					
              </tr>
              <tr>
                      <td> Phone :</td>
                      <td> <?= $store->phone;?></td>					
              </tr>
              <tr>
                      <td> Website :</td>
                      <td> <?= $store->website;?></td>					
              </tr>
						
					
					<tr>
						<td>Logo : </td>
						<td><?php if($store->logo){?>
								<img src="<?= base_url().'uploads/store_images/thumb/'.$store->logo;?>" alt="">
								<?php }else echo "No Image"; ?>
						</td>					
					</tr>	
					                
               <tr>
                      <td> Chosen tag word(s) :</td>
                      <td> <?= $store->tag_words;?></td>					
              </tr>
             
               					
					<tr>
						<td>Created Date :</td>
						<td><?= $store->created_date;?></td>					
					</tr>	
					

				</table>            
           
        </div>
        
    </body>
</html>

<!--

-->