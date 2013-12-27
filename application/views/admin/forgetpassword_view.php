<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
    <head>
        <meta charset="utf-8">
            <title>Admin</title>
            <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta name="description" content="">
                        <meta name="author" content="">
                            <link rel="stylesheet" type="text/css" href="<?php echo base_url('themes/admin/css/stylesheet.css'); ?>">
                                <link rel="stylesheet" type="text/css" href="<?php echo base_url('themes/admin/css/admin_theme.css'); ?>">
                                    <script src="<?php echo base_url('themes/front/js/jquery.min.js'); ?>" type="text/javascript"></script>

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

                                        .adm-login-container{
                                            padding:20px;

                                        }

                                        .loginbox{
                                            background:#f7f7f7;
                                            border:1px solid #e5e5e5;
                                            padding:60px 5px 5px 15px;
                                            width:500px;
                                            height:280px;
                                            margin-top:5%;
                                            text-align:left;

                                        }
                                    </style>

                                    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
                                    <!--[if lt IE 9]>
                                      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                                    <![endif]-->
                                    </head>

                                    <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
                                    <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
                                    <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
                                    <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
                                    <!--[if (gt IE 9)|!(IE)]><!--> 
                                    <body class=""> 
                                        <!--<![endif]-->

                                        <div align="center" class="adm-login-container">
                                            <div class="loginbox">                               		
                                                <form name="frmLogin" action="<?php echo base_url('admin/welcome/forgetpassword') ?>" method="post">
                                                    <div align="center" style="color:red;"><?php echo $this->session->flashdata('login_error'); ?></div>
                                              <table width="100%" cellpadding="2" cellspacing="2" border="0">

                                                        <tr><td colspan="3"><h4>Forget Password </h4> </td></tr>

                                                        <tr>
                                                            <td colspan="3" align="center">Give your login name for get the new password.</td>
                                                        </tr>
														 <tr>
                                                            <td colspan="3" align="center">&nbsp;</td>
                                                        </tr>


                                                        <tr>
                                                            <td width="5%">&nbsp;</td>
                                                            <td width="35%" align="left" valign="top"><label>Login Name: </label></td>
                                                            <td width="60%" align="left" valign="top">
                                                                <input type="text" id="username" name="username"  value="<?php echo set_value('username'); ?>" placeholder="Your login user name" />
                                                                <?php
                                                                $userNameError = form_error('username');
                                                                if (isset($userNameError)) {
                                                                    echo '<div style="font-size:11px; color:red;">' . $userNameError . '</div>';
                                                                }
                                                                ?>                                                            </td>
                                                        </tr>

                                                        
                                                        
                                                        <tr><td colspan="3"></td></tr>

                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                          <td align="left">
                                                                <input type="submit" id="submit" value="Submit" /></td>
                                                            <td align="left"></td>
                                                        </tr>
                                                    </table>
                                                </form>                 
                                            </div>
                                        </div>

                                    </body>

                                    </html>