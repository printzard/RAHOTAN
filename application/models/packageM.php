<?php
Class packageM extends CI_Model {

	function getPackageServiceType(){
     $this -> db -> select('*');
     $this -> db -> from('Package_ServiceType');
 
     $query = $this -> db -> get();
 
     if($query -> num_rows() > 0) {
        return $query->result_array();
     } else {     
        return false;
     }
  }


  function getPackageId($name){
  	 $this -> db -> select('package_id');
     $this -> db -> from('Package');
     $this->db->join("Hotel", "Hotel.hotel_id = Package.hotel_id");
     $this->db->join("BanquetRoom", "BanquetRoom.ban_id = Package.ban_id");
     $this->db->join("Staff", "Staff.staff_id = Package.staff_id");
     $this->db->where("packageName",$name);

     $query = $this->db->get();
    if($query -> num_rows() > 0) {
        $data = $query->result_array();
        return $data[0]["package_id"];
     } else {     
        return false;
     }
  }
}
?>