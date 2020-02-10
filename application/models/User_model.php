<?php 
    class User_model extends CI_Model {

        public function insert_users ($data) {

            $year = $data['txt_year'];
            $month = $data['txt_month'];
            $day = $data['txt_day'];

            if(strlen($day) < 2) {
                $day = "0".$day;
            }
            
             if(strlen($month) < 2) {
                $month = "0".$month;
            }
            
            $dob = $day."-".$month."-".$year;

            return $this->db->insert('tbl_users', array(
                "fname"=>$data['txt_fname'],
                "lname"=>$data['txt_lname'],
                "dob"=>$dob,
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