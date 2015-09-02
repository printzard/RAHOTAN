<?php
    class contact extends CI_Controller{

      function __construct()
    
        public function index(){
            if($this->session->userdata('logged_in')){

             $session_data = $this->session->userdata('logged_in');

             if($session_data['userType'] == 'C') { 
               $data['username'] = $session_data['username'];
               $data['userType'] = $session_data['userType'];
               $data['email'] = $session_data['email'];
               
             }
     
             else if($session_data['userType'] == 'S')  {
               $data['username'] = $session_data['username'];
               $data['staff_id'] = $session_data['staff_id'];
               $data['hotelname'] = $session_data['hotelname'];
               $data['sex'] = $session_data['sex'];
               $data['firstname'] = $session_data['firstname'];
               $data['lastname'] = $session_data['lastname'];
               $data['position'] = $session_data['position'];
               $data['userType'] = $session_data['userType'];
             }
     
             
             $this->load->view('contact/contact-admin.html', $data);
           }
           else
           {
             $data['username'] = null;
             $this->load->view('contact/contact-admin.html',$data);
           }
        }

    }
?>