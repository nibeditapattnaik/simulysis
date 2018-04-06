<?php

class Blog extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("coursemodel");
    $this->load->model("blogmodel");
    $this->load->model("faqmodel");
  }
  
  public function index($blogId)
  {
    $data["blogDetails"] = $this->blogmodel->getBlogDetailsById($blogId);
    $data["recentBlogs"] = $this->blogmodel->getBlogs(3,"", " order by created_at DESC");
    $this->load->view("templates/header");
    $this->load->view("blogpost", $data);
    $this->load->view("templates/footer");
  }
}

?>