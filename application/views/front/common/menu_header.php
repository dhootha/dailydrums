
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
  <!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script> -->
  <!--<script src="<?=base_url('themes/front/js/1.10.2-jquery-ui.js');?>"></script>  http://code.jquery.com/ui/1.10.2/jquery-ui.js -->
  <script src="<?=base_url('themes/front/js/jquerysdk1.4.js');?>"></script>
  
  <script type="text/javascript" src="<?=base_url('themes/front/js/jquery.jcarousel.min.js');?>"></script>
  
  <link rel="stylesheet" type="text/css" href="<?=base_url('themes/front/css/skin.css');?>" />
  
	<script  type="text/javascript" >
			$.noConflict();
			$(document).ready(function(){
							$( "#suggestionbox" ).autocomplete({
									source: "<?=base_url('welcome/location_suggestion');?>",
									change: function(){
													var value = $('#suggestionbox').val();
													setCookie('current_location',value,'1');
										}
									});
							var value = getCookie('current_location');
							
							if( value != '' && value != null ) {
									$('#local_area_text').html(value);
									//$('#change_loc_area_link').html(value);
								}
								else{
										$('#change_loc_area_link').html('Change Local Area');
									}
							
							$('#submit_loc_area').click(function(){
										if( $( "#suggestionbox" ).val() == '' ){
												alert('Please Select A Loaction');
												$( "#suggestionbox" ).focus();
												}
												else{
														//$('#change_loc_area_link').html($( "#suggestionbox" ).val());
														$('#local_area_text').html($( "#suggestionbox" ).val());
														$('.change_local_area_hover').toggle('slow');
														document.location='';
													}
								});
				});
				
		function setCookie(c_name,value,exdays) {
						var exdate=new Date();
						exdate.setDate(exdate.getDate() + exdays);
						var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
						document.cookie=c_name + "=" + c_value;
					}
					
		function getCookie(c_name) {
						var c_value = document.cookie;
						var c_start = c_value.indexOf(" " + c_name + "=");
						if (c_start == -1) {
						  c_start = c_value.indexOf(c_name + "=");
						  }
						if (c_start == -1) {
						  c_value = null;
						  }
						else {
							  c_start = c_value.indexOf("=", c_start) + 1;
							  var c_end = c_value.indexOf(";", c_start);
							  if (c_end == -1) {
									c_end = c_value.length;
									}
								c_value = unescape(c_value.substring(c_start,c_end));
							}
						return c_value;
				}


	function dropdown() { 
			
			//$('#area_form').css('display','block');
			//$('#area_msg').css('display','none');
			/*request = $.ajax({
									      type: 'post',
									      url: "<?=base_url('user/fetch_country_list')?>",
									      data: '',
										dataType:'json'
									 	 });
			request.done(function(response,status) {
				
												$('#country').html(response);
												
												
				
			});*/
		
			$('.change_local_area_hover').toggle('slow');	
		}
		
		
		
	jQuery.easing['BounceEaseOut'] = function(p, t, b, c, d) {
			if ((t/=d) < (1/2.75)) {
				return c*(7.5625*t*t) + b;
			} else if (t < (2/2.75)) {
				return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
			} else if (t < (2.5/2.75)) {
				return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
			} else {
				return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
			}
		};
		
		jQuery(document).ready(function() {
		    jQuery('#mycarousel').jcarousel({
		    	//easing: 'BounceEaseOut',
		    	wrap: 'circular',
		    	scroll: 5,
		    	start: 0,
		      animation: 2000,
		      vertical: false,
		      visible: 5,
		      //size:5  //repeats
		    });
		});

	
</script>

