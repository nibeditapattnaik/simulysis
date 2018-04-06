<?php
class Faqmodel extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }
  
  public function saveFaq($courseId, $question, $answer)
  {
    $params['course_id'] = $courseId;
    $params['question'] = $question;
    $params['answer'] = $answer;
    $this->db->insert("course_faq", $params);
    if($this->db->insert_id())
      return true;
    return false;    
  }
  
  public function getAllFaqs($courseId="")
  {
    $query = "select * from course_faq";
    if(empty($courseId))
      $query .= " where course_id=''";
    else
      $query .= "where course_id=$courseId";
    $result = $this->db->query($query);
    $recordSet = array();
    foreach ($result->result() as $row)
    {
      $recordSet[]            = $row;
    }
    return $recordSet; 
  }
}
?>