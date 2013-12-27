<!-- <script type="text/javascript" src="<?=base_url('themes/thirdparty_js/highcharts-js/jquery.min.js');?>"> </script> -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="<?=base_url('themes/thirdparty_js/highcharts-js/highcharts.js');?>"></script>
<script src="<?=base_url('themes/thirdparty_js/highcharts-js/modules/exporting.js');?>"></script>

<!--Start Content-->
        <div class="container-fluid">
            <div class="main_container">
                <div class="row-fluid">
                
                <div class="span9 main_content">
                    <h2 class="title">Analytic</h2>
                    <div class="contact_form campaign_form">
                    	<div class="block">
                            <h2 class="title"><span id="selected_tab_header">Metrics and Analytics</span> : <span id="selected_store_header">Loding...</span></h2>
																		
									<!-- Action Message Section Start-->
									<?php if( $this->session->flashdata( 'action_msg' ) ){?>
									 <div class="row-fluid">
                            	<div class="span3 form_label">&nbsp;</div>
                                	<div class="span4"><div class="<?=($this->session->flashdata('action') == '0')?'error_message':'success_message1';?>" id="action_msg"><?=$this->session->flashdata('action_msg');?>&nbsp;</div></div>
                                <div class="clr"></div>
                            </div>    
                            <?php } ?>
                            <!-- Action Message Section End-->   
                            
                                                 
                            <div class="row-fluid">
                            	<div class="span3">
                            		<?php if($stores){ 
                            						$store_actv_flag     = '0';
											if($type_of_analytics == 'deal'){
														$selected_store_name = $stores[0]->business_name;
												}else{
                            									$selected_store_name = $stores[0]->store_name;
														}
                            		?>
                            			<ul class="links links1">
									<?php foreach($stores as $store){ 
												if($type_of_analytics == 'deal'){ ?>
											<li <?php if($requested_store_id == $store->id) { $selected_store_name = $store->business_name; echo "class=active"; } ?> ><a href="<?=base_url('user/analytics/deal/'.$store->id.'/'.$analytic_type)?>"><?=$store->business_name;?></a></li>
                            				<?php } else{  ?>
                            						<li <?php if($requested_store_id == $store->store_id) { $selected_store_name = $store->store_name; echo "class=active"; } ?> ><a href="<?=base_url('user/analytics/store/'.$store->store_id.'/'.$analytic_type)?>"><?=$store->store_name;?></a></li>
                            				<?php } } ?>
                                    </ul>
                            		<?php } else{ echo "No Stores found";}?>
                                	<input type="hidden" id="selected_store_name" value="<?=$selected_store_name;?>">
                               </div>
                                
                                <div class="span9">
                                    <ul class="tab">
                                       <!-- <li id="active_subscriber_tab" <?php if($selected_tab == 'a') echo "class='active'"; ?> ><a href="#">Metrics</a></li> -->
                                        <li id="pending_subscriber_tab" <?php if($selected_tab == 'p') echo "class='active'"; ?> ><a href="#">Analytics</a></li>
                                    </ul>
                                    <div class="clr"></div>
                                    
                                    
                                    <!-- METRICS START  -->
                                    
                                    <div id="active_subscriber_container" <?php if($selected_tab == 'p') echo "style='display:none;'" ?> class="content_tab"> 
                                    	<h2 style='color:red;'>No active metrics found.</h2>
                                    </div> 
                                    <!-- METRICS END  -->
                                    
                                    <div class="clr"></div>

                                    <!-- ANALYTICS START  -->
                                    
                                    <div id="analytic_container"  <?php if($selected_tab == 'a') echo"style='display:none;'"; ?> class="content_tab">
								<div class="links2">
		                                   	<a <?php if($analytic_type == 'click') echo "class='blue'"; ?> href="<?=base_url('user/analytics/store/'.$requested_store_id.'/click')?>">User Click Rate</a>
										   <span class="space">|</span>   
										<a <?php if($analytic_type == 'visit') echo "class='blue'"; ?> href="<?=base_url('user/analytics/store/'.$requested_store_id.'/visit')?>">Page Visits</a>
										   <span  class="space">|</span>   
										<a <?php if($analytic_type == 'campaign') echo "class='blue'"; ?> href="<?=base_url('user/analytics/store/'.$requested_store_id.'/campaign')?>">Campaign Wise</a>
                                        </div>
								<?php if($analytic_type == 'click'){?>
											<script type="text/javascript">
												<?php if($click_rate_months) { ?>
															$(document).ready(function(){   // monthly click rate
																		$('#container').highcharts({
																	  title: {
																		 text: '<b>Monthly</b>',
																		 x: -20 //center
																	  },
																	  subtitle: {
																		 text: '',
																		 x: -20
																	  },
																	  xAxis: {
																		<?php 
																				 $months = '';
																				 $tot_click = '';
																				 if(!empty($click_rate_months)){
																						foreach($click_rate_months as $month){ $months[] = "'".$month['months']."'"; $tot_click[] = $month['tot_click']; }
																						$months = implode(',',$months);
																						$tot_click = implode(',',$tot_click);
																						}
																		?>
																		 categories: [<?=$months;?>]
																	  },
																	  yAxis: {
																		 title: {
																			text: ''
																		 },
																		  min: -1,
																		  minPadding: 100,
																		  startOnTick: false,

																		 plotLines: [{
																			value: 0,
																			width: 1,
																			color: '#808080'
																		 }]
																	  },
																	  tooltip: {
																		 valueSuffix: 'clicks'
																		
																	  },
																	  legend: {
																		 layout: 'vertical',
																		 align: 'right',
																		 verticalAlign: 'middle',
																		 borderWidth: 0
																	  },
																	 navigation: {
																		  buttonOptions: {
																			 enabled: false
																		  }
																	   },
																	  series: [ {
																		 name: '<?=$selected_store_name;?>',
																		 data: [<?=$tot_click;?>]
																	  }]
																   });
															});
												<?php } 
												           if($click_rate_weeks) { ?>
		
															$(function () {
																   $('#container_week').highcharts({  // weekly click rate
																	  title: {
																		 text: '<b>Weekly</b>',
																		 x: 1 //center
																	  },
																	  subtitle: {
																		 text: '',
																		 x: 0
																	  },
																	  xAxis: {
																		<?php 
																				 $dates = '';
																				 $tot_click = '';
																				 if(!empty($click_rate_weeks)){
																						foreach($click_rate_weeks as $week){ $weeks[] = "'".$week['date']."'"; $tot_click[] = $week['tot_click']; }
																						$weeks = implode(',',$weeks);
																						$tot_click = implode(',',$tot_click);
																						}
																		?>
																		 categories: [<?=$weeks;?>]
																	  },
																	  yAxis: {
																		 title: {
																			text: ''
																		 },
																		  min: -1,
																		  minPadding: 100,
																		  startOnTick: false,
																		 plotLines: [{
																			value: 0,
																			width: 1,
																			color: '#808080'
																		 }]
																	  },
																	  tooltip: {
																		 valueSuffix: 'clicks'
																		 
																	  },
																	  legend: {
																		 layout: 'vertical',
																		 align: 'right',
																		 verticalAlign: 'middle',
																		 borderWidth: 0
																	  },
																	navigation: {
																		  buttonOptions: {
																			 enabled: false
																		  }
																	   },
																	colors: [
																			  '#8bbc21'
																		   ],
																	  series: [ {
																		 name: '<?=$selected_store_name;?>',
																		 data: [<?=$tot_click;?>]
																	  }]
																   });
															    });
														<?php } ?>
												</script>
											<?php if(!$click_rate_weeks) { ?>
													<div id="false_container_week" style="border:1px solid #ddd;  text-align:center; color:red; padding: 100px; min-width: 150px; height: 0px; ">No Clicks found.</div>
												<?php } else{?>
													<div id="container_week" style="border:1px solid #ddd; min-width: 150px; height: 300px; margin: 0 auto 15px;"></div>
											<?php } if(empty($click_rate_months)) { ?>
													<div id="false_container" style="border:1px solid #ddd;  text-align:center; color:red; padding: 100px; min-width: 150px; height: 0px; ">No Clicks found.</div>
												<?php } else{?>
													<div id="container" style="border:1px solid #ddd; min-width: 150px; height: 300px; margin: 0 auto 15px;"></div>
								<?php }  }
										   elseif($analytic_type == 'visit'){?>
														<script type="text/javascript">
																	<?php 
																			 $tot_click = array('clicks'=>'','views'=>'','url_nav'=>'','search'=>'');
																			
																				$day_list = array();
																				 if(!empty($clicks_rate_weeks))
																						foreach($clicks_rate_weeks as $week){ $day_list[] = "'".$week['date']."'"; }
																				if(!empty($views_rate_weeks))
																						foreach($views_rate_weeks as $week){ $day_list[] = "'".$week['date']."'"; }
																				if(!empty($search_rate_weeks))
																						foreach($search_rate_weeks as $week){ $day_list[] = "'".$week['date']."'";}
																				if(!empty($url_nav_rate_weeks))
																						foreach($url_nav_rate_weeks as $week){ $day_list[] = "'".$week['date']."'";}

																				 if(!empty($day_list)){
																						$day_list = array_unique($day_list);
																				

																						for($i=0;$i<count($day_list);$i++){

																								 if(!empty($clicks_rate_weeks)){
																									foreach($clicks_rate_weeks as $clicks_rate){
																											if($day_list[$i] == "'".$clicks_rate['date']."'") {
																														$tot_click['clicks'][$i] = $clicks_rate['tot_click'];  break;
																														}else{
																															    $tot_click['clicks'][$i] = '0'; 
																															    }
																										}
																									}
																								if(!empty($views_rate_weeks)){
																									foreach($views_rate_weeks as $views_rate){
																										if($day_list[$i] == "'".$views_rate['date']."'"){
																													$tot_click['views'][$i] = $views_rate['tot_click'];   break;
																													}else{
																														 $tot_click['views'][$i] = '0'; }
																										}
																									}
																								if(!empty($search_rate_weeks)){
																									foreach($search_rate_weeks as $search_rate){
																										if($day_list[$i] == "'".$search_rate['date']."'"){
																													$tot_click['search'][$i] = $search_rate['tot_click'];   break;
																													}else{
																														 $tot_click['search'][$i] = '0'; }
																										}
																									}
																								if(!empty($url_nav_rate_weeks)){
																									foreach($url_nav_rate_weeks as $url_nav_rate){
																										if($day_list[$i] == "'".$url_nav_rate['date']."'"){
																													$tot_click['url_nav'][$i] = $url_nav_rate['tot_click'];   break;
																													}else{
																														 $tot_click['url_nav'][$i]= '0'; }
																										}
																									}
																						}
																				if(!empty($tot_click['clicks']))
																								$tot_click['clicks'] = implode(',',$tot_click['clicks']);
																								else
																									$tot_click['clicks'] = '0';
																						if(!empty($tot_click['views']))
																								$tot_click['views'] = implode(',',$tot_click['views']);
																								else
																									$tot_click['views'] = '0';
																						if(!empty($tot_click['search']))
																								$tot_click['search'] = implode(',',$tot_click['search']);
																									else
																									$tot_click['search'] = '0';

																						if(!empty($tot_click['url_nav']))
																								$tot_click['url_nav'] = implode(',',$tot_click['url_nav']);		
																									else
																									$tot_click['url_nav'] = '0';																			
																				 }
																				 ?>

																	$(function () {
																		   $('#container_visit').highcharts({   // weekly page visit 
																			  chart: {
																				 type: 'column'
																			  },
																			  title: {
																				 text: ''
																			  },
																			  subtitle: {
																				 text: ''
																			  },
																			  xAxis: {																
																				 categories: [<?=implode(',',$day_list);?>]
																			  },
																			  yAxis: {
																				 min: 0,
																				 title: {
																					text: ''
																				 }
																			  },
																			  tooltip: {
																				 headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
																				 pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
																					'<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
																				 footerFormat: '</table>',
																				 shared: true,
																				 useHTML: true
																			  },
																			  plotOptions: {
																				 column: {
																					pointPadding: 0.2,
																					borderWidth: 0
																				 }
																			  },
																			navigation: {
																				  buttonOptions: {
																					 enabled: false
																				  }
																			   },
																			  series: [{
																				 name: 'Views',
																				 data: [<?=$tot_click['views'];?>]
																	    
																			  }, {
																				 name: 'Clicks',
																				 data: [<?=$tot_click['clicks'];?>]
																	    
																			  }, {
																				 name: 'URL Nav',
																				 data: [<?=$tot_click['url_nav'];?>]
																	    
																			  }, {
																				 name: 'Seach',
																				 data: [<?=$tot_click['search'];?>]
																	    
																			  }]
																		   });
																	    });
														</script>
														<?php if(($tot_click['search'] != '') || ($tot_click['clicks']  != '') || ($tot_click['views'] != '') || ($tot_click['url_nav'] != '')) {?>
																			<div id="container_visit" style="border:1px solid #ddd; min-width: 150px; height: 300px; margin: 0 auto"></div>	
														<?php } else{ ?>			
																<div id="false_container_visit" style="border:1px solid #ddd;  text-align:center; color:red; padding: 100px; min-width: 150px; height: 0px; ">No Analytics found for this store</div>							
														<?php } ?>			
								<?php }
													   elseif($analytic_type == 'campaign'){?>
																	<script type="text/javascript">
																			<?php 
																					 $tot_click = array('clicks'=>'','views'=>'','url_nav'=>'','search'=>'');
		
																						$day_list = array();
																						 if(!empty($clicks_rate_weeks))
																								foreach($clicks_rate_weeks as $week){ $day_list[] = "'".$week['date']."'"; }
																						if(!empty($views_rate_weeks))
																								foreach($views_rate_weeks as $week){ $day_list[] = "'".$week['date']."'"; }
																						if(!empty($search_rate_weeks))
																								foreach($search_rate_weeks as $week){ $day_list[] = "'".$week['date']."'";}
																						if(!empty($url_nav_rate_weeks))
																								foreach($url_nav_rate_weeks as $week){ $day_list[] = "'".$week['date']."'";}



																						 if(!empty($day_list)){
																								$day_list = array_unique($day_list);
			

																								for($i=0;$i<count($day_list);$i++){

																										 if(!empty($clicks_rate_weeks)){
																											foreach($clicks_rate_weeks as $clicks_rate){
																													if($day_list[$i] == "'".$clicks_rate['date']."'") {
																																$tot_click['clicks'][$i] = $clicks_rate['tot_click'];  break;
																																}else{
																																	    $tot_click['clicks'][$i] = '0'; 
																																	    }
																												}
																											}
																										if(!empty($views_rate_weeks)){
																											foreach($views_rate_weeks as $views_rate){
																												if($day_list[$i] == "'".$views_rate['date']."'"){
																															$tot_click['views'][$i] = $views_rate['tot_click'];   break;
																															}else{
																																 $tot_click['views'][$i] = '0'; }
																												}
																											}
																										if(!empty($search_rate_weeks)){
																											foreach($search_rate_weeks as $search_rate){
																												if($day_list[$i] == "'".$search_rate['date']."'"){
																															$tot_click['search'][$i] = $search_rate['tot_click'];   break;
																															}else{
																																 $tot_click['search'][$i] = '0'; }
																												}
																											}
																										if(!empty($url_nav_rate_weeks)){
																											foreach($url_nav_rate_weeks as $url_nav_rate){
																												if($day_list[$i] == "'".$url_nav_rate['date']."'"){
																															$tot_click['url_nav'][$i] = $url_nav_rate['tot_click'];   break;
																															}else{
																																 $tot_click['url_nav'][$i]= '0'; }
																												}
																											}
																								}
																						if(!empty($tot_click['clicks']))
																								$tot_click['clicks'] = implode(',',$tot_click['clicks']);
																								else
																									$tot_click['clicks'] = '0';
																						if(!empty($tot_click['views']))
																								$tot_click['views'] = implode(',',$tot_click['views']);
																								else
																									$tot_click['views'] = '0';
																						if(!empty($tot_click['search']))
																								$tot_click['search'] = implode(',',$tot_click['search']);
																									else
																									$tot_click['search'] = '0';

																						if(!empty($tot_click['url_nav']))
																								$tot_click['url_nav'] = implode(',',$tot_click['url_nav']);		
																									else
																									$tot_click['url_nav'] = '0';	
																						 }
																						 ?>																		
																				$(function () {
																						   $('#container_campaign').highcharts({   // weekly page visit campaign wise
																							  chart: {
																								 type: 'column'
																							  },
																							  title: {
																								 text: ''
																							  },
																							  subtitle: {
																								 text: ''
																							  },
																							  xAxis: {
																								 categories: [<?=implode(',',$day_list);?>]
																							  },
																							  yAxis: {
																								 min: 0,
																								 title: {
																									text: ''
																								 }
																							  },
																							  tooltip: {
																								 headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
																								 pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
																									'<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
																								 footerFormat: '</table>',
																								 shared: true,
																								 useHTML: true
																							  },
																							  plotOptions: {
																								 column: {
																									pointPadding: 0.2,
																									borderWidth: 0
																								 }
																							  },
																							navigation: {
																									  buttonOptions: {
																										 enabled: false
																									  }
																								   },
																							  series: [{
																								 name: 'Views',
																								 data: [<?=$tot_click['views'];?>]
																					    
																							  }, {
																								 name: 'Clicks',
																								 data: [<?=$tot_click['clicks'];?>]
																					    
																							  }, {
																								 name: 'URL Nav',
																								 data: [<?=$tot_click['url_nav'];?>]
																					    
																							  }, {
																								 name: 'Search',
																								 data: [<?=$tot_click['search'];?>]
																					    
																							  }]
																						   });
																					    });
																		</script>
																	<?php if(($tot_click['search'] != '') || ($tot_click['clicks']  != '') || ($tot_click['views'] != '') || ($tot_click['url_nav'] != '')) {?>
																			<div id="container_campaign" style="border:1px solid #ddd; min-width: 150px; height: 300px; margin: 0 auto"></div>	
																	<?php } else{ ?>			
																			<div id="false_container_campaign" style="border:1px solid #ddd;  text-align:center; color:red; padding: 100px; min-width: 150px; height: 0px; ">No Analytics found for this Campaign</div>							
																	<?php } ?>
																	<?php } ?>
										
                                    </div>
                                    <!-- ANALYTICS  END -->
                                    
                                    
                                    <div class="clr"></div>
                                </div>
                                <div class="clr"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
		 <?php  $this->load->view('front/common/right_menu'); ?>

                <div class="clr"></div>
                </div>
            </div>
        </div>
 <!--End Content-->

<script type="text/javascript" >

		$(document).ready( function(){
			
			$('#selected_store_header').text($('#selected_store_name').val());

			
				$('#pending_subscriber_tab').click(function(){
					
								$('#pending_subscriber_tab').addClass('active');
								$('#active_subscriber_tab').removeClass('active');
								//$('#selected_tab_header').text('Pending Requests');
								$('#active_subscriber_container').hide();//('slide', {direction: 'right'}, 200);
								$('#analytic_container').show('slide', {direction: 'left'}, 500);
								/*$("div.pending-holder").jPages({
								    containerID : "pending_subscribers_list",
								    perPage: 10
							  	}); */
								return false;
					   });	
				
			});
			

  
</script>


        
