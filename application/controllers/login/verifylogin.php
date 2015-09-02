<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('User','',TRUE);
 }

 function index()
 {
   //This method will have the credentials validation
   $this->load->library('form_validation');

   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.  User redirected to login page
     $this->load->view('login.html');
   }
   else
   {
     //Go to private area
     redirect('home', 'refresh');
   }

 }

 function check_database($password)
 {
   //Field validation succeeded.  Validate against database
   $username = $this->input->post('username');

   //query the database
   $result = $this->User->login($username, $password);

   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {

      if($row->userType == 'C'){
         $sess_array = array(
           'cus_id' => $row->cus_id,
           'username' => $row->username,
           'userType' => $row->userType
         );
      } 

      if ($row->userType == 'S') {
          $sess_array = array(
           'staff_id' => $row->staff_id,
           'username' => $row->username,
           'hotelname' => $row->hotelName,
           'firstname' => $row->firstname,
           'lastname' => $row->lastname,
           'sex' => $row->sex,
           'position' => $row->position,
           'userType' => $row->userType,
           'hotel_id' => $row->hotel_id
         );      
        }
       $this->session->set_userdata('logged_in', $sess_array);
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return false;
   }
 }
}
?>