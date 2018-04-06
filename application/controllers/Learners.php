<?php

class Learners extends CI_Controller{
    function __construct(){
        parent::__construct();
        
        $this->load->model("coursemodel");
        $this->load->model("blogmodel");
        $this->load->model("faqmodel");
    }
    
    public function index(){
        $this->load->view('templates/header');
        $this->load->view('learners');
        $this->load->view('templates/footer');
    }
    
   public function login(){
         
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
    
        echo "<center>";
        if($this->form_validation->run()){
            
            $this->load->model('loginmodel');
        
        $email = $this->input->post('email');
        $password = $this->input->post('password');
            //echo "$email";
            //echo "$password";
        /*$data1=$this->input->post();
        unset($data1['submit']);
        */ 
         /*if($this->loginmodel->log($data1)){
           echo "Registered Successfully";
            $this->load->view('templates/header');
            $this->load->view('about');
            $this->load->view('templates/footer');
         }else{
             $page=0;
       $data["blogs"] = $this->blogmodel->getBlogsPagination(3, $page, "blogs/index");
    $data["recentBlogs"] = $this->blogmodel->getBlogs(3,"", " order by created_at DESC");
    $this->load->view("templates/header");
    $this->load->view("blog", $data);
    $this->load->view("templates/footer");
          }*/
           
     $user = $this->loginmodel->login($email, $password); 
           /* echo '<pre>';
                print_r($user);
            echo '</pre>';
            exit();*/
        if($user){
           /* $session_data = array(
            'user_name'=>$user->user_name;
            'email'=>$user->email;
            'password'=>$user->password;
            'user_role_id'=>$user->user_role_id;
            'mobile'=>$user->mobile;
            'admin_permission'=>$user->admin_permission;
            );*/
              $this->session->set_userdata('favourite_website', 'http://simulysis.com');
         
        // set array of items in session
        $arraydata = array(
                'user_name'  => $user->user_name,
                'email'     => $user->email,
                'password' => $user->pasword,
                'user_role_id' => $user->user_role_id,
                'mobile' => $user->mobile,
                'admin_permission' => $user->admin_permission
        );
        $this->session->set_userdata($arraydata);
         
        /**** GET SESSION DATA ****/
        // get data from session
        echo "Favourite Website: ". $this->session->userdata('favourite_website');
        echo "<br>";
        echo "Author Name: ". $this->session->userdata('user_name');
        echo "<br>";
        echo "mobile: " . $this->session->userdata('mobile');
        echo "<br>";
            $admin_permission = $user->admin_permission;
            if($admin_permission == 'no'){
                //echo "hlw";
            $this->load->view('templates/header');
            $this->load->view('about');
            $this->load->view('templates/footer');
            }else if($admin_permission == 'yes'){
                //echo "full blog";
                $page=0;
                $data["blogs"] = $this->blogmodel->getBlogsPagination(3, $page, "blogs/index");
                $data["recentBlogs"] = $this->blogmodel->getBlogs(3,"", " order by created_at DESC");
                $this->load->view("templates/header");
                $this->load->view("blog", $data);
                $this->load->view("templates/footer");
            }
            //echo "$admin_permission";
            //echo ":sucess";
        }
        }else{
            echo validation_errors(); 
        }
       echo "</center>";
   }
        
    }
?>