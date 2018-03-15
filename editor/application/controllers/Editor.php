<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editor extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model(array('journal_model','user_model'));
        $this->load->library(array('session','form_validation'));
        $this->load->helper('date');

    }

    public function index(){
        $data = new stdClass();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            //redirect('login');
            show_404();

        }else{
            if ($_SESSION['priviledge'] !== 1){
                //redirect('home');
                show_404();
            }



            $data->journals = $this->journal_model->get_journals();
            $this->load->view('templates/header');
            $this->load->view('editor_home', $data);
            $this->load->view('templates/footer');

        }
    }

    public function users(){
        $data = new stdClass();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('login');
        }
        if ($_SESSION['priviledge'] !== 1){
            //redirect('home');
            show_404();
        }

        $data->users = $this->user_model->get_users();
        $this->load->view('templates/header');
        $this->load->view('list_users', $data);
        $this->load->view('templates/footer');


    }

    public function journals(){
        $data = new stdClass();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('login');


        }
        if ($_SESSION['priviledge'] !== 1){
            //redirect('home');
            show_404();
        }
            $data->journals = $this->journal_model->get_unread_journals();
            $data->reviewers = $this->user_model->get_reviewers();
            $data->pageinfo = array(
                'pagetitle' => 'Unreviewed Journals',
                'notfound' => 'No Unreviewed Journal at this moment',
            );
            $this->load->view('templates/header');
            $this->load->view('list_journal', $data);
            $this->load->view('templates/footer');

    }

    public function test( ){
//        $data = new stdClass();
//        $data->journal = $this->journal_model->get_latest_journal_by_user($_SESSION['user_id']);
//        $this->load->view('templates/header', $data);
//        $this->load->view('journal/journal_view', $data);
//        $this->load->view('templates/footer');

        var_dump($this->user_model->get_application()->request_to);
    }

    public function review($manuscript_no = false, $reviewer = false){
        $data = new stdClass();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){
            redirect('login');
        }
        if($_SESSION['priviledge'] != '1'){
            show_404();
        }
        if ($manuscript_no == false){
            //no arguements passed
            redirect('editor');
        }elseif($reviewer == false){
            //one arguement passed
            $data->manuscript_no = $manuscript_no;
            $data->journal = $this->journal_model->get_journal_by_man_no($manuscript_no);
            if(empty($data->journal)){
                //no journal
                show_404();
            }

            $data->reviewers = $this->user_model->get_reviewers();
            $this->load->view('templates/header');
            $this->load->view('choose_reviewer', $data);
            $this->load->view('templates/footer');
        }
        else{
            //both arguements passed
            if ($this->journal_model->review($manuscript_no, $reviewer, $_SESSION['user_id'])) {
                //echo "Successful";
                //redirect('review/success');
                $this->session->set_flashdata('message', 'Article Reviewed Successfully');
                redirect('journal/view/' . $manuscript_no);
            }else{
                $this->session->set_flashdata('error', 'Article Reviewed Failed, Retry');
                redirect('journal/view/' . $manuscript_no);
            }

        }
    }

    public function reviewed($manuscript_no = false, $reviewer = false){
        $data = new stdClass();
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
            if ($manuscript_no == false || $reviewer == false){
                redirect('editor/review');
            }else{
                if ($this->journal_model->review($manuscript_no, $reviewer, $_SESSION['user_id'])){
                    //echo "Successful";
                    //redirect('review/success');
                    $this->session->set_flashdata('message', 'Article Reviewed Successfully');
                    redirect('journal/view/'.$manuscript_no);
                }
            }
        }
    }

    public function applications(){

    }

    public function complete($journal_id=false){
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){

            redirect('login');
        }
        if ($journal_id == false){
            redirect('editor');
        }
        $data = new stdClass();
        $data->journal = $this->journal_model->get_journal($journal_id);

        // load form helper and validation library
        $this->load->helper(array('form','file'));
        $this->load->library('form_validation');


        // set variables from the form
        $config['upload_path']          = './files/edited/';
        $config['allowed_types']        = 'pdf|docx|doc';
        $config['max_size']             = 32768;

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('comments', 'Comments', 'trim|max_length[1000]');

        if ($this->form_validation->run() === false){
            $this->load->view('templates/header');
            $this->load->view('journal/journal_view',$data);
            $this->load->view('templates/footer');
        }else{

            if ( ! $this->upload->do_upload('editedfile')){
                $error = array('error' => $this->upload->display_errors());

                $this->load->view('templates/header');
                $this->load->view('journal/journal_view', $data);
                $this->load->view('templates/footer');
            }else{
                $data = array('upload_data' => $this->upload->data());

                // set variables from the form into an array
                $application = array(
                    'status' => '4',
                    'editedcomment' => $this->input->post('comments'),
                    'editedfile' => $this->upload->data('file_name'),
                    'editedon' => unix_to_human(time(), TRUE),
                );

                if ($this->journal_model->send_edited($journal_id, $application)){


                    redirect('journal/view/'.$journal_id);

                }else{


                    $data->error = 'There was a problem updating your comment. Please try again.';

                    // send error to the view
                    $this->load->view('templates/header');
                    $this->load->view('journal/journal_view', $data);
                    $this->load->view('templates/footer');

                }
            }




        }


    }

    public function editing(){


        $data = new stdClass();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('login');


        }
        if ($_SESSION['priviledge'] !== 1){
            //redirect('home');
            show_404();
        }

        $data->pageinfo = array(
            'pagetitle' => 'Journals you are Editing ',
            'notfound' => "No Journals Yet",
        );

        $data->journals = $this->journal_model->get_editor_journals($_SESSION['user_id']);
        $this->load->view('templates/header', $data);
        $this->load->view('list_journals', $data);
        $this->load->view('templates/footer');


    }

    public function update(){
        $data = new stdClass();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('login');


        }
        if ($_SESSION['priviledge'] !== 1){
            //redirect('home');
            show_404();
        }

        $data->pageinfo = array(
            'pagetitle' => 'Journals you are reviewing ',
            'notfound' => "No Journals has been assigned to you yet",
        );

        $data->journals = $this->journal_model->get_updates_for_editor($_SESSION['user_id']);
        $this->load->view('templates/header', $data);
        $this->load->view('list_journals', $data);
        $this->load->view('templates/footer');

    }

    public function approve_application($user_id = false){
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){

            redirect('login');
        }
        $details = $this->user_model->get_application($user_id);
        if ($user_id == false || $details == null){
            redirect('profile');
        }
        $application = $details->request_to;
        if ($application==1){
            $this->user_model->make_editor($user_id);
        }elseif($application == 2){
            $this->user_model->make_reviewer($user_id);
        }

        redirect('user/view/'.$this->user_model->get_username_from_user_id($user_id));
        //var_dump($application);
    }

    public function deny_application($application_id=false){

    }







}