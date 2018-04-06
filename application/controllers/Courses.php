<?php

class Courses extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("users");
    $this->load->model("coursemodel");
    $this->load->model("payumoney");
    $this->load->model("ccavenue");
  }
  
  public function index($page=0)
  {
    $data["allCourses"] = $this->coursemodel->getCoursesPagination(9,$page, "courses/index");
    $this->load->view("templates/header");
    $this->load->view("courses", $data);
    $this->load->view("templates/footer");
  }
  
  public function feacourses($page=0)
  {
    $data["allCourses"] = $this->coursemodel->getCoursesPagination(6,$page, "courses/feacourses", " where c.course_name='FEA'");
    $this->load->view("templates/header");
    $this->load->view("courses", $data);
    $this->load->view("templates/footer");
  }
  
  public function cfdcourses($page=0)
  {
    $data["allCourses"] = $this->coursemodel->getCoursesPagination(6,$page, "courses/cfdcourses", " where c.course_name='CFD'");
    $this->load->view("templates/header");
    $this->load->view("courses", $data);
    $this->load->view("templates/footer");
  }
  
  public function chennaicourses($page=0)
  {
    $data["allCourses"] = $this->coursemodel->getCoursesPagination(6,$page, "courses/chennaicourses", " where cs.course_location='Chennai'");
    $this->load->view("templates/header");
    $this->load->view("courses", $data);
    $this->load->view("templates/footer");
  }
  public function bangalorecourses($page=0)
  {
    $data["allCourses"] = $this->coursemodel->getCoursesPagination(6,$page, "courses/bangalorecourses", " where cs.course_location='Bangalore'");
    $this->load->view("templates/header");
    $this->load->view("courses", $data);
    $this->load->view("templates/footer");
  }
  
  public function hyderabadcourses($page=0)
  {
    $data["allCourses"] = $this->coursemodel->getCoursesPagination(6,$page, "courses/hyderabadcourses", " where cs.course_location='Hyderabad'");
    $this->load->view("templates/header");
    $this->load->view("courses", $data);
    $this->load->view("templates/footer");
  }
  
  public function populatepayumoneyparams()
  {
    $params['first_name'] = $this->input->post("fname");
    $params['last_name'] = $this->input->post("lname");
    $params['age'] = $this->input->post("age");
    $params['email'] = $this->input->post("email");
    $params['phone'] = $this->input->post("phone");
    $params['gender'] = $this->input->post("gender");
    $params['education'] = $this->input->post("edu");
    $params['branch'] = $this->input->post("branch");
    if($id = $this->users->userExists($this->input->post("email"), $this->input->post("phone")))
    {
      $paramCourse["user_id"] = $id;
    }
    else
    {      
      $paramCourse["user_id"] = $this->users->registerUser($params);  
    }  
    $paramCourse['course_schedule_x_id'] = $this->input->post("course");
    
    $groupId = $this->input->post("groupId");
    $existingGroup = true;
    if(empty($groupId))
    {
      $groupId = md5($paramCourse["user_id"].$paramCourse['course_schedule_x_id']);
      $existingGroup = true;
    }
    
    $paramCourse["group_id"] = $groupId;
    
    $crssId = $this->coursemodel->insertCrossReference($paramCourse);
    
    $array["paymentParts"] = array("name"=>"abc",
                                   "description"=>"abcd",
                                   "value"=>"500",
                                   "isRequired"=>"true",
                                   "settlementEvent" => "EmailConfirmation"
                                  );

    $array["paymentIdentifiers"] = array("field"=>"CompletionDate",
                                         "value"=>"31/10/2012",
                                        ); 
    
    $hashparams['productinfo'] = json_encode($array);
    $hashparams['amount'] = (float) "1000.0";
    $hashparams['email'] = $this->input->post("email");
    $hashparams['firstname'] = $this->input->post("fname");
    
    $this->payumoney->setHashArray($hashparams);
    $hash = $this->payumoney->generateHash();
    $txnid = $this->payumoney->getTranxId();
    $key = $this->payumoney->getKey();
    $surl = $this->payumoney->surl;
    $furl = $this->payumoney->furl;
    
    $this->coursemodel->saveTransaction($txnid, $crssId);
    $result["url"] = $this->payumoney->getAction();
    $result["hash"] = $hash;
    $result["txnid"] = $txnid;
    $result["key"] = $key;
    $result["surl"] = $surl;
    $result["furl"] = $furl;
    $result["productinfo"] = $hashparams['productinfo'];
    $result["servProv"] = $this->payumoney->serviceProvider;
    
    header('content-type: application/json; charset=utf-8');
    echo json_encode($result);
  }
  
  
  
  public function populateccavenueparams()
  {
    $params['first_name'] = $this->input->post("fname");
    $params['last_name'] = $this->input->post("lname");
    $params['age'] = $this->input->post("age");
    $params['email'] = $this->input->post("email");
    $params['phone'] = $this->input->post("phone");
    $params['gender'] = $this->input->post("gender");
    $params['education'] = $this->input->post("edu");
    $params['branch'] = $this->input->post("branch");
    if($id = $this->users->userExists($this->input->post("email"), $this->input->post("phone")))
    {
      $paramCourse["user_id"] = $id;
    }
    else
    {      
      $paramCourse["user_id"] = $this->users->registerUser($params);  
    }  
    $paramCourse['course_schedule_x_id'] = $this->input->post("course");
    
    $groupId = $this->input->post("groupId");
    $existingGroup = true;
    if(empty($groupId))
    {
      $groupId = md5($paramCourse["user_id"].$paramCourse['course_schedule_x_id']);
      $existingGroup = true;
    }
    
    $paramCourse["group_id"] = $groupId;
    
    $crssId = $this->coursemodel->insertCrossReference($paramCourse);
    $txnid = $this->ccavenue->getTxnId();
    
    $this->coursemodel->saveTransaction($txnid, $crssId);
	
    $data = "";

    $data .= "merchant_id={$this->ccavenue->merchant_id}&";
    $data .= "order_id={$txnid}&";
    $data .= "amount=1000&";
    $data .= "currency=INR&";
    $data .= "redirect_url={$this->ccavenue->rurl}&";
    $data .= "cancel_url={$this->ccavenue->rurl}&";
    $data .= "language=EN";
    $working_key = $this->ccavenue->key;
	
	//echo $data;
    $result["merchant_data"] = $this->ccavenue->encrypt($data, $working_key);	
    $result["url"] = $this->ccavenue->action;	
    $result["access_code"] = $this->ccavenue->access_code;
    
    header('content-type: application/json; charset=utf-8');
    echo json_encode($result);
  }
  
}

?>