<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'form_validation'));
        $this->load->model(array('user_model', 'journal_model'));
        $this->load->helper('date');
    }
    public function editor($hash=false){
        $data = new stdClass();

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            redirect('home');

        }

        if ($hash!='I7L18Bml6R2UpyOg'){
            show_404();
        }

        $this->load->helper('form');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|max_length[20]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
        $this->form_validation->set_rules('qualification', 'Qualification', 'trim|required');
        $this->form_validation->set_rules('qualification', 'Qualification', 'trim|required');

        if ($this->form_validation->run() === false){

            $data->register_fallback = true;
            $this->load->view('templates/raw_header');
            $this->load->view('user/register', $data);
            $this->load->view('templates/raw_footer');

        }else{

            // set variables from the form
            $user = array(
                'username'  => $this->input->post('username'),
                'email'     => $this->input->post('email'),
                'research_field' => $this->input->post('relevance'),
                'firstname' => $this->input->post('firstname'),
                'othernames' => $this->input->post('othernames'),
                'lastname' => $this->input->post('lastname'),
                'qualification' => $this->input->post('qualification'),
                'gender' => $this->input->post('gender'),
            );
            $password  = $this->input->post('password');
            $user['priviledge'] = '1';


            if ($this->user_model->create_user($user, $password)){

                $data->username = $user['username'];
                $data->password = $password;
                $data->priviledge = $user['priviledge'];
                $this->load->view('templates/raw_header');
                $this->load->view('user/registration_success', $data);
                $this->load->view('templates/raw_footer');


            }else{

                // user creation failed, this should never happen
                $data->error = 'There was a problem creating your new account. Please try again.';

                // send error to the view
                $data->register_fallback = true;
                $this->load->view('templates/raw_header');
                $this->load->view('user/register', $data);
                $this->load->view('templates/raw_footer');

            }

        }
    }

    public function reviewer($hash=false){
        $data = new stdClass();

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            redirect('home');

        }
        if ($hash!='afKT7l9vU6bjQdc3'){
            show_404();
        }


        $this->load->helper('form');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|max_length[20]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
        $this->form_validation->set_rules('qualification', 'Qualification', 'trim|required');
        $this->form_validation->set_rules('qualification', 'Qualification', 'trim|required');

        if ($this->form_validation->run() === false){

            $data->register_fallback = true;
            $this->load->view('templates/raw_header');
            $this->load->view('user/register', $data);
            $this->load->view('templates/raw_footer');

        }else{

            // set variables from the form
            $user = array(
                'username'  => $this->input->post('username'),
                'email'     => $this->input->post('email'),
                'research_field' => $this->input->post('relevance'),
                'firstname' => $this->input->post('firstname'),
                'othernames' => $this->input->post('othernames'),
                'lastname' => $this->input->post('lastname'),
                'qualification' => $this->input->post('qualification'),
                'gender' => $this->input->post('gender'),
            );
            $password  = $this->input->post('password');

            $user['priviledge'] = '2';


            if ($this->user_model->create_user($user, $password)){

                $data->username = $user['username'];
                $data->password = $password;
                $data->priviledge = $user['priviledge'];
                $this->load->view('templates/raw_header');
                $this->load->view('user/registration_success', $data);
                $this->load->view('templates/raw_footer');


            }else{

                // user creation failed, this should never happen
                $data->error = 'There was a problem creating your new account. Please try again.';

                // send error to the view
                $data->register_fallback = true;
                $this->load->view('templates/raw_header');
                $this->load->view('user/register', $data);
                $this->load->view('templates/raw_footer');

            }

        }
    }
}