<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model(array('journal_model', 'user_model'));
        $this->load->helper('download');
    }

    public function index(){
        $data = new stdClass();

        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('user/login');
        }

        $data->user = $this->user_model->get_user($_SESSION['user_id']);
        $data->journals = $this->journal_model->get_journals();

        $data->pageinfo = array(
            'pagetitle' => 'All Journals',
            'notfound' => "No Journals has been submitted yet",
        );

        $this->load->view('templates/header', $data);
        $this->load->view('list_journal', $data);
        $this->load->view('templates/footer');
    }

    public function create(){
        $data = new stdClass();

        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('user/login');

        }


        // load form helper and validation library
        $this->load->helper(array('form','file'));
        $this->load->library('form_validation');

        // set validation rules
        $this->form_validation->set_rules('journaltitle', 'Journal Title', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('journalauthors', 'Journal Authors', 'trim|required|alpha_numeric_spaces|min_length[5]');
        $this->form_validation->set_rules('journalabstract', 'Journal Abstract', 'trim|required|min_length[5]|max_length[1000]');



        if ($this->form_validation->run() == false) {

            // validation not ok, send validation errors to the view
            $this->load->view('templates/raw_header');
            $this->load->view('journal/create', $data);
            $this->load->view('templates/raw_footer');

        } else {

            // set variables from the form
            $config['upload_path']          = './files/';
            $config['allowed_types']        = 'pdf|docx|doc';
            $config['max_size']             = 32768;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('journalfile')){
                $error = array('error' => $this->upload->display_errors());

                $this->load->view('templates/raw_header');
                $this->load->view('journal/create', $data);
                $this->load->view('templates/raw_footer');
            }else{
                $data = array('upload_data' => $this->upload->data());


                // set variables from the form into an array
                $journal = array(
                    'author_id' => $_SESSION['user_id'],
                    'title' => $this->input->post('journaltitle'),
                    'journaltype' => $this->input->post('journaltype'),
                    'authors' => $this->input->post('journalauthors'),
                    'abstract' =>$this->input->post('journalabstract'),
                    'journalfile' => $this->upload->data('file_name'),
                    'status' => '1',
                );



                if ($this->journal_model->create_journal($journal)){

                    // user creation ok
                    redirect('home');

                }else{

                    // user creation failed, this should never happen
                    $data->error = 'There was a problem creating your new account. Please try again.';

                    // send error to the view
                    $this->load->view('templates/raw_header');
                    $this->load->view('journal/create', $data);
                    $this->load->view('templates/raw_footer');


                }
            }

        }

    }

    public function view($journal_id = false){
        $data = new stdClass();

        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('user/login');
        }

        if ($journal_id == false){
            redirect('journal/index');
        }

        $data->journal = $this->journal_model->get_journal($journal_id);
        $data->status = $this->status_formatter($data->journal->status);
        $this->load->view('templates/header');
        $this->load->view('view_journal', $data);
        $this->load->view('templates/footer');

    }

    private function status_formatter($status){
        $status_array = array(
            '1' => 'Yet to be assigned to a reviewer',
            '2' => 'Reviewing in progress',
            '3' => "Review Completed, Waiting for editor's contribution ",
            '4' => "Review Completed Successful, Please download a copy of the reviewed work"

        );
        return $status_array[$status];
    }

    public function downloader($filename){
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('user/login');
        }
        force_download('C:\\wamp64\\www\\ngs\\files\\'.$filename, NULL);

    }



}