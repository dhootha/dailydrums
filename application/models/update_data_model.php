<?php

/**
 * This class will be used for generic functions in frontsection
 * For eg: fetch user data 
 */
class Update_data_model extends CI_Model {

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

		  public function update_user_profile($user_id='',$update_arr = array()){

					if(!empty($update_arr) && $user_id != ''){
						$this->db->where('user_id',$user_id);
						$this->db->update('user_profile',$update_arr);
						return true;
						}
						else{
								return false;
								}
			}

		  public function update_profile($user_id) {
		  	
				$updatefieldarray = array('firstname'=>$this->input->post('first_name'),
										'lastname'=>$this->input->post('last_name'),
										'zip'=>$this->input->post('zip'),
										'primary_phone'=>$this->input->post('primary_phone'));
										
  				$this->load->model('Common_model');
				$zip_data = $this->Common_model->fetch_zip_by_city('1',trim($this->input->post('zip')));
	    			$r = $this->Common_model->fetchLatLong(trim($zip_data[0]->zip));
				if(!empty($r)){
					$updatefieldarray['lat'] = $r['lat'];
					$updatefieldarray['long'] = $r['long'];
					}
//echo"<pre>"; print_r($r); exit;
				//$id = $this->input->post('user_id');

				$this->db->where('user_id ='.$user_id);
        		$this->db->update('user_profile', $updatefieldarray);
        		
        		$update_user = array('email'=>$this->input->post('business_email'));
        		$this->db->where('id',$user_id);
        		$this->db->update('user',$update_user);	
			}

		public function update_password() {

				$new_password = $this->input->post('new_password');
				$old_password   = $this->input->post('old_password');
				$user_id             = $this->input->post('user_id');

				$updatefieldarray = array('password'=>md5($new_password));
				$whr_array 		  = array('id'=>$user_id,
								     		  'password'=>md5($old_password));

				$this->db->where($whr_array);
        			$this->db->update('user', $updatefieldarray);
				
				if( $this->db->affected_rows() )
						return TRUE;
					else
						return FALSE;
			}

		public function update_local_area( $user_id ) {

				$country = $this->input->post('country');
				$state     = $this->input->post('state');
				$city 	 = $this->input->post('city');

				$update_array = array('country_id'=>$country,
									    'state'=>$state,
									    'city'=>$city);

				$whr_arr = array( 'user_id'=>$user_id );

				$this->db->where($whr_arr);
        			$this->db->update('user_profile', $update_array);
				
				if( $this->db->affected_rows() )
						return TRUE;
					else
						return FALSE;
			}
			
		public function reset_password($encoded_email) {

				$new_password = $this->input->post('new_password');

				$updatefieldarray = array('password'=>md5($new_password));
				$whr_array 		   = array("md5(email)"=>$encoded_email);

				$this->db->where($whr_array);
        		$this->db->update('user', $updatefieldarray);
				
				return TRUE;
			}
			
