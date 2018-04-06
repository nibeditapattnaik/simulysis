<?php

class Blogs extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("coursemodel");
    $this->load->model("blogmodel");
    $this->load->model("faqmodel");
  }
  
  public function index($page=0)
  {
    $data["blogs"] = $this->blogmodel->getBlogsPagination(3, $page, "blogs/index");
    $data["recentBlogs"] = $this->blogmodel->getBlogs(3,"", " order by created_at DESC");
    $this->load->view("templates/header");
    $this->load->view("blog", $data);
    $this->load->view("templates/footer");
  }
}

?>