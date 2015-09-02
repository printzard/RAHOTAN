<?php 

class home extends CI_Controller {

   function __construct() {
     parent::__construct();
     $this->load->model('User','',TRUE);
     $this->load->model('BanquetM','',TRUE);
   }



   function index() {

     if($this->session->userdata('logged_in')) {
       $session_data = $this->session->userdata('logged_in');

       if(!session_id()){
          session_start(); 
        } 

        if($session_data['userType'] == 'C') { 
          $result = $this->User->getCustomer($session_data['cus_id']);

            if($result) {
               $data = array();
                
                foreach($result as $row) {   
                   $data = array(
                     'username' => $row->username,
                     'firstname' => $row->firstname,
                     'lastname' => $row->lastname,
                     'phone' => $row->phone,
                     'email' => $row->email,
                     'province' => $row->province
                   );
                } 
            }
         $this->load->view('main/customer-dashboard.html', $data);
       }

       else if($session_data['userType'] == 'S')  {
         $query = $this->BanquetM->getBanquet($session_data['hotel_id']);

              if($query){
               $data['rs'] = $query->result_array();
               
               /*$data = array();
                foreach($result as $row) {   
                   $data = array(
                     'username' => $row->username,
                     'staff_id' => $row->staff_id,
                     'sex' => $row->sex,
                     'firstname' => $row->firstname,
                     'lastname' => $row->lastname,
                     'position' => $row->position,
                     'userType' => $row->userType,
                     'hotelname' => $row->hotelName
                   );
                } */
              
            } else {
              $data['rs'] = null;
            }
         $this->load->view('main/staff-dashboard.html', $data);
       }
     } else {
       //If no session, redirect to login page
       redirect('login/login', 'refresh');
     }
   }



   function logout(){
     $this->session->unset_userdata('logged_in');
     session_destroy();
     redirect('home', 'refresh');
   }

}

?>