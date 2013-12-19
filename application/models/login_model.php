<?php

/**
 * This class will be used for generic functions in frontsection
 * For eg: validate login
 */
class Login_model extends CI_Model {

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

			public function authinticate_login() {

					$email = $this->input->post('daily_drums_user_id');
					$pwd   = md5( $this->input->post('daily_drums_password') );
		
					$this->db->select("u.id, u.email, u.user_type, up.firstname, up.lastname,up.legal_name,up.business_email,up.display_name");
					$this->db->from('user u');
					$this->db->join('user_profile up', 'up.user_id=u.id');
					$where_array = array(
										     'u.email' => $email,
										     'u.password' => $pwd,
										     'u.status' => '1'
										 );
					 $this->db->where($where_array);

					 $qry = $this->db->get();
					 $userRS = $qry->row(); 
					 $userNR = $qry->num_rows();

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
