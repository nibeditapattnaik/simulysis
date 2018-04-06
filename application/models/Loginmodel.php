<?php 
class Loginmodel extends CI_Model{
    
  
     function __construct(){
        parent :: __construct();
        
    }
  /* public function log($data){
        
        echo "Hii"."&nbsp";
        echo "$data[email]"."<br/>";
        $cond = 'no';
        $cond1 = 'yes';
        $this->db->select('*');
        $this->db->from('regusers');
        $this->db->where('email', $data[email]);
        $this->db->where('password', $data[password]);
        $q = $this->db->get();
        $res=$q->num_rows();
       echo "hello1"."&nbsp";
       echo "$res" ;
        if($q->num_rows() == 0){
            echo "Please Register First";
        }
        else if(($q->num_rows() > 0) //and  'admin_permission' == $cond
        ){
            echo "hello111"."&nbsp";
            $q .= "where admin_permission = 'no'";
            echo "hello111"."&nbsp";
            if($q->numrows()>0){
                echo "nibedita";
                return "true";
            }
           /* $this->db->select('name');
            $this->db->from('regusers'); 
            $this->db->where('admin_permission',$cond);
            $query = $this->db->get();
            echo "hello123"."&nbsp";
            $row = $query->num_rows();
            echo "$row";
            if($row > 0){
                $this->load->view('blog');
            }
            else{
                $this->load->view('about');
            }
            /*foreach($query->result() as $knm){
                echo $knm->name;
                echo "hello 546";
            }
            */
            //return "true";
       // }
       /*else if(($q -> num_rows() > 0 and 'admin_permission' == $cond1)){
            echo ">0 and permissin is yes";
        }*/
      // echo "hello3"."&nbsp";
   // }*/
    public function login($email, $password){
        $query = $this->db->where(['email'=>$email, 'password'=>$password])
            ->get('regusers');
        $em=$query->num_rows();
        //echo "$em";
        if($query->num_rows > 0){
            return $query->row();
        }
        else{
            echo "GO for REGISTRATION first...";
        }
        //echo "hello";
    }
}
?>