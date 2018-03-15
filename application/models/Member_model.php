<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Member_model extends CI_Model{
    public function __construct(){
        parent ::__construct();
        $this->load->database();
        $this->load->helper('date');

    }

    public function date_formatter($date){
        //if ( (int)mdate('%Y', time()) > (int)mdate('%Y', strtotime($date) ) -1  ){
        $month = mdate('%m', strtotime($date) );
        $year = mdate('%Y', strtotime($date) ) ;
        // return "";
        //}
        $months = array(
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        );
        return $months[$month]. " ". $year ;

    }

    public function get_member($user_id) {

        $this->db->from('members');
        $this->db->where('id', $user_id);
        return $this->db->get()->row();

    }

    public function get_members(){
        $this->db->from('members');
        return $this->db->get()->result();
    }

    public function get_member_by_username($username){
        $this->db->from('members');
        $this->db->where('username', $username);
        return $this->db->get()->row();
    }

    public function get_user_id_from_userdetail($user_detail) {

        $this->db->select('id');
        $this->db->from('members');
        $this->db->where('username', $user_detail);
        $this->db->or_where('email', $user_detail);

        return $this->db->get()->row('id');

    }

    public function get_username($interest){
        $abbr = array(
            "astronomy" =>'APS',
            "atmosphere" => 'ATM',
            "hydro" =>'HYD',
            "ocean" =>'OCN',
            "solar" =>'STS',
            "solid" =>'SES',
        );


        $username = mdate('%Y', time());
        $username .= $abbr[$interest];

        $this->db->from('index_list');
        $this->db->where('id', 1);
        $index_no = $this->get_index(strtolower($abbr[$interest]));
        $username .= str_pad($index_no, 3, "0", STR_PAD_LEFT);

        return $username;

    }

    public function register($user) {

        $password = $user['password'];
        $user['password'] = $this->hash_password($user['password']);
        if ($this->db->insert('members', $user)){
            return $this->send_confirmation_email($user['username'], $user['email'], $user['firstname'], $password) ;
        }

        return false;


    }

    public function reset_password($user_id, $password){
        $user = array(
            'password' => $this->hash_password($password),
            'changed_pass' => '1'
        );
        $this->db->where('id', $user_id);
        return $this->db->update('members', $user);
    }

    public function resolve_login($user_detail, $password){
        $this->db->select('password');
        $this->db->from('members');
        $this->db->where('username', $user_detail);
        $this->db->or_where('email', $user_detail);
        $hash = $this->db->get()->row('password');

        return $this->verify_password_hash($password, $hash);
        //return $password == $hash;
    }

    public function update($user_id, $password, $update_data){
        $this->db->select('password');
        $this->db->from('members');
        $this->db->where('id', $user_id);
        $hash = $this->db->get()->row('password');

        if ($this->verify_password_hash($password, $hash)){

            $this->db->where('id', $user_id);
            return $this->db->update('members', $update_data);
        }
        return false;
    }

    public function update_password($current_password, $new_password){
        $this->db->select('password');
        $this->db->from('members');
        $this->db->where('id', $_SESSION['user_id']);
        $hash = $this->db->get()->row('password');

        if ($this->verify_password_hash($current_password, $hash)){

        //if ($current_password == $hash){
            //$this->db->set('password', $this->hash_password($new_password));
            $user = array(
                'password' => $this->hash_password($new_password),
                'changed_pass' => '1'
            );
            $this->db->where('id', $_SESSION['user_id']);
            return $this->db->update('members', $user);
        }
        return false;
    }

    private function hash_password($password) {

        return password_hash($password, PASSWORD_BCRYPT);

    }

    private function verify_password_hash($password, $hash) {

        return password_verify($password, $hash);

    }

    private function update_index($update_data){
        if (!empty($update_data)){
            $this->db->where('id', '1');
            return $this->db->update('index_list', $update_data);
        }
        return false;

    }

    private function get_index($interest){
        $this->db->where('id', 1);
        $index = $this->db->get()->row($interest);
        $index+=1;

        $update_data = array(
            $interest => $index,
        );
        //var_dump($update_data);

        if ($this->update_index($update_data)){
            return $index;
        }
        return '000';
    }

    private function send_confirmation_email($username, $email, $firstname, $password) {

        // load email library and url helper
        $this->load->library('email');
        $this->email->from('donotreply@niggs.org', 'NIGGS');

        // get user registration date
        //$registration_date = $this->db->select('date')->from('members')->where('username', $username)->get()->row('date');
        $registration_date = $this->db->select('date')
            ->from('members')
            ->where('username', $username)
            ->get()
            ->row('date');

        // create a user email hash with user email and user registration date


        $hash = sha1($email . $registration_date);

        // prepare the email

        $this->email->to($email);
        $this->email->subject('NIGGS - Confirm your account');
        $message  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>';
        $message .= "Hi " . $firstname . ",<br>";
        $message .= "Thanks for registering with us<br><br>";
        $message .= "Here are your login details : <br> <br> Username: ". $username. "<br> Password: ". $password . "<br>";
        $message .= "Ensure you change your password upon login. <br><br>";
        $message .= "Please click the link below to confirm your NIGGS membership account <br><br>";

        $message .= "Click this link: <a target=\"_blank\" href=\"" . base_url() . "confirm_account/". $username . "/" . $hash . "\">Confirm your email and validate your account</a>";

        $message .= "<br><br>Please ignore this message if you didnt create the account ";
        $message .= "</body></html>";
        $link = base_url() . "confirm_account/". $username . "/" . $hash ;
        //var_dump($link);
        $this->email->message($message);


        // send the email and return status
        return $this->email->send();
        //$this->email->send();

    }

    public function send_password_reset_link($userdetail){
        $this->load->library('email');
        $this->email->from('donotreply@niggs.org', 'NIGGS');

        //Get user
        $this->db->from('members');
        $this->db->where('email', $userdetail);
        $this->db->or_where('username', $userdetail);
        $user = $this->db->get()->row();
        //var_dump($user);

        if (!empty($user)){
            $this->email->to($user->email);
            $this->email->subject('NIGGS - Password Reset');
            $message  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>';

            $message .= "You requested to change your password. <br><br>";
            $message .= "Please click the link below to reset your password <br><br>";

            $username_hash = md5($user->username);
            $date_hash = md5($user->date);
            $message .= "Click this link: <a target=\"_blank\" href=\"" . base_url() . "reset_password/".$user->username."/"  . $username_hash . "/" . $date_hash . "\">Reset your password</a>";

            $message .= "<br><br>Please ignore this message if you didnt request the password change ";
            $message .= "</body></html>";
            $this->email->message($message);


            // send the email and return status
            return $this->email->send();
        }
        return false;
    }



}