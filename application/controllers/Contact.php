<?php

class Contact extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("emailhandler");
  }
  
  public function index()
  {
    $data["page"] = "contact";
    $this->load->view("templates/header");
    $this->load->view("contact", $data);
    $this->load->view("templates/footer");
  }
  
  public function sendcontactmail()
  {
    $name = $this->input->post("name");
    $lname = $this->input->post("lname");
    $mail = $this->input->post("mail");
    $phone = $this->input->post("phone");
    $message = $this->input->post("message");
    $this->emailhandler->sendContactMail($name.$lname, $mail, $phone, $message);
    echo "true";
  }
}

?>