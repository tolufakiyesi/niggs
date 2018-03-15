<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>





    <div class="container-fluid">
        <!-- Page -->

        <?php if (isset($journals) && !empty($journals)) : ?>
        <div class="page-header">
            <h1 class="page-title"><?= $pageinfo['pagetitle'] ?></h1>
        </div>
        <div class="page-content">
            <!-- Panel -->
            <div class="panel">
                <div class="panel-body container-fluid">
                    <div class="row row-lg">
                        <div class="col-md-12">

                            <?php foreach ($journals as $journal) : ?>
                            <table>
                                <tr>
                                    <td>Title: </td>
                                    <td><a href = "<?= base_url('journal/view/'.$journal->manuscript_no) ?>"  > <?= $journal->title ?> </a> </td>

                                </tr>
                                <tr>
                                    <td>Author: </td>
                                    <td><?= $this->user_model->get_username_from_user_id($journal->author_id) ?> </td>

                                </tr>
                                <tr>
                                    <td>Uploaded On: </td>
                                    <td><?= $journal->date ?></td>

                                </tr>
                                <tr>
                                    <td>Status: </td>
                                    <td><?=$this->journal_model->status_formatter($journal->status) ?></td>

                                </tr>

                                <?php if($journal->status != 1): ?>
                                <tr>
                                    <td>Reviewer: </td>
                                    <td><?= $this->user_model->get_username_from_user_id($journal->reviewer_id) ?></td>

                                </tr>
                                <tr>
                                    <td>Editor: </td>
                                    <td><?= $this->user_model->get_username_from_user_id($journal->editor_id) ?></td>

                                </tr>
                                <?php endif ?>

                                <br>
                                <br>

                            </table>
                                <br>
                            <?php endforeach ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>



        <?php else : ?>
            <h4><?= $pageinfo['notfound'] ?></h4>
        <?php endif; ?>
    </div>



