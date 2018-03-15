<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Api_model extends CI_Model{

    var $client_service = "frontend-client";
    var $auth_key = "ngsrestapi";

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function validate_auth()
    {
        $client_service = $this->input->get_request_header('Client-Service', TRUE);
        $auth_key = $this->input->get_request_header('Auth-Key', TRUE);


        if ($client_service == $this->client_service && $auth_key == $this->auth_key){
            return true;
        }

        return false;

    }

    public function resolve_login($username, $password)
    {
        $this->db->from('users');
        $this->db->where('username', $username);
        $user = $this->db->get()->row();

        //No user found
        if (empty($user)){
            return false;
        }

        if (password_verify($password, $user->password)){
            return true;
        }
        return false;


    }
}