<?php
class Users extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }
  
  public function do_admin_login($username, $password)
  {
    $password = md5($password);
    $query = "select * from admin_users where user_name='$username' and password='$password'";
    $userResult = $this->db->query($query);
    if($userResult -> num_rows() == 1)
    {
      return $userResult->row_array();
    }
    else
    {
      return false;
    }    
  }
  
  public function registerUser($params)
  {
    $this->db->insert("users", $params);
    $id = $this->db->insert_id();
    return $id;
  }
  
  public function userExists($email, $phone)
  {
    $query = "select id from users where email='$email' and phone='$phone'";
    $result = $this->db->query($query);
    if($result->num_rows())
    {
      return $result->row()->id;
    }
    return false;
  }
  
  public function subscribeNewsLetter($email)
  {
    $query = "select count(*) as totalcount from newsletter_subscription where email='$email'";
    $result = $this->db->query($query);
    if($result->row()->totalcount)
    {
      return "You are already subscribed to our news letter. Thanks for showing your interest.";
    }
    $params['email'] = $email;
    if($this->db->insert("newsletter_subscription", $params))
      return "Thank you for sucscribing to our newsletter.";
  }
  
  public function getAllSubscriberData()
  {
    $query = "select u.first_name,u.last_name,u.email,u.education,u.phone,ucc.group_id,cs.course_location,cs.start_date,c.course_name, p.trans_id,p.start_time,p.end_time, p.status from payments p
      left join user_course_cross ucc on p.cross_ref_id = ucc.id
      left join users u on ucc.user_id = u.id
      left join course_schedule_cross csc on ucc.course_schedule_x_id = csc.id
      left join course_schedule cs on csc.course_schedule_id = cs.id
      left join courses c on csc.course_id = c.id
    ";
    
    $result = $this->db->query($query);
    $returnResult = array();
    foreach($result->result() as $row)
    {
      $returnResult[] = $row;
    }
    return $returnResult;
  }
}
?>