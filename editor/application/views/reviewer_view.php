<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>





<div class="container-fluid">
        <!-- Page -->

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
                                <?php if (isset($journals) && !empty($journals)) : ?>
                                <h4 class="example-title"><?= $pageinfo['pagetitle'] ?></h4>
                                <div class="example table-responsive">
                                    <!--
                                     <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <p class="text-center"></p>
                                </div>
                                 -->
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>

                                            <th>Journal Name</th>
                                            <th>Posted By</th>
                                            <th>Posted On</th>
                                            <th class="text-nowrap">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($journals as $journal) : ?>
                                            <tr>

                                                <td><a href = "<?= base_url('journal/view/'.$journal->manuscript_no) ?>"  > <?= $journal->title ?> </a> </td>
                                                <td><?= $this->user_model->get_username_from_user_id($journal->author_id) ?></td>
                                                <td><?= $journal->date ?></td>
                                                <td>
                                                    <?=$this->journal_model->status_formatter($journal->status) ?>
                                                </td>
                                            </tr>

                                        <?php endforeach; ?>

                                        <?php else : ?>
                                            <h4>No journals yet</h4>
                                        <?php endif; ?>
                                        <!-- Modal For Delete -->

                                        </tbody>
                                    </table>




                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



</div>

