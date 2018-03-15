<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('string');
        $this->load->library(array('session','form_validation'));
        $this->load->model(array('member_model'));
    }

	public function index()
	{

        $data = new stdClass();
        $data->page = array(
            'home' => "active",

        );

        $this->load->view('header_active', $data);
		$this->load->view('index');

        $this->load->view('footer');

	}
	
	public function about()
	{
        $data = new stdClass();
        $data->page = array(

            'about' => "active",

        );
        $this->load->view('header_active', $data);
		$this->load->view('about');
        $this->load->view('research_footer');
        $this->load->view('footer');

	}
	
	public function astronomy()
	{
        $this->load->view('header');
		$this->load->view('astronomy');
        $this->load->view('research_footer');
        $this->load->view('footer');

	}

    public function atmosphere()
    {
        $this->load->view('header');
        $this->load->view('atmosphere');
        $this->load->view('research_footer');
        $this->load->view('footer');

    }

    public function edit(){
        // create the data object
        $data = new stdClass();
        if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false){
            redirect('members');
        }
        $data->user = $this->member_model->get_member($_SESSION['user_id']);

        if ($data->user->is_confirmed == '0'){
            redirect('profile');
        }

        $this->load->helper('form');


        $this->form_validation->set_rules('affiliation', 'Affiliation', 'trim|required|alpha_numeric_spaces|min_length[4]|max_length[50]');
        $this->form_validation->set_rules('mailing_addr', 'Mailing Address', 'trim|min_length[4]|max_length[80]');
        $this->form_validation->set_rules('town', 'Town or City', 'trim|required|alpha_numeric_spaces|min_length[2]|max_length[30]');
        $this->form_validation->set_rules('state', 'State or Province', 'trim|required|alpha_numeric_spaces|min_length[4]|max_length[30]');
        //$this->form_validation->set_rules('country', 'Country', 'trim|required|alpha_numeric_spaces|min_length[4]|max_length[20]');

        if ($this->form_validation->run() === false){

            $this->load->view('edit_profile', $data);

        }else{
            $user = array(


                'affiliation' => $this->input->post('affiliation'),
                'town' => $this->input->post('town'),
                'state' => $this->input->post('state'),
                'country' => $this->input->post('country'),
                'mailing_addr' => $this->input->post('mailing-address'),

            );

            if(isset($_FILES['file-upload']['size']) && $_FILES['file-upload']['size']>0){

                // set variables from the form

                $config['upload_path']          = './images/';
                $config['allowed_types']        = 'jpg|jpeg|png';
                $config['max_size']             = 32768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('file-upload')){
                    $data->error = array('error' => $this->upload->display_errors());

                    $this->load->view('edit_profile', $data);
                }else{
                    //$upload_data = array('upload_data' => $this->upload->data());


                    // set variables from the form into an array
                    $user['avatar'] = $this->upload->data('file_name');
                }
            }

            $password = $this->input->post('password');
            if ($this->member_model->update($_SESSION['user_id'], $password, $user )){
                //redirect('profile');
                $data->message = 'Profile Updated Successfully';
                $data->messagetype = 'alert-success';
                $this->load->view('profile', $data);
            }else{
                $data->error = 'Incorrect Password, Profile update failed';

                // send error to the view

                $this->load->view('edit_profile', $data);
            }




        }



    }

    public function reset_password($username=false, $username_hash = false, $date_hash = false){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            show_404();
        }
        if($username == false ||$username_hash == false || $date_hash == false){
            show_404();
        }
        $data= new stdClass();
        $data->user = $this->member_model->get_member_by_username($username);

        if(empty($data->user)){
            show_404();
        }

        if ( md5($data->user->username) == $username_hash && md5($data->user->date) == $date_hash ){
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[30]');
            $this->form_validation->set_rules('password_conf', 'Confirm new password', 'trim|required|min_length[4]|max_length[30]|matches[password]');

            if ($this->form_validation->run() === false){

                $this->load->view('change_password', $data);

            }else{

                $password = $this->input->post('password');

                if ($this->member_model->reset_password($data->user->id, $password)){
                    //redirect('profile');
                    $data->message = "Password Successfully changed";
                    $data->messagetype = "alert-success";
                    $this->load->view('change_password', $data);
                }

                $data->message = 'Please try again';

                // send error to the view

                $this->load->view('change_password', $data);

            }
        }else{
            show_404();
        }


    }

    public function forgot_password(){
        $data = new stdClass();

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('userdetail', 'Email or Username', 'trim|required|min_length[2]|max_length[30]');

        if ($this->form_validation->run() == false) {

            // validation not ok, send validation errors to the view
            $this->load->view('request_password', $data);

        } else {

            // set variables from the form
            $email = $this->input->post('userdetail');


            if ($this->member_model->send_password_reset_link($email)) {

                $data->message = "Password Reset link sent, Check your Email";
                $data->messagetype = "alert-success";
                $this->load->view('request_password', $data);

            } else {
                // login failed
                $data->message = 'Unknown username or email.';

                $this->load->view('request_password', $data);

            }

        }
    }

    public function hydro()
    {
        $this->load->view('header');
        $this->load->view('hydro');
        $this->load->view('research_footer');
        $this->load->view('footer');

    }

    public function leaders()
    {
        $data = new stdClass();
        $data->page = array(

            'leaders' => "active",
        );
        $this->load->view('header_active', $data);
        $this->load->view('leaders');
        //$this->load->view('research_footer');
        $this->load->view('footer');

    }

    public function member($username = false){
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){
            redirect('members');
        }

        if ($username === false) {
            redirect( 'profile');
        }
        $data = new stdClass();
        $data->user = $this->member_model->get_member_by_username($username);
        if (empty($data->user)){
           show_404();
        }

        $this->load->view('member_profile', $data);

    }

    public function members()
    {

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            redirect('profile');
        }
        $this->load->view('members');



    }

    public function members_list()
    {
        $data = new stdClass();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('members');
        }

        $data->user = $this->member_model->get_member($_SESSION['user_id']);
        if ($data->user->is_confirmed == '0'){
            redirect('profile');
        }
        $data->members = $this->member_model->get_members();
        $this->load->view('members_list', $data);

    }

    public function password(){
        // create the data object
        $data = new stdClass();
        if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false){
            redirect('members');
        }

        $data->user = $this->member_model->get_member($_SESSION['user_id']);

        $this->load->helper('form');


        $this->form_validation->set_rules('current-password', 'Current password', 'trim|required|min_length[4]|max_length[30]');
        $this->form_validation->set_rules('new-password', 'New password', 'trim|required|alpha_numeric_spaces|min_length[4]|max_length[30]');
        $this->form_validation->set_rules('retype-new-password', 'Confirm new password', 'trim|required|min_length[4]|max_length[30]|matches[new-password]');

        if ($this->form_validation->run() === false){

            $this->load->view('password', $data);

        }else{

            $current_password = $this->input->post('current-password');
            $new_password = $this->input->post('new-password');
            if ($this->member_model->update_password($current_password, $new_password)){
                //redirect('profile');
                $data->message = "Password Successfully changed";
                $data->messagetype = "alert-success";
                $this->load->view('password', $data);
            }

            $data->message = 'Incorrect Password, Password update failed';

            // send error to the view

            $this->load->view('password', $data);

        }



    }

    public function profile(){
        $data = new stdClass();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){
            redirect('members');
        }

        $data->user = $this->member_model->get_member($_SESSION['user_id']);

        if ($data->user->is_confirmed == '0'){
            $data->message = "Please check your email and confirm your account";
        }elseif ($data->user->changed_pass == '0'){
            $data->message = "Please change your password to a new one";
        }

        $this->load->view('profile', $data);


    }

    public function solar()
    {
        $this->load->view('header');
        $this->load->view('solar');
        $this->load->view('research_footer');
        $this->load->view('footer');

    }

    public function register(){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            redirect('profile');
        }
        $this->load->helper('form');

        $data = new stdClass();

        $data->page = array(
            'login' => '',
            'register' => 'active',

        );

        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|alpha_numeric_spaces|min_length[2]|max_length[20]');
        $this->form_validation->set_rules('middlename', 'Middlename', 'trim|alpha_numeric_spaces|max_length[20]');
        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|alpha_numeric_spaces|min_length[2]|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[members.email]');
        $this->form_validation->set_rules('phoneno', 'Phone Number', 'trim|required|alpha_dash|min_length[11]|max_length[20]');
        $this->form_validation->set_rules('education', 'Education', 'required');
        //$this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('primary-interest', 'Primary Interest', 'required');
       // $this->form_validation->set_rules('education', 'Education Level', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('referee-email', 'Referee Email', 'trim|valid_email');

        if ($this->form_validation->run() === false){
            $data->register_fallback = true;
            $this->load->view('members', $data);
        }else{


            // set variables from the form
            $user = array(
                'username' => $this->member_model->get_username($this->input->post('primary-interest')),
                'password' => random_string('alnum', 8),
                'firstname'  => $this->input->post('firstname'),
                'middlename'  => $this->input->post('middlename'),
                'lastname'  => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'email'     => $this->input->post('email'),
                'phone' => $this->input->post('phoneno'),
                'education' => $this->input->post('education'),
                'affiliation' => $this->input->post('affiliation'),
                'address' => $this->input->post('address'),
                'town' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                //'country' => $this->input->post('country'),
                'mailing_addr' => $this->input->post('mailing-address'),
                'primary_intrest' => $this->input->post('primary-interest'),
                'research_intrests' => $this->input->post('research-interest') > 1 ? implode(', ' , $this->input->post('research-interest')):$this->input->post('research-interest'),
                'referee_name' => $this->input->post('referee-name'),
                'referee_affiliation' => $this->input->post('referee-affiliation'),
                'referee_rank' => $this->input->post('referee-rank'),
                'referee_phone' => $this->input->post('referee-phone'),
                'referee_email' => $this->input->post('referee-email'),


            );


            if ( $this->member_model->register($user)  ){


                $data->user = $user;
                // user creation ok
                $this->load->view('header');
                $this->load->view('reg_success', $data);
                $this->load->view('footer');



            }else{
//
//                // user creation failed, this should never happen
                $data->message = 'There was a problem creating your new account. Please try again.';


                $data->register_fallback = true;
                $this->load->view('members', $data);


            }

        }
    }

    public function login(){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            redirect('profile');
        }

        $data = new stdClass();

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('login_userdetail', 'Email or Username', 'trim|required|min_length[2]|max_length[30]');
        $this->form_validation->set_rules('login_password', 'Password', 'required|min_length[2]|max_length[20]');

        if ($this->form_validation->run() == false) {



            // validation not ok, send validation errors to the view
            $this->load->view('members', $data);

        } else {

            // set variables from the form
            $email = $this->input->post('login_userdetail');
            $password = $this->input->post('login_password');

            if ($this->member_model->resolve_login($email, $password)) {

                $user_id = $this->member_model->get_user_id_from_userdetail($email);
                $user    = $this->member_model->get_member($user_id);

                // set session user datas
                $_SESSION['user_id']      = (int)$user->id;
                $_SESSION['username']     = (string)$user->username;
                $_SESSION['logged_in']    = (bool)true;

                // $this->load->view('header');
                // $this->load->view('user/dashboard', $data);
                // $this->load->view('footer');
                redirect('profile');

            } else {
                // login failed
                $data->message = 'Wrong username or password.';

                $this->load->view('members', $data);

            }

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
            redirect('members');
        }
            // there user was not logged in, we cannot logged him out,
            // redirect him to site root
            redirect('members');



    }

    public function contact_us(){
        $data = new stdClass();
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[2]|max_length[20]');
        $this->form_validation->set_rules('message', 'Message', 'required|min_length[10]|max_length[2000]');


        if ($this->form_validation->run() ==false ){


            $this->load->view('contact', $data);
        }
        else {

            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $message = $this->input->post('message');

            $this->load->library('email');
            $this->email->from($email, $name);
            $this->email->to('niggsorg@gmail.com');
            $this->email->subject('Contact Us');
            $this->email->message("Message from: " . $name . " " . $email . " <br> <br>" . $message);


            if ($this->email->send()) {
                $data->message = "Sent Successfully";
                $data->messagetype = "alert-success";
                $this->load->view('contact', $data);
            } else {
                $data->message = "Error sending your message";
                $data->messagetype = "alert-danger";
                $this->load->view('contact', $data);
            }
        }
    }

    public function confirm_account($username, $hash){
        $data = new stdClass();
        // find the email for the given user
        $data->user = $this->member_model->get_member_by_username($username);

        $email = $data->user->email;
        $registration_date = $data->user->date;



        // if the user from the url exists
        if ($email && $registration_date) {

        //if (!empty($data->user)) {
            if (sha1($email . $registration_date) == $hash) {

                // values from the url are good, we can validate the account
                $user = array('is_confirmed' => '1');
                $this->db->where('username', $username);
                $data->message = "Account confirmed, Please Login";
                $data->messagetype = "alert-success";
                if($this->db->update('members', $user)){
                    $this->load->view('members', $data);
                }


            }
            $data->message = "Account not found, Please Register";
            $this->load->view('members', $data);
            //return false;

        }else{
            show_404();
        }

        //redirect('members');


    }


}
