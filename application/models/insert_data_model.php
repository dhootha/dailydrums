<?php

/**
 * This class will be used for generic functions in frontsection
 * For eg: fetch user data 
 */
class Insert_data_model extends CI_Model {

		    //private $action_types;

		    private $_action_primary_id;
		    private $_action_table_name;
		    private $_action_user_id;

		    //private $action_array;

		    function __construct() {
			 // Call the Model constructor
			 parent::__construct();
			 //$this->set_action_type();
		    }
		    
		  	 public function save_deal($user_id,$file_name) {
		  	 	
		  	 			$data_array = array(
		  	 										'user_id'=>$user_id,
		  	 										'business_image'=>$file_name,
		  	 										'category_id'=>$this->input->post('deal_category'),
		  	 										'business_name'=>$this->input->post('business_name'),
		  	 										'business_description'=>$this->input->post('business_description'),
		  	 										'business_duration'=>$this->input->post('duration'),
		  	 										'business_price'=>$this->input->post('price'),
		  	 										'address'=>$this->input->post('address'),
		  	 										'landmarks'=>$this->input->post('landmarks'),
		  	 										'timings'=>$this->input->post('timings')	  	 											
		  	 									);
		  	 							
		  	 			$this->db->insert('deals',$data_array);
		  	 			
		  	 			if( ($inserted_deal_id = $this->db->insert_id()) )
								return $inserted_deal_id;
								else 
										return false;
		  	 	}
		
		public function report_deal($data_arr = array()){

			if(!empty($data_arr)){
				$insert_query = $this->db->insert_string('deal_reports', $data_arr);
				$insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
				$this->db->query($insert_query);
				//$this->db->insert('deal_reports',$data_arr); 
				return ($this->db->insert_id())?$this->db->insert_id():false;
				}
				else{  
						return false;
					  }
		}

		public function save_review($data_array = array()){
		
				if(!empty($data_array)){
					$this->db->insert('deal_reviews',$data_array);
					return $this->db->insert_id();
					}else{
							return false;
						}
			}
		  	 	
