<?php

/**
 * This class will be used for generic functions in admin section
 * For eg: delete records, status update, status show etc.
 */
class Common_model extends CI_Model {

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
    
    public function fetchLatLong($address){
    	
    		$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$response = curl_exec($ch);
			curl_close($ch);
			$response_a  = json_decode($response);
			if(!empty($response_a->results)){
					$res = array();
					//$response_a  = json_decode($response);
					$res['lat']  = $response_a->results[0]->geometry->location->lat;
					$res['long'] = $response_a->results[0]->geometry->location->lng;
					return $res;
					}
					else{
							return false;
						}
    	}

    public function show_info($info_id) {
        echo $this->session->flashdata($info_id);
    }

    /**
     * This function can used to get all records or particular records depending on the clause
     * @param type $where_array -- $array = array('name' => $name, 'title' => $title, 'status' => $status); $this->db->where($where_array);
     * @return boolean
     */
    function show_status($currentStatus) {
        $statusImage = 'online-dot.jpg';
        if (isset($currentStatus)) {
            $statusImage = ($currentStatus == '1') ? 'online-dot.jpg' : 'offline-dot.jpg';
        }
        return $statusImage;
    }

    /**
     * Generalised delete functions
     * @param type $tableName
     * @param type $identifier
     * @param type $pkId
     * @return boolean
     */
    function delete_records($tableName, $identifier, $pkId) {

        if (isset($tableName) && isset($identifier) && isset($pkId)) {

            $this->db->delete($tableName, array($identifier => $pkId));
          //echo  $this->db->last_query(); exit;
            return true;
        }
        else
            return false;
    }
    
    function update_sign_info($dataArray = array(),$user_id = ''){
    	
    		if(!empty($dataArray)){
    				$user_name = explode(' ',$dataArray['user_name'],2);
    				$data['firstname'] = $user_name[0];
    				$data['lastname']  = $user_name[1];
    				$this->db->where('user_id',$user_id);
    				$this->db->update('user_profile',$data);
    				
    				$data = array('email'=>$dataArray['email'],'password'=>md5($dataArray['password']));
    				$this->db->where('id',$user_id);
    				$this->db->update('user',$data);
    				
    				return true;
    			
    			}else{
    				return false;
    					}
    	}
    	
    function update_business_info($dataArray = array(),$user_id = ''){
    	
    		if(!empty($dataArray) && $user_id != ''){
    	   				
    				$data = array('legal_name'=>$dataArray['legal_name'], 'business_email'=>$dataArray['business_email']);
    				$this->db->where('user_id',$user_id);
    				$this->db->update('user_profile',$data);
    				return true;
	    			}
	    			else{
	    				return false;
	    					}
    	}
    	
    function update_membership_info($dataArray = array(),$user_id = ''){
    	
    		if(!empty($dataArray) && $user_id != ''){
    	   				
    				$data = array('display_name'=>$dataArray['display_name']);
    				$this->db->where('user_id',$user_id);
    				$this->db->update('user_profile',$data);
    				return true;
	    			}
	    			else{
	    				return false;
	    					}
    	}
    	
    function update_address_info($dataArray = array(),$user_id = ''){
    	
    		if(!empty($dataArray) && $user_id != ''){
    	   				
    				$data = array( 'address_one'=>$dataArray['address_line1'],
    									'address_two'=>$dataArray['address_line2'], 
    									'city'=>$dataArray['city'],
    									'state'=>$dataArray['state'],
    									'zip'=>$dataArray['zip'],
    									'country_id'=>$dataArray['country'],
    									'primary_phone'=>$dataArray['primary_phone']
    									);
    								
				$zip_data = $this->Common_model->fetch_zip_by_city('1',trim($dataArray['zip']));	
		    		$r = $this->fetchLatLong(trim($zip_data[0]->zip));
					if(!empty($r)){
						$data['lat'] = $r['lat'];
						$data['long'] = $r['long'];
						}
    				
    				$this->db->where('user_id',$user_id);
    				$this->db->update('user_profile',$data);
    				return true;
	    			}
	    			else{
	    				return false;
	    					}
    	}
    	
    function update_card_info($dataArray = array(),$user_id = ''){
    	
    		if(!empty($dataArray) && $user_id != ''){
    	   				
    				$data = array( 'card_name'=>$dataArray['card_name'],
    									'cc_number'=>$dataArray['cc_number'], 
    									'security_code'=>$dataArray['security_code']
    									);
    				
    				$this->db->where('user_id',$user_id);
    				$this->db->update('credit_card_details',$data);
    				return true;
	    			}
	    			else{
	    				return false;
	    					}
    	}
    
