<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>





    <div class="container-fluid">
        <!-- Page -->

        <div class="page-header">
            <h1 class="page-title">Articles</h1>
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

                                            <th>Article Name</th>
                                            <th>Posted By</th>
                                            <th>Posted On</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($journals as $journal) : ?>
                                            <tr>

                                                <td><a href = "<?= base_url('journal/view/'.$journal->manuscript_no) ?>"  > <?= $journal->title ?> </a> </td>
                                                <td><?= $this->user_model->get_username_from_user_id($journal->author_id) ?></td>
                                                <td><?= $journal->date ?></td>
                                                <td>
                                                    <a href="<?= base_url('editor/review/'.$journal->manuscript_no)?>">
                                                        <small><button class="btn btn-xs btn-success">Review</button></small>
                                                    </a>
                                                </td>
                                            </tr>

                                        <?php endforeach; ?>

                                        <?php else : ?>
                                            <h4>No journals yet</h4>
                                        <?php endif; ?>
                                        <!-- Modal For Delete -->
                                        <div class="modal fade" id="{{$category->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-center">Warning!!!</h4>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <p style="font-weight: bold; font-size:24px;">Do you want to delete the category called <span style="text-transform: capitalize;">{{$category->category_name}}</span>?</p>
                                                        <img class="img-responsive center-block" width="30%" src="public/dashboard/img/delete.png" alt="">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a data-dismiss="modal" class="btn btn-info"><i class="zmdi zmdi-close"></i> Close</a> <a href="{{url('delete-category')}}/{{$category->id}}/{{str_slug($category->category_name)}}" class="btn btn-danger"><i class="zmdi zmdi-delete"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </tbody>
                                    </table>

                                    <div id="id01" class="modal">

                                        <form class="modal-content animate" action="/action_page.php">

                                            <div class="page-header">
                                                <p><h1 class="page-title">Reviewers</h1></p>
                                            </div>

                                            <div class="container">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($reviewers as $reviewer): ?>
                                                        <tr>
                                                            <td> <a href="<?=base_url('editor/reviewed/'.$reviewer->id.'/'.$journal->manuscript_no) ?> "><?= $reviewer->username ?></a> </td>
                                                            <td><?= $reviewer->email ?></td>
                                                        </tr>

                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>

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



