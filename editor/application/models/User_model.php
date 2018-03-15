<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model{
    public function __construct(){
        parent ::__construct();
        $this->load->database();
    }

    public function resolve_user_login($username, $password) {


        $this->db->select('password');
        $this->db->from('users');
        $this->db->where('username', $username);
        $hash = $this->db->get()->row('password');

        return $this->verify_password_hash($password, $hash);

    }

    public function get_user_id_from_username($username) {

        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('username', $username);

        return $this->db->get()->row('id');

    }

    public function get_username_from_user_id($user_id) {

        $this->db->select('username');
        $this->db->from('users');
        $this->db->where('id', $user_id);

        return $this->db->get()->row('username');

    }

    public function create_user($user, $password) {
        $user['password'] = $this->user_model->hash_password($password);
        //return $this->db->insert('users', $user) && $this->send_confirmation_email($user);
        return $this->db->insert('users', $user);

    }

    public function get_user($user_id) {

        $this->db->from('users');
        $this->db->where('id', $user_id);
        return $this->db->get()->row();

    }

    public function get_user_by_username($username) {

        $this->db->from('users');
        $this->db->where('username', $username);
        return $this->db->get()->row();

    }

    public function get_users() {

        $this->db->from('users');
        return $this->db->get()->result();

    }

    public function update($user_id, $update_data, $password){
        $this->db->select('password');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $hash = $this->db->get()->row('password');

        if ($this->verify_password_hash($password, $hash)){
            $this->db->where('id', $user_id);
            return $this->db->update('users', $update_data);
        }
        return false;
    }

    public function update_user($user_id, $update_data){
        $this->db->select('password');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $hash = $this->db->get()->row('password');

        if ($this->verify_password_hash($update_data->password, $hash)){
            $this->db->where('id', $user_id);
            return $this->db->update('users', $update_data);
        }
        return false;
    }

    public function update_password($current_password, $new_password){
        $this->db->select('password');
        $this->db->from('users');
        $this->db->where('id', $_SESSION['user_id']);
        $hash = $this->db->get()->row('password');

        if ($this->verify_password_hash($current_password, $hash)){


            $user = array(
                'password' => $this->hash_password($new_password),

            );
            $this->db->where('id', $_SESSION['user_id']);
            return $this->db->update('users', $user);
        }
        return false;
    }


    public function search($query){
        $this->db->from('users');
        $this->db->like('username', $query);
        $this->db->or_like('email', $query);
        $this->db->or_like('research_field', $query);
        return $this->db->get()->result();
    }

    public function get_category($category){
        $categories = array(
           '1' => 'Editor',
           '2' => 'Reviewer',
           '3' => 'Author'
        );
        return $categories[$category];
    }

    private function hash_password($password) {

        return password_hash($password, PASSWORD_BCRYPT);

    }

    private function verify_password_hash($password, $hash) {

        return password_verify($password, $hash);

    }

    public function get_reviewers() {

        $this->db->from('users');
        $this->db->where('priviledge', '2');
        $this->db->or_where('priviledge', '1');
        return $this->db->get()->result();

    }

    public function get_application($user_id){
        $this->db->from('applications');
        $this->db->where('applicant_id', $user_id);
        return $this->db->get()->row();
    }

    public function priviledge_formatter($priviledge){
        if ($priviledge==NULL){
            return $priviledge;
        }
        $priviledges = array(
            '1' => 'Editor',
            '2' => 'Reviewer',
            '3' => 'Author',

        );
        return $priviledges[$priviledge];
    }

    public function send_application($application){
        return $this->db->insert('applications', $application);
    }

    public function make_reviewer($user_id){
        $this->db->where('applicant_id', $user_id);
        $this->db->delete('applications');

        $data = array(
            'priviledge' => '2',
        );

        $this->db->where('id', $user_id);

        return $this->db->update('users', $data);
    }

    public function make_editor($user_id){
        $application = array(
            'status' => '2',
            'date_granted' => unix_to_human(time(), TRUE),
        );
        $this->db->where('applicant_id', $user_id);
        $this->db->update('applications', $application);

        $data = array(
            'priviledge' => '1',
        );

        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }

    public function super_update($user_id, $user){
        $this->db->where('id', $user_id);
        return $this->db->update('users', $user);
    }




    public function reset_password($user_id, $password){
        $user = array(
            'password' => $this->hash_password($password),
            'hash' => '',
        );
        $this->db->where('id', $user_id);
        return $this->db->update('users', $user);
    }

    private function send_confirmation_email($user) {

        // load email library and url helper
        $this->load->library('email');
        $this->email->from('niggsorg@gmail.com', 'NIGGS Editorial');

        // prepare the email

        $this->email->to($user['email']);
        $this->email->subject('NIGGS Editorial - Confirm your account');
        $message  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>';
        $message .= "Thanks for registering with us". $user->firstname ."<br><br>";
        $message .= "Your account has been created and you are by default granted author priviledges. <br>";
        $message .= "This includes the ability to submit journals for review by our editors <br>";
        $message .= "If you are willing to join our team of Reviewers and Editors, please login and apply for a priviledge change. <br>";
        $message .= "You will be required to submit an example of something you've worked on before for you to be approved<br><br>";
        $message .= "Please click the link below to confirm your NIGGS Editorial account then Login as an author<br><br>";

        $message .= "Click this link: <a target=\"_blank\" href=\"" . base_url() . "confirm_account/". $user['username'] . "/" . md5($user['password']."nG5") . "\">Confirm your email and validate your account</a>";

        $message .= "<br><br>Please ignore this message if you didnt create the account ";
        $message .= "</body></html>";
        //$link = base_url() . "confirm_account/". $username . "/" . $hash ;
        //var_dump($link);
        $this->email->message($message);


        // send the email and return status
        return $this->email->send();


    }



    public function send_password_reset_link($userdetail){
        $this->load->library('email');
        $this->email->from('niggsorg@gmail.com', 'NIGGS Editorial');

        $this->db->from('users');
        $this->db->where('email', $userdetail);
        $this->db->or_where('username', $userdetail);
        $user = $this->db->get()->row();

        if (!empty($user)){
            $this->email->to($user->email);
            $this->email->subject('NIGGS Editorial - Password Reset');
            $message  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>';

            $message .= "You requested to change your NIGGS Editorial account password. <br><br>";
            $message .= "Please click the link below to reset your password <br><br>";

            $this->load->helper('string');
            $hash_value = array(
                'hash' => random_string('alnum', 8),
            );
            $hash = md5("reset#NGS" . $user->email . $hash_value['hash']);
            echo $hash;

            $this->super_update($user->id, $hash_value);
            $message .= "Click this link: <a target=\"_blank\" href=\"" . base_url() . "user/reset_password/".$user->username."/"  . $hash  . "\">Reset your password</a>";

            $message .= "<br><br>Please ignore this message if you didnt request the password change ";
            $message .= "</body></html>";
            $this->email->message($message);


            // send the email and return status
            return $this->email->send();
        }
        return false;
    }



}