    function fetch_stores($whr_arr = null){
    	
    		$this->db->select('s.*');
    		$this->db->from('store s');
    		
    		if($whr_arr != null){
				$this->db->where($whr_arr);    			
    			}
    			
    		$arr = $this->db->get();
    		
    		if($arr->num_rows() > 0 ) {

								return $arr->result(); 
							}
							else {
									   return false;
								   }	
    	}
    	
    	
    	function fetch_subscribers_list( $store_id = '', $bsns_user_id = '' ){
    		
    		$this->db->select('up.display_name,up.user_id,sm.map_id subscription_id,sm.status');
    		$this->db->from('store_map sm');
    		$this->db->join('user_profile up','sm.user_id = up.user_id');
    		
    		/*$this->db->select('up.display_name,up.user_id,ds.id subscription_id,ds.status');
    		$this->db->from('deals d');
    		$this->db->join('deal_subscriptions ds','ds.deal_id = d.id','left');
    		$this->db->join('user_profile up','up.user_id =ds.user_id','left');

			if($bsns_user_id != '')
    				$this->db->where('d.user_id',$bsns_user_id);*/
    		if($store_id != '')
    				$this->db->where('sm.store_id',$store_id);
    				
    		$subscribersRS = $this->db->get();
    		
    		if($subscribersRS->num_rows() > 0){
    			
				//echo "<pre>"; print_r($subscribersRS->result()); //exit;
				return  $subscribersRS->result();  			
    			}
    			else{
    				//echo"No"; exit;
    					return false;
    				}
        	}
        	
     function delete_store_subscriber( $subscribers = '' ){
     	
     		if( $subscribers != '' ){
     			
     			$this->db->where_in('map_id',$subscribers);
     			$this->db->delete('store_map');
     			return true;
     			} else {
     						return false;
     					  }
     		}
     	
     function confirm_store_subscriber( $subscribers = '' ){
     	
     		if( $subscribers != '' ){
     			$up_array = array('status'=>'1');
     			$this->db->where_in('map_id',$subscribers);
     			$this->db->update('store_map',$up_array);
     			return true;
     			} else {
     						return false;
     					  }
     		}

    /**
     * This is will populate the country list
     * @param type $country_name -optional $array = array('name' => $name, 'title' => $title, 'status' => $status); $this->db->where($where_array);
     * @return boolean
     */
    function get_countries($where_array = null) {

        $this->db->select('*');
        $this->db->from('countries');
        if ($where_array != null) {
            $this->db->where($where_array);
        }
        $this->db->order_by('country_name', 'ASC');
        $fetchQuery = $this->db->get();

        if ($fetchQuery->num_rows() > 0) {
            return $fetchQuery->result();
        }
        else
            return false;
    }

    /*
     * Show country name by ID
     */

    public function get_country_name($country_id) {
        $country_obj = $this->get_countries(array('id' => $country_id));
        $country_name = '';
        if ($country_obj !== false)
            $country_name = $country_obj[0]->country_name;

        return $country_name;
    }

    /**
     * Count all the action
     * @param type $action_type
     * @param type $table_primary_id
     * @return type
     */
    private function get_action_count($action_type) {


        $total_like = '';

        if (!empty($action_type)) {

            $this->db->where('action_table_name', $this->_action_table_name);

            $this->db->where('action_type', $action_type);

            $this->db->where('action_table_pk_id', $this->_action_primary_id);

            $this->db->from('action');

            //$total_like = ($this->db->count_all_results() == '0') ? '' : $this->db->count_all_results() ;
            $total_like = $this->db->count_all_results();
        }

        return ($total_like == '0') ? '' : $total_like;
    }

    public function get_like_count($table_primary_id, $table_name) {

        $this->_action_primary_id = $table_primary_id;

        $this->_action_table_name = $table_name;

        $total_like = $this->get_action_count($action_type = 'like');

        return $total_like;
    }

    public function get_comment_count($table_primary_id, $table_name) {

        $this->_action_primary_id = $table_primary_id;

        $this->_action_table_name = $table_name;

        $total_comment = $this->get_action_count($action_type = 'comment');

        return $total_comment;
    }

    public function fetch_all_comments($pk_id, $table_name = 'ask_me') {

        $this->db->select('*');
        $this->db->from('action');
        $this->db->where('action_table_name', $table_name);
        $this->db->where('action_table_pk_id', $pk_id);
        $this->db->where('action_type', 'comment');
        $fetchQuery = $this->db->get();
        if ($fetchQuery->num_rows() > 0) {
            return $fetchQuery->result();
        }
        else
            return false;
    }

