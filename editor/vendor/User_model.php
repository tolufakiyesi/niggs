<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model{
    public function __construct(){
        parent ::__construct();
        $this->load->database();
    }

    public function resolve_user_login($username, $password, $priviledge) {

        $this->db->start_cache();
        $this->db->select('password');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->stop_cache();
        $hash = $this->db->get()->row('password');

        $this->db->select('priviledge');
        $user_priviledge = $this->db->get()->row('priviledge');

        $this->db->flush_cache();

        return ( $this->verify_password_hash($password, $hash) && $priviledge == $user_priviledge );

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
        return $this->db->insert('users', $user);

    }

    public function get_user($user_id) {

        $this->db->from('users');
        $this->db->where('id', $user_id);
        return $this->db->get()->row();

    }

    public function get_users() {

        $this->db->from('users');
        return $this->db->get()->result();

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

    public function search($query){
        $this->db->from('products');
        $this->db->select('name');
        $this->db->like('name', $query);
        $this->db->or_like('description', $query);

        return $this->db->get()->result();

    }

    public function get_reviewers() {

        $this->db->from('users');
        $this->db->where('priviledge', '2');
        return $this->db->get()->result();

    }

    public function get_application(){

    }

    public function send_application($application){
        return $this->db->insert('applications', $application);
    }


}