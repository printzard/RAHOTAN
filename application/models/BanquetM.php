<?php
Class BanquetM extends CI_Model {

  function getHotel($id){
     $this -> db -> select('*');
     $this -> db -> from('Hotel');
     $this -> db -> join('Staff', 'Hotel.hotel_id = Staff.hotel_id');
     $this -> db -> where('staff_id', $id);
     $this -> db -> limit(1);
 
     $query = $this -> db -> get();
 
     if($query -> num_rows() == 1) {
        return $query->result();
     } else {     
        return false;
     }
  }



  function editHotel(){
      $data = array(
        'hotelLocation' => $this->input->post('hotelLocation'),
        'hotelTel' => $this->input->post('hotelTel'),
        'hotelEmail' => $this->input->post('hotelEmail'),
        'website' => $this->input->post('website')
      );
      $this->db->where('hotel_id', $this->input->post('hotel_id'));
      $query = $this->db->update('Hotel', $data);
      if($query){
          return true;
      }else{
          return false;
      }
  }


  function addBanquet(){
       $data = array(
          'banName' => $this->input->post('banName'),
          'description' => $this->input->post('description'),
          'photosynthLink' => str_replace("/view","/embed",$this->input->post('photosynthLink')),
          'capacity' => $this->input->post('capacity'),
          'hotel_id' => $this->input->post('hotel_id'),
          'googleMapLink' => $this->input->post('googleMapLink')
      );
      $query = $this->db->insert('BanquetRoom', $data);
      if($query){
          return true;
      }else{
          return false;
      }
  }


  function getBanquet($id){
     $this -> db -> select('*');
     $this -> db -> from('BanquetRoom');
     $this -> db -> join('Hotel', 'BanquetRoom.hotel_id = Hotel.hotel_id');
     $this -> db -> where('Hotel.hotel_id', $id);
 
     $query = $this -> db -> get();
 
     if($query -> num_rows() > 0) {
        return $query;
     } else {     
        return false;
     }
  }

  function getHotelIdFromBanquet($id){
    $this->db->select("Hotel.hotel_id");
    $this->db->from("Hotel");
    $this->db->join("BanquetRoom", "BanquetRoom.hotel_id = Hotel.hotel_id");
    $this->db->where("BanquetRoom.ban_id",$id);

    $query = $this->db->get();
    if($query -> num_rows() > 0) {
        $data = $query->result_array();
        return $data[0]["hotel_id"];
     } else {     
        return false;
     }

  }

}

?>