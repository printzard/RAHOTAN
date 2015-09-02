<?php
    class ValidateForm extends CI_Controller{

        public function checkCustomerRegister(){
            
            $this->load->helper(array('form', 'url', 'email'));
            $this->load->library('form_validation');


           /* $this->form_validation->set_rules(
        
                'firstname', 'first name', 'required|ctype_alpha(firstname)',
                array(
                        'required'               => 'required.',
                        'ctype_alpha(firstname)' => 'required only characters'
                ),

                'lastname', 'last name','required|ctype_alpha(firstname)',
                array(
                        'required'               => 'required.',
                        'ctype_alpha(firstname)' => 'required only characters'
                ),

                'birthdate', 'birth day', 'required', array('required' => 'required.'),

                'phone', 'phone number','required|exact_length[13]',
                array(
                        'required'      => 'required.',
                        'exact_length'  => 'invalid %s.'
                ),

                'sex', 'sex', 'required', array('required' => 'required.'),

                'email', 'Email', 'required|valid_email|is_unique[Customer.email]|is_unique[Staff.email]',
                array(
                        'required'      => 'required.',
                        'valid_email'   => 'invalid %s.',
                        'is_unique'     => 'This %s is already exists.'
                ),


                'username', 'Username',
                'required|min_length[6]|max_length[20]|is_unique[Customer.username]|is_unique[Staff.username]',
                array(
                        'required'      => 'required.',
                        'min_length'    => 'required 6-20 letters.',
                        'max_length'    => 'required 6-20 letters.',
                        'is_unique'     => 'This %s is already exists.'
                ),

                'password', 'Password', 'required|min_length[6]|md5(password)', 
                array(
                        'required'      => 'required.',
                        'min_length'    => 'required at least 6 letters.'
                ),

                'passconf', 'Password Confirmation', 'required|matches[password]',
                array(
                        'required'      => 'required.',
                        'matches'       => '%s is not match.',
                )
        );*/


           // if ($this->form_validation->run() == FALSE){
                //$this->load->view('register/customer-register.html');
            //} else {

                if($this->input->post('submit')!=null){
                    $data = array(
                        'username' => $this->input->post('username'),
                        'password' => MD5($this->input->post('password')),
                        'userType' => "C",
                        'firstname' => $this->input->post('firstname'),
                        'lastname' => $this->input->post('lastname'),
                        'birthday' => $this->input->post('birthday'),
                        'sex' => $this->input->post('sex'),
                        'job' => $this->input->post('job'),
                        'salary' => $this->input->post('salary'),
                        'education' => $this->input->post('education'),
                        'province' => $this->input->post('province'),
                        'status' => $this->input->post('status'),
                        'phone' => $this->input->post('phone'),
                        'email' => $this->input->post('email')
                    );
                    $this->db->insert('Customer', $data);        
                $this->load->view('register/customer-confirm-registered.html');
           }
           $this->load->view('register/customer-register.html');
       }




        public function checkStaffRegister(){
            
            $this->load->helper(array('form', 'url', 'email'));
            $this->load->library('form_validation');

                if($this->input->post('submit')!=null){
                    $data = array(
                        'username' => $this->input->post('username'),
                        'password' => MD5($this->input->post('password')),
                        'userType' => "S",
                        'firstname' => $this->input->post('firstname'),
                        'lastname' => $this->input->post('lastname'),
                        'sex' => $this->input->post('sex'),
                        'phone' => $this->input->post('phone'),
                        'position' => $this->input->post('position'),
                        'department' => $this->input->post('department'),
                        'hiredate' => $this->input->post('hiredate'),
                        'salary' => $this->input->post('salary'),
                        'email' => $this->input->post('email')
                    );
                    $this->db->insert('Staff', $data);        
                $this->load->view('register/customer-confirm-registered.html');
           }
           $this->load->view('register/staff-register.html');
       }


    }
?>