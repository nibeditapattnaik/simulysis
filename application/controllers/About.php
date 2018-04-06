<?php

class About extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
  }
  
  public function index()
  {
    $this->load->view("templates/header");
    $this->load->view("about");
    $this->load->view("templates/footer");
  }
}

?>