		public function save_campaign($user_id='1',$file_name='',$logo='',$campaign_type = 'basic') {
		  	 	
		  	 			$data_array = array(
		  	 										'user_id'=>$user_id,
		  	 										'business_image'=>$file_name,
		  	 										'business_logo'=>$logo,
		  	 										'store_id'=>$this->input->post('store_name'),
		  	 										'category_id'=>$this->input->post('category'),
		  	 										'business_name'=>$this->input->post('title'),
		  	 										'business_description'=>$this->input->post('description'),
		  	 										'duration_to'=>$this->input->post('duration_to'),
		  	 										'duration_from'=>$this->input->post('duration_from'),
		  	 										'country'=>$this->input->post('country'),
		  	 										'city'=>$this->input->post('city'),
		  	 										'city_area'=>$this->input->post('city_area'),
		  	 										'region'=>$this->input->post('region'),
		  	 										'address'=>$this->input->post('address'),
		  	 										'phone'=>$this->input->post('phone'),
		  	 										'website'=>$this->input->post('website_url'),
		  	 										'campaign_type'=>$campaign_type
		  	 										//'campaign_under'=>$camp_under	  	 											
		  	 									  ); //'business_price'=>$this->input->post('price'),
		  	 									
		  	 			if($campaign_type == 'pro'){
			  	 				$data_array['campaign_url'] = trim($this->input->post('campaign_url'));
			  	 				}
				  	 			elseif($this->input->post('use_logo') == 'use'){
					  	 				$data_array['use_logo'] = '1';
					  	 				}
					  	if($this->input->post('print_opt')){
						  		$data_array['print_opt'] = '1';
						  		}
						  		else{
						  				$data_array['print_opt'] = '0';
						  			  }
					  	 				
					  	 if(isset($_POST['campaign_status'])){
					  	 		if($this->input->post('campaign_status') == 'post')
					  	 				$data_array['status'] = '1';
					  	 				elseif($this->input->post('campaign_status') == 'save')
						  	 					$data_array['status'] = '2';
						  	 					elseif($this->input->post('campaign_status') == 'schedule')
						  	 							$data_array['status'] = '3';
					  	 		}
					  	 		else {
					  	 				$data_array['status'] = '1';
					  	 				}
					  	 				
					  	 if(isset($_POST['campaign_under'])){
						  	 	$data_array['campaign_under'] = $this->input->post('campaign_under');
						  	 	}
						  	 	else{
						  	 			$data_array['campaign_under'] = '1';
						  	 		  }
						  	 		  
						$this->load->model('Common_model');
	    				$zip_data = $this->Common_model->fetch_zip_by_city('1',trim($data_array['city_area']));
	    										  	 		  
			    		$r = $this->Common_model->fetchLatLong($zip_data[0]->zip);
						if(!empty($r)){
							$data_array['lat'] = $r['lat'];
							$data_array['long'] = $r['long'];
							}
					  	
		  	 			//echo "<pre>"; print_r($data_array)	; exit;
		  	 			//echo $this->db->insert_string('deals',$data_array); exit;		
		  	 				
		  	 			$this->db->insert('deals',$data_array);
		  	 			
		  	 			if($data_array['status'] == '1'){
		  	 			
				  	 			if( ($inserted_deal_id = $this->db->insert_id()) ){
				  	 				
				  	 					$store_id = $this->input->post('store_name');
				  	 					$this->db->select('user_id');
				  	 					$this->db->where('store_id',$store_id);
				  	 					$this->db->from('store_map');
				  	 					$qry = $this->db->get();
				  	 					if($qry->num_rows != 0 ){
				  	 							$data = array('deal_id'=>$inserted_deal_id);
				  	 							foreach($qry->result() as $user){
				  	 									$data['user_id'] = $user->user_id;
				  	 									$this->db->insert('deal_subscriptions',$data);
				  	 									}
				  	 							}
										return $inserted_deal_id;
										}
										else 
												return false;
								}
								else	
									return true;
		  	 	}
		  	 	
		  	 	public function save_store($user_id='1',$logo='') {
		  	 	
		  	 			$data_array = array(
		  	 										'user_id'=>$user_id,
		  	 										'logo'=>$logo,
		  	 										'store_name'=>$this->input->post('store_name'),
		  	 										'address1'=>$this->input->post('address_line1'),
		  	 										'address2'=>$this->input->post('address_line2'),
		  	 										'street'=>$this->input->post('street'),
		  	 										'city'=>$this->input->post('city'),
		  	 										'zip'=>$this->input->post('zip'),
		  	 										'phone'=>$this->input->post('phone'),
		  	 										'website'=>$this->input->post('website'),
		  	 										'state'=>$this->input->post('state'),
		  	 										'tag_words'=>$this->input->post('tag_words')									
		  	 									); //'business_price'=>$this->input->post('price'),
		  	 									
						$this->load->model('Common_model');
	    				$zip_data = $this->Common_model->fetch_zip_by_city('1',trim($data_array['zip']));
			    		$r = $this->Common_model->fetchLatLong($zip_data[0]->zip);
						if(!empty($r)){
							$data_array['lat'] = $r['lat'];
							$data_array['long'] = $r['long'];
							}		  	 			
		  	 							
		  	 			$this->db->insert('store',$data_array);
		  	 			
		  	 			if( ($inserted_store_id = $this->db->insert_id()) )
								return $inserted_store_id;
								else 
										return false;
		  	 	}
		  	 	
		  	 	
		  	 	public function save_user_plan_map_data($data_array){
		  	 		
		  	 				$this->db->insert('user_plan_map',$data_array);
		  	 				if( ($inserted_deal_id = $this->db->insert_id()) )
								return $inserted_deal_id;
								else 
										return false;
		  	 				}

		  

	}

