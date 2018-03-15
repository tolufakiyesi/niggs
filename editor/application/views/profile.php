<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="container-fluid">
        <!-- Page -->
        <?php  if(!empty($this->session->flashdata('message') )): ?>
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    <?= $this->session->flashdata('message') ?>
                </div>
            </div>

        <?php endif ?>

            <div class="page-header">
                <h1 class="page-title"><?= $this->user_model->get_category($user->priviledge)?>'s Profile <a href="<?= base_url('user/edit')?>" class="btn btn-xs btn-success pull-right" >Edit</a></h1>
            </div>
            <div class="page-content">
                <!-- Panel -->
                <div class="panel">
                    <div class="panel-body container-fluid">
                        <div class="row row-lg">
                            <div class="col-md-12">

                                <table class="table table-responsive">
                                    <tr>
                                        <td>Surname: </td>
                                        <td><?= strtoupper($user->lastname) ?></td>

                                    </tr>
                                    <tr>
                                        <td>Other Names: </td>
                                        <td><?= $user->firstname ?>  <?= $user->othernames ?> </td>

                                    </tr>

                                    <tr>
                                        <td>Username: </td>
                                        <td><?= $user->username ?></td>

                                    </tr>
                                    <tr>
                                        <td>Email: </td>
                                        <td><?= $user->email ?></td>

                                    </tr>
                                    <tr>
                                        <td>Qualification: </td>
                                        <td><?= $user->qualification ?></td>

                                    </tr>
                                    <tr>
                                        <td>Role: </td>
                                        <td><?= $this->user_model->get_category($user->priviledge)?></td>

                                    </tr>
                                    <?php if($user->priviledge == 1): ?>

                                        <tr>
                                            <td>History: </td>
                                            <td>Edited: <?= count($this->journal_model->edited_count($user->id))?> &nbsp;
                                                Editing: <?= count($this->journal_model->get_updates_for_editor($user->id))?> &nbsp;
                                                Awaiting Reviewer: <?= count($this->journal_model->get_awaiting_reviewer($user->id))?>

                                            </td>

                                        </tr>
                                    <?php elseif($user->priviledge == 2): ?>

                                        <tr>
                                            <td>History: </td>
                                            <td> Reviewed: <?= count($this->journal_model->reviewed_count($user->id))?>
                                                &nbsp; Reviewing: <?= count($this->journal_model->get_updates_for_reviewer($user->id))?>
                                            </td>

                                        </tr>


                                    <?php endif ?>


                                    <?php if(isset($user_action)): ?>

                                    <tr>
                                        <td><?=$user_action ?> </td>
                                        <td>
                                            <?php foreach ($user_action_journals as $user_journal) : ?>
                                                <a href="<?= base_url('journal/view/'.$user_journal->manuscript_no)?>"><?= $user_journal->title ?></a></br>
                                            <?php endforeach; ?>
                                        </td>

                                    </tr>

                                    <?php endif ?>

                                    <?php if($_SESSION['priviledge'] == 1 && $this->user_model->get_application($user->id) !== NULL && $this->user_model->get_application($user->id)->status != '2'): ?>
                                        <tr>
                                            <td>Application: </td>
                                            <td> Become
                                            <a href="<?= base_url('editor/approve/'.$user->id)?>"><?= $this->user_model->priviledge_formatter($this->user_model->get_application($user->id)->request_to)  ?></a></td>

                                    </tr>
                                    <?php endif ?>

                                    <tr>
                                        <td>Submissions: <?= count($this->journal_model->get_user_journals($user->id))?> </td>
                                        <td>
                                            <?php foreach ($journals as $journal) : ?>
                                            <a href="<?= base_url('journal/view/'.$journal->manuscript_no)?>"><?= $journal->title ?></a></br>
                                            <?php endforeach; ?>
                                        </td>

                                    </tr>




                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

    </div>