		public function update_campaign($user_id='1',$file_name='',$logo='',$campaign_id,$campaign_type = 'basic') {
		  	 	
		  	 			$data_array = array(
		  	 										'user_id'=>$user_id,
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
		  	 										'website'=>$this->input->post('website_url')	  	 											
		  	 									); //'business_price'=>$this->input->post('price'),
		  	 									
		  	 			if($campaign_type == 'pro'){
			  	 				$data_array['campaign_url'] = trim($this->input->post('campaign_url'));
			  	 				}
				  	 			elseif($this->input->post('use_logo') == 'use'){
					  	 				$data_array['use_logo'] = '1';
					  	 				}
					  	 				elseif($this->input->post('use_logo') != 'use') {
					  	 						$data_array['use_logo'] = '0';
					  	 						}
						
					  	if(  $file_name != '' ) {
					  	 	$data_array['business_image']=$file_name;
					  	 	}
			  	 		if( $logo != '' ) {
			  	 				$data_array['business_logo']=$logo;
			  	 				}
			  	 				
			  	 		$this->load->model('Common_model');
						$zip_data = $this->Common_model->fetch_zip_by_city('1',trim($this->input->post('city_area')));						
			    			$r = $this->Common_model->fetchLatLong(trim($zip_data[0]->zip));
						if(!empty($r)){
							$data_array['lat'] = $r['lat'];
							$data_array['long'] = $r['long'];
							}		
			  	 		
		  	 			$this->db->where('id',$campaign_id);			
		  	 			$this->db->update('deals',$data_array);
		  	 			
		  	 			//echo $this->db->last_query(); exit;
		  	 			
		  	 			return true;
		  	 	}
		  	 	
		  	 	
		  	 	public function update_store($user_id='1',$logo='',$store_id) {
		  	 	
		  	 			$data_array = array(
		  	 										'user_id'=>$user_id,
		  	 										'store_name'=>$this->input->post(store_name),
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
		  	 									
		  	 			
			  	 		if( $logo != '' ) {
			  	 				$data_array['logo']=$logo;
			  	 				}
			  	 		
			  	 		$this->load->model('Common_model');
	    				$zip_data = $this->Common_model->fetch_zip_by_city('1',trim($this->input->post('zip')));
			    		$r = $this->Common_model->fetchLatLong($zip_data[0]->zip);
			    		
						if(!empty($r)){
							$data_array['lat'] = $r['lat'];
							$data_array['long'] = $r['long'];
							}
							
		  	 			$this->db->where('store_id',$store_id);			
		  	 			$this->db->update('store',$data_array);
		  	 			
		  	 			//echo $this->db->last_query(); exit;
		  	 			
		  	 			return true;
		  	 	}
		  
		  
	public function update_front_campaign($user_id='1',$file_name='',$logo='',$campaign_type = 'basic') {
		  	 	
		  	 			$data_array = array(
		  	 										'user_id'=>$user_id,
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
		  	 										'website'=>$this->input->post('website_url')
		  	 										//'campaign_under'=>$camp_under	  	 											
		  	 									  ); //'business_price'=>$this->input->post('price'),
		  	 									  
		  	 			if($file_name != ''){
		  	 				$data_array['business_image']=$file_name;
		  	 				}
		  	 			if($logo != '')	
		  	 				$data_array['business_logo'] = $logo;
		  	 									
		  	 			if($campaign_type == 'pro'){
			  	 				$data_array['campaign_url'] = trim($this->input->post('campaign_url'));
			  	 				}
				  	 			elseif($this->input->post('use_logo') == 'use'){
					  	 				$data_array['use_logo'] = '1';
					  	 				}
					  	 				else{
					  	 						$data_array['use_logo'] = '0';
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
	    				$zip_data = $this->Common_model->fetch_zip_by_city('1',trim($this->input->post('city_area')));
			    		$r = $this->Common_model->fetchLatLong($zip_data[0]->zip);
			    		
						if(!empty($r)){
							$data_array['lat'] = $r['lat'];
							$data_array['long'] = $r['long'];
							}
							
		  	 			$this->db->where('deals.id',$this->input->post('deal_id'));			
		  	 			$this->db->update('deals',$data_array);
		  	 			
		  	 			//echo $this->db->last_query();
		  	 			//exit;
		  	 			
		  	 			// ***** Send deal to subscriber list *****
		  	 			
		  	 			if($data_array['status'] == '1'){
		  	 			
				  	 			if( ($inserted_deal_id = $this->input->post('deal_id')) ){
				  	 				
				  	 					$store_id = $this->input->post('store_name');
				  	 					$this->db->select('user_id');
				  	 					$this->db->where('store_id',$store_id);
				  	 					$this->db->from('store_map');
				  	 					$qry = $this->db->get();
				  	 					if($qry->num_rows != 0 ){
				  	 							$data = array('deal_id'=>$inserted_deal_id);
				  	 							foreach($qry->result() as $user){
				  	 									$data['user_id'] = $user->user_id;
				  	 									$insert_query = $this->db->insert_string('deal_subscriptions', $data);
				  	 									$insert_query = str_ireplace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
														$this->db->query($insert_query);
				  	 									//$this->db->insert('deal_subscriptions',$data);
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
			
		

	}

