<?php

/**
 * This class will be used for generic functions in frontsection
 * For eg: fetch user data 
 */
class Fetch_data_model extends CI_Model {

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

			public function fetch_user_data( $id = '', $email = '', $encoded_email = '',$status = '' ) {
				
					$this->db->select('u.*,up.*,ccd.*,country.country_name');
					$this->db->from('user u');
					$this->db->join('user_profile up', 'up.user_id=u.id');
					$this->db->join('credit_card_details ccd', 'ccd.user_id=u.id','left');
					$this->db->join('countries country', 'country.id=up.country_id','left');
					
					if( $id != '' )
							$this->db->where('u.id',$id);
						elseif( $email != '' )
								$this->db->where('u.email',trim($email));
							elseif( $encoded_email != '' )
									$this->db->where("md5(u.email)",$encoded_email);
									
					if( $status != '' )
							$this->db->where('u.status',$status);
						

					 $qry = $this->db->get();
					 
					 //echo $this->db->last_query();
					 
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
							else {
									   return false;
								   }		
					}

			public function fetch_user_reviews($whr_array = array()){
			
				if(!empty($whr_array)){
					$this->db->where($whr_array);
					$tot_subscription = ", (select count(smap.map_id) from store_map smap where smap.store_id = r.store_id ) tot_subscription";
					$tot_rev = ", (select count(dr.review_id) from deal_reviews dr where r.user_id = dr.user_id AND r.store_id = dr.store_id) tot_reviews";
					$this->db->select("r.*,d.business_name,d.business_logo,d.business_image,d.use_logo,d.campaign_type,up.display_name,up.photo".$tot_rev.$tot_subscription);
					$this->db->from('deal_reviews r');
					$this->db->join("deals d","d.id=r.deal_id");
					$this->db->join('user_profile up', 'up.user_id=r.user_id');
					$this->db->order_by('r.created_date', 'DESC');
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
					else{
							return false;
						  }
			}


			public function authinticate_login( $email_id='' ,$password='') {
				
					if( $email_id != '' && $password != '' ) {
						
							$email = $email_id;
							$pwd   = $password;
						}
						else{
							
									$email = $this->input->post('daily_drums_user_id');
									$pwd   = md5( $this->input->post('daily_drums_password') );
							}
					//echo $email." . ".$pwd;
					
					$this->db->select("u.id, u.email, u.user_type, up.firstname, up.lastname,up.legal_name,up.business_email,up.display_name");
					$this->db->from('user u');
					$this->db->join('user_profile up', 'up.user_id=u.id');
					$where_array = array(
										     'u.email' => $email,
										     'u.password' => md5($pwd),
										     'u.status' => '1'
										 );
					 $this->db->where($where_array);

					 $qry = $this->db->get();
					 $userRS = $qry->row(); 
					 $userNR = $qry->num_rows();
					 
					 //echo $this->db->last_query();

					 if ($userNR > 0) {                                 // Assigning data into session
						     $data_arr =  array(
											     'user_id' => $userRS->id,
											      'full_name' => $userRS->firstname . ' ' . $userRS->lastname,
											      'display_name' => $userRS->display_name,
											      'legal_name' => $userRS->legal_name,
											      'email' => $userRS->email,
											      'user_type'=>$userRS->user_type
										      );
										      
						     return $data_arr;
						 }
						 else
						     return false;
				}
	
			

	}
