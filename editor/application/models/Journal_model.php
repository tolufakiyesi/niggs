<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Journal_model extends CI_Model{
    public function __construct(){
        parent ::__construct();
        $this->load->database();
        $this->load->helper('date');

    }

    public function create_journal($journal){
        return $this->db->insert('journals', $journal);
    }

    public function get_total_journals(){
        return $this->db->count_all('journals');
    }

    public function get_journal($id) {

        $this->db->from('journals');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function get_journal_by_man_no($man_no) {

        $this->db->from('journals');
        $this->db->where('manuscript_no', $man_no);
        return $this->db->get()->row();
    }

    public function get_journals() {

        $this->db->from('journals');
        return $this->db->get()->result();

    }

    public function get_user_journals($id){
        $this->db->from('journals');
        $this->db->where('author_id', $id);
        return $this->db->get()->result();
    }

    public function get_unread_journals(){
        $this->db->from('journals');
        $this->db->where('status', '1');
        return $this->db->get()->result();
    }

    public function review($manuscript_no, $reviewer, $editor){
        $data = array(
            'status' => '2',
            'reviewer_id' => $reviewer,
            'editor_id' => $editor,
        );

        $this->db->where('manuscript_no', $manuscript_no);
        //return $this->db->update('journals', $data) && $this->send_review_alert($manuscript_no, $reviewer, $editor);
        return $this->db->update('journals', $data);
    }

    public function get_reviewables($id){
        $this->db->from('journals');
        $this->db->where('reviewer_id', $id);
        return $this->db->get()->result();

    }

    public function get_reviewer_journals($id){
        $this->db->from('journals');
        $this->db->where('reviewer_id', $id);
        return $this->db->get()->result();

    }

    public function get_editor_journals($id){
        $this->db->from('journals');
        $this->db->where('editor_id', $id);
        return $this->db->get()->result();

    }

    public function status_formatter($status){

        $status_array = array(
            '1' => 'Yet to be assigned to a reviewer',
            '2' => 'Reviewing in progress',
            '3' => "Review Completed, Waiting for editor's contribution ",
            '4' => "Review Completed Successful, Please download a copy of the reviewed work"

        );
        return $status_array[$status];
    }

    public function get_latest_journal_by_user($user_id){
        $this->db->from('journals');
        $this->db->order_by('date', 'DESC');
        $this->db->where('author_id', $user_id);
        return $this->db->get()->row();

    }

    public function unreviewed_model_count(){
        $this->db->from('journals');
        $this->db->where('status', '1');
        return $this->db->count_all_results();
    }

    public function reviewer_unreviewed_count($user_id){
        $this->db->from('journals');
        $this->db->where('reviewer_id', $user_id);
        return $this->db->count_all_results();
    }

    public function send_review( $journal_id,$review_details){
        $this->db->where('id', $journal_id);
        return $this->db->update('journals', $review_details);
    }

    public function send_edited( $journal_id,$edited_details){
        $this->db->where('id', $journal_id);
        return $this->db->update('journals', $edited_details);
    }

    public function editing_currently_count($editor_id){
        $this->db->from('journals');
        $this->db->where('editor_id', $editor_id);
        return $this->db->count_all_results();
    }

    public function edited_count($editor_id){
        $this->db->from('journals');
        $this->db->where('editor_id', $editor_id);
        $this->db->where('status', '4');
        return $this->db->get()->result();
    }

    public function reviewed_count($reviewer_id){
        $this->db->from('journals');
        $this->db->where('reviewer_id', $reviewer_id);
        $this->db->where('status', '3');
        return $this->db->get()->result();
    }

    public function download($filename){


        if(!empty($filename)){
            //load download helper
            $this->load->helper('download');
            $this->load->helper('file');

            //get file info from database
            //$fileInfo = $this->file->getRows(array('id' => $id));

            //file path
            //$file = 'uploads/files/'.$fileInfo['file_name'];
            $file = '.\files\\'.$filename;

            //download file from directory
            force_download($file, NULL);

        }

    }

    public function get_updates_for_editor($editor_id){
        $this->db->from('journals');
        $this->db->where('editor_id', $editor_id);
        $this->db->where('status', '3');
        return $this->db->get()->result();
    }

    public function get_updates_for_reviewer($reviewer_id){
        $this->db->from('journals');
        $this->db->where('reviewer_id', $reviewer_id);
        $this->db->where('status', '2');
        return $this->db->get()->result();
    }

    public function get_awaiting_reviewer($editor_id){
        $this->db->from('journals');
        $this->db->where('editor_id', $editor_id);
        $this->db->where('status', '2');
        return $this->db->get()->result();
    }

    public function update($journal_id, $journal){
        $this->db->where('id', $journal_id);
        return $this->db->update('journals', $journal);

    }

    public function send_review_alert($journal_id, $reviewer, $editor){
        $journal = $this->get_journal($journal_id);
        $reviewer_email = $this->user_model->get_user($reviewer)->email;
        //$editor =

        $this->load->library('email');
        $this->email->from('niggsorg@gmail.com', 'NIGGS Editorial');

        $this->email->to($reviewer_email);
        $this->email->subject('NIGGS Editorial - Alert');
        $message  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>';

        $message .= "Hi there, <br><br>";
        $message .= "A journal has been assigned to you for review, please find the details below.<br>";
        $message .= "Journal Title: ".$journal->title;
        $message .= "<br> By: ".$journal->authors;
        $message .= "<br><br> Please <strong><a href=\"". base_url('journal') ."\">login</a></strong> to download and review the file";
        $message .= "<br><br>You received this message because you are registered as a reviewer on The Nigerian Geopysical Society's editorial website<br>";
        $message .= "Please ignore this message if you received it by mistake";
        $message .= "</body></html>";
        $this->email->message($message);
        return $this->email->send();
    }

    public function search($query){
        $this->db->from('journals');
        $this->db->select('title');
        $this->db->like('title', $query);
        $this->db->or_like('fulltitle', $query);

        return $this->db->get()->result();

    }

    private function get_index($interest){
        $this->db->where('id', 1);
        $index = $this->db->get()->row($interest);
        $index+=1;

        $update_data = array(
            $interest => $index,
        );


        if ($this->update_index($update_data)){
            return $index;
        }
        return '000';
    }

    public function get_manuscript_no($relevance){
        $abbr = array(
            "astronomy" =>'APS',
            "atmosphere" => 'ATM',
            "hydro" =>'HYD',
            "ocean" =>'OCN',
            "solar" =>'STS',
            "solid" =>'SES',
            "others" => 'NGS'
        );

        $man_no = array_key_exists($relevance, $abbr) ?  $abbr[$relevance] : 'NGS';
        $man_no .= substr((string)mdate('%Y', time()), -2);
        $man_no .= '_';


        $this->db->from('journal_index');
        $this->db->where('id', 1);
        $index_no = $this->get_index(strtolower($abbr[$relevance]));
        $man_no .= str_pad($index_no, 3, "0", STR_PAD_LEFT);

        return $man_no;

    }

    public function format_relevance($relevance){

        $abbr = array(
            "astronomy" =>'Astronomy and Planetary Science',
            "atmosphere" => 'Atmospheric Science',
            "hydro" =>'Hydrological Science',
            "ocean" =>'Ocean Science',
            "solar" =>'Solar and Terrestial Science',
            "solid" =>'Solid Earth Science',
            "others" => 'NGS'
        );

        if(key_exists($relevance,$abbr)){
            return $abbr[$relevance];
        }
        return 'NGS';
    }

    private function update_index($update_data){
        if (!empty($update_data)){
            $this->db->where('id', '1');
            return $this->db->update('journal_index', $update_data);
        }
        return false;

    }

}