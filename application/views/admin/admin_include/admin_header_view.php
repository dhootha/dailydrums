<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <title>Welcome to Daily Drums Adminstrator Pannel</title>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="RAHUL" >
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('themes/admin/css/stylesheet.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('themes/admin/css/admin_theme.css'); ?>">
        <!--<script src="<?php echo base_url('themes/front/js/jquery.min.js'); ?>" type="text/javascript"></script>-->
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('themes/thirdparty_js/fancybox/fancybox/jquery.fancybox-1.3.4.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('themes/thirdparty_js/fancybox/fancybox/jquery.easing-1.3.pack.js'); ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url('themes/thirdparty_js/fancybox/fancybox/jquery.fancybox-1.3.4.css'); ?>" type="text/css" media="screen" />
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> <!-- // for date picker -->
        <link rel="stylesheet" href="<?=base_url('themes/thirdparty_js/jquery_ui_datepicker/jquery-ui.css');?>" /> <!--  // for date picker -->
        <!-- ----- Datepicker code  -->
        
        <script>
		   //$.noConflict();
		   /* $(function() {
		        $("#dob").datepicker({
		            changeMonth: true,
		            yearRange: '1950:2000',
		            //defaultDate: new Date(1985, 00, 01),
		            defaultDate: new Date(),
		            showButtonPanel: true,
		            dateFormat: 'dd-mm-yy',
		            changeYear: true
		        });
		    });*/
		
		</script>
        
        <!-- ----- Datepicker code  -->

        
        <!-- Demo page code -->

        <style type="text/css">
            #line-chart {
                height:300px;
                width:800px;
                margin: 0px auto;
                margin-top: 1em;
            }
            .brand { font-family: georgia, serif; }
            .brand .first {
                color: #ccc;
                font-style: italic;
            }
            .brand .second {
                color: #fff;
                font-weight: bold;
            }
        </style>

 
    </head>

    
    <body class=""> 
      

        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav pull-right">
                   
                    <li><a href="<?php echo base_url();?>" target="_blank" class="hidden-phone visible-tablet visible-desktop" role="button">View Site</a></li>
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                             <?php 
                             $loggedin_data = $this->session->userdata('admin');
                             echo ($loggedin_data['admin_display_name']=='') ? 'Admin User' : $loggedin_data['admin_display_name'];
                             ?>                            
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="<?php echo base_url('admin/welcome/my_account');?>">My Account</a></li>
                            <li class="divider"></li>
                            <!--<li><a tabindex="-1" class="visible-phone" href="#">Settings</a></li>-->
                            <li class="divider visible-phone"></li>
                            <li><a tabindex="-1" href="<?php echo base_url('admin/welcome/logout');?>">Logout</a></li>
                        </ul>
                    </li>

                </ul>
                <a class="brand" href="<?php echo base_url('admin')?>"><span class="first">Daily Drums</span> <span class="second">Administrator Pannel</span></a>
            </div>
        </div>
        
        <script>
        function openFancyBox(hrefPage) {
            
            $.fancybox({
               'autoScale'      : true,
               'transitionIn'   : 'elastic',
               'transitionOut'  : 'elastic',
               'speedIn'        : 100,
               'speedOut'       : 200,
               'type'           : 'iframe',
                'scrolling'     : 'no',
               'width'          : 710 ,
               'height'         : 450 ,
               'href'           : hrefPage
            });
          }
          
          
          /**
           * Common function used for delete
           * @param {type} deleteURL 
           * @returns {Boolean}
           */
          function confirm_delete(deleteURL){
              var ans  = confirm('Are you sure to delete the record ?');
              if(ans){
                  window.location.href=deleteURL;                  
              }
              else{
                  return false;
              }
          }
        </script>
