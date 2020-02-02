<?php 
    class User_model extends CI_Model {

        public function insert_users ($data) {
            return $this->db->insert('tbl_users', array(
                "fname"=>$data['txt_fname'],
                "lname"=>$data['txt_lname'],
                "dob"=>$data['txt_dob'],
                "email"=>$data['txt_email'],
                "password"=>$data['txt_cpw'],
            ));
        }

        public function check_login($email, $pw ) {
            $result = $this->db
                ->where(['email'=> $email,'password'=>$pw])
                ->get('tbl_users');
            
            if( $result->num_rows() > 0 ) {
                return $result->row();
            }    
        }
    }

?>