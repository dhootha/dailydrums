<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

class Static_pages extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     */
    public $is_logged_in;
    public $pageName;
    
    public function __construct() {
        parent::__construct();
         
        $this->load->library('authmanager'); ////$session_id = $this->session->all_userdata();
        $this->is_logged_in = $this->authmanager->is_logged_in();
        
        if(!$this->is_logged_in){
            redirect('admin/welcome/login');            
        }
        $this->load->model('admin/Static_page_model');
        $this->load->model('Common_model');
        $this->pageName = 'Manage Static Pages';
        
    }
    
    /**
     * Index redirecting to home()
     * @param type $method
     */
    public function index() {
         $this->home();        
    }
    
    /**
     * Default controller home
     */
    public function home() {
        $data['pageName'] = $this->pageName;
        $statcPagesRS = $this->Static_page_model->get_static_pages();
        $data['statcPagesRS'] = $statcPagesRS;
        $this->load->view('admin/static_pages/listing_view', $data);    
    }
    
    
    /**
     * Adding static page from admin end
     */
    public function add_page() {
        $data['pageName'] = $this->pageName . ' : Add Page';
        
        if(isset($_POST['page_action']) && !empty($_POST['page_action'])){
            
            $isPageAdded = $this->Static_page_model->insert_page();
            
            if(!$isPageAdded) {
                $this->session->set_flashdata('info_message', '<span class="error-alert">Unable to add the record</span>');
            }
            else{
                $this->session->set_flashdata('info_message', 'Record added successfull!');
                redirect('admin/static_pages/home', "location");
            }
        }
        $this->load->view('admin/static_pages/add_view', $data);    
    }

    
    
    /**
     * Show details page
     */
    public function view() {
        $get = $this->uri->uri_to_assoc();
        if(!isset($get['id'])){
            echo '<h5>Error in page. Please try again later.</h5>';
            exit();
        }
        
        $page_id = $get['id'];
        $where_clause = array('page_id' => $page_id);
        $statcPagesRS = $this->Static_page_model->get_static_pages($where_clause);

        if(!$statcPagesRS) {
            echo '<h5>No records found..</h5>';
            exit();
        }
        $page = $statcPagesRS[0];

        $data['page'] = $page;

        $this->load->view('admin/static_pages/view_details', $data);    
        
        
    }
 
    
    /**
     *  Editing the content of the pages
     */
    public function edit_page() {
        $data['pageName'] = $this->pageName . ' : Edit Page';
        $get = $this->uri->uri_to_assoc();
        
        //If no id found
        if(!isset($get['id'])){
            $this->session->set_flashdata('info_message', '<span class="error-alert">No content found</span>');
            redirect('admin/static_pages/home', "location");
            exit();
        }
        
        $page_id = $get['id'];
        $where_clause = array('page_id' => $page_id);
        $statcPagesRS = $this->Static_page_model->get_static_pages($where_clause);

        if (!$statcPagesRS) {
            $this->session->set_flashdata('info_message', '<span class="error-alert">Content not available. Please try again later.</span>');
            redirect('admin/static_pages/home', "location");
            exit();
        }
        
        $page = $statcPagesRS[0];
        $data['page'] = $page;
        
        //After posting save data
        if(isset($_POST['page_id']) && !empty($_POST['page_id'])) {
            $pst_page_id =  addslashes($_POST['page_id']);
            $isPageAdded = $this->Static_page_model->update_page($pst_page_id);
            if(!$isPageAdded) {
                $this->session->set_flashdata('info_message', '<span class="error-alert">Unable to update the record</span>');
            }
            else{
                $this->session->set_flashdata('info_message', 'Record updated successfull!');
                redirect('admin/static_pages/home', "location");
            }
        }
        $this->load->view('admin/static_pages/edit_view', $data);    
    }
    
    
    
    function delete() {
        $get = $this->uri->uri_to_assoc();

        //If no id found
        if (!isset($get['id'])) {
            $this->session->set_flashdata('info_message', '<span class="error-alert">Sorry unable to perform the task</span>');
            redirect('admin/static_pages/home', "location");
            exit();
        }
        $id = addslashes($get['id']);
        $idName = 'page_id';
        $tableName= $this->Static_page_model->static_table;
        $isDelete = $this->Common_model->delete_records($tableName, $idName, $id);
        if($isDelete){
             $this->session->set_flashdata('info_message', 'Records delete successfully');
        }
        else{
             $this->session->set_flashdata('info_message', '<span class="error-alert">Sorry unable to perform the task</span>');
        }
        redirect('admin/static_pages/home', "location");
        exit();
    }

}

 