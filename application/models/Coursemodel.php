<?php
class Coursemodel extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }
  
  public function insertCrossReference($params)
  {
    $this->db->insert("user_course_cross", $params);
    $id = $this->db->insert_id();
    return $id;
  }
  
  public function getGroupDetails($groupId)
  {
    $query = "select u.* from users u left join user_course_cross ucr on ucr.user_id=u.id where ucr.group_id='$groupId'";
    $result = $this->db->query($query);
    $returnResult = array();
    foreach($result->result() as $row)
    {
      $returnResult[] = $row;
    }
    return $returnResult;
  }
  
  public function getCoursesOnly()
  {
    $query = "select * from courses";
    
    $result = $this->db->query($query);
    $returnResult = array();
    foreach($result->result() as $row)
    {
      $returnResult[] = $row;
    }
    return $returnResult;
  }
  
  public function saveTransaction($txnid, $crossId)
  {
    $date = time();
    $this->db->insert("payments", array("trans_id"=>$txnid, "cross_ref_id"=>$crossId, "start_time"=>$date));
  }  
  
  public function updateStatus($txnid, $status)
  {
    $params['end_time'] = time();
    $params['status']   = strtolower($status);
    $this->db->where('trans_id', $txnid);
    $this->db->update('payments', $params); 
  }
  
  public function getCourses($limit="", $featured=0)
  {
    $query = "select c.course_name, c.course_description, cs.course_price, cs.days, cs.timing, cs.course_venue, cs.course_location, cs.start_date, cs.duration, csc.id, csc.image, csc.course_display_id from courses c
      left join course_schedule_cross csc on c.id=csc.course_id
      left join course_schedule cs on  csc.course_schedule_id = cs.id
    ";
    
    if($featured>0)
      $query .= " where csc.featured=$featured"; 
    
    if(!empty($limit))
      $query .= " LIMIT $limit";
    
    $result = $this->db->query($query);
    $returnResult = array();
    foreach($result->result() as $row)
    {
      $returnResult[] = $row;
    }
    return $returnResult;
  }
  
  public function getCoursesPagination($perPage, $page=0, $url="", $where="")
  {
    $query = "select c.course_name, c.course_description, cs.course_price, cs.course_venue, cs.days, cs.timing, cs.course_location, cs.start_date, cs.duration, csc.id, csc.image, csc.course_display_id from courses c
      left join course_schedule_cross csc on c.id=csc.course_id
      left join course_schedule cs on  csc.course_schedule_id = cs.id 
    ";
    
    if(!empty($where))
      $query .= $where;
    
    $offset = $page ;
    $query .= " LIMIT $offset, $perPage";   
    
   
    
    $result = $this->db->query($query);
    $returnResult = array();
    foreach($result->result() as $row)
    {
      $returnResult["result"][] = $row;
    }
    $returnResult['pagination'] = $this->createPagination($perPage, $url, $where);
    return $returnResult;
  }
  
  public function createPagination($perPage, $url="", $where)
  {
    $countQuery = "select c.course_name, c.course_description, c.course_price, cs.course_venue, cs.course_location, cs.start_date, cs.duration, csc.id from courses c
      left join course_schedule_cross csc on c.id=csc.course_id
      left join course_schedule cs on  csc.course_schedule_id = cs.id";
    
    if(!empty($where))
      $countQuery .= $where;
    
    $countResult = $this->db->query($countQuery);
    $count = $countResult->num_rows();
    
    $this->load->library('pagination');

    $config['base_url'] = empty($url)? "javascript:void(0)": base_url($url);
    $config['total_rows'] = $count;
    $config['per_page'] = $perPage;
    $config['num_links'] = 3;
    
    $config['full_tag_open'] = '<ul  class="pagination">';
    $config['full_tag_close'] = '</ul>';

    $config['first_link'] = '« First';
    $config['first_tag_open'] = '<li class="prev page">';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = 'Last »';
    $config['last_tag_open'] = '<li class="next page">';
    $config['last_tag_close'] = '</li>';

    $config['next_link'] = 'Next →';
    $config['next_tag_open'] = '<li class="next page">';
    $config['next_tag_close'] = '</li>';

    $config['prev_link'] = '← Previous';
    $config['prev_tag_open'] = '<li class="prev page">';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="active"><a href="">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li class="page">';
    $config['num_tag_close'] = '</li>';    

    $this->pagination->initialize($config);
    return $this->pagination->create_links();
  }
  
  public function getCourseDetails($crossId)
  {
    $query = "select c.id as course_id, c.*, cs.*, csc.id as cross_id, csc.unique_course_id, csc.course_display_id from courses c
      left join course_schedule_cross csc on c.id=csc.course_id
      left join course_schedule cs on  csc.course_schedule_id = cs.id  where csc.id= $crossId
    ";
    $result = $this->db->query($query);
    return $result->row();
  }
  
  public function validateGroupId($grpId)
  {
    $query = "select * from user_course_cross where group_id = '$grpId'";
    $result = $this->db->query($query);
    $result->num_rows();
    if($result->num_rows() > 0)
    {
      if($result->num_rows() >=5)
        $message['error'] = "Already 5 members are there in this group.";
      else
        $message['message'] = "valid";
      return $message;
    }
    $message['error'] = "Invalid Group Id.";    
    return $message;
  }
  
  public function getTopicDetails($courseId)
  {
    $query = "select t.* from course_topics t 
      left join course_topic_cross ctc on ctc.course_topic = t.id where ctc.course = $courseId order by t.sequence
    ";
    
    $result = $this->db->query($query);
    $returnResult = array();
    foreach($result->result() as $row)
    {
      $returnResult[] = $row;
    }
    return $returnResult;
  }
  
  public function getSessionDetailsByTopic($topicId)
  {
    $query = "select ts.* from course_topic_schedule ts 
      left join topic_schedule_cross tsc on tsc.topic_schedule_id = ts.id where tsc.course_topic_id = $topicId
    ";
    $result = $this->db->query($query);
    $returnResult = array();
    foreach($result->result() as $row)
    {
      $returnResult[] = $row;
    }
    return $returnResult;
  }
  
  public function getCourseSchedules()
  {
	  $result = $this->db->query("select csc.course_display_id, cs.start_date from course_schedule cs left join course_schedule_cross csc on cs.id = csc.course_schedule_id");
	$resordset = array();
	foreach($result->result() as $row)
	{
	  $records = array();
      $records["title"] = $row->course_display_id;
      $records["start"] = date("Y-m-d", strtotime($row->start_date));
	  $records["color"] = "#F39C12";
	  
	  $recordset[] = $records;
	}
	
	return $recordset;
  }
}
?>