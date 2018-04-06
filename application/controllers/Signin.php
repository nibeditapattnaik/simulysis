<?php

class Signin extends CI_Controller
{
  var $loginError = "";
  var $message = "";
  function __construct()
  {
    parent::__construct();
    $this->load->model("emailhandler");
    $this->load->model("users");
  }
  
  public function index($error="")
  {
    $data["page"] = "login";
    if($error)
      $data["error"] = "wrong Username/Password !!!";
    $this->load->view("templates/header");
    $this->load->view("login", $data);
    $this->load->view("templates/footer");
  }
  
  public function login ()
  {
    $username = $this->input->post("username");
    $password = $this->input->post("password");
    //exit;
    if($user = $this->users->do_admin_login($username, $password))
    {
      $this->session->set_userdata('logged_in', $user);
      redirect("adminprofile");
    }
    else
    {
      redirect("signin/index/1");
    }
  }
  
}

?>