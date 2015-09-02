<?php
    class main extends CI_Controller{
    
        public function index(){
            if($this->session->userdata('logged_in')){

             $session_data = $this->session->userdata('logged_in');

             if($session_data['userType'] == 'C') { 
               $data['username'] = $session_data['username'];
               $data['userType'] = $session_data['userType'];   
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
             $this->load->view('index.html', $data);
           }

           else
           {
             $data['username'] = null;
             $this->load->view('index.html',$data);
           }
        }

        public function test(){
          $this->load->view('register/customer-confirm-registered.html');
        }

    }
?>