    public function set_like($primary_id, $table_name, $liked_by) {
        $inserted_action_id = '';

        $this->_action_primary_id = $primary_id;

        $this->_action_table_name = $table_name;

        $this->_action_user_id = $liked_by;

        $this->db->select('id');
        $this->db->from('action');
        $this->db->where('action_by_user_id', $liked_by);
        $this->db->where('action_table_pk_id ', $primary_id);
        $this->db->where('action_table_name', $table_name);
        $this->db->where('action_type ', 'like');

        $get_likedRS = $this->db->get();

        if ($get_likedRS->num_rows() <= 0) {

            $data_insert = array(
                'action_by_user_id' => $liked_by,
                'action_table_name' => $table_name,
                'action_table_pk_id' => $primary_id,
                'action_type' => 'like',
            );

            $this->db->insert('action', $data_insert);

            $inserted_action_id = $this->db->insert_id();
        }

        return $inserted_action_id;
    }

    public function set_comment($primary_id, $table_name, $comment_by, $comment) {
        $inserted_action_id = '';

        $comment = trim($comment);

        if (!empty($comment)) {

            $data_insert = array(
                'action_by_user_id' => $comment_by,
                'action_table_name' => $table_name,
                'action_table_pk_id' => $primary_id,
                'action_type' => 'comment',
                'action_content' => $comment,
            );


            $this->db->insert('action', $data_insert);
            $inserted_action_id = $this->db->insert_id();
        }

        return $inserted_action_id;
    }

    public function get_banner_by_position($position = 'top') {
        $this->db->select('*');
        $this->db->where('position', $position);
        $this->db->where('status', '1');
        $this->db->from('banners');
        $fetchQuery = $this->db->get();

        if ($fetchQuery->num_rows() > 0) {
            $banner_rs = $fetchQuery->result();
            $banner_url = 'uploads/banner_img/' . $banner_rs[0]->banner_url;
            $banner_link = $banner_rs[0]->banner_link;

            return array('banner_url' => $banner_url, 'banner_link' => $banner_link);
        }
        else
            return false;
    }

    //by Manish
    public function get_static_pages($id) {
        $this->db->select('*');
        $this->db->where('page_id', $id);
        $this->db->where('page_status', '1');
        $this->db->from('static_pages');
        $fetchQuery = $this->db->get();
        if ($fetchQuery->num_rows() > 0) {
            return $fetchQuery->result();
        }
        else
            return false;
    }

    //+++++++++++++ Function for sending Email ++++++++++++++++++++++

    public function send_html_email($to, $subject, $message, $from, $from_name) {

        $config['charset'] = 'iso-8859-1';
        $config['mailtype'] = 'html';
        $config['validate'] = TRUE;

        $this->email->initialize($config);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->from($from, $from_name);
        $this->email->to($to);

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function forgetpassword_check_valid_user($tablename, $wherearr) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where($wherearr);
        $checkforgetpassworduserQuery = $this->db->get();

        if ($checkforgetpassworduserQuery->num_rows() == 1) {
            return $checkforgetpassworduserQuery->result();
        } else {
            return false;
        }
    }

    public function reset_password($tablename, $wherearr, $updatefieldarray) {
        $this->db->where($wherearr);
        $this->db->update($tablename, $updatefieldarray);
        //echo $this->db->last_query();

        return true;
    }

