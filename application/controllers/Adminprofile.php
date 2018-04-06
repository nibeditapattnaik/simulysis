<?php

class Adminprofile extends CI_Controller
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
    if($this->session->userdata('logged_in'))
    {
     $userdata       = $this->session->userdata('logged_in');
     $this->loggedIn = true;
     $this->username = $userdata['user_name'];
    }
    else
    {
      redirect("signin");
    }
  }
  
  public function logout()
  {
    $this->session->unset_userdata('logged_in');
    session_destroy();
    $this->loggedIn = false;
    /*$data['loggedIn'] = $this->loggedIn;
    $data['username'] = $this->username;
    $data['page'] = 'home';
    $this->load->view("template/header", $data);
    $this->load->view("home");
    $this->load->view("template/footer", $data);*/
    redirect("signin");
  }
  
  public function index()
  {
    $data["page"] = "adminprofile";
    $data['allCourses'] = $this->coursemodel->getCoursesOnly();
    $data['allSubscribers'] = $this->users->getAllSubscriberData();
    $this->load->view("templates/header");
    $this->load->view("adminprofile", $data);
    $this->load->view("templates/footer");
  }
  
  public function saveBlogData()
  {
    $this->tabHandler = "#blog";
    $courseId = $this->input->post("course");
    $title = $this->input->post("title");
    $content  = $this->input->post("content");
    
    if($this->blogmodel->saveBlog($courseId, $content, $title))
    {      
      $this->message    = "Blog Posted Successfully.";
    }
    else
    {
      $this->message    = "Some error occured while saving the blog.";
    }
    $data["page"] = "adminprofile";
    $data['allCourses'] = $this->coursemodel->getCoursesOnly();
    $data['tab'] = $this->tabHandler;
    $data['msg'] = $this->message;
    $data['allSubscribers'] = $this->users->getAllSubscriberData();
    $this->load->view("templates/header");
    $this->load->view("adminprofile", $data);
    $this->load->view("templates/footer");    
  }
  
  public function saveFaqData()
  {
    $this->tabHandler = "#faq";
    $courseId = $this->input->post("course");
    $question  = $this->input->post("question");
    $answer  = $this->input->post("answer");
    
    if($this->faqmodel->saveFaq($courseId, $question, $answer))
    {      
      $this->message    = "FAQ Posted Successfully.";
    }
    else
    {
      $this->message    = "Some error occured while saving the FAQ.";
    }
    $data["page"] = "adminprofile";
    $data['allCourses'] = $this->coursemodel->getCoursesOnly();
    $data['allSubscribers'] = $this->users->getAllSubscriberData();
    $data['tab'] = $this->tabHandler;
    $data['msg'] = $this->message;
    $this->load->view("templates/header");
    $this->load->view("adminprofile", $data);
    $this->load->view("templates/footer");    
  }
  
}

?>