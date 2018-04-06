<?php
class Blogmodel extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }
  
  public function saveBlog($courseId, $content, $title)
  {
    $params['course_id'] = $courseId;
    $params['blog_content'] = $content;
    $params['title'] = $title;
    $this->db->insert("course_blog", $params);
    if($this->db->insert_id())
      return true;
    return false;    
  }
  
  public function getBlogDetailsById($id)
  {
    $query = "select * from course_blog where id=$id";
    $result = $this->db->query($query);
    return $result->row();
  }
  
  public function getBlogs($limit=0, $featuredOnly = "", $orderBy = "")
  {
    $query  = "select * from course_blog";
    
    if($featuredOnly)
      $query .= " where featured=1";
    
    if($limit>0)
      $query .= " LIMIT $limit";
    
    
    $result = $this->db->query($query);
    
    $returnResult = array();
    foreach($result->result() as $row)
    {
      $returnResult[] = $row;
    }
    return $returnResult;
  }
  
   public function getBlogsPagination($perPage, $page=0, $url="", $where="")
  {
    $query = "select * from course_blog $where";
    
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
    //echo $where;
    $countQuery = "select * from course_blog $where";
    //echo $countQuery;
    //exit;
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
  
  
}
?>