    public function thousandsCurrencyFormat($num) {
        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];
        return $x_display;
    }

    private function total_unread_message($profile_user_id) {
        $this->db->where('user_id', $profile_user_id);
        $this->db->where('message_is_read', '0');
        $this->db->where('message_is_trash', '0');
        $this->db->from('message');
        return $this->db->count_all_results();
    }

    public function display_unread_counter($profile_user_id) {
        $total_unread = $this->total_unread_message($profile_user_id);
        return ($total_unread > 0) ? '(' . $total_unread . ')' : '';
    }
    
    public function fetch_category($id = null) {
    	
    		$this->db->where('category_status','1');
    		
    		if($id != null) {
    			$this->db->where('category_id',$id);
    			}
    		    			
    		$this->db->from('category');
    		$resulRS = $this->db->get();
    		
    		if ($resulRS->num_rows() > 0) {
            return $resulRS->result();
        }
        else
            return false;
    		
    		//echo "<pre>";
    		//print_r($resulRS);
    		//exit;
    		
    	}
    	
    	public function getLocations( $term = '' ) {
    		
    			error_reporting(0);
				
				//$sql 	= "select name from `auto_suggest` where name like '%$query%'";
				//$query 	= mysql_query($sql);				
				
				$this->db->select('*');
				$this->db->like('city', $term, 'both'); 
				$this->db->or_like('zip', $term, 'both'); 
				$this->db->from('location');
				$this->db->limit(10,0);
				$resulRS = $this->db->get();

				$val = '';
				
				foreach($resulRS->result() as $row){
							$val[] = $row->city.", ".$row->zip;
					}
					
				return $val;
    		}
    		
    	
    	public function fetch_zip_by_city($status = '', $id = '', $city_name = ''){
    		
    			$this->db->select('*');
    			$this->db->from('location');
    			if($status != '')
    				$this->db->where('status',$status);
    			if($id != '')
    				$this->db->where('loc_id',$id);
    				elseif($city_name != '')
    					$this->db->where('city',trim($city_name));
    			$this->db->order_by('loc_id','ASC');
    				
    			$qry = $this->db->get();
    			
    			if ( $qry->num_rows() > 0 ) {
							$arr = array();
							foreach ($qry->result() as $row) {
								    $arr[] =  $row;
									 }
							return $arr;
						}
						else{
										return false;
									   }	
    		}
    		
    	
    	
    	public function fetch_city($status = '', $id = ''){
    		
    			$this->db->select('distinct(city),loc_id');
    			$this->db->from('location');
    			if($status != '')
    				$this->db->where('status',$status);
    			if($id != '')
    				$this->db->where('loc_id',$id);
    			$this->db->order_by('city','ASC');
    			$this->db->group_by('city');
    			//$this->db->limit(10,20);
    				
    			$qry = $this->db->get();
    			
    			//echo $this->db->last_query();
    			//exit;
    			
    			if ( $qry->num_rows() > 1 ) {
							$arr = array();
							foreach ($qry->result() as $row) {
								    $arr[] =  $row;
									 }
							return $arr;
						}
						elseif($qry->num_rows() == 1) {
								return $qry->row(); 
								}
								else{
										return false;
									   }	
    		}
    		
    public function fetch_zip($status = '', $id = '', $city_name = ''){
    		
    			$this->db->select('*');
    			$this->db->from('location');
    			if($status != '')
    				$this->db->where('status',$status);
    			if($id != '')
    				$this->db->where('loc_id',$id);
    				elseif($city_name != '')
    					$this->db->where('city',trim($city_name));
    			$this->db->order_by('loc_id','ASC');
    				
    			$qry = $this->db->get();
    			
    			if ( $qry->num_rows() > 1 ) {
							$arr = array();
							foreach ($qry->result() as $row) {
								    $arr[] =  $row;
									 }
							return $arr;
						}
						elseif($qry->num_rows() == 1) {
								return $qry->row(); 
								}
								else{
										return false;
									   }	
    		}
                
    public function getDeals($campaign_type = '',$campaign_under = '') {
    		
    		  $cur_date = strtotime(date('y-m-d h:m:s',time()));
            $this->db->select('deals.*,user.user_type,loc.zip zip_code, loc.city city_name');
            $this->db->from('deals deals');
            $this->db->join('user user', 'user.id = deals.user_id','left');
		  $this->db->join('location loc', 'deals.city_area = loc.loc_id');
            $this->db->where('deals.status','1');
            
            if($campaign_type != ''){
	            	$this->db->where('deals.campaign_type',$campaign_type);
	            	}
	            	
	         if($campaign_under != ''){
	            	$this->db->where('deals.campaign_under',$campaign_under);	
	            	}
	            		
            $this->db->order_by("deals.id", "desc"); 
            $qry = $this->db->get(0,3);
            
            if($qry->num_rows > 0){
		            $data = $qry->result();
		            $activeData = array();
		            
		            for($i=0;$i<count($data);$i++){
		         				$end_date = strtotime($data[$i]->duration_to." 23:59:59");
		            			if($end_date >= $cur_date){
			            				$data[$i]->end_time = $end_date - $cur_date;
			            				$activeData[] = $data[$i];
			            				}
		         			}
		         		return $activeData;
	         		}
	         		else{
	         				return false;
	         			  }
    }
    
    
    public function getTotalDeals($category_id='' ,$category_slug='', $search_for='',$campaign_type = '',$campaign_under = ''){
    	
		  $cur_date = strtotime(date('y-m-d h:m:s',time()));        
            $this->db->select('deals.*,user.user_type');
            $this->db->from('deals deals');
            $this->db->join('category cat', 'deals.category_id = cat.category_id','left');
            $this->db->join('user user', 'user.id = deals.user_id','left');
            $this->db->where('deals.status','1');
            
            if($campaign_type != ''){
	            	$this->db->where('deals.campaign_type',$campaign_type);
	            	}
	            	
	         if($campaign_under != ''){
	            	$this->db->where('deals.campaign_under',$campaign_under);	
	            	}
            
            if($category_id!=''){
                $this->db->where('deals.category_id',$category_id);
                }
            	elseif($search_for == 'category' && $category_slug != '' ){
		            	 $this->db->where('cat.category_slug',$category_slug);
		            	 }
		            	 elseif($search_for == 'all' && $category_slug != ''){
		            	 	$this->db->like('deals.business_name',$category_slug);
		            	 	}
            $this->db->order_by("deals.id", "desc"); 
            $qry = $this->db->get();
            
            if($qry->num_rows > 0){
		            $data = $qry->result();
		            $activeData = array();
		            
		            for($i=0;$i<count($data);$i++){
		         				$end_date = strtotime($data[$i]->duration_to." 23:59:59");
		            			if($end_date >= $cur_date){
			            				$data[$i]->end_time = $end_date - $cur_date;
			            				$activeData[] = $data[$i];
			            				}
		         			}
		         		return $activeData;
	         		}
	         		else{
	         				return false;
	         			  }
    		}

		public function latest_post($whr_arr = array(),$start_limit='',$end_limit=''){ 

				$this->db->select("dr.*,up.display_name,up.photo,d.business_name as deal_name, d.campaign_type,d.use_logo, d.business_logo,
d.business_image");
				$this->db->from("deal_reviews dr");
				$this->db->join("deals d","d.id=dr.deal_id","left");
				$this->db->join('user u', 'u.id = dr.user_id','left');
				$this->db->join('user_profile up', 'up.user_id = dr.user_id','left');
				if(!empty($whr_arr))
						$this->db->where($whr_arr);
				$this->db->order_by("dr.review_id", "desc"); 
				if($start_limit != '' && $end_limit != '')
						$this->db->limit($start_limit,$end_limit);
			     $qry = $this->db->get();  //echo $this->db->last_query(); exit;
				if($qry->num_rows > 0){
					return $qry->result();
					}
					else{
							return fasle;
						  }
			}   
    
        public function endingSoonDeals($category_id='' ,$category_slug='', $search_for=''){
        
	        	  $cur_date = strtotime(date('y-m-d h:m:s',time()));
	            $this->db->select('deals.*,user.user_type');
	            $this->db->from('deals deals');
	            $this->db->join('category cat', 'deals.category_id = cat.category_id','left');
	            $this->db->join('user user', 'user.id = deals.user_id','left');
	            $this->db->where('deals.status','1');
	            $this->db->order_by("deals.id", "desc"); 
	            $qry = $this->db->get();
	            //pritn_r($qry->result());
	            
	           if($qry->num_rows > 0)
	            	{
	            		$endSoonData = array();
	            		$data = $qry->result();
	            		
	            		for($i=0;$i<count($data);$i++){
	            				$end_date = strtotime($data[$i]->duration_to." 23:59:59");
		            			if($end_date >= $cur_date){
			            				$data[$i]->end_time = $end_date - $cur_date;
			            				$endSoonData[] = $data[$i];
			            				}
	            			}
	            		// Sorting the array
		            	foreach ($endSoonData as $row) {
							  	foreach ($row as $key => $value){
							    		${$key}[]  = $value; //Creates $volume, $edition, $name and $type arrays.
							  			}  
								}
							
		            	array_multisort($end_time,SORT_ASC,$business_name,SORT_ASC,$endSoonData);
		            	return $endSoonData;
	            	}
	            	else {
	            			return false;
	            			} 
	            			
	            	//echo "<pre>"; print_r($endSoonData); exit;            		
    		}
    
        public function neighborhoodDeals($center_lat,$center_lng,$radius){
        	
        			// Search the rows in the markers table
					/*$query = sprintf("SELECT d.id,d.user_id, d.lat, d.long, ( 3959 * acos( cos( radians('%s') ) * cos( radians( d.lat ) ) * cos( radians( d.long ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( d.lat ) ) ) ) AS distance FROM deals as d HAVING distance < '%s' ORDER BY distance LIMIT 0 , 1000",
					  mysql_real_escape_string($center_lat),
					  mysql_real_escape_string($center_lng),
					  mysql_real_escape_string($center_lat),
					  mysql_real_escape_string($radius));
					//$result = mysql_query($query);
					$r = $this->db->query($query);
					
					echo "<pre>"; print_r($r->result()); exit;*/
					
				if(isset($_COOKIE['current_location'])){
					$loc_area = $_COOKIE['current_location'];
					$loc_area = explode(',',$loc_area);  
					$loc_area = $loc_area[0];
		    		     $r = $this->Common_model->fetchLatLong(trim($loc_area));

					if(!empty($r)){
						$center_lat = 	$r['lat'];
						$center_lng =  $r['long'];
						}	
					
					}
					
			if($center_lat != null && $center_lng != null){
        
				   	  $cur_date = strtotime(date('y-m-d h:m:s',time()));
					  $this->db->select("deals.*,user.user_type, ( 3959 * acos( cos( radians(".$center_lat.") ) * cos( radians( deals.lat ) ) * cos( radians( deals.long ) - radians(".$center_lng.") ) + sin( radians(".$center_lat.") ) * sin( radians( deals.lat ) ) ) ) AS distance");
					  $this->db->from('deals deals');
					  $this->db->join('category cat', 'deals.category_id = cat.category_id','left');
					  $this->db->join('user user', 'user.id = deals.user_id','left');
					  $this->db->where('deals.status','1');
					  $this->db->where('deals.campaign_type','basic');
					  $this->db->or_where('deals.campaign_under','2');
					  $this->db->where('deals.campaign_type','pro');
					  $this->db->order_by("distance", "asc"); 
					  $this->db->having("distance < ",$radius+1);
					  $qry = $this->db->get();
					  
						  
					 if($qry->num_rows > 0)
					  	{
					  		$neighborhoodData = array();
					  		$data = $qry->result();
					  		
					  		for($i=0;$i<count($data);$i++){
					  				$end_date = strtotime($data[$i]->duration_to." 23:59:59");
						  			if($end_date >= $cur_date){
							  				$data[$i]->end_time = $end_date - $cur_date;
							  				$neighborhoodData[] = $data[$i];
							  				}
					  			}
					  			//echo "<pre>"; print_r($neighborhoodData); exit;
					  		
						  	return $neighborhoodData;
					  	}
					  	else {
					  		   //echo "hi"; exit;
					  			return false;
					  			} 
	            }else {
	            		 return false;
	            		 }			
	            	
    		}
    
    
    public function getMySubscription($category_id){
        
            $this->db->select('deals.*, user.user_type, subscriptions.*, s.store_name, s.logo store_logo');
            $this->db->from('deals deals');
            $this->db->join('user user', 'user.id = deals.user_id','left');
            $this->db->join('deal_subscriptions subscriptions', 'subscriptions.deal_id = deals.id','left');
            $this->db->join('store s','s.store_id=deals.store_id','left');
            $this->db->group_by('deals.store_id');
            $this->db->where('subscriptions.user_id',$this->is_logged_in['user_id']);
            $this->db->where('deals.status','1');
            if($category_id!='')
                $this->db->where('deals.category_id',$category_id);
            $this->db->order_by("deals.id", "desc");
//            echo $this->db->last_query();
//            die();
            $qry = $this->db->get();
            
            return $qry->result();
    			}
    			
    			
    			
	public function MySubscriptionForEndUser($user_id = ''){
        
				if($user_id == '')
					$user_id = $this->is_logged_in['user_id'];
				
				$this->db->select('smap.*,s.*');
				$this->db->distinct();
				$this->db->join('store s','s.store_id=smap.store_id','left');
				$this->db->where('smap.user_id',$user_id);
				$this->db->from('store_map smap');
            $qry = $this->db->get();
            
            return $qry->result();
    			}    			
    			
    			
    public function getMyInbox($category_id){
        
        		$user_id = $this->is_logged_in['user_id'];
            $this->db->select("deals.*, user.user_type, subscriptions.*, s.store_name, s.logo store_logo, c.clip_id clip");
            $this->db->from('deals deals');
            $this->db->join('user user', 'user.id = deals.user_id','left');
            $this->db->join('deal_subscriptions subscriptions', 'subscriptions.deal_id = deals.id','left');
            $this->db->join('store s','s.store_id=deals.store_id','left');
            $this->db->join('clips c','c.deal_id=deals.id AND c.user_id = '.$user_id,'left');
            //$this->db->group_by('deals.store_id');
            $this->db->where('subscriptions.user_id',$user_id);
            $this->db->where('deals.status','1');
            if($category_id!='')
                $this->db->where('deals.category_id',$category_id);
            $this->db->order_by("deals.id", "desc");
          
            $qry = $this->db->get();
            //echo $this->db->last_query();
            //die();
            return $qry->result();
    			}
    			
    public function getMyClips(){
        
            $this->db->select('deals.*, user.user_type, c.*, s.store_name, s.logo store_logo');
            $this->db->from('deals deals');
            $this->db->join('user user', 'user.id = deals.user_id','left');
            $this->db->join('clips c', 'c.deal_id = deals.id','left');
            $this->db->join('store s','s.store_id=deals.store_id','left');
            //$this->db->group_by('deals.store_id');
            $this->db->where('c.user_id',$this->is_logged_in['user_id']);
            $this->db->where('deals.status','1');

            $this->db->order_by("c.clip_id", "desc");
//            echo $this->db->last_query();
//            die();
            $qry = $this->db->get();
            
            return $qry->result();
    			}
    
    public function isSubscribe($user_id,$deal_id){
        $this->db->select('subscriptions.id');
        $this->db->from('deal_subscriptions subscriptions');
        $this->db->where('subscriptions.deal_id',$deal_id);
        $this->db->where('subscriptions.user_id',$user_id);
        $this->db->where('subscriptions.status','1');
        $qry = $this->db->get();
        if($qry->result())
            return true;
        else
            return false;
        
    }
    public function deleteSubscription($data){
    	
    		/*if($data['store_id']){
    			
    			$this->db->select('id');
    			$this->db->from('deals');
    			$this->db->where('store_id',$data['store_id']);
    			$this->db->where('user_id',$data['user_id']);
    			$this->db->get();
    			if($qry->result()){
    				$deal_ids = 
    				}
		         else
		            return false;
    			
    			}*/
        
        $this->db->where($data);
        $this->db->delete('deal_subscriptions'); 
    }
    
    public function insertSubscription($data){
    	
    		$deal_id = $data['deal_id'];
    		$user_id = $data['user_id'];
        
         $this->db->insert('deal_subscriptions', $data); 
         
         $this->db->select('deals.store_id');
    		$this->db->from('deals');
    		$this->db->where('id',$deal_id);
    		$qry = $this->db->get();
    		$ret = $qry->row();
    		
    		if($ret->store_id){    			
    				$this->db->select('store_map.map_id');
		    		$this->db->from('store_map');
		    		$this->db->where('store_id',$ret->store_id);
		    		$this->db->where('user_id',$user_id);
		    		$qry = $this->db->get();
		    		
		    		if($qry->num_rows == 0){
							$arr = array('store_id'=>$ret->store_id,
											 'user_id'=>$user_id ); 
							$this->db->insert('store_map',$arr);   
							}			
	    			}
    		}
    
    public function deleteClip($data){
    	
        	$this->db->where($data);
        	$this->db->delete('clips'); 
        	return true;
    		}
    
    public function insertClip($data){
        
        	$this->db->insert('clips', $data); 
        	return true;
    		}
    		
    public function deleteStoreMap($data){
    	
        	$this->db->where($data);
        	$this->db->delete('store_map'); 
        	return true;
    		}
    public function insertStoreMap($data){
        
        	$this->db->insert('store_map', $data); 
        	return true;
    		}
    
    
    
    
    /********************** IMAGE MANUPULATION  *****************************/
    /**
     * This function will upload the photo
     * @param type $file_pointer $_FILES['file_pointer']
     * @param type $destination_dir
     * @return type
     */
    public function upload_photo($file_pointer, $destination_dir, $new_file_name='',$image_size=300) {
        
        if($new_file_name=='') {
            $file_info = pathinfo($_FILES[$file_pointer]['name']);
            $new_file_name = md5(date('his')) . '_photo.' . $file_info['extension'];
            $new_file_name = strtolower($new_file_name);
        }

        $upload_directory_path =  $destination_dir ; 

        if (is_dir($upload_directory_path) == false)
            mkdir($upload_directory_path, 0777, true);

        if (is_dir($upload_directory_path . '/thumb') == false)
            mkdir($upload_directory_path . '/thumb', 0777, true);
        
        $data = getimagesize($_FILES[$file_pointer]['tmp_name']);
        
        if($data[0]< $image_size) {
            return 'Sorry Image size is too short.';
        }
        else{
            $config['upload_path'] = $upload_directory_path;
            $config['file_name'] = $new_file_name;
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '50000';
            $config['remove_space'] = TRUE;
            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if (!$this->upload->do_upload($file_pointer)){
                return $this->upload->display_errors();
                }
            else {
                $uploaded_file_info= $this->upload->data();
                $source_file = $config['upload_path'] .'/'. $uploaded_file_info['file_name'];
                $target_file = $config['upload_path'].'/thumb/'. $uploaded_file_info['file_name'];
                
                if($data[0] > 150)
                		$this->do_resize($source_file, $target_file);
                //echo "Hi"; exit;
                return 'success';
            } 
        }
        
    }

    /**
     * Creating the thumbnail
     * @param type $large_img_path
     * @param type $thumb_img_path
     * @param type $photo_name
     */
    public function do_resize($large_img_path, $thumb_img_path) {
        //$filename = $photo_name;
        $source_path = $large_img_path;
        $target_path = $thumb_img_path;
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => TRUE,
            'create_thumb' => TRUE,
            'thumb_marker' => '',
            'width' => 230,
            'height' => 145
        );


        $this->load->library('image_lib');
        $this->image_lib->initialize($config_manip);

        if (!$this->image_lib->resize()) {
            die($this->image_lib->display_errors());
        }
        // clear //
        $this->image_lib->clear();
    }
    /********************** END OF IMAGE MANUPULATION  *****************************/


    
    public function dealDetails($dealId){
        
        $this->db->select('u.display_name,deals.*,cat.category_name,loc.zip zip_id, loc_c.city city_name');
        $this->db->from('user_profile u');
        $this->db->join('deals deals', 'deals.user_id = u.user_id','left');
	   $this->db->join('location loc', 'loc.loc_id = deals.city_area','left');
	   $this->db->join('location loc_c', 'loc_c.loc_id = deals.city','left');
        $this->db->join('category cat', 'deals.category_id = cat.category_id','left');
        $this->db->where('deals.id',$dealId);
        $this->db->where('deals.status','1');
        $qry = $this->db->get();
        //echo $this->db->last_query();
        //die();
	  $this->make_analytic_data($qry->result(),'click');
        return $qry->result();
    }

	public function make_analytic_data($arr = array(),$action_type='click'){

			if(!empty($arr)){
				$store_ids = array();
				foreach($arr as $row){
							$store_ids[] = $row->store_id;
						}
				if(!empty($store_ids)){
					$store_ids = array_unique($store_ids);
					foreach($store_ids as $store){
						$this->insert_analytic_data('',$store,$action_type);
						}
					}
				}
		}

	public function insert_analytic_data($deal_id='',$store_id='',$action_type=''){

			if($deal_id != '')
				$data_array['deal_id'] = $deal_id;
			if($store_id != '')
				$data_array['store_id'] = $store_id;
			if($action_type != '')
				$data_array['action_type'] = $action_type;
		  	 							
		  	$this->db->insert('analytics',$data_array);
		}

	public function click_rate_months($store_id = ''){

	if($store_id != '' && is_numeric($store_id)){	
			$sql = "SELECT count(1) as tot_click,DATE_FORMAT(  `created_date` ,  '%b' ) as months
						FROM  `analytics` 
						WHERE store_id =".$store_id." AND date_format(`created_date`,'%y')=date_format(now(),'%y') 
						group by DATE_FORMAT(  `created_date` ,  '%b' ) 
						order by `created_date` asc";
			//$qry = $this->db->query($sql);
			$data = mysql_query($sql);  //echo mysql_num_rows($data);
			if(mysql_num_rows($data)){
			while($a = mysql_fetch_assoc($data)){
				$qry[] = $a; 
			}

			//$qry = $this->db->get($sql);
			//echo "<pre>";print_r($qry); exit;
			if(count($qry)>0){
				return $qry;
				}
				else{
						return false;
						}
			}
			else{
					return false;
					}
		}
		else{
				return false;
				}
	}

	public function click_rate_weeks($store_id = ''){

	if($store_id != '' && is_numeric($store_id)){	
			$sql =    "SELECT COUNT(1) AS tot_click, DATE_FORMAT(  `created_date` ,  '%d/%m/%y' ) as date FROM `analytics`
						WHERE `store_id` = ".$store_id." AND (DATEDIFF( date_format(now(),'%Y/%m/%d'),  date_format(`created_date`,'%Y/%m/%d') ) < 7)
						group by DATE_FORMAT(`created_date`,'%d/%m/%y')
						order by `created_date` asc";
			//echo $sql;
			//$qry = $this->db->query($sql);
			$data = mysql_query($sql);
			if(mysql_num_rows($data)){
			while($a = mysql_fetch_assoc($data)){
				$qry[] = $a; 
			}

			//$qry = $this->db->get($sql);
			//echo "<pre>";print_r($qry); exit;
			if(count($qry)>0){
				return $qry;
				}
				else{
						return false;
						}
			}
			else{
					return false;
					}
		}
		else{
				return false;
				}
	}
    
    public function fetch_static_page($id=''){
    	
    			$this->db->select('static.*');
    			$this->db->from('static_pages static');
    			if($id != ''){
    				$this->db->where('static.page_id',$id);
    				$qry = $this->db->get();
    				return $qry->row();
    				}else
    			return false;
    	}
    	
    public function save_contact_user(){
    	
    		$user_name = $this->input->post('u_name');
    		$email = $this->input->post('email');
    		$subject = $this->input->post('subject');
    		$message = $this->input->post('message');
    		
    		$data_array = array(
    								  'user_name'=>$user_name,
    								  'email'=>$email,
    								  'subject'=>$subject,
    								  'message'=>$message,
    								  'created_by'=>$_SERVER['REMOTE_ADDR']
    									);
    		$this->db->insert('contact_us',$data_array);
		  	 			
		  	 			if( ($inserted_deal_id = $this->db->insert_id()) )
								return $inserted_deal_id;
								else 
										return false;
    		}
    		
    public function get_plan_list($id = ''){
    	
			$this->db->select('plan.*');
			if($id != '')
					$this->db->where('id',$id);
			$this->db->where('plan.plan_status','1');
			$this->db->from('business_plan plan');
			$qry = $this->db->get();
			
			//print($qry->num_rows);exit;
			
			if($qry->num_rows != '0'){
				if($qry->num_rows > 1)
							return $qry->result();
							else{
								//print_r($qry->row());exit;
								return $qry->row();
								}
				}
				else{
						return false;
						}
    		}
    		
}
