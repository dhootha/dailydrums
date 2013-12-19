<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Landing page for the front end
 */

class Welcome extends CI_Controller {

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
        $this->load->model('Insert_data_model');

       $this->is_logged_in = $this->authmanager->is_logged_in('user');

	if( $this->is_logged_in ) {
				$user_data = $this->Fetch_data_model->fetch_user_data($this->is_logged_in['user_id']);
				if(!$user_data->city)
							$local_area = 'zip- '.$user_data->zip;
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
    public function index() {
    	
    				redirect(base_url('home'));
    				exit;
    			}
    			
    	public function main() {
    		
    			if ($this->is_logged_in['user_id']) {
		      		     $headerdata['logged_in'] = TRUE;
						  $headerdata['active_class'] = '';
						  if ($this->is_logged_in['user_type'] == 'end_user') {
						  		
						  		 $user_data = $this->Fetch_data_model->fetch_user_data($this->is_logged_in['user_id']);
						 		 $data['neighborhood_deals'] = $this->Common_model->neighborhoodDeals($user_data->lat,$user_data->long,'25');
					    		}
					    }
						else{
							  $headerdata['logged_in'] = FALSE;
							  }
							  				 
					 //echo $user_data->lat." ".$user_data->long;	  
					 $headerdata['page_title'] = 'Welcome To Daily Drums';
		
					$data['deals']                = $this->Common_model->getDeals('pro','1');  // param - '1' means In-store type camapigns
					$data['online_deals']    = $this->Common_model->getDeals('pro','3');  // param - '1' means In-store type camapigns
					$data['endsoon_deals'] = $this->Common_model->endingSoonDeals();
					$slider_deals                 = $this->Common_model->getTotalDeals();

					$rand_index  = array_rand( $slider_deals,6);
					foreach($rand_index as $index)
							$data['slider_deals'][] = $slider_deals[$index];
					
					 $this->load->view('front/common/header', $headerdata);
					 $this->load->view('front/common/menu_header', $headerdata);
					 $this->load->view('front/home',$data);
					 $this->load->view('front/common/footer'); 
    		}

	public function latest_posts(){

					if ($this->is_logged_in['user_id']) {
					      		$headerdata['logged_in'] = TRUE;
									$headerdata['active_class'] = '';
					      }
							else{
									 $headerdata['logged_in'] = FALSE;
									 $headerdata['active_class'] = '';
								  }
								  
					 $headerdata['page_title'] = 'Latest Posts';			
					 $headerdata['action_msg'] = ( $this->session->flashdata('action_msg') != '' )?$this->session->flashdata('action_msg'):'';
					
					$whr_reciews = array('r.status'=>'1');
					$data['reviews'] = $this->Fetch_data_model->fetch_user_reviews($whr_reciews);
                                         
                  		 $this->load->view('front/common/header', $headerdata);
					 $this->load->view('front/common/menu_header', $headerdata);
					 $this->load->view('front/latest_post_all',$data);
					 $this->load->view('front/common/footer');
		}
    		
    	
    	public function neighborhood() {
    		
		    		 if ($this->is_logged_in['user_id']) {
					      		$headerdata['logged_in'] = TRUE;
									$headerdata['active_class'] = 'inbox';
					      }
							else{
									 $headerdata['logged_in'] = FALSE;
									 $headerdata['active_class'] = '';
								  }
								  
					 $user_data = $this->Fetch_data_model->fetch_user_data($this->is_logged_in['user_id']);
								  
					 $headerdata['page_title'] = 'Ending soon campaigns';			
					 $headerdata['action_msg'] = ( $this->session->flashdata('action_msg') != '' )?$this->session->flashdata('action_msg'):'';
		  
		    		 $data['deals'] = $this->Common_model->neighborhoodDeals($user_data->lat,$user_data->long,'25');	// $category_slug for value to searc and $search_for for searching fields
                                         
                  		 $this->load->view('front/common/header', $headerdata);
					 $this->load->view('front/common/menu_header', $headerdata);
					 $this->load->view('front/neighborhood_all',$data);
					 $this->load->view('front/common/footer');
     		}
    		
    	public function ending_soon() {
    		
		    		 if ($this->is_logged_in['user_id']) {
					      		$headerdata['logged_in'] = TRUE;
									$headerdata['active_class'] = 'inbox';
					      }
							else{
									 $headerdata['logged_in'] = FALSE;
									 $headerdata['active_class'] = '';
								  }
								  
					 $headerdata['page_title'] = 'Ending soon campaigns';			
					 $headerdata['action_msg'] = ( $this->session->flashdata('action_msg') != '' )?$this->session->flashdata('action_msg'):'';
		  
		    		 $data['deals'] = $this->Common_model->endingSoonDeals();	// $category_slug for value to searc and $search_for for searching fields
                                         
                  $this->load->view('front/common/header', $headerdata);
					 $this->load->view('front/common/menu_header', $headerdata);
					 $this->load->view('front/ending_soon_all',$data);
					 $this->load->view('front/common/footer');
     		}
     		
     		
     	public function online_stores() {
    		
		    		 if ($this->is_logged_in['user_id']) {
					      		$headerdata['logged_in'] = TRUE;
									$headerdata['active_class'] = 'inbox';
					      }
							else{
									 $headerdata['logged_in'] = FALSE;
									 $headerdata['active_class'] = '';
								  }
								
					$headerdata['action_msg'] = ( $this->session->flashdata('action_msg') != '' )?$this->session->flashdata('action_msg'):'';
		    		$category_slug='';
		    		$search_for = '';
		    		
		    		if( ($this->uri->segment(3) == 'category') && ($this->uri->segment(4) != '') ) {			//---- For category wise search
			    				$category_slug = str_replace('%20','-',$this->uri->segment(4));
			    				//$category_slug = str_replace((/[`~!@#$%^&*()|+\_\s+=?;:'",.<>\{\}\[\]\\\/]/gi), '',$category_slug);
			    				//echo $category_slug = preg_replace("/[^A-Za-z0-9 ]/", '',$category_slug); exit;
			    				$search_for = 'category';
                                }
               if( ($this->uri->segment(3) == 'search') && ($this->uri->segment(4) != '') ) { 			//---- For search all
			    				$category_slug = str_replace('%20','-',$this->uri->segment(4));
			    				//$category_slug = str_replace(/[`~!@#$%^&*()|+\_\s+=?;:'",.<>\{\}\[\]\\\/]/gi, '',$category_slug);//.replace( /\-+/g, ' ' );
			    				//echo $category_slug = preg_replace("/[^A-Za-z0-9 ]/", '',$category_slug); exit;
			    				$search_for = 'all';
                                }
		    		 $data['deals'] = $this->Common_model->getTotalDeals('',$category_slug,$search_for,'pro','3');	// $category_slug for value to searc and $search_for for searching fields
                                         
                $this->load->view('front/common/header', $headerdata);
					 $this->load->view('front/common/menu_header', $headerdata);
					 $this->load->view('front/online_stores_all',$data);
					 $this->load->view('front/common/footer');
     		}
    	
    	public function deals() {
    		
		    		 if ($this->is_logged_in['user_id']) {
					      		$headerdata['logged_in'] = TRUE;
									$headerdata['active_class'] = 'myaccount';
					      }
							else{
									 $headerdata['logged_in'] = FALSE;
									 $headerdata['active_class'] = '';
								  }
								
					$headerdata['action_msg'] = ( $this->session->flashdata('action_msg') != '' )?$this->session->flashdata('action_msg'):'';
		    		$category_slug='';
		    		$search_for = '';
		    		
		    		if( ($this->uri->segment(3) == 'category') && ($this->uri->segment(4) != '') ) {			//---- For category wise search
			    				$category_slug = str_replace('%20','-',$this->uri->segment(4));
			    				//$category_slug = str_replace((/[`~!@#$%^&*()|+\_\s+=?;:'",.<>\{\}\[\]\\\/]/gi), '',$category_slug);
			    				//echo $category_slug = preg_replace("/[^A-Za-z0-9 ]/", '',$category_slug); exit;
			    				$search_for = 'category';
                                }
               if( ($this->uri->segment(3) == 'search') && ($this->uri->segment(4) != '') ) { 			//---- For search all
			    				$category_slug = str_replace('%20','-',$this->uri->segment(4));
			    				//$category_slug = str_replace(/[`~!@#$%^&*()|+\_\s+=?;:'",.<>\{\}\[\]\\\/]/gi, '',$category_slug);//.replace( /\-+/g, ' ' );
			    				//echo $category_slug = preg_replace("/[^A-Za-z0-9 ]/", '',$category_slug); exit;
			    				$search_for = 'all';
                                }
		    		 $data['deals'] = $this->Common_model->getTotalDeals('',$category_slug,$search_for,'pro','1');	// $category_slug for value to searc and $search_for for searching fields
                                         
                $this->load->view('front/common/header', $headerdata);
					 $this->load->view('front/common/menu_header', $headerdata);
					 $this->load->view('front/deals',$data);
					 $this->load->view('front/common/footer');
     		}
     		
     		
     		
     		public function pricing() {
     					 $this->load->view('front/common/header');
						 $this->load->view('front/pricing');
						 $this->load->view('front/common/footer');
     			}
     			
     		public function proceed_basic_register() {
     					 $this->load->view('front/common/header');
						 $this->load->view('front/business_basic_proceed_register');
						 $this->load->view('front/common/footer');
     			}
     		
     		public function proceed_pro_register() {
     			
     					 $headerdata['plans'] = $this->Common_model->get_plan_list();
     					 //echo "<pre>"; print_r($plans);exit;
     					 $this->load->view('front/common/header');
						 $this->load->view('front/business_pro_proceed_register',$headerdata);
						 $this->load->view('front/common/footer');
     			}
    	
  			public function contact_us() {
				  				if ($this->is_logged_in['user_id']) {
							      		$headerdata['logged_in'] = TRUE;
											$headerdata['active_class'] = '';
									    }
										else{
												 $headerdata['logged_in'] = FALSE;
											}
								 $headerdata['page_title'] = 'Contact Us';
								 $this->load->view('front/common/header', $headerdata);
								 $this->load->view('front/common/menu_header', $headerdata);
								 $this->load->view('front/contact_us');
								 $this->load->view('front/common/footer');
								 }
		
	public function contactus_submit() {
												$this->form_validation->set_rules('u_name', 'User Name', 'trim|required|max_length[56]|xss_clean');
												$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|email');
												$this->form_validation->set_rules('message', 'Message', 'trim|required|max_length[255]|xss_clean');
												
												$this->form_validation->set_error_delimiters('* ', '');
												
												if($this->form_validation->run() == FALSE) {
															$this->contact_us();
														}
														else{
																if($this->Common_model->save_contact_user()){
																		$this->session->set_flashdata('action','1');
																		$this->session->set_flashdata('action_msg','Thank you for contact us. We will get back to you soon.');
																		}		
																		else{
																				$this->session->set_flashdata('action','0');
																				$this->session->set_flashdata('action_msg','Sorry, failed to upload your details');
																				}	
																redirect(base_url('welcome/contact_us'));
																exit;											
												}
		}
		
	public function thank_you(){
		
			 if ($this->is_logged_in['user_id']) {
					      		$headerdata['logged_in'] = TRUE;
									$headerdata['active_class'] = '';
							    }
								else{
										 $headerdata['logged_in'] = FALSE;
									  }
			 $pro_user_id = $this->session->userdata('pro_user_id');	
			 				  
			 if($pro_user_id){
						 $msg = "You have successfully registered in Daily Drums, a mail has been forwarded to you with your payment details. Please click on the provided activation link to activate your account";
						 
			 			 $headerdata['success_msg'] = $msg;
						 $headerdata['page_title'] = 'Thank you';
						 $this->load->view('front/common/header', $headerdata);
						 $this->load->view('front/common/menu_header', $headerdata);
						 $this->load->view('front/thank_you',$headerdata);
						 $this->load->view('front/common/footer');
						 }
						 else{
						 		redirect(base_url('user'));
						 		}
			 }

   public function settings() {
   	
	       if (!$this->is_logged_in['user_id'])
		  	 		redirect(site_url());
		       
			 $headerdata['page_title'] = 'Settings';
			 $this->load->view('front/common/header', $headerdata);
			 $this->load->view('front/user/settings_view');
			 $this->load->view('front/common/footer');
    }

	public function fetch_country_list() {
						$data = $this->Common_model->get_countries();
						for($countries='',$i=0;$i<count($data);$i++){
								$countries .= "<option value='".$data[$i]->id."'>".$data[$i]->country_name."</option>";
							}
						echo json_encode($countries);
						exit;
		}
		
		
	public function location_suggestion() {
		
				$query = $this->input->get('term');
				$val = $this->Common_model->getLocations($query);
				
				echo json_encode($val);
				exit;
		}
		
   public function suscribeDeal(){
           extract($_POST);
           if($status=='un'){
           		/* if(isset($action_on) && $action_on != '')
           		 		$data['store_id'] = $action_on;
           		 		else*/
                			$data['deal_id'] = $deal_id;
                			
                $data['user_id'] = $this->is_logged_in['user_id'];
                
                $this->Common_model->deleteSubscription($data);
                echo "Subscribe";
           }
           else {
                $data['deal_id'] = $deal_id;
                $data['user_id'] = $this->is_logged_in['user_id'];
                $data['status'] = '1';
                $this->Common_model->insertSubscription($data);
                echo "Unsubscribe";
           }
       }     
       
    public function suscribeStore(){
           extract($_POST);
           if($status=='un'){
           		 $data['store_id'] = $store_id;
                $data['user_id'] = $this->is_logged_in['user_id'];
                $this->Common_model->deleteStoreMap($data);
                echo "Subscribe";
           }
           else {
                $data['store_id'] = $store_id;
                $data['user_id'] = $this->is_logged_in['user_id'];
                $this->Common_model->insertStoreMap($data);
                echo "Unsubscribe";
           }
       }    
      
    public function dealDetails($dealId) {
                    if ($this->is_logged_in['user_id']) {
					      		$headerdata['logged_in'] = TRUE;
									$headerdata['active_class'] = '';
							    }
								else{
										 $headerdata['logged_in'] = FALSE;
									  }
                    $dealDetails = $this->Common_model->dealDetails($dealId);

                    if(!empty($dealDetails)) {
	                       $dealDetails = $dealDetails[0];
                    		}
                   
                    $data['dealDetails'] = $dealDetails;
                    $headerdata['page_title'] = 'Welcome To Daily Drums';

						$whr_reciews = array('r.deal_id'=>$dealId,'r.status'=>'1');
                    		$data['reviews'] = $this->Fetch_data_model->fetch_user_reviews($whr_reciews);
						 $data['deals'] = $this->Common_model->getDeals();		
						 	 
						 $this->load->view('front/common/header', $headerdata);
						 $this->load->view('front/common/menu_header', $headerdata);
						 $this->load->view('front/deal_details', $data); 
						 $this->load->view('front/common/footer');
             }   

	public function save_review(){

			if (!($id = $this->is_logged_in['user_id'])) {
					      			 redirect(base_url());
									 exit;
									  }
	
			if(isset($_POST['deal_id'])){
				
				$this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[255]|xss_clean');
				$this->form_validation->set_rules('comment', 'Comment', 'trim|required|xss_clean');
				$this->form_validation->set_rules('deal_id', 'Deal Id', 'trim|required|xss_clean|numeric');
				
				$this->form_validation->set_error_delimiters('* ', '');
				
				if($this->form_validation->run() == FALSE) {
							$this->dealDetails($this->input->post('deal_id'));
						}
						else{
								$deal_details = $this->Common_model->dealDetails(trim($this->input->post('deal_id')));
								$data_array = array('title'=>$this->input->post('title'),
															'comment'=>$this->input->post('comment'),
															'deal_id'=>trim($this->input->post('deal_id')),
															'user_id'=>$id,
															'store_id'=>$deal_details[0]->store_id);
								if($this->Insert_data_model->save_review($data_array)){
											$this->session->set_flashdata('action_msg',"Yor review has been posted successfully.");
											$this->session->set_flashdata('action',"1");
											redirect(base_url('welcome/dealDetails/'.$this->input->post('deal_id')));
									}
									else{
											$this->session->set_flashdata('action_msg',"Falied to post your review.");
											$this->session->set_flashdata('action',"0");
											redirect(base_url('welcome/dealDetails/'.$this->input->post('deal_id')));
										  }
							}
			}
			else{
					redirect(base_url());
					exit;
				  }
		}

	public function report_deal(){
			
			if (!($id = $this->is_logged_in['user_id'])) {
					      			 redirect(base_url());
									 exit;
									  }
			$report_arr = array('deal_id'=>trim($this->uri->segment(4)),
									    'user_id'=>$id,
									    'report_type'=>trim($this->uri->segment(3))
										);
			
			if($this->Insert_data_model->report_deal($report_arr)){
				$this->session->set_flashdata('ret_msg',"This campaign is marked as a ".trim($this->uri->segment(3)));
				$this->session->set_flashdata('ret_action',"1");
				redirect(base_url('welcome/dealDetails/'.$this->uri->segment(4)));
				exit;
				}
				else{ 
						$this->session->set_flashdata('ret_msg',"Falied to mark this campaign.");
						$this->session->set_flashdata('ret_action',"0");
						redirect(base_url('welcome/dealDetails/'.$this->uri->segment(4)));
						exit;
					  }
		}
             
     public function clip_campaign_by_url(){
     	
     		$deal_id = $this->uri->segment(3);
     		if($deal_id != ''){
     				 $data['deal_id'] = $deal_id;
                $data['user_id'] = $this->is_logged_in['user_id'];
                if( $this->Common_model->insertClip($data))
                		$this->session->set_flashdata('action_msg',"Successfully added in your clip list.");
                		else
			     				  $this->session->set_flashdata('action_msg',"Falied to subscribe.");
     			} 
     			else{
     					$this->session->set_flashdata('action_msg',"Falied to subscribe.");
     				   }
     			redirect(base_url('user/my_clips'));
     		}
             
               
             
     public function clip_campaign($clip_id = ''){
           
           extract($_POST);
           if($status=='un'){
           		/* if(isset($action_on) && $action_on != '')
           		 		$data['store_id'] = $action_on;
           		 		else*/
                $data['clip_id'] = $clip_id;
                $data['user_id'] = $this->is_logged_in['user_id'];
                
                $this->Common_model->deleteClip($data);
                echo "Subscribe";
           }
           else {
                $data['deal_id'] = $deal_id;
                $data['user_id'] = $this->is_logged_in['user_id'];
                //$data['status'] = '1';
                $this->Common_model->insertClip($data);
                echo "Unsubscribe";
           }
       }  
                    
}
?>
