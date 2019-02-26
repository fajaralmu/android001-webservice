<?php
class Cekuser{

    public $koneksi;

    public function __construct(){
        $this->koneksi = mysqli_connect("localhost", "root", "", "mpi");
        if (mysqli_connect_errno()) {
            echo mysqli_connect_error();
            exit();
        }
        
    }
    
    function get_user($namaobjek, $where=null){
        $user = array();
        $sql = "SELECT * FROM `".$namaobjek."`";
        if($where!=null && is_array($where)){
            $sql.='WHERE ';
            $i = 0;
            foreach ($where as $key => $value) {
                if($i>0){
                    $sql.='AND';
                }
               $sql.='`'.$key.'`=\''.$value.'\'';
               $i++;
            }
        }
        if($result =  mysqli_query($this->koneksi, $sql)){
           $user = mysqli_fetch_assoc($result);
        }	
        return $user;
    }

    function get_obj($namaobjek, $where=null){
        $num = 0;
        $sql = "SELECT * FROM `".$namaobjek."`";
        if($where!=null && is_array($where)){
            $sql.='WHERE ';
            $i = 0;
            foreach ($where as $key => $value) {
                if($i>0){
                    $sql.='AND';
                }
               $sql.='`'.$key.'`=\''.$value.'\'';
               $i++;
            }
        }
        if($result =  mysqli_query($this->koneksi, $sql)){
           $num = mysqli_num_rows($result);
        }	
        return $num;
    }
   
    function user_valid($username, $katasandi){
        $user  = $this->get_obj('user',array('username'=>$username, 'katasandi'=>$katasandi));
        if($user==1){
          return true;
        }
        return false;
    }
   
}
?>