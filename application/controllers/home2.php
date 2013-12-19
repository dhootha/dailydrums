<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Landing page for the front end
 */

class Home extends CI_Controller {

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
        
        $this->is_logged_in = $this->authmanager->is_logged_in('user');
        
        if( $this->is_logged_in ) {

			$user_data = $this->Fetch_data_model->fetch_user_data($this->is_logged_in['user_id']);
			$local_area = $user_data->city.", ".$user_data->state;

			if( strlen($local_area) > 23 ) {

				$local_area = substr( $local_area,0,20 )."...";
				}
			
			$this->user_type = $this->is_logged_in['user_type'];
			$this->local_area = $local_area;
		}
    }

    /**
     * Index Page for this controller.
     */
    public function index() {

        if ($this->is_logged_in['user_id']) {
            redirect(site_url('user/profile'));
        }
        
        $headerdata['page_title'] = 'Welcome To Dailydrums';
     //   $headerdata['countryList'] = $this->Common_model->get_countries();
        
        $this->load->view('front/common/header', $headerdata);
        $this->load->view('front/common/menu_header', $headerdata);
        $this->load->view('front/account_view');
        $this->load->view('front/common/footer');
    }

    public function settings()
    {
      if (!$this->is_logged_in['user_id'])
          redirect(site_url());
              
        $headerdata['page_title'] = 'Settings';
        $this->load->view('front/common/header', $headerdata);
        $this->load->view('front/user/settings_view');
        $this->load->view('front/common/footer');
         
    }

}
