<?php

/**
 * This class will be used for generic functions in admin section
 * For eg: delete records, status update, status show etc.
 */
class Registration_model extends CI_Model {

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

    public  function register_business_basic() {
			
					$name 				    = $this->input->post('name');
					$email 				    = $this->input->post('email');
					$password 			    = md5($this->input->post('password'));
					$business_name  	    = $this->input->post('business_name');
					$business_email  	    = $this->input->post('business_email');
					$display_name 		    = $this->input->post('display_name');
					$address_line_1 		 = $this->input->post('address_line_1');
					$address_line_2 		 = $this->input->post('address_line_2');
					$city 				    = $this->input->post('city');
					$zip 				    	 = trim($this->input->post('zip'));
					$state 				    = $this->input->post('state');
					$country 			    = $this->input->post('country');
					$phone_primary 		 = $this->input->post('phone_primary');
					$card_name 		    	 = $this->input->post('card_name');
					$card_number 		    = $this->input->post('card_number');
					$security_code 		 = $this->input->post('security_code');
					
					$first_name = trim(substr($name,0,strpos($name,' ')));
					$last_name  = trim(substr($name,strpos($name,' ')));
		
					$user_data = array('email'=>$email ,
									    	 'password'=>$password);
		
					$this->db->insert('user',$user_data);
					$inserted_user_id = $this->db->insert_id();
		
					$user_profile_data = array('user_id'=>$inserted_user_id,
													   'firstname'=>$first_name,
													    'lastname'=>$last_name,
													    'address_one'=>$address_line_1,
													    'address_two'=>$address_line_2,
													    'city'=>$city,
													    'state'=>$state,
													    'country_id'=>$country,
													    'legal_name'=>$business_name,
													    'business_email'=>$business_email,
													    'zip'=>$zip ,
													    'display_name'=>$display_name ,
													    'primary_phone'=>$phone_primary );
													    
					$this->load->model('Common_model');
		    		$r = $this->Common_model->fetchLatLong($zip);
					if(!empty($r)){
						$user_profile_data['lat'] = $r['lat'];
						$user_profile_data['long'] = $r['long'];
						}
			
					$this->db->insert('user_profile',$user_profile_data);
		
					$credit_card_data = array('user_id'=>$inserted_user_id,
									        	  'card_name'=>$card_name,
											  'cc_number'=>$card_number,
											  'security_code'=>$security_code);
											  
					$this->db->insert('credit_card_details',$credit_card_data);
					return $inserted_user_id ;			
					}


	public function activate_link($id) {
					
					$this->db->select('user.*');
					$this->db->where('md5(email)',$id);
					$this->db->from('user');
					$qry = $this->db->get();
					$user = $qry->row(); 
//print_r($user);die();
					if(!empty($user)){
					
							if($user->user_type == 'end_user'){
								$dataArray = array('status'=>'1');
								
								/* update blog table*/
								$stat_sql2 = "update `wp_usercontrol` set `disable_status`='enabled' where `ID`=".$user->blog_id;
								$query2 =$this->db->query($stat_sql2);
								/* update blog table*/
								}
								else{
										$dataArray = array('status'=>'2');
										}
								
							$this->db->where('md5(email)',$id);
							$this->db->update('user',$dataArray);
							if( $this->db->affected_rows() )
								return $user->user_type;
								else 
									return false;
							}
							else{
									return false;
									}
					}
		
	public function transaction_entry($transaction_data){
					$this->db->insert('transacation_history',$transaction_data);
					
					if( $this->db->insert_id() )
						return true;
						else 
							return false;
					}
		
	public function register_end_user() {
			
			$first_name 		    = $this->input->post('first_name');
			$last_name 			    = $this->input->post('last_name');
			$email 				    = $this->input->post('email');
			$password 			    = md5($this->input->post('password'));
			$display_name 		    = $this->input->post('display_name');
			$zip 				    	 = $this->input->post('zip');
			$phone		    		 = $this->input->post('phone');
			$gender					 = $this->input->post('gender');

			$user_data = array('email'=>$email ,
							    'password'=>$password,
							    'user_type'=>'end_user');

			$this->db->insert('user',$user_data);
			$inserted_user_id = $this->db->insert_id();

			$user_profile_data = array('user_id'=>$inserted_user_id,
									   'firstname'=>$first_name,
									    'lastname'=>$last_name,
									    'zip'=>$zip ,
									    'display_name'=>$display_name ,
									    'primary_phone'=>$phone,
									    'gender'=>$gender
									     );
									     
			$this->load->model('Common_model');
    		$r = $this->Common_model->fetchLatLong($zip);
			if(!empty($r)){
				$user_profile_data['lat'] = $r['lat'];
				$user_profile_data['long'] = $r['long'];
			}
	
			$this->db->insert('user_profile',$user_profile_data);
			
			
			/*insert data into blog*/
			$names = $first_name.' '.$last_name;
			$insert_sql = "insert into `wp_users` set ".
						  "`user_login`='".$email."',".
						  "`user_email`='".$email."',".
						  "`user_nicename`='".str_replace(' ','',$first_name)."',".
						  "`user_pass`='".$password."',".
						  "`user_registered`=NOW(),".
						  "`display_name`='".str_replace(' ','',$names)."'";
						
			$query =$this->db->query($insert_sql);
			$insert_id_blog = $this->db->insert_id();
			
	
			$this->db->query("insert into `wp_usermeta` set `meta_key`='first_name', `meta_value`='".$first_name."',`user_id`=".$insert_id_blog);
			$this->db->query("insert into `wp_usermeta` set `meta_key`='last_name', `meta_value`='".$last_name."',`user_id`=".$insert_id_blog);
			$this->db->query("insert into `wp_usermeta` set `meta_key`='nickname', `meta_value`='".str_replace(' ','',$names)."',`user_id`=".$insert_id_blog);
			$this->db->query("insert into `wp_usermeta` set `meta_key`='description', `meta_value`='',`user_id`=".$insert_id_blog);
			$this->db->query("insert into `wp_usermeta` set `meta_key`='rich_editing', `meta_value`='true',`user_id`=".$insert_id_blog);
			$this->db->query("insert into `wp_usermeta` set `meta_key`='comment_shortcuts', `meta_value`='false',`user_id`=".$insert_id_blog);
			$this->db->query("insert into `wp_usermeta` set `meta_key`='admin_color', `meta_value`='fresh',`user_id`=".$insert_id_blog);
			$this->db->query("insert into `wp_usermeta` set `meta_key`='use_ssl', `meta_value`='0',`user_id`=".$insert_id_blog);
			$this->db->query("insert into `wp_usermeta` set `meta_key`='show_admin_bar_front', `meta_value`='true',`user_id`=".$insert_id_blog);
			$this->db->query("insert into `wp_usermeta` set `meta_key`='wp_capabilities', `meta_value`='a:1:{s:10:\"subscriber\"\;b:1\;}',`user_id`=".$insert_id_blog);
			$this->db->query("insert into `wp_usermeta` set `meta_key`='wp_user_level', `meta_value`='0',`user_id`=".$insert_id_blog);
			$this->db->query("insert into `wp_usermeta` set `meta_key`='default_password_nag', `meta_value`='',`user_id`=".$insert_id_blog);
						
			$insert_sql1 = "insert into `wp_usercontrol` set ".
						  "`user_login`='".$email."',".
						  "`user_email`='".$email."',".
						  "`user_nicename`='".str_replace(' ','',$names)."',".
						  "`ID`='".$insert_id_blog."',".
						  "`role`='subscriber',".
						  "`disable_status`='disabled'";
						
			$query1 =$this->db->query($insert_sql1);
			
			$update_sql = "update `user` set `blog_id`='".$insert_id_blog."' where `id`=".$inserted_user_id;		
			$this->db->query($update_sql);
			
			/*insert data into blog*/

			return $inserted_user_id ;			
	}
	
	public function update_pro_data($user_id,$data = array()){				// after pay update business to pro
    		
    				//$dataArray = array('status'=>'2');
					$this->db->where('id',$user_id);
					$this->db->update('user',$data);
					return $this->db->affected_rows();
    				}
		

		
		 

   /* public function fetch_all_comments($pk_id, $table_name = 'ask_me') {

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
    }*/

}
