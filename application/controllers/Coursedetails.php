<?php

class Coursedetails extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("coursemodel");
    $this->load->model("blogmodel");
    $this->load->model("faqmodel");
    $this->load->model("blogmodel");
  }
  
  public function index($crossId, $description)
  {
    $data['coursedetails'] = $this->coursemodel->getCourseDetails($crossId);
    $data['topicdetails'] = $this->coursemodel->getTopicDetails($data['coursedetails']->course_id);
	$sessionArray = array();
    foreach($data['topicdetails'] as $topic)
    {
      $sessionArray[$topic->id] =  $this->coursemodel->getSessionDetailsByTopic($topic->id);
    }
    $data["sessiondetails"] = $sessionArray;
    $data["course_blogs"] = $this->blogmodel->getBlogs(3, true);
    $data["faqs"] = $this->faqmodel->getAllFaqs();
    $this->load->view("templates/header");
    $this->load->view("coursedetails", $data);
    $this->load->view("templates/footer");
  }
  
  public function downloadpdf($type)
  {
    if(strtolower($type) == 'cfd')
    {
      $filename = "CFD_Course_outline.pdf";
    }
      
    if(strtolower($type) == 'fea')
    {
      $filename = "FEA_Course_outline.pdf";
    }
    
    if(strtolower($type) == 'cfd-pro')
    {
      $filename = "CFD_PRO.pdf";
    }
    
    if(strtolower($type) == 'fea-pro')
    {
      $filename = "FEA_PRO.pdf";
    }
    
    if(strtolower($type) == 'scientific-computing')
    {
      $filename = "ScientificComputing.pdf";
    }

    header("Content-type: application/pdf");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    readfile("./download/".$filename."");
  }
}

?>