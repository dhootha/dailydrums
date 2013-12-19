<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public $is_logged_in;
    public $my_account_model;

    public function __construct() {
        parent::__construct();
        $this->load->library('utils');
        $this->load->library('authmanager');

        $this->is_logged_in = $this->authmanager->is_logged_in();
        $this->load->model('Common_model');
        $this->load->model('admin/Admin_my_account_model');
        $this->my_account_model = $this->Admin_my_account_model;
    }

    public function index() {

        if (!$this->is_logged_in) {
            redirect('admin/welcome/login');
        }
        $this->load->view('admin/dashboard_view');    //$session_id = $this->session->all_userdata();
    }

    /**
     * Login function for admin
     */
    public function login() {
        if ($this->is_logged_in) {
            redirect('admin/welcome/');
        }
        $data = '';
        if (isset($_POST) && !empty($_POST)) {
            $this->load->model('admin/Login_model');
            $validAdminRs = $this->Login_model->validate_login();

            if ($validAdminRs) {
                $validAdminRs = $validAdminRs[0];
                $data['admin']['admin_username'] = $validAdminRs->username;
                $data['admin']['admin_login_id'] = $validAdminRs->id;
                $data['admin']['admin_email'] = $validAdminRs->email;
                $data['admin']['admin_display_name'] = $validAdminRs->display_name;
                $this->session->set_userdata($data);
                $this->session->set_flashdata('info_message', 'Successfully logged in');
                redirect('admin/welcome/index');
            } else {
                //IF no validation error found but db username mismatch 
                if (validation_errors() == '' && $validAdminRs == false) {
                    $this->session->set_flashdata('login_error', 'Invalid username/password');
                    redirect('admin/welcome/login');
                }
            }
        }
        $this->load->view('admin/login_view');
    }

    public function forgetpassword() {
        $data = '';
        if (isset($_POST) && !empty($_POST)) {
            $userName = addslashes($this->input->post('username', TRUE));
            $this->form_validation->set_rules('username', 'Username', 'required');
            if ($this->form_validation->run() != FALSE) {

                $tablename = 'admin_user';
                $wherearray = array('username' => $userName);
                $validAdminRs = $this->Common_model->forgetpassword_check_valid_user($tablename, $wherearray);

                if ($validAdminRs) {
                    $data['message'] = $validAdminRs;
                    $data['resetpasswordurl'] = base_url('admin/welcome/resetpassword/' . urlencode($this->utils->encode_string($validAdminRs[0]->username)));

                    //email fielda
                    $to = $validAdminRs[0]->email;
                    $subject = 'Reset password link request';
                    $fromemail = 'noreply@brainyax.com';
                    $fromname = 'Brainyax';
                    $msg = $this->load->view('email_templates/user_forgot_template', $data, TRUE);
                    
                    $this->utils->send_email($to, $subject, $msg, $fromemail, $fromname);
                    $this->session->set_flashdata('info_message', 'Check your given mailid for the new password.');
                    redirect('admin/welcome/login');
                    exit;
                } else {
                    //IF no validation error found but db username mismatch 
                    if (validation_errors() == '' && $validAdminRs == false) {
                        $this->session->set_flashdata('login_error', 'Invalid username');
                        redirect('admin/welcome/forgetpassword');
                        exit;
                    }
                }
            }
        }
        $this->load->view('admin/forgetpassword_view');
    }

    /**
     * Logout function for admin
     */
    public function logout() {
        $this->session->unset_userdata('admin');
        $this->session->set_flashdata('login_error', 'You have been successfully logged out');
        redirect('admin/welcome/login');
        exit;
    }

    /**
     * Add my account section to change admin details
     */
    public function my_account() {

        $loggedin_data = $this->session->userdata('admin');

        $admin_user_id = $loggedin_data['admin_login_id'];

        $my_ac_details_RS = $this->my_account_model->get_admin_details($admin_user_id);

        if ($my_ac_details_RS == false) {
            $this->session->set_flashdata('login_error', 'Please login and try again.');
            redirect('admin/welcome/login');
        }

        $data['account_details'] = $my_ac_details_RS[0];

        if (isset($_POST['page_action']) && !empty($_POST['page_action'])) {

            $this->form_validation->set_rules('username', 'Username', 'required|trim');
            $this->form_validation->set_rules('display_name', 'Display name', 'required|trim');
            if (!empty($_POST['email']))
                $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|trim');

            if (!empty($_POST['new_password'])) {
                $this->form_validation->set_rules('new_password', 'Password', 'required|trim|min_length[6]');
                $this->form_validation->set_rules('passconf', 'Confirm password', 'required|trim');
            }

            if ($this->form_validation->run() != FALSE) {
                $this->my_account_model->update_account_details($admin_user_id, $_POST);

                $data['admin']['admin_username'] = $my_ac_details_RS[0]->username;
                $data['admin']['admin_login_id'] = $my_ac_details_RS[0]->id;
                $data['admin']['admin_email'] = $_POST['email'];
                $data['admin']['admin_display_name'] = $_POST['display_name'];
                $this->session->set_userdata($data);

                $this->session->set_flashdata('info_message', 'Updated successfully.');
                redirect('admin/welcome/my_account');
                exit();
            }
            else
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        }

        $this->load->view('admin/my_account/my_account_view', $data);
    }

    public function resetpassword() {

        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password1', 'Password', 'required|matches[password2]');
            $this->form_validation->set_rules('password2', 'Password Confirmation', 'required');
            if ($this->form_validation->run() != FALSE) {

                $tablename = 'admin_user';
                $email = $this->input->post('email');
                $password = $this->input->post('password1');

                $wherearray = array('email' => $email);
                $updatefieldarray = array('password' => md5($password));

                $validAdminRs = $this->Common_model->forgetpassword_check_valid_user($tablename, $wherearray);
                if ($validAdminRs) {
                    $updatepassword = $this->Common_model->reset_password($tablename, $wherearray, $updatefieldarray);
                    if ($updatepassword) {

                        $to = $validAdminRs[0]->email;
                        $subject = 'Your password modified';
                        $fromemail = 'noreply@brainyax.com';
                        $fromname = 'Brainyax';
                        $msg = "<p>Hello Admin, <br><br>Your password modified recently. " . date('d M Y H:i:s') . "</p><p>From <br> Brainyax Webteam</p>";
                        $this->utils->send_email($to, $subject, $msg, $fromemail, $fromname);
                        $this->session->set_flashdata('info_message', 'Password successfully updated.');
                        redirect('admin/welcome/login');
                        exit;
                    } else {
                        $this->session->set_flashdata('login_error', 'Not a valid user.');
                        redirect('admin/welcome/login');
                        exit;
                    }
                } else {
                    $this->session->set_flashdata('login_error', 'Not a valid user.');
                    redirect('admin/welcome/login');
                    exit;
                }
            }
        }
        $this->load->view('admin/resetpassword_view');
    }

}

