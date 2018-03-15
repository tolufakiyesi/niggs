<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library(array('session','form_validation'));
        $this->load->model(array('user_model','journal_model'));
        $this->load->helper('date');
    }

    public function index(){
        redirect('user/profile');
    }

    public function confirm_account($username=false, $hash=false){
        $data = new stdClass();
        // find the email for the given user

        if ($username == false || $hash == false){
            show_404();
        }
        $data->user = $this->user_model->get_user_by_username($username);

        if (empty($data->user)) {
            show_404();
        }
        $email = $data->user->email;
        $registration_date = $data->user->date;

        // if the user from the url exists

        if (sha1("NGS_Editorial_Confirm" . $data->user->email . $data->user->hash) == $hash) {

            // values from the url are good, we can validate the account
            $user = array(
                'is_confirmed' => '1',
                'hash'=> '',
            );
            $data->message = "Account confirmed, Please Login";
            $data->messagetype = "alert-success";
            if($this->user_model->super_update($user->id, $user)){
                $this->load->view('login', $data);
            }else{
                //account confirmation failed, should not happen
                $data->message = "Confirmation Failed, Please Try Again";
                $this->load->view('login', $data);
            }


        }else{
            $data->message = "Account not found, Please Register";
            $this->load->view('login', $data);
        }


    }

    public function edit(){
        // create the data object
        $data = new stdClass();
        if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false){
            redirect('login');
        }
        $data->user = $this->user_model->get_user($_SESSION['user_id']);

        $this->load->helper('form');


        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|max_length[20]');

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('qualification', 'Qualification', 'trim|required|max_length[10]');

        $email = $this->input->post('email');
        if ($email != $data->user->email){
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        }




        if ($this->form_validation->run() === false){


            $this->load->view('templates/header');
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        }else{
            $user = array(
                'username'  => $this->input->post('username'),
                'email'     => $this->input->post('email'),
                'firstname' => $this->input->post('firstname'),
                'othernames' => $this->input->post('othernames'),
                'lastname' => $this->input->post('lastname'),
                'qualification' => $this->input->post('qualification'),
                'gender' => $this->input->post('gender'),
            );
            $password = $this->input->post('password');
            if ($this->user_model->update($_SESSION['user_id'], $user, $password)){
                $this->session->set_flashdata('message', 'Profile Updated Successfully');
                redirect('profile');
            }


            $data->error = 'Incorrect Password, Profile update failed';

            // send error to the view
            $this->load->view('templates/header');
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        }
    }

    public function forgot_password(){
        $data = new stdClass();

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('userdetail', 'Email or Username', 'trim|required|min_length[2]|max_length[30]');

        if ($this->form_validation->run() == false) {

            // validation not ok, send validation errors to the view
            $this->load->view('templates/raw_header');
            $this->load->view('user/request_password', $data);
            $this->load->view('templates/raw_footer');

        } else {

            // set variables from the form
            $email = $this->input->post('userdetail');


            if ($this->user_model->send_password_reset_link($email)) {

                $data->message = "Password Reset link sent, Check your Email";
                $data->messagetype = "alert-success";
                $this->load->view('templates/raw_header');
                $this->load->view('user/request_password', $data);
                $this->load->view('templates/raw_footer');

            } else {
                // login failed
                $data->message = 'Unknown username or email.';

                $this->load->view('templates/raw_header');
                $this->load->view('user/request_password', $data);
                $this->load->view('templates/raw_footer');

            }

        }
    }

    public function journals(){
        $data = new stdClass();

        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('login');
        }

        $data->user = $this->user_model->get_user($_SESSION['user_id']);
        $data->journals = $this->journal_model->get_user_journals($_SESSION['user_id']);

        $data->pageinfo = array(
            'pagetitle' => 'Your Journals',
            'notfound' => "You haven't submitted any Journals yet ",
        );

        $this->load->view('templates/header', $data);
        $this->load->view('list_journals', $data);
        $this->load->view('templates/footer');
    }

    public function login() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){
            // create the data object
            $data = new stdClass();

            // load form helper and validation library
            $this->load->helper('form');
            $this->load->library('form_validation');

            // set validation rules
            $this->form_validation->set_rules('login_username', 'Username', 'required|alpha_numeric');
            $this->form_validation->set_rules('login_password', 'Password', 'required');

            if ($this->form_validation->run() == false) {

                // validation not ok, send validation errors to the view
                $this->load->view('templates/raw_header');
                $this->load->view('user/login', $data);
                $this->load->view('templates/raw_footer');

            } else {

                // set variables from the form
                $username = $this->input->post('login_username');
                $password = $this->input->post('login_password');


                if ($this->user_model->resolve_user_login($username, $password)) {

                    $user_id = $this->user_model->get_user_id_from_username($username);
                    $user    = $this->user_model->get_user($user_id);

                    // set session user datas
                    $_SESSION['user_id']      = (int)$user->id;
                    $_SESSION['username']     = (string)$user->username;
                    $_SESSION['logged_in']    = (bool)true;
                    $_SESSION['priviledge']    = (int)$user->priviledge;



                    // user login ok
                    redirect('profile');

                } else {

                    // login failed
                    $data->message = 'Wrong username or password.';

                    $this->load->view('templates/raw_header');
                    $this->load->view('user/login', $data);
                    $this->load->view('templates/raw_footer');

                }

            }
        }else{
            redirect('user/profile');
        }
    }

    public function logout(){
        // create the data object
        $data = new stdClass();

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

            // remove session datas
            foreach ($_SESSION as $key => $value) {
                unset($_SESSION[$key]);
            }

            // user logout ok
            redirect('login');

        } else {

            // there user was not logged in, we cannot logged him out,
            // redirect him to site root
            redirect('login');

        }

    }

    public function profile(){
        $data = new stdClass();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){
            redirect('login');
        }
        $data->user = $this->user_model->get_user($_SESSION['user_id']);
        $data->journals = $this->journal_model->get_user_journals($_SESSION['user_id']);

        if ($_SESSION['priviledge'] == 2){
            $data->user_action = "Reviewing";
            $data->user_action_journals = $this->journal_model->get_reviewer_journals($_SESSION['user_id']);
        }
        if ($_SESSION['priviledge'] == 1){
            $data->user_action = "Editing";
            $data->user_action_journals = $this->journal_model->get_editor_journals($_SESSION['user_id']);
        }
            $this->load->view('templates/header');
            $this->load->view('profile', $data);
            $this->load->view('templates/footer');




    }

    public function register(){
        $data = new stdClass();

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            redirect('home');

        }

        $this->load->helper('form');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|max_length[20]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
        $this->form_validation->set_rules('qualification', 'Qualification', 'trim|required');

        if ($this->form_validation->run() === false){

            $data->register_fallback = true;
            $this->load->view('templates/raw_header');
            $this->load->view('user/login', $data);
            $this->load->view('templates/raw_footer');

        }else{

            // set variables from the form
            $user = array(
                'username'  => $this->input->post('username'),
                'email'     => $this->input->post('email'),
                'priviledge' => '3',
                'firstname' => $this->input->post('firstname'),
                'othernames' => $this->input->post('othernames'),
                'lastname' => $this->input->post('lastname'),
                'qualification' => $this->input->post('qualification'),
                'gender' => $this->input->post('gender'),
            );
            $password  = $this->input->post('password');

            if ($this->user_model->create_user($user, $password)){

                $data->username = $user['username'];
                $this->load->view('templates/raw_header');
                $this->load->view('registration_success', $data);
                $this->load->view('templates/raw_footer');


            }else{

                // user creation failed, this should never happen
                $data->error = 'There was a problem creating your new account. Please try again.';

                // send error to the view
                $data->register_fallback = true;
                $this->load->view('templates/raw_header');
                $this->load->view('user/login', $data);
                $this->load->view('templates/raw_footer');

            }

        }
    }

    public function request(){
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){

            redirect('login');
        }
        $data = new stdClass();

        $this->form_validation->set_rules('priviledge', 'Priviledge', 'required');
        $this->form_validation->set_rules('relevance', 'Research Relevance', 'required');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header');
            $this->load->view('user/request');
            $this->load->view('templates/footer');

        }else{


            // set variables from the form into an array
            $application = array(
                'applicant_id' => $_SESSION['user_id'],
                'request_to' => $this->input->post('priviledge'),
                'relevance' => $this->input->post('relevance'),
                'status' => 1,
            );


            if ($this->user_model->send_application($application)) {
                $this->session->set_flashdata('message', 'Your request has been submitted successfully');
                redirect('profile');

            } else {


                $data->error = 'There was a problem submitting your request. Please try again.';

                // send error to the view
                $this->load->view('templates/header');
                $this->load->view('user/request', $data);
                $this->load->view('templates/footer');

            }
        }
    }
