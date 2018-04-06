<?php
class Email extends CI_Controller{
    function __construct(){
        parent::__construct();
    }
    function index(){
      /*  $config = Array(
            'protocol' =>'smtp',
            'smtp_hpts' =>'ssl://smtp.googlemail.com',
            'smtp_port' =>587,
            'smtp_user' => 'nibedita2017ee@gmail.com',
            'smtp_pass' => 'mamakunumuni'
        );
        
        $this->load->library('email',$config);
        $this->email->set_newline("\r\n");
        
        $this->email->from('nibedita2017ee@gmail.com');
        $this->email->to('nibedita2017ee@gmail.com');
        $this->email->subject('This is a testing email from codeigniter');
        $this->email->message('It is workin great');
        
        if($this->email->send()){
            echo 'your mail sent successfully';
        }
        
        else{
            show_error($this->email->print_debugger());
        }
        
    */
        
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'nibedita2017ee@gmail.com';
        $config['smtp_pass']    = 'mamakunumuni';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);

        $this->email->from('nibedita2017ee@gmail.com');
        $this->email->to('nibedita2017ee@gmail.com'); 

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');  

        $this->email->send();

        echo $this->email->print_debugger();

       // $this->load->view('email_view');
}
}