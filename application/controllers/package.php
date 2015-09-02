<?php
    class package extends CI_Controller{
    
    	public function __construct() {
   			parent::__construct();
   			$this->load->model('packageM','',TRUE);
   			$this->load->model('BanquetM','',TRUE);
   			$this->load->helper('form');
 		}

    	 public function index(){

    	 	if($this->session->userdata('logged_in')){

            	$session_data = $this->session->userdata('logged_in');

	             if($session_data['userType'] == 'C') { 
	               redirect('home', 'refresh');
	               
	             } else if($session_data['userType'] == 'S')  {
	             	$query = $this->BanquetM->getBanquet($session_data['hotel_id']);

             			if($query){
               				$data['rs'] = $query->result_array();
            			} else {
              				redirect('home', 'refresh');
	             		}
                  $packageServiceType = $this->packageM->getPackageServiceType();

                  $data = array(
                    "banquet"=>$data['rs'],
                    "packageservicetype"=>$packageServiceType);

	  				$this->load->view('package/create-package.html', $data);
	        	 } 

	         } else {
	            redirect('login/login','refresh');
	       }
    	}





      public function create(){
        $data = $this->input->post();
        $session_data = $this->session->userdata('logged_in');

        //get service count
        $count = 0;
        while(true){
          if(isset($data["service".($count+1)])){
            $count++;
          }else{
            break;
          }
        }

        //get service option and prices
        $services = array();
        for($i = 1; $i<=$count;$i++){
          $serviceoptions = array();
          $serviceoptionscount = 0;
          while(true){
            $serviceoptionscount++;
            if(isset($data["service".$i."option".$serviceoptionscount]) 
              & isset($data["service".$i."price".$serviceoptionscount])){
              array_push($serviceoptions,array(
                "option_name"=>$data["service".$i."option".$serviceoptionscount],
                "price"=>$data["service".$i."price".$serviceoptionscount]
                ));
            }else{
              break;
            }
          }
          $service = array(
            "package_service_type_id" => $data["service".$i],
            "Package_ServiceOption"=>$serviceoptions
            );
          array_push($services,$service);
        }

        //check event
        if(!isset($data["event"])){
          $data["event"] = array();
        }else{
          if(array_search("others",$data["event"]) != 0){
            unset($data["event"][array_search("others",$data["event"])]);
            array_push($data["event"],$data["otherEvent"]);
          }
        }


        //create package in package table
        /*$inputdata = array(
           "packageName" => $data["packageName"],
           "packagePrice" => $data["startPrice"],
           "availableDateStart" => $data["dateStart"],
           "availableDateFinish" => $data["dateFinish"],
           "hotel_id" => $this->BanquetM->getHotelIdFromBanquet($data["place"]),
           "ban_id" => $data["place"],
           "staff_id" => $session_data["staff_id"]
          );
          $this->db->insert('Package',$inputdata);*/


        // insert event in package_event table
       /* foreach ($data["event"] as $event){
          $eventArray = array(
            "package_id" => $this->packageM->getPackageId($data["packageName"]),
            'package_event_name' => $event
        );
        $this->db->insert('Package_Event',$eventArray);
      }*/

      // insert service in package_service table
      //  foreach($services as $service){
         // $serviceArray = array(
            //"package_id" => $this->packageM->getPackageId($data["packageName"]),
            //"package_service_type_id" => $service["package_service_type_id"]
          //);
         //  $this->db->insert('Package_Service',$serviceArray);
        //}

        //insert option in package_service_option table

      foreach ($services as $service){
        if (is_array($service)){
          
            foreach ($service as $option){
                if (is_array($option)){
                    foreach ($option as $row){
                      echo "package id: ".$this->packageM->getPackageId($data["packageName"])."<br/>";
                      echo $service['package_service_type_id']."<br/>";
                      echo $row['option_name']."&nbsp&nbsp";
                     echo $row['price']."<br/>";
                    }
                }
            }
        }
    }



       /* echo "<pre>";
        print_r($services);
        echo "</pre>";*/
      }

    }
 ?>