<?php if( $this->user_type != 'business_basic' && $this->user_type != 'business_pro' ) { ?> <!-- to show only for end user -->

<!-- Statrt Menu Header -->

<?php $category_details = $this->Common_model->fetch_category(); ?>
<div class="menu row-fluid">
        	<div class="container-fluid">
            <ul>
                <li class="menu_local main_popup_li">
                    <h4>DRUM BEATS</h4>
                    <div class="floatleft" id="local_area_text"><?=isset($this->local_area)?$this->local_area:''?></div>
                    <div class="floatright change_local_area">
									<?php if( isset($this->local_area) && $this->local_area != '' ){ ?>
						                    	<a class="menu_local_submenu" id="change_loc_area_link" onclick="dropdown();"  >Change Local Area</a>
														
									<?php } ?>
									
										<div class="change_local_area_hover" id="change_area">
											<!--<h2 class="title blue">Change Local Area</h2>-->
											<div class="content_form" id="area_form">	
											
												<div class="form_div">
													<div class="form_div_text">City / Zip :</div>
													<div class="form_div_area">
														<input type="text" id="suggestionbox" name="suggestionbox">
													</div>
													<div class="blue_btn_div"><a href="#" class="blue_btn2" id="submit_loc_area">Ok</a></div>
												</div>
												
											</div>
											
										</div>
						            <ul>
						                <li></li>
						            </ul>
                    </div>
                </li>
                <li class="menu_main_content">
	                <ol id="mycarousel" class="jcarousel-skin-tango">
	                
	                		<?php  foreach( $category_details as $category ) {?>
							     <li class="class_li_div">
											<a href="<?=base_url('welcome/deals/category').'/'.$category->category_slug;?>">
			                    		<span class="icon"><img src="<?=($category->category_logo)?base_url($this->config->item('category_image')).'/'.$category->category_logo:base_url('themes/front/css/next-horizontal.png');?>" alt=""></span>
			                    		<span><?=$category->category_name;?></span>
			                    		</a>						     
							     </li>
							     <?php } ?>
							     <!--
							     <li class="class_li_div">
										<a href="<?=base_url('welcome/deals/category/id/40');?>">
									  	<span class="icon"><img src="<?=base_url('themes/front/images/restaurent_icon.png');?>" alt=""></span>
									  	<span>Restaurants</span>
									  </a>						     
							     </li>
							     <li class="class_li_div">
											<a href="<?=base_url('welcome/deals/category/id/41');?>">
										  	<span class="icon"><img src="<?=base_url('themes/front/images/ele_icon.png');?>" alt=""></span>
										  	<span>Electronics &amp; Computers</span>
										  </a>						     
							     </li>
							     <li class="class_li_div">
											<a href="<?=base_url('welcome/deals/category/id/42');?>">
										  	<span class="icon"><img src="<?=base_url('themes/front/images/hotels_icon.png');?>" alt=""></span>
										  	<span>Hotels &amp; Travel</span>
										  </a>							     
							     </li>
							     <li class="class_li_div">
										<a href="<?=base_url('welcome/deals/category/id/43');?>">
			                    	<span class="icon"><img src="<?=base_url('themes/front/images/beauty_icon.png');?>" alt=""></span>
			                    	<span>Beauty &amp; Spa</span>
			                    </a>						     
							     </li> 
							     <li class="class_li_div">
										<a href="<?=base_url('welcome/deals/category/id/43');?>">
			                    	<span class="icon"><img src="<?=base_url('themes/front/images/beauty_icon.png');?>" alt=""></span>
			                    	<span>Beauty &amp; Spa 1</span>
			                    </a>						     
							     </li>
							     <li class="class_li_div">
										<a href="<?=base_url('welcome/deals/category/id/43');?>">
			                    	<span class="icon"><img src="<?=base_url('themes/front/images/beauty_icon.png');?>" alt=""></span>
			                    	<span>Beauty &amp; Spa 2</span>
			                    </a>						     
							     </li>
							     <li class="class_li_div">
										<a href="<?=base_url('welcome/deals/category/id/43');?>">
			                    	<span class="icon"><img src="<?=base_url('themes/front/images/beauty_icon.png');?>" alt=""></span>
			                    	<span>Beauty &amp; Spa 3</span>
			                    </a>						     
							     </li>
							     <li class="class_li_div">
										<a href="<?=base_url('welcome/deals/category/id/43');?>">
			                    	<span class="icon"><img src="<?=base_url('themes/front/images/beauty_icon.png');?>" alt=""></span>
			                    	<span>Beauty &amp; Spa 4</span>
			                    </a>						     
							     </li>
							     <li class="class_li_div">
										<a href="<?=base_url('welcome/deals/category/id/43');?>">
			                    	<span class="icon"><img src="<?=base_url('themes/front/images/beauty_icon.png');?>" alt=""></span>
			                    	<span>Beauty &amp; Spa 5</span>
			                    </a>						     
							     </li>       -->   
	                </ol>
                </li>
                
                <!--<li class="menu_item first">
                    <a href="<?=base_url('welcome/deals/category/id/39');?>">
                    	<span class="icon"><img src="<?=base_url('themes/front/images/shopping_icon.png');?>" alt=""></span>
                    	<span>Shopping</span>
                    </a>
                </li>
                <li class="menu_item">
						 	<a href="<?=base_url('welcome/deals/category/id/40');?>">
						  	<span class="icon"><img src="<?=base_url('themes/front/images/restaurent_icon.png');?>" alt=""></span>
						  	<span>Restaurants</span>
						  </a>
                </li>
                <li class="menu_item">
                	<a href="<?=base_url('welcome/deals/category/id/41');?>">
                    	<span class="icon"><img src="<?=base_url('themes/front/images/ele_icon.png');?>" alt=""></span>
                    	<span>Electronics &amp; Computers</span>
                    </a>
                </li>
                <li class="menu_item">
                    <a href="<?=base_url('welcome/deals/category/id/42');?>">
                    	<span class="icon"><img src="<?=base_url('themes/front/images/hotels_icon.png');?>" alt=""></span>
                    	<span>Hotels &amp; Travel</span>
                    </a>
                </li>
                <li class="menu_item">
                	<a href="<?=base_url('welcome/deals/category/id/43');?>">
                    	<span class="icon"><img src="<?=base_url('themes/front/images/beauty_icon.png');?>" alt=""></span>
                    	<span>Beauty &amp; Spa</span>
                    </a>
                </li>
                <li class="menu_item jcarousel-next jcarousel-next-horizontal" >
                	<a href="#">
                    	<span class="icon"><img src="<?=base_url('themes/front/images/more_icon.png');?>" alt=""></span>
                    	<span>More</span>
                    </a>
                </li>-->
            </ul>
            </div>
        </div>
        <!--End Menu Header-->
        
 <?php } ?>
