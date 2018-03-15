<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model(array('journal_model', 'user_model'));

        $this->load->helper(array('form','file','download','form'));
        $this->load->library('form_validation');

    }

    public function index(){
        $data = new stdClass();

        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('login');
        }
        if ($_SESSION['priviledge'] == 3){
            redirect('user/journals');

        }
        if ($_SESSION['priviledge'] == 2){
            redirect('reviewer');

        }

        $data->user = $this->user_model->get_user($_SESSION['user_id']);
        $data->journals = $this->journal_model->get_journals();

        $data->pageinfo = array(
            'pagetitle' => 'All Articles',
            'notfound' => "No Articles has been submitted yet",
        );

        $this->load->view('templates/header', $data);
        $this->load->view('list_journal', $data);
        $this->load->view('templates/footer');
    }

    public function create(){
        $data = new stdClass();

        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('login');

        }

        $data->user = $this->user_model->get_user($_SESSION['user_id']);

        // load form helper and validation library


        // set validation rules
        $this->form_validation->set_rules('title', 'Journal Title', 'trim|required|min_length[5]|is_unique[journals.title]', array('is_unique' => 'A Journal of the same title has already been submitted, please review and try again'));
        $this->form_validation->set_rules('authors', 'Journal Authors', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('abstract', 'Journal Abstract', 'trim|required|min_length[5]|max_length[1000]');



        if ($this->form_validation->run() == false) {

            // validation not ok, send validation errors to the view
            $this->load->view('templates/header');
            $this->load->view('journal/create_view', $data);
            $this->load->view('templates/footer');

        } else {

            // set variables from the form
            $config['upload_path']          = './files/';
            $config['allowed_types']        = 'docx|doc';
            $config['max_size']             = 32768;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('journalfile')){
                $error = array('error' => $this->upload->display_errors());

                $this->load->view('templates/raw_header');
                $this->load->view('journal/create_view', $error);
                $this->load->view('templates/raw_footer');
            }else{
                $data = array('upload_data' => $this->upload->data());


                $journal = $this->input->post();
                $journal['author_id'] = $_SESSION['user_id'];
                $journal['journalfile'] = $this->upload->data('file_name');
                $journal['status'] = '1';
                $journal['manuscript_no'] = $this->journal_model->get_manuscript_no($journal['relevance']);

                unset($journal['confirmation']);


                if ($this->journal_model->create_journal($journal)){

                    $this->session->set_flashdata('message', 'Article Uploaded Successfully');
                    redirect('journal/view/'.$journal['manuscript_no']);

                }else{

                    // user creation failed, this should never happen
                    $data->error = 'There was a problem creating your journal. Please try again.';

                    // send error to the view
                    $this->load->view('templates/raw_header');
                    $this->load->view('journal/create_view', $data);
                    $this->load->view('templates/raw_footer');                }
            }

        }

    }

    public function view($man_no = false){
        $data = new stdClass();

        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('login');
        }

        if ($man_no == false){
            redirect('journal');
        }

        $data->journal = $this->journal_model->get_journal_by_man_no($man_no);
        //$data->status = $this->journal_model->status_formatter($data->journal->status);

        if ($data->journal == null){
            show_404();
        }
        $this->load->view('templates/header');
        $this->load->view('journal/journal_view', $data);
        $this->load->view('templates/footer');

    }

    public function download($filename=false, $step = false){
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('login');

        }
        //load download helper
        $this->load->helper('download');
        $this->load->helper('file');

        if(!empty($filename) && $step== false){


            //get file info from database
            //$fileInfo = $this->file->getRows(array('id' => $id));

            //file path
            //$file = 'uploads/files/'.$fileInfo['file_name'];
            $file = './files/'.$filename;

            //download file from directory
            force_download($file, NULL);

        }elseif ($filename!= false && $step!= false){
            $file = './files/'.$filename.'/'.$step;

            //download file from directory
            force_download($file, NULL);
        }

    }

    //set download privacy
    public function edit($man_no = false){
        // create the data object
        $data = new stdClass();

        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('login');

        }
        if ($man_no == false){
            redirect('journal/index');
        }

        $data->journal = $this->journal_model->get_journal_by_man_no($man_no);

        if ($data->journal == null){
            show_404();
        }
        if ($data->journal->author_id != $_SESSION['user_id'] || $data->journal->status != 1){
            show_404();
        }

        $this->form_validation->set_rules('journaltitle', 'Journal Title', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('journaltype', 'Journal Type', 'required');
        $this->form_validation->set_rules('journalauthors', 'Journal Authors', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('journalabstract', 'Journal Abstract', 'trim|required|min_length[5]|max_length[1000]');


        if ($this->form_validation->run() === false){

            $user = $this->user_model->get_user($_SESSION['user_id']);
            // echo($user->username);
            //$data->name = $user->name;
            $data->username = $user->username;
            $data->email = $user->email;

            $this->load->view('templates/header');
            $this->load->view('journal/edit', $data);
            $this->load->view('templates/footer');
        }else{
            $journal = array(
                'title' => $this->input->post('journaltitle'),
                'fulltitle' => $this->input->post('fulltitle'),
                'journaltype' => $this->input->post('journaltype'),
                'authors' => $this->input->post('journalauthors'),
                'abstract' =>$this->input->post('journalabstract'),
                'relevance' => $this->input->post('relevance'),

            );

            if(isset($_FILES['journalfile']['size']) && $_FILES['journalfile']['size']>0){

                // set variables from the form
                $config['upload_path']          = './files/';
                $config['allowed_types']        = 'docx|doc';
                $config['max_size']             = 32768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('journalfile')){
                    $error = array('error' => $this->upload->display_errors());

                    $this->load->view('templates/header');
                    $this->load->view('journal/edit', $error);
                    $this->load->view('templates/footer');
                }else{
                    $data = array('upload_data' => $this->upload->data());


                    // set variables from the form into an array
                    $journal['journalfile'] = $this->upload->data('file_name');
                }
            }

            if ($this->journal_model->update($data->journal->id, $journal)){



                $this->session->set_flashdata('message', 'Article Updated Successfully');
                redirect('journal/view/'.$man_no);

            }else{


                $data->error = 'There was a problem creating your journal. Please try again.';

                // send error to the view
                $this->load->view('templates/header');
                $this->load->view('journal/edit', $data);
                $this->load->view('templates/footer');                }
            }


        }

    public function report(){
        $data = new stdClass();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('login');


        }

        $data->journals = $this->journal_model->get_user_journals($_SESSION['user_id']);

        $data->pageinfo = array(
            'pagetitle' => 'Your Articles',
            'notfound' => 'No Submitted Articles yet',
        );
        $this->load->view('templates/header');
        $this->load->view('journal_report', $data);
        $this->load->view('templates/footer');


    }

    public function test(){
//        $status = $this->journal_model->get_manuscript_no('atmosphere');
//        var_dump($status);

        $journals = $this->journal_model->get_journals();
        foreach ($journals as $journal){
            if (empty($journal->manuscript_no)){
                $updated = array('manuscript_no' => $this->journal_model->get_manuscript_no(!empty($journal->relevance) ? $journal->relevance : "others"));
                var_dump($updated);
                echo $this->journal_model->update($journal->id, $updated);
            }
        }
    }

    public function delete($manuscript_no=false){
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('login');

        }
        if ($manuscript_no == false){
            show_404();
        }
        if( $this->journal_model->delete_journal($manuscript_no)){

        }


    }


}