<?php
class Registermodel extends CI_Model{
    function __construct(){
        parent::__construct();
        
    }
    public function reg($data){
        echo "<center>";
        echo "<h4><b> <br/><br/></br><br/>";
       echo "Hii"."&nbsp";
       echo "$data[user_name]"."<br/>";
        //return hello;
       // $query="SELECT * FROM regusers WHERE user_name='".$data[user_name]."' and "."email='".$data[email]."'";
        
        //$q=$query->num_rows();
        $this->db->select('*');
        $this->db->from('regusers');
        $this->db->where('user_name',$data[user_name]);
        $this->db->where('email',$data[email]);
        $q=$this->db->get();
       //echo hello;
        //echo $q;
      if( $q->num_rows() > 0 )
        { 
            //echo "$q->num_rows".'()';
        echo "You have already registered"; 
         //return FALSE;
        }
        //echo hello;
       /*if($query->num_rows() > 0){
            echo "You have already registered";
           return FALSE;
        }
        /*else{
            $this->db->insert('regusers',$data);
            echo "You have registered";

        }*/
       else
        {
           return $this->db->insert('regusers',$data); //returns 0 if failure and 1 if success
        }
           
        echo "</b></h4>";
        echo "</center>";
    }
    
}
?>