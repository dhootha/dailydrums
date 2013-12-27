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
        <div class="page-content1"><span>User Details</span>  
        <hr>

				<table border="0" cellpadding="0" cellspacing="0" class="table_content_table">
					<tr>
						<td width="200">User Name :</td>
						<td> <?= $user->firstname." ".$user->lastname;?></td>					
					</tr>
					<tr>
						<td>Email :</td>
						<td> <?= $user->email;?></td>					
					</tr>
					<tr>
						<td>Type :</td>
						<td> <?= $user->user_type;?></td>					
					</tr>	
					<tr>
						<td>Address Line 1 :</td>
						<td><?= strip_slashes($user->address_one);?></td>					
					</tr>	
					<tr>
						<td>Address Line 2 : </td>
						<td><?= strip_slashes($user->address_two);?></td>					
					</tr>	
					<tr>
						<td>City :</td>
						<td> <?= strip_slashes($user->city);?></td>					
					</tr>	
					<tr>
						<td> State :</td>
						<td> <?= strip_slashes($user->state);?></td>					
					</tr>	
					<tr>
						<td>Country : </td>
						<td><?= strip_slashes($user->country_name);?></td>					
					</tr>	
					<tr>
						<td>Legal Name : </td>
						<td><?= strip_slashes($user->legal_name);?></td>					
					</tr>	
					<tr>
						<td>Business Email : </td>
						<td><?= strip_slashes($user->business_email);?></td>					
					</tr>	
					
					<tr>
						<td>Display Name :</td>
						<td> <?= strip_slashes($user->display_name);?></td>					
					</tr>	
					<tr>
						<td>Primary Phone : </td>
						<td><?= strip_slashes($user->primary_phone);?></td>					
					</tr>	
					<tr>
						<td>Card Name : </td>
						<td><?= strip_slashes($user->card_name);?></td>					
					</tr>	
					<tr>
						<td>Credit Card Number : </td>
						<td><?= strip_slashes($user->cc_number);?></td>					
					</tr>	
					
					<tr>
						<td>Security code :</td>
						<td> <?= strip_slashes($user->security_code);?></td>					
					</tr>	
					<tr>
						<td>Status : </td>
						<td><?= ($user->status == '1')?"Active":"Inactive";?></td>					
					</tr>	
					<tr>
						<td>Created Date :</td>
						<td><?= $user->created_date;?></td>					
					</tr>	
					<tr>
						<td>Last Login :</td>
						<td><?= $user->login_time;?></td>					
					</tr>	
					<tr>
						<td>Last Logout :</td>
						<td><?= $user->logout_time;?></td>					
					</tr>	

				</table>            
           
        </div>
        
    </body>
</html>

<!--

-->