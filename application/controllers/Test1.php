<?php
class Test1 extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
	//$this->load->model("ccavenue");
  }
  
  public function index()
  {
	//echo $this->ccavenue->encrypt("hello", "7D55698A9D6F276B94FED009897B048B");
	$data['msg']= $this->ccavenue->encrypt("hello", "7D55698A9D6F276B94FED009897B048B");
	$this->load->view("test", $data);
  }
}

?>