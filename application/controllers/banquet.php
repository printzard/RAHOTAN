<?php
    class banquet extends CI_Controller{
    
    	public function __construct() {
   			parent::__construct();
   			$this->load->model('BanquetM','',TRUE);
   			$this->load->helper('form');
 		}

    	 public function index(){

			if($this->session->userdata('logged_in')){

            	$session_data = $this->session->userdata('logged_in');

	             if($session_data['userType'] == 'C') { 
	               redirect('home', 'refresh');
	               
	             } else if($session_data['userType'] == 'S')  {
	               
	               $result = $this->BanquetM->getHotel($session_data['staff_id']);

		           if($result) {
		             $data = array();
		             foreach($result as $row) {   
		               $data = array(
		               	 'username' => $row->username,
	            	     'staff_id' => $row->staff_id,
	                     'sex' => $row->sex,
	                     'firstname' => $row->firstname,
	                     'lastname' => $row->lastname,
	                     'position'  => $row->position,
	                     'userType' => $row->userType,


	                     'hotel_id' => $row->hotel_id,
		                 'hotelname' => $row->hotelName,
		                 'address' => $row->hotelLocation,
		                 'tel' => $row->hotelTel,
		                 'email' => $row->hotelEmail,
		                 'website' => $row->website
		               );
		             } 


	             }        
	             $this->load->view('package/add-banquet.html', $data);
	         } else {
	             $data['username'] = null;
	             redirect('login/login','refresh');
	         }
	       }
        
    	 }


    	 public function confirm(){
    	 	$session_data = $this->session->userdata('logged_in');

    	 	if($session_data['username'] == NULL) { 
	               redirect('home', 'refresh');
	               
	         } else {
    	 	$data = array();
    	 	$data = array(
    	 	  'banName' => $this->input->post('banquetname'),
	          'description' => $this->input->post('description'),
	          'photosynthLink' => str_replace("/view","/embed",$this->input->post('photosynthlink')),
	          'capacity' => $this->input->post('guest'),
	          'hotel_id' => $this->input->post('hotel_id'),
	          'googleMapLink' => $this->input->post('googlemaplink'),
	          'hotelLocation' => $this->input->post('address'),
		      'hotelTel' => $this->input->post('tel'),
		      'hotelEmail' => $this->input->post('email'),
		      'hotelName' => $this->input->post('hotelname'),
		      'website' => $this->input->post('website')
    	 	);
    	 	$this->load->view('package/new-banquet-confirm.html',$data);
    	 }
    	 }




    	 public function insert(){
    	 	$resultEdit = $this->BanquetM->editHotel();
    	 	$resultAdd = $this->BanquetM->addBanquet();
    	 	if($resultEdit && $resultAdd){
    	 		redirect('home','refresh');
    	 	}
    	 }
    	 
    	 public function delete(){

		    $ban_id = $this->input->post('ban_id');
		     

    	 	$this->db->where('ban_id', $ban_id);
    		$query = $this->db->delete('BanquetRoom');

    		if($query){
         	 echo "ok";
      		}else{
         	 echo "error";
      		}
    	 }


    	 public function editDescription(){

    	 	$ban_id = $this->input->post('ban_id');

	    	$data = array(
		        'banName' => $this->input->post('banName'),
		        'description' => $this->input->post('description')
			);

			$this->db->where('ban_id', $ban_id);
			$query = $this->db->update('BanquetRoom', $data);

			if($query){
	    		echo "ok";
			}else{
	  			echo "error";
			}

    	 }


    	  public function editSynth(){

    	 	$ban_id = $this->input->post('ban_id');

	    	$data = array(
		        'photosynthLink' => str_replace("/view","/embed",$this->input->post('photosynthLink'))
			);

			$this->db->where('ban_id', $ban_id);
			$query = $this->db->update('BanquetRoom', $data);

			if($query){
	    		echo "ok";
			}else{
	  			echo "error";
			}

    	 }


		 public function editMap(){

    	 	$ban_id = $this->input->post('ban_id');

	    	$data = array(
		        'googleMapLink' => $this->input->post('googleMapLink')
			);

			$this->db->where('ban_id', $ban_id);
			$query = $this->db->update('BanquetRoom', $data);

			if($query){
	    		echo "ok";
			}else{
	  			echo "error";
			}

    	 }    	 


    }
 ?>