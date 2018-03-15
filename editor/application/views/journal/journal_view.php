<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid" style="margin-bottom: 30px;">
    <?php  if(!empty($this->session->flashdata('message') )): ?>
        <div class="col-md-12">
            <div class="alert alert-success" role="alert">
                <?= $this->session->flashdata('message') ?>
            </div>
        </div>
    <?php endif ?>
    <?php  if(!empty($this->session->flashdata('error') )): ?>
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <?= $this->session->flashdata('error') ?>
            </div>
        </div>
    <?php endif ?>


    <h1><?=$journal->title ?></h1>
    <p class="text" style="font-size: large">Manuscript Number: <?=!empty($journal->manuscript_no)? $journal->manuscript_no : " "?></p>
    <p class="text" style="font-size: large">Research Relevance: <?=!empty($journal->relevance)? $this->journal_model->format_relevance($journal->relevance): "Undefined"?></p>

    <?php if($journal->author_id == $_SESSION['user_id'] && $journal->status == 1 ): ?>
        <button class="btn  pull-right"><a href="<?=base_url('journal/edit/'.$journal->manuscript_no) ?>">Edit Article</a></button> <p>You will be unable to edit this article once it has been assigned to a reviewer</p>
    <?php endif ?>

    <ul class="w3-leftbar w3-theme-border" style="list-style:none">
        <?=$journal->fulltitle ?>
    </ul>
    <hr>
    <h4>By: <?=$journal->authors ?></h4>
    <?=$journal->date ?>
    <br>
    <br>
    <div class="w3-container w3-sand w3-leftbar" >
        <p><i><?=$journal->abstract ?></i></p>
    </div>
    <br>



    <hr>

    <h2>Article Details</h2>
    <br>
    <h4>Status:  <strong><?=$this->journal_model->status_formatter($journal->status) ?></strong></h4>

    <?php if(($journal->status == '1') && ($_SESSION['priviledge']=='1')): ?>
        <a href="<?= base_url('editor/review/' . $journal->manuscript_no)?>">
            <small><button class="btn btn-xs btn-success">Review</button></small>
        </a>
    <?php endif ?>



    <?php if($journal->status != '1'): ?>
    <table class="table table-responsive">
        <tr>
            <td> Editor: </td>
            <td><?=$this->user_model->get_user($journal->editor_id)->username ?></td>
            <td><?=$this->user_model->get_user($journal->editor_id)->email?></td>
        </tr>

        <tr>
            <td> Reviewer: </td>

            <td><?=$this->user_model->get_user($journal->reviewer_id)->username ?></td>
            <td><?=$this->user_model->get_user($journal->reviewer_id)->email?>
                <?php if(($journal->status == '2') && ($_SESSION['user_id']==$journal->editor_id)): ?>
                    <a href="<?= base_url('editor/review/' . $journal->manuscript_no)?>">
                        <small><button class="btn btn-xs btn-warning pull-right">Rereview</button></small>
                    </a>
                <?php endif ?>
            </td>
        </tr>


    </table>

    <?php else: ?>
        <?php if($_SESSION['priviledge'] == '1' || $journal->author_id == $_SESSION['user_id']): ?>
            <h4><strong>Reviewer Preference</strong></h4>
            <table class="table table-responsive">
                <thead>
                <th>Fullname</th>
                <th>Affiliation</th>
                <th>Email</th>
                <th>Phone</th>
                </thead>
            <?php
                for($i=1; $i <=5; $i+=1 ){
                    $suggested_name = "suggested_name_".$i;
                    $suggested_affiliation = "suggested_affiliation_".$i;
                    $suggested_email = "suggested_email_".$i;
                    $suggested_phone = "suggested_phone_".$i;
                    if (!empty($journal->$suggested_name )){
                        echo "<tr> <td>".$journal->$suggested_name ."</td><td>". $journal->$suggested_affiliation ."</td><td>". $journal->$suggested_email ."</td><td>". $journal->$suggested_phone ."</td></tr>";
                    }

                }
            ?>
            </table>
        <?php endif; ?>
    <?php endif ?>

    <p><a href="<?=base_url().'download/'.$journal->journalfile ?>">Download</a> a copy of the submitted journal</p>
    <?php if($journal->status >= 3 && ($_SESSION['priviledge'] == '1' || $journal->reviewer_id == $_SESSION['user_id'] || $journal->author_id == $_SESSION['user_id']) ): ?>
        <p><a href="<?=base_url().'download/reviewed/'.$journal->reviewedfile ?>">Download</a> a copy of the Reviewed journal</p>
    <?php endif; ?>

    <?php if( $journal->status == 4 && ($_SESSION['priviledge'] == '1' || $journal->author_id == $_SESSION['user_id']) ): ?>
        <p><a href="<?=base_url().'download/edited/'.$journal->editedfile ?>">Download</a> a copy of the Edited journal</p>
    <?php endif; ?>
    <hr>
    <?php if($_SESSION['priviledge'] == '1' || $_SESSION['user_id'] == $journal->reviewer_id || $journal->author_id == $_SESSION['user_id']): ?>

        <div class="w3-container w3-sand w3-leftbar" >
            <?php if($_SESSION['user_id'] == $journal->editor_id): ?>
            <h4>Reviewer's Comment</h4>
            <p><?=$journal->reviewercomment ?></p><br>
            <?php elseif (($_SESSION['user_id'] == $journal->editor_id)||($_SESSION['user_id'] == $journal->author_id)): ?>
            <h4>Editor's Comment</h4>
            <p><?=$journal->editorcomment ?></p><br>
            <?php endif; ?>


        </div>


    <?php endif ?>


    <?php if($_SESSION['priviledge'] == '2' && $journal->reviewer_id == $_SESSION['user_id']): ?>
        <hr>
        <?= form_open_multipart('reviewer/review/'.$journal->id) ?>

        <?php if (validation_errors()) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (isset($error)) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            </div>
        <?php endif; ?>


            <label for="reviewedfile">Submit Reviewed File</label>
            <input type="file" class="form-control" id="reviewedfile" name="reviewedfile" required>
            <p class="help-block">Not larger than 30mb</p>
            <div class="form-group">
                <label for="comments">Comments</label>
                <textarea  class="form-control" id="comments" name="comments" rows="3" ><?= set_value('comments')?></textarea>
                <p class="help-block">Limit 1000 characters </p>
            </div>
            <input type="submit" class="btn btn-default" value="Submit">


        </form>

    <?php endif ?>




    <?php if($_SESSION['priviledge'] == '1' && $journal->editor_id == $_SESSION['user_id']): ?>
        <hr>
        <?= form_open_multipart('editor/complete/'.$journal->id) ?>

        <?php if (validation_errors()) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (isset($error)) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            </div>
        <?php endif; ?>


        <label for="editedfile">Submit Completed Reviewed File</label>
        <input type="file" class="form-control" id="editedfile" name="editedfile"  required>
        <p class="help-block">Not larger than 30mb</p>
        <div class="form-group">
            <label for="comments">Comments</label>
            <textarea  class="form-control" id="comments" name="comments" rows="3" ><?= set_value('comments')?></textarea>
            <p class="help-block">Limit 1000 characters </p>
        </div>
        <input type="submit" class="btn btn-default" value="Submit">
        </form>

    <?php endif ?>

</div>





