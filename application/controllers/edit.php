<?php
    class edit extends CI_Controller{

    	public function index(){
    		$session_data = $this->session->userdata('logged_in');

	    	$data = array(
		        'firstname' => $this->input->post('firstname'),
		        'lastname' => $this->input->post('lastname'),
		        'email' => $this->input->post('email'),
		        'phone' => $this->input->post('phone'),
		        'province' => $this->input->post('province')
			);

			$this->db->where('cus_id', $session_data['cus_id']);
			$query = $this->db->update('Customer', $data);

			if($query){
	    		echo "ok";
			}else{
	  			echo "error";
			}

    	}

	}

?>