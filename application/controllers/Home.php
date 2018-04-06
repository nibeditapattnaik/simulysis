<?php

class Home extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("coursemodel");
    $this->load->model("blogmodel");
  }
  
  public function index()
  {
    $data["courses"] = $this->coursemodel->getCourses(8, 1);
    $data["page"] = "home";
    $data["course_blogs"] = $this->blogmodel->getBlogs(3, true);
    $data["previous_course_images"] = glob('./design/previouscoursegallery/*.jpg');
    $this->load->view("templates/header", $data);
    $this->load->view("home", $data);
    $this->load->view("templates/footer", $data);
  }
}

?>