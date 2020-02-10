<?php 
    class Action extends CI_Controller {
        public function index() {
            $this->load->view('login');
        }

        public function login() {
            $this->load->view('login');
        }

        public function register() {
            $this->load->view('registration');
        }

        public function home() {
            $this->load->view('home');
        }

        public function user_register() {
            // echo "Form-submit";
            // $data = $this->input->post();
            // print_r($data);

             $this->form_validation->set_rules(
                 'txt_fname',
                 'First Name',
                 'required|trim|min_length[3]|callback_check_name',
                 array(
                     'required' => 'Required',
                     'min_length' => 'Invalid name'
                 )
             );

             $this->form_validation->set_rules(
                 'txt_lname',
                 'Last Name',
                 'required|trim|min_length[3]|callback_check_name',
                 array(
                     'required' => 'Required',
                     'min_length' => 'Invalid name'
                 )
             );

            $this->form_validation->set_rules(
                'txt_email', 
                'Email',
                'required|trim|is_unique[tbl_users.email]|callback_check_email',
                array(
                    'required' => 'Required',
                    'is_unique'     => 'Email already exists.'
                )
            );
            
            $this->form_validation->set_rules(
                 'txt_pw',
                 'Password',
                 'required|trim|min_length[8]',
                 array(
                     'required' => 'Required',
                     'min_length' => 'Required (8 characters)'
                 )
             );

            $this->form_validation->set_rules(
                'txt_cpw',
                'Confirm Password',
                'required|trim|matches[txt_pw]',
                array(
                    'required' => 'Required',
                    'matches' => 'Password is not matched' 
                )
            );
        
        
            if($this->form_validation->run()) {
            
                //validation pass Pass, and call to the model;
                $data = $this->input->post();
                $data['txt_pw'] = sha1($this->input->post('txt_pw'));
                $data['txt_cpw'] = sha1($this->input->post('txt_cpw'));
              
                if ($this->user_model->insert_users($data)) {

                    $this->session->set_flashdata("success", "Registerd successfully");

                    redirect("login");
                }
                else {
                    //  $this->session->set_flashdata("error", " not registerd,
                    //  try again");

                     redirect("register");
                }
            }
            else {
                //validation fail
                $this->register();
            }
        }


        public function check_name($name) {
            $regex1 = "/^[^\\d\\s]+$/";
            $regex2 = "/(?i)(^[a-z])((?![ .,'-]$)[a-z .,'-]){0,24}$/";

            preg_match($regex1,$name,$output1);
            preg_match($regex2,$name,$output2);

            if(($output1 & $output2) || $name == '') {  
                return true;
            }
            else {
                $this->form_validation->set_message('check_name', 'Invalid name');
                return false;
            }
        }

        public function check_email($email) {

            $regex = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
            preg_match($regex,$email,$output);

            if( ($output) || ($email == '') ) {
                return true;
            }
            else {
                $this->form_validation->set_message('check_email', 'Invalid email');
                return false;
            }

        }

        public function user_login() {
       
            $this->form_validation->set_rules(
                'txt_email', 
                'Email',
                'required|trim|valid_email',
                array(
                    'required' => 'Required',
                    'valid_email' => 'Invalid email',
                )
            );

            $this->form_validation->set_rules(
                'txt_pw', 
                'Password',
                'required|trim',
                array(
                    'required' => 'Required'
                )
            );

            if($this->form_validation->run()) {
               $email = $this->input->post('txt_email');
               $pw = sha1($this->input->post('txt_pw'));
               $userExist = $this->user_model->check_login($email, $pw);

               if($userExist) {
                $sessionData = [
                    'id' => $userExist->id,
                    'fname' => $userExist->fname,
                    'lname' => $userExist->lname,
                    'dob' => $userExist->dob,
                    'email' => $userExist->email,
                ];
                
                $_SESSION['status'] = 'Active';
                session_start();
                $this->session->set_userdata($sessionData);
                redirect('home');
               }
               else {
                 $this->session->set_flashdata('login_error','Invalid credentials');
                 //redirect('login');
                 $this->login();
               }
            }
            else {
                $this->login();
            }
        }


        public function navigation() {
            $action = $this->input->post('action');
            $page = $this->input->post('page');
            
            
            if($action == "Logout") {
                session_start();
                session_destroy();
                $_SESSION = array();
                header("location:login");
                $this->load->view($page);
            }
            else {
           
                $this->load->view($page);
            }
        }
    }
?>


