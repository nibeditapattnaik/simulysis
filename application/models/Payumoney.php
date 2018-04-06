<?php
class Payumoney extends CI_Model
{
  private $action = "";
  private $salt   = "";
  private $key    = "";
  private $hashArray = array();
  
  var $serviceProvider = "";
  var $surl = "";
  var $furl = "";
  
  var $txnid      = "";
  
  function __construct()
  {
    parent::__construct();
    
    $this->action = $this->config->item("payumoney_url");
    $this->salt   = $this->config->item("payumoney_salt");
    $this->key    = $this->config->item("payumoney_merchant_key");
    
    
    $this->furl = base_url("subscribe/transactionfailed");
    $this->surl = base_url("subscribe/transactionsuccess");
  }
  
  public function getAction()
  {
    return $this->action;
  }
  
  public function getKey()
  {
    return $this->key;
  }  
  
  public function getSalt()
  {
    return $this->salt;
  }
  
  public function getTranxId()
  {
    return $this->txnid;
  }
  
  public function setHashArray($array)
  {    
    $this->hashArray[] = $this->key ;
    $this->txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    $this->hashArray[] = $this->txnid ;
    $hashSequence = "amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
    $hashVarsSeq = explode('|', $hashSequence);
    foreach($hashVarsSeq as $hash)
    {
      $hashString = isset($array[$hash])?$array[$hash]:'';   
      if($hash == 'amount')
        $hashString = number_format((float)$hashString, 1, '.', '');        
      $this->hashArray[] = $hashString;
    }
  }
  
  public function generateHash()
  {
    $this->hashArray[] = $this->salt;
    //echo implode("|", $this->hashArray);
    //exit;
    return hash("sha512",implode("|", $this->hashArray));
  }
}

?>