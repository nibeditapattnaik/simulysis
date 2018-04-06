<?php
class Register extends CI_Controller{
    function __construct(){
        parent::__construct();
        
    }
    
    public function index(){
    $this->load->view('templates/header');
    $this->load->view('register');
    $this->load->view('templates/footer');
   
    }
    
    public function registration(){       // $this->load->view('templates/header');
        $this->form_validation->set_rules('user_name', 'Username','required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric');
       
         /*$data=array(
          'user_name'=>$_POST['user_name'],
          'email'=>$_POST['email'],
          'password'=>$_POST['password'],
          'user_role_id'=>$_POST['user_role_id'],
          'mobile'=>$_POST['mobile']
        );
        foreach($data as $d){
            echo $d.'<br/>';
        }
        $this->db->insert('regusers',$data);*/
         echo "<center>";
        echo "<b>";
    if($this->form_validation->run()){
            
            $this->load->model('registermodel');
            
            $data1=$this->input->post();
            unset($data1['submit']);
            /*echo '<pre>';
            print_r($data);
            echo '</pre>';*/
          /*$query="insert into regusers values ('ni','xf@gh','dfg','2','5454654')";
            $this->db->query($query);*/
            //$this->db->insert('regusers',$data1);
           // echo "going to model";
            
            //$this->registermodel->reg($data1);
           
            // echo "came from model";
           
           
          if($this->registermodel->reg($data1)){
                echo "Registered Successfully"."<br/>";
            }else{
                    echo "Registration Failure"."<br/>";
          }
        echo "***** Thank you for showing  your interest*****";
        }else{
            echo validation_errors(); 
        }
         
        echo "</b>";
        echo "</center>";
       // $this->load->view('templates/footer');
  }
}
?>