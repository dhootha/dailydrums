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
    <!-- <link href="<?=base_url('themes/front/css/pagination_style.css');?>" rel="stylesheet"> -->
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
	 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	 <script type="text/javascript" src="<?=base_url('themes/front/js/jquery.pages.js');?>"></script><!-- For pagination -->
   <script type="text/javascript" src="<?=base_url('themes/front/js/jquery.jqtransform.js');?>"></script>
   <script type="text/javascript" src="<?=base_url('themes/front/js/public.js');?>"></script>
   
   <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> <!-- for date picker -->
   <link rel="stylesheet" href="<?=base_url('themes/thirdparty_js/jquery_ui_datepicker/jquery-ui.css');?>" /> <!--// for date picker -->
        <!--// ----- Datepicker code -->
        
        <script>
		   /*//$.noConflict();
		    $(function() {
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
       <!--// ----- Datepicker code -->
   

</head>
<body class="page">
	
    <?php $display_name = ($this->is_logged_in['user_id'])?"Welcome ".$this->is_logged_in['display_name']:'&nbsp;'; ?>

	<?php $this->load->view('front/common/search_header');?>
		
<!--Start Header-->
        <div class="header row-fluid">
        	<div class="container-fluid">
                <h1 class="span3 logo"><a href="<?=base_url('welcome/main');?>" title="dailydrums"><img src="<?=base_url('themes/front/images/logo.png');?>" alt=""></a></h1>
                
           <?php if(($this->is_logged_in['user_type'] == 'end_user') || $this->is_logged_in['user_id'] == ''){ ?>
          	  <!-- ############# Search part is for end user only ############ --> 
                	    
					                <div class="span9 header_right">
					                		<p class="align-right red spi">
					                		<?php if( $this->user_type == 'end_user' ) { echo $display_name; } else echo "&nbsp;";/* else{ echo "<p class='align-right red spi'><a class='red spi' href='".base_url('user')."'>LOGIN</a></p>"; }*/ ?>
					                    </p>
					                    <div class="search_main">
					                        <div class="categories">
					                            <a href="#" class="dropdown">Categories</a>
					                            
					                        </div>
					                        <?php $search_val = ($this->uri->segment(3) == 'search')?$this->uri->segment(4):'';?>
					                        <input type="text" name="search" id="search" value="<?=$search_val;?>" class="inputbox">
					                        <input type="button" value="Search" id="search_button" name="search_button" class="search_btn">
					                    </div>
					                </div>
					                
				                 <div class="clr"></div>
				                  <div class="category_dropdown">
				                    <div class="row-fluid">
				                    
				                    
				                    <div class="span2">
				                            <ul class="bullet2">
				                    <?php 
													$category_details = $this->Common_model->fetch_category();                    
				                    if( $category_details ) {
				                    	
				                    			 $per_clmn = ( (count($category_details) % 3) == 0 )?(count($category_details) / 3):intval((count($category_details) / 3)+1);
					                    			$i = 1; 
					                    			foreach( $category_details as $category ) 
					                    				{
					                    				 if($i > $per_clmn) { $i = 1; ?>
						                    		
								                    		</ul>
								                        </div>
								                        <div class="span2">
							                           <ul class="bullet2">
						                    		<?php } ?>
						                    				
						                    				<li><a href="<?=base_url('welcome/deals/category').'/'.$category->category_slug;?>"><?=$category->category_name;?></a></li>
						             			<?php 
						             				$i++;	
						             				} }
								             			else{
								             					echo "No Category Found...";
								             				}
						             			?>
				                    			</ul>
						                        </div>
				                        <div class="span6">
				                            <div class="menu_details">
				                            	<h2 class="title blue">Restaurants & Foods</h2>
				                                <div class="img"><img width="100%" src="<?=base_url('themes/front/images/menu_item1.jpg');?>" alt=""></div>
				                                <!-- <p class="gray">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the ...</p> -->
				                            </div>
				                        </div>
				                    </div>
				                </div>
										<script type="text/javascript" >
										
												$(document).ready(function(){
													
														var srch_val = $('#search').val();
														$('#search').val(srch_val.replace('%20',' '));  // To remove %20 for first time
														
														$('#search_button').click(function(){ 			 // To submit for search
																var val = $('#search').val();
																document.location = "<?=base_url('welcome/deals/search').'/';?>"+val.trim();
																});
														$('#search').keyup(function(){ 						// To replace non alphanumeric charecter to space
																var val = $('#search').val();
																val = val.replace(/[`~!@#$%^&*()|+\_\s=?;:'",.<>\{\}\[\]\\\/]/gi, ' ').replace( /\s+/g, ' ' );
										    					$('#search').val(val);
																});
																
														$('.category_dropdown').mouseleave(function(){
																		    $(".category_dropdown").hide();
																		  });
														
														$('.categories').click(function(){
																		    $(".category_dropdown").toggle();
																		  });
													});
										</script>                
           <!-- ############# Search part is for end user only ############ -->          
         <?php } ?>
         
            </div>
        </div>
  <!-- End Header -->
       

