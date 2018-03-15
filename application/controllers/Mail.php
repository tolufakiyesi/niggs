<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('email');

    }
    public function send(){
        $this->load->library('email');

        $this->email->from('teepfakk@gmail.com', 'Test Mail');
        $this->email->to('tolufakiyesi@yahoo.com');

        $this->email->smtp_host = 'smtp.gmail.com';
        $this->email->smtp_user = 'teepfakk@gmail.com';
        $this->email->smtp_pass = 'blablaBla';
        $this->email->smtp_port = 587;
        $this->email->protocol = 'smtp';


        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        var_dump($this->email);
//        var_dump($this->email->send());
        try{
            $this->email->send();
        }catch (Exception $ex){
            var_dump($ex);

        }




    }
}