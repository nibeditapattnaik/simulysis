<?php
class Emailhandler extends CI_Model
{
  var $from = "Simulysis@simulysis.my";
  
  public function __construct()
  {
    $this->load->library('email');
    $this->load->model('coursemodel');
    $this->email->initialize(array("mailtype"=>'html'));
    parent::__construct();
  } 
  
  public function sendContactMail($name, $mail, $phone, $message)
  {
    $this->email->from($mail);
    $this->email->to("info@simulysis.com");
    $this->email->subject("Query Mail: $name $phone");
    $this->sendMail($message);
  }
  
  public function notifyUserPaymentDetails($txnid)
  {
    $query = "Select u.*, p.*, ucr.group_id, ucr.course_schedule_x_id as cross_id from payments p 
    left join user_course_cross ucr on p.cross_ref_id = ucr.id
    left join users u on ucr.user_id = u.id
    where p.trans_id = '$txnid'";
    $result = $this->db->query($query);
    
    $details = $result->row();
    $groupId= $details->group_id;
    
    $groupDetails = $this->coursemodel->getGroupDetails($groupId);
    $courseDetails = $this->coursemodel->getCourseDetails($details->cross_id);
    $topicDetails = $this->coursemodel->getTopicDetails($courseDetails->course_id);
    foreach($topicDetails as $topic)
    {
      $sessionArray[$topic->id] =  $this->coursemodel->getSessionDetailsByTopic($topic->id);
    }
    $this->email->from($this->from);
    $this->email->to($details->email);
    
    $this->email->subject('Simulysis: Subscription Notification');    
    
    $startTime = date("Y-M-d H:i:s", $details->start_time);
    $endTime = date("Y-M-d H:i:s", $details->end_time);
    
    $message1 = "Hi {$details->first_name},<br/><br/>";
    $message1 .= "Thank you for showing interest on our courses. <br/><br/>";
    $message1 .= "Here is your order details. <br/><br/>";
    $message1 .= "<table border=1>
    <tr>
      <th>Transaction Id</th>
      <th>Course Name</th>
      <th>Amount</th>
      <th>Start Time</th>
      <th>End Time</th>
      <th>Status</th>
    </tr>
    <tr>
      <td>{$txnid}</td>
      <td>{$courseDetails->course_name}</td>
      <td>1000 INR</td>
      <td>{$startTime}</td>
      <td>{$endTime}</td>
      <td>{$details->status}</td>
    </tr>    
    </table>";
    //get the message template from view file
    $message1 .= "<p style='color:green;'>Course Name: {$courseDetails->course_name}</p><p>Location: {$courseDetails->course_location}</p><p>Venue: {$courseDetails->course_venue}</p><p>Date: {$courseDetails->start_date}</p><p>Course Id: {$courseDetails->unique_course_id}</p>";
    $groupCount = count($groupDetails);
    if($groupCount>1)
      $message1 .= "<p style='color:red;'>You have {$groupCount} members in your group. Add ".(5-$groupCount)." to your team to get 10% discount. Your groupid is '{$groupId}'. Share this with your friend and ask them to enter this group id while registering for the same course.</p>";
    else
      $message1 .= "<p style='color:red;'>Here is your fresh group id '{$groupId}'. Share this with your friend. Make a group of 5 and availe 10% discount.</p>" ;
    $message1 .= "<p>Here is the course schedule and session timings.</p>";
    $message1 .= "<table border=1>";
    foreach($topicDetails as $topic)
    {
      $message1 .= "<tr>
        <td>{$topic->topic_name}</td>
        <td>{$topic->objective}</td>
        <td>{$topic->date}</td>
        <td>{$topic->duration}</td>
      ";
      foreach($sessionArray[$topic->id] as $session)
      {
        $message1 .= "<td>{$session->start_time} - {$session->end_time}</td>";
      }
      $message1 .= "</tr>";
    }
    $message1 .= "</table>";
    $this->sendMail($message1);
  }
  
  public function sendMail($message)
  {
    //get the header footer from view file
    //$header = $this->load->view("email/header", true);  
    //$footer = $this->load->view("email/footer", true); 
    //$message = $header.$message.$footer;
    $this->email->message($message);
    $this->email->send();
  }
}

?>