/*
    public function request(){
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){

            redirect('login');
        }

        $data = new stdClass();

        // load form helper and validation library
        $this->load->helper(array('form','file'));
        $this->load->library('form_validation');


        // set variables from the form
        $config['upload_path']          = './files/requests/';
        $config['allowed_types']        = 'pdf|docx|doc';
        $config['max_size']             = 32768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('priorwork')){
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('templates/header');
            $this->load->view('request');
            $this->load->view('templates/footer');
        }else{
            $data = array('upload_data' => $this->upload->data());


            // set variables from the form into an array
            $application = array(
                'applicant_id' => $_SESSION['user_id'],
                'request_to' => $this->input->post('priviledge'),
                'prior_work' => $this->upload->data('file_name'),
                'status' => 1,
            );



            if ($this->user_model->send_application($application)){

                redirect(profile);

            }else{

                // user creation failed, this should never happen
                $data->error = 'There was a problem creating your new account. Please try again.';

                // send error to the view
                $this->load->view('templates/header');
                $this->load->view('request');
                $this->load->view('templates/footer');

            }
        }
    }

*/

    public function request2(){
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){

            redirect('login');
        }
        $this->form_validation->set_rules('priviledge', 'Priviledge', 'required');
        $this->form_validation->set_rules('relevance', 'Research Relevance', 'required');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header');
            $this->load->view('user/request');
            $this->load->view('templates/footer');

        }else{
            $application = $this->input->post();
            var_dump($application);
        }
    }

    public function reset_password($username = false, $hash=false){
        if ( $username == false ){
            show_404();
        }
        $data = new stdClass();
        $data->user = $this->user_model->get_user_by_username($username);

        if ( empty($data->user) ){
            show_404();
        }
        if ($hash != md5("reset#NGS".$data->user->email . $data->user->hash)){

            show_404();
        }
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[30]');
        $this->form_validation->set_rules('password_conf', 'Confirm new password', 'trim|required|min_length[4]|max_length[30]|matches[password]');
        if ($this->form_validation->run() == false){
            $this->load->view('templates/raw_header');
            $this->load->view('user/change_password', $data);
            $this->load->view('templates/raw_footer');
        }else{


            $password = $this->input->post('password');
            if ($this->user_model->reset_password($data->user->id, $password)){

                $data->message = "Password Successfully changed, please login";
                $data->messagetype = "alert-success";
                $this->load->view('templates/raw_header');
                $this->load->view('user/change_password', $data);
                $this->load->view('templates/raw_footer');
            }else {

                $data->message = 'Please try again';

                // send error to the view

                $this->load->view('templates/raw_header');
                $this->load->view('user/change_password', $data);
                $this->load->view('templates/raw_footer');

            }
        }



    }

    public function view($username = false){
        $data = new stdClass();

        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){

            redirect('login');
        }

        if ($username == false ){
            show_404();
        }
        $data->user = $this->user_model->get_user($this->user_model->get_user_id_from_username($data->username));
        if ($data->user == null){
            show_404();
        }
        $data->journals = $this->journal_model->get_user_journals($data->user->id);
        $this->load->view('templates/header', $data);
        $this->load->view('profile', $data);
        $this->load->view('templates/footer');
    }

    public function test(){
        $data = new stdClass();
        $data->username = "tolufakiyesi";
        $this->load->view('templates/raw_header');
        $this->load->view('registration_success', $data);
        $this->load->view('templates/raw_footer');
        //$data->user = $this->user_model->get_user('4');
        //$this->session->set_flashdata('message', 'Hello WWorld');
        //redirect('profile');

    }



}

?>