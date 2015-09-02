<?php
Class User extends CI_Model
{
 function login($username, $password)
 {
   $this -> db -> select('*');
   $this -> db -> from('Customer');
   $this -> db -> where('username', $username);
   $this -> db -> where('password', MD5($password));
   $this -> db -> limit(1);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {	   
	      $this -> db -> select('*');
         $this -> db -> from('Staff');
         $this -> db -> join('Hotel', 'Staff.hotel_id = Hotel.hotel_id');
         $this -> db -> where('username', $username);
         $this -> db -> where('password', MD5($password));
         $this -> db -> limit(1);
       
         $query = $this -> db -> get();
       
         if($query -> num_rows() == 1)
         {
           return $query->result();
         }
         else
         {     
           return false;
         }
   }
 }


  function getCustomer($id){
     $this -> db -> select('*');
     $this -> db -> from('Customer');
     $this -> db -> where('cus_id', $id);
     $this -> db -> limit(1);
 
     $query = $this -> db -> get();
 
     if($query -> num_rows() == 1) {
        return $query->result();
     } else {     
        return false;
     }
  }
    

}
?>