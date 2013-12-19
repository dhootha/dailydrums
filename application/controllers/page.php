<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Landing page for the front end
 */

class Page extends CI_Controller {

    public  $is_logged_in;
    public  $user_session_id = 'user';
    private $secret_key = 'useriddailydrums';
    public $local_area = '';
    public $user_type = '';
    

    public function __construct() {
        
        parent::__construct();
    
		  $this->load->library('session');
        $this->load->library('authmanager'); 
        $this->load->model('Common_model');
	 	  $this->load->model('Fetch_data_model');
        
       $this->is_logged_in = $this->authmanager->is_logged_in('user');

	if( $this->is_logged_in ) {
				$user_data = $this->Fetch_data_model->fetch_user_data($this->is_logged_in['user_id']);
				if(!$user_data->city)
							$local_area = 'zip: '.$user_data->zip;
						else
							 $local_area = $user_data->city.", ".$user_data->state;
	
				if( strlen($local_area) > 23 ) {
						$local_area = substr( $local_area,0,20 )."...";
						}
					
				$this->local_area = $local_area;
				$this->user_type = $this->is_logged_in['user_type'];
			}
    }

    /**
     * Index Page for this controller.
     */
    public function index($id) {
    			echo $id;
    					//redirect(base_url());
    				}
    				
    public function id(){
    	
    		if ($this->is_logged_in['user_id']) {
					      		$headerdata['logged_in'] = TRUE;
									$headerdata['active_class'] = 'myaccount';
					      }
							else{
									 $headerdata['logged_in'] = FALSE;
									 $headerdata['active_class'] = '';
								  }
    	
    		$page_id =  $this->uri->segment(3);
    		$static_data = $this->Common_model->fetch_static_page($page_id);
    		if($static_data != false){
    					$headerdata['static_data'] = $static_data;
    			}
    			
    		$this->load->view('front/common/header', $headerdata);
			$this->load->view('front/common/menu_header', $headerdata);
			$this->load->view('front/static_page');
			$this->load->view('front/common/footer');
    	}
    			
    	  
}
?>
