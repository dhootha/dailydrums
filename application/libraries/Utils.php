<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Utils {

    public $ci;

    public function __construct() {
        $this->ci = & get_instance();
        
        $this->ci->load->library('email');
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->ci->email->initialize($config);
        
        
        //$GET_profile_user = $this->ci->uri->uri_to_assoc(1); 
        //print_r($GET_profile_user);die;
    }

    /**
     * @param type $dataArray = 
     *  array('to'=>'to@mail.com', 
     *        'from'=>'frm@mail.com',
     *        'subject'=>'Sample Subject',
     *        'mailbody'=>'Sample messag body'
     *  )
     */
    public function send_email($to,$subject='',$mailbody='',$from='webmaster@brainyax.com',$from_name='Brainyax') {

        if (!empty($to) && !empty($mailbody)) {
            $admin_email = $this->ci->config->item('admin_email');
            $this->ci->email->from($from, $from_name);
            $this->ci->email->to($to);
            $this->ci->email->bcc($admin_email);
            //$this->ci->email->bcc('them@their-example.com');

            $this->ci->email->subject($subject);
            $this->ci->email->message($mailbody);

            $this->ci->email->send();

            //echo $this->ci->email->print_debugger();
            //exit();
        }
    }
    
    
    public function clean_input_keys($str) {
        if ( ! preg_match("/^[#a-z0-9:_\/-]+$/i", $str)) // <----INS
        {
            return false;
        }
        else 
            return true;
          
    }
    
}

//end of class

/* End of file Someclass.php */