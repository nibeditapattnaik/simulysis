<?php

class Subscribe extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("payumoney");
    $this->load->model("coursemodel");
    $this->load->model("emailhandler");
    $this->load->model("users");
    $this->load->model("ccavenue");
  }
  
  public function index()
  {
    $data["allCourses"] = $this->coursemodel->getCourses();
    $this->load->view("templates/header");
    $this->load->view("subscribe", $data);
    $this->load->view("templates/footer");
  }
  
  public function newsletter()
  {
    $email = $this->input->post("email");
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false)
      $result['message'] = "Please enter a valid email.";
    else
      $result['message'] = $this->users->subscribeNewsLetter($email);
    header('content-type: application/json; charset=utf-8');
    echo json_encode($result);
  }
  
  /* public function populateUniqueCourseId()
  {
    $result = $this->db->query("select * from course_schedule_cross");
    foreach($result->result() as $row)
    {
      $uci = md5($row->id);
      $this->db->query("update course_schedule_cross set unique_course_id = '$uci' where id=".$row->id);
    }
  } */
  
  public function populatecourse($crossId)
  {
    $data["allCourses"] = $this->coursemodel->getCourses();
    $data["selectedcourse"] = $crossId;
    $this->load->view("templates/header");
    $this->load->view("subscribe", $data);
    $this->load->view("templates/footer");
  }
  
  public function crosstocourseandviceversa()
  {
    $crossId = $this->input->post("crossid");
    $uniqueCourseId = $this->input->post("courseId"); 
    if(!empty($crossId))
      $result['uniqueCourseId'] = md5($crossId);
    header('content-type: application/json; charset=utf-8');
    echo json_encode($result);
    //if(!empty($uniqueCourseId))
      //$result['courseid'] = $this->coursemodel->converttocoursecrossid($uniqueCourseId);
  }
  
  public function checkgroupid()
  {
    $grpId = $this->input->post("groupid");
    $result = $this->coursemodel->validateGroupId($grpId);
    
    header('content-type: application/json; charset=utf-8');
    echo json_encode($result);
  }
  
  public function transactionsuccess()
  {
    $status=$this->input->post("status");
    $firstname=$this->input->post("firstname");
    $amount=$this->input->post("amount");
    $txnid=$this->input->post("txnid");
    $posted_hash= $this->input->post("hash");
    $key= $this->input->post("key");
    $productinfo= $this->input->post("productinfo");
    $email=$this->input->post("email");
    $salt = $this->payumoney->getSalt();

    If ($this->input->post("additionalCharges")) 
    {
      $additionalCharges=$this->input->post("additionalCharges");
      $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
    }
    else 
    {
      $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
    }
  	$hash = hash("sha512", $retHashSeq);
		 
    if ($hash != $posted_hash) 
    {
      $message = "Invalid Transaction. Please try again";
    }
	  else 
    {
      $this->coursemodel->updateStatus($txnid, $status);
      $this->emailhandler->notifyUserPaymentDetails($txnid);
      $message = "<h4>Thank You. Your order status is ". $status .".</h4>";
      $message .= "<h5>Your Transaction ID for this transaction is ".$txnid.".</h5>";
      $message .= "<h5>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h5>";
		}    
    $data['message'] = $message;
    $this->load->view("templates/header");
    $this->load->view("transsuccess", $data);
    $this->load->view("templates/footer");
  }
  public function transactionfailed()
  {
    $status=$this->input->post("status");
    $firstname=$this->input->post("firstname");
    $amount=$this->input->post("amount");
    $txnid=$this->input->post("txnid");
    $posted_hash= $this->input->post("hash");
    $key= $this->input->post("key");
    $productinfo= $this->input->post("productinfo");
    $email=$this->input->post("email");
    $salt = $this->payumoney->getSalt();

    If ($this->input->post("additionalCharges")) 
    {
      $additionalCharges=$this->input->post("additionalCharges");
      $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
    }
    else 
    {
      $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
    }
  	$hash = hash("sha512", $retHashSeq);
		 
    if ($hash != $posted_hash) 
    {
      $message = "Invalid Transaction. Please try again";
    }
	  else 
    {
      $this->coursemodel->updateStatus($txnid, $status);
      $this->emailhandler->notifyUserPaymentDetails($txnid);
      $message = "<h4>Thank You. Your order status is ". $status .".</h4>";
      $message .= "<h5>Your Transaction ID for this transaction is ".$txnid.".</h5>";
      $message .= "<h5>Please Retry Your payment.</h5>";
		}    
    $data['message'] = $message;
    $this->load->view("templates/header");
    $this->load->view("transsuccess", $data);
    $this->load->view("templates/footer");
  }
  
  public function paymentredirect()
  {
	$workingKey = $this->ccavenue->key;		//Working Key should be provided here.
	$encResponse = $this->input->post("encResp");			//This is the response sent by the CCAvenue Server
	$rcvdString = $this->ccavenue->decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status = "";
	$decryptValues = explode('&', $rcvdString);
	$dataSize = sizeof($decryptValues);
	$message = "";
	
	$txnid = "";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==0)	$txnid = $information[1];
		if($i==3)	$order_status=$information[1];
	}

	if($order_status==="Success")
	{
		$message = "Thank you for registering. Course details has been mailed to your email.";
		
	}
	else if($order_status==="Aborted")
	{
		$message .= "<br>You have cancelled the transaction. Please try again later.";
	
	}
	else if($order_status==="Failure")
	{
		$message .= "<br>The transaction has been declined.";
	}
	else
	{
		$message .= "<br>Security Error. Illegal access detected";
	
	}

	$message .= "<br><br>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if(in_array($i, array(0,1,2,5,6)))
	    	$message .= $information[0].' &nbsp;&nbsp;&nbsp;&nbsp;'.$information[1].'<br>';
	}

      //$this->coursemodel->updateStatus($txnid, $order_status);
      //$this->emailhandler->notifyUserPaymentDetails($txnid);

    $data['message'] = $message;
    $this->load->view("templates/header");
    $this->load->view("transsuccess", $data);
    $this->load->view("templates/footer");
  }
}

?>