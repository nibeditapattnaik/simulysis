<?php

class Eventcalender extends CI_Controller
{
  var $tabHandle = "";
  var $message = ""; 
  var $loggedIn = false;
  var $username = "";
  
  function __construct()
  {
    parent::__construct();
    $this->load->model("coursemodel");
    $this->load->model("blogmodel");
    $this->load->model("faqmodel");
    $this->load->model("users");
  }
  
  public function index()
  {
    $this->load->view("templates/header");
    $this->load->view("eventcalender");
    $this->load->view("templates/footer");
  } 
  
  public function getevents()
  {
	$result = $this->coursemodel->getCourseSchedules();
	header("content-type: application/json; charset=utf-8");
    echo json_encode($result);
  }
}

?>