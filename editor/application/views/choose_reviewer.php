<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>





<div class="container-fluid" >
        <!-- Page -->
    <div  style="min-height: 600px;">
        <div class="page-header">
            <h1 class="page-title">Journals</h1>
        </div>
        <div class="page-content">
            <!-- Panel -->
            <div class="panel">
                <div class="panel-body container-fluid">
                    <div class="row row-lg">
                        <div class="col-md-12">
                            <!-- Example Bordered Table -->
                            <div class="example-wrap">
                                <h1><a href="<?=base_url('journal/view/'.$journal->manuscript_no) ?>"><?=$journal->title ?></a></h1>
                                <p class="text" style="font-size: large">Manuscript Number: <?=!empty($journal->manuscript_no)? $journal->manuscript_no : " "?></p>
                                <p class="text" style="font-size: large">Research Relevance: <?=!empty($journal->relevance)? $this->journal_model->format_relevance($journal->relevance): "Undefined"?></p>



                                <ul class="w3-leftbar w3-theme-border" style="list-style:none">
                                    <?=$journal->fulltitle ?>
                                </ul>
                                <hr>


                                <h4 class="example-title">Choose A Reviewer</h4>
                                <div class="input-group custom-search-form">
                                    <label>Search: </label>
                                    <input type="text" placeholder="Name or Username">
                                    <span >
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                                </div>
                                <div class="example table-responsive">


                                    <table class="table table-responsive">
                                        <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Field</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($reviewers as $reviewer): ?>
                                            <tr>
                                                <td> <a href="<?=base_url('editor/review/'.$manuscript_no.'/'.$reviewer->id) ?> "><?= $reviewer->username ?></a> </td>
                                                <td><?= $reviewer->email ?></td>
                                                <td>Reviewed: <?= count($this->journal_model->reviewed_count($reviewer->id))?> &nbsp; Reviewing:<?= count($this->journal_model->get_updates_for_reviewer($reviewer->id))?> </td>
                                                <td><?= $this->journal_model->format_relevance($reviewer->research_field) ?></td >

                                            </tr>

                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                    <div id="id01" class="modal">

                                        <form class="modal-content animate" action="/action_page.php">

                                            <div class="page-header">
                                                <p><h1 class="page-title">Reviewers</h1></p>
                                            </div>

                                            <div class="container">


                                            </div>


                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
