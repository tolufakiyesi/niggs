<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviewer extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model(array('journal_model','user_model'));
        $this->load->helper('date');
    }

    public function index(){
        $data = new stdClass();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('login');


        }
        if ($_SESSION['priviledge'] < 2){
            //redirect('home');
            show_404();
        }

        $data->pageinfo = array(
            'pagetitle' => 'Review Journals',
            'notfound' => "No Journals has been assigned to you yet",
        );

        $data->journals = $this->journal_model->get_reviewables($_SESSION['user_id']);
        $this->load->view('templates/header', $data);
        $this->load->view('reviewer_view', $data);
        $this->load->view('templates/footer');


    }

    public function review($manuscript_no=false){
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){

            redirect('login');
        }
        if ($manuscript_no == false){
            redirect('reviewer');
        }
            $data = new stdClass();
            $data->journal = $this->journal_model->get_journal_by_man_no($manuscript_no);

            if (empty($data->journal)){
                show_404();
            }
            if ($data->journal->reviewer_id != $_SESSION['user_id']){
                redirect('reviewer');
            }

            // load form helper and validation library
            $this->load->helper(array('form','file'));
            $this->load->library('form_validation');


            // set variables from the form
            $config['upload_path']          = './files/reviewed/';
            $config['allowed_types']        = 'pdf|docx|doc';
            $config['max_size']             = 32768;

            $this->load->library('upload', $config);

            $this->form_validation->set_rules('comments', 'Comments', 'trim|max_length[1000]');

            if ($this->form_validation->run() === false){
                $this->load->view('templates/header');
                $this->load->view('journal/journal_view',$data);
                $this->load->view('templates/footer');
            }else{

                if ( ! $this->upload->do_upload('reviewedfile')){
                    $error = array('error' => $this->upload->display_errors());

                    $this->load->view('templates/header');
                    $this->load->view('journal/journal_view', $data);
                    $this->load->view('templates/footer');
                }else{
                    $data = array('upload_data' => $this->upload->data());

                    // set variables from the form into an array
                    $application = array(
                        'status' => '3',
                        'reviewercomment' => $this->input->post('comments'),
                        'reviewedfile' => $this->upload->data('file_name'),
                        'reviewedon' => unix_to_human(time(), TRUE),
                    );

                    if ($this->journal_model->send_review($data->journal->id, $application)){

                        $this->session->set_flashdata('message', 'Review Successful');
                        redirect('journal/view/'.$data->manuscript_no);

                    }else{

                        // user creation failed, this should never happen
                        $data->error = 'There was a problem sending your review. Please try again.';

                        // send error to the view
                        $this->load->view('templates/header');
                        $this->load->view('journal/journal_view', $data);
                        $this->load->view('templates/footer');

                    }
                }




            }


    }

    public function update(){
        $data = new stdClass();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('login');


        }
        if ($_SESSION['priviledge'] !== 2){
            //redirect('home');
            show_404();
        }

        $data->pageinfo = array(
            'pagetitle' => 'Journals you are reviewing ',
            'notfound' => "No Journals has been assigned to you yet",
        );

        $data->journals = $this->journal_model->get_updates_for_reviewer($_SESSION['user_id']);
        $this->load->view('templates/header', $data);
        $this->load->view('reviewer_view', $data);
        $this->load->view('templates/footer');

    }





}

?>