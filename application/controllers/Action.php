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
          
            $config_rules = array(
                array(
                    "field" => "txt_fname",
                    "label" => "First Name",
                    "rules" => "required|min_length[3]|trim",
                ),
                array(
                    "field" => "txt_lname",
                    "label" => "Last Name",
                    "rules" => "required|min_length[3]|trim",
                ),
                array(
                    "field" => "txt_dob",
                    "label" => "Date Of Birth",
                    "rules" => "required|trim",
                ),
                array(
                    "field" => "txt_pw",
                    "label" => "Password",
                    "rules" => "required|min_length[8]|trim",  
                )
            );


            $this->form_validation->set_rules($config_rules);

            $this->form_validation->set_rules(
                'txt_email', 
                'Email',
                'required|trim|valid_email|is_unique[tbl_users.email]',
                array(
                    'valid_email' => 'Invalid email.',
                    'is_unique'     => 'This %s already exists.'
                )
            );
            
            $this->form_validation->set_rules(
                'txt_cpw',
                'Confirm Password',
                'required|trim|matches[txt_pw]',
                array(
                    'matches' => 'Password is not matched' 
                )
            );
        
        
            if($this->form_validation->run()) {
            
                //validation pass Pass, and call to the model;
                $data = $this->input->post();
                $data['txt_pw'] = sha1($this->input->post('txt_pw'));
                $data['txt_cpw'] = sha1($this->input->post('txt_cpw'));
              
                if ($this->user_model->insert_users($data)) {

                    $this->session->set_flashdata("success", "User registerd successfully");

                    redirect("login");
                }
                else {
                     $this->session->set_flashdata("error", "User not registerd,
                     try again");

                     redirect("register");
                }
            }
            else {
                //validation fail
                $this->register();
            }
        }

        public function user_login() {
       
            $this->form_validation->set_rules(
                'txt_email', 
                'Email',
                'required|trim|valid_email',
                array(
                    'valid_email' => 'Invalid email.',
                )
            );

            $this->form_validation->set_rules(
                'txt_pw', 
                'Password',
                'required|trim'
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
                 $this->session->set_flashdata('login_error','Email or password incorrect');
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


