<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>dailydrums</title>
	<meta name="description" content="">
	<meta name="author" content="RAHUL" >

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
  	<link href='http://fonts.googleapis.com/css?family=Istok+Web' rel='stylesheet' type='text/css'>
  	<link href='http://fonts.googleapis.com/css?family=Raleway:400,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Economica' rel='stylesheet' type='text/css'>
	<link href="<?=base_url('themes/front/css/bootstrap.css');?>" rel="stylesheet">
    <link href="<?=base_url('themes/front/css/base.css');?>" rel="stylesheet">
    <link href="<?=base_url('themes/front/css/bootstrap-responsive.css');?>" rel="stylesheet">
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?=base_url('themes/front/images/favicon.ico');?>">
	<link rel="apple-touch-icon" href="<?=base_url('themes/front/images/apple-touch-icon.png');?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?=base_url('themes/front/images/apple-touch-icon-72x72.png');?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?=base_url('themes/front/images/apple-touch-icon-114x114.png');?>">
	
	<link rel="stylesheet" type="text/css" href="<?=base_url('themes/front/css/jqtransform.css');?>" />
	 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
   <script type="text/javascript" src="<?=base_url('themes/front/js/jquery.jqtransform.js');?>"></script>
   <script type="text/javascript" src="<?=base_url('themes/front/js/public.js');?>"></script>
   

</head>
<body class="page">

<!--Start Header-->
        <div class="header row-fluid">
        	<div class="container-fluid">
                <h1 class="span3 logo"><a href="<?=base_url('welcome/main');?>" title="dailydrums"><img src="<?=base_url('images/logo.png');?>" alt=""></a></h1>
                <div class="span7 header_right offset2">
                    <div class="top_login">
                    	<div class="row-fluid">
                    	<form name="login" action="<?=base_url('user/login');?>" method="post">
                        	<div class="span5">
                        	
                            	<span class="form_label">Email</span>
                                <input type="text" name="daily_drums_user_id" id="daily_drums_user_id" value="" class="inputbox">
                            </div>
                            <div class="span5">
                            	<span class="form_label">Password <!--<a class="font11 red" href="#">Forgot your password?</a>--></span>
                                <input type="password" name="daily_drums_password" id="daily_drums_password" value="" class="inputbox">
                            </div>
                            <div class="span2">
                                <span class="form_label">&nbsp;</span>
                                <input type="submit" value="Sign In" class="singin_btn">
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
                <div class="clr"></div>
            </div>
        </div>
        <!--End Header-->

<!--Start Content-->
<div class="container-fluid"><div class="beat_img">BEAT OUT THE BEST<br>
DEALS
AND EVENTS!</div></div>
        <div class="landing_banner">
        	<div class="join_form">
            	<div class="container-fluid">
                	
                    <div class="row-fluid">
                        <div class="span5 offset7">
                        	<h2 class="title">Join now - it’s free.</h2>
                            <div class="content">
                            
                            <form name="enduser_signup" action="<?=base_url('home/signup');?>" method="post">
                            	<div class="error_message"><?=$this->session->flashdata( 'action_msg');?></div>
                            	<div class="row-fluid">
                                	<div class="span6"><span class="error_message"><?=form_error('first_name');?></span><input type="text" name="first_name" id="first_name" class="inputbox" placeholder="First Name" value="<?=$this->session->flashdata( 'first_name');?>" ></div>
                                    <div class="span6"><span class="error_message"><?=form_error('last_name');?></span><input type="text" name="last_name" id="last_name" class="inputbox" placeholder="Last Name" value="<?=$this->session->flashdata( 'last_name');?>" ></div>
                                    <div class="clr"></div>
                                </div>
                                <div class="row-fluid">
                                	<div class="span12"><span class="error_message"><?=form_error('display_name');?></span><input type="text" class="inputbox" name="display_name" id="display_name" value="<?=$this->session->flashdata('display_name');?>" placeholder="Choose your User Name to appear on comments"></div>
                                    <div class="clr"></div>
                                </div>
                                <div class="row-fluid">
                                	<div class="span6"><span class="error_message"><?=form_error('email');?></span><input type="text" class="inputbox" name="email" id="email" value="<?=$this->session->flashdata('email');?>"  placeholder="Your Email"></div>
                                    <div class="span6"><span class="error_message"><?=form_error('retype_email');?></span><input type="text" class="inputbox" name="retype_email" id="retype_email" value="<?=$this->session->flashdata('retype_email');?>" placeholder="Re-enter Email"></div>
                                    <div class="clr"></div>
                                </div>
                                <div class="row-fluid">
                                	<div class="span6"><span class="error_message"><?=form_error('password');?></span><input type="password" class="inputbox" name="password" id="password" value="<?=$this->session->flashdata('password');?>" placeholder="Password"></div>
                                    <div class="span6"><span class="error_message"><?=form_error('retype_password');?></span><input type="password" class="inputbox" name="retype_password" id="retype_password" value="<?=$this->session->flashdata('retype_password');?>" placeholder="Re-enter Password"></div>
                                    <div class="clr"></div>
                                </div>
                                <div class="row-fluid">
                                	<div class="span12"><span class="error_message"><?=form_error('zip');?></span><input type="text" name="zip" id="zip" value="<?=$this->session->flashdata('zip');?>" class="inputbox"  placeholder="Enter Zip Code to get best deals in your neighborhood"></div>
                                    <div class="clr"></div>
                                </div>
                                <div class="row-fluid">
                                	<div class="span12"><span class="error_message"><?=form_error('phone');?></span><input type="text" name="phone" id="phone" value="<?=$this->session->flashdata('phone');?>" class="inputbox" placeholder="Phone Number"></div>
                                    <div class="clr"></div>
                                </div>
                                <div class="row-fluid">
                                	<div class="span12"><span class="error_message"><?=form_error('gender');?></span>
                                    	<span class="radio_list"><input type="radio" name="gender" value="Male" checked="checked"> Male</span>
                                        <span class="radio_list"><input type="radio" name="gender" value="Female"> Female</span>
                                    </div>
                                    <div class="clr"></div>
                                </div>
                                <p>By Signing up, I agree to the terms and conditions of Daily Drums</p>
                                <p class="align-center"><input type="submit" value="SIGN UP" class="signup_btn"></p>
                                
                              </form>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        	<div class="slider">
            	<div class="img"><img src="<?=base_url('themes/front/images/home_img.jpg');?>" height="100%" alt=""></div>
            </div>
        </div>
        <!--End Content-->