<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>








    <div class="container-fluid">
        <!-- Page -->

        <div class="page-header">
            <h1 class="page-title">Users</h1>
        </div>
        <div class="page-content">
            <!-- Panel -->
            <div class="panel">
                <div class="panel-body container-fluid">
                    <div class="row row-lg">
                        <div class="col-md-12">

                            <table class="table table-responsive">
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Priviledge</th>
                                    <th>History</th>
                                </tr>
                                <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><a href="<?= base_url('user/index/'.$user->username)?>"> <?= $user->username ?> </a></td>
                                    <td><?= $user->email ?></td>
                                    <td><?= $this->user_model->get_category($user->priviledge)?></td>

                                    <td>
                                        <?php if($user->priviledge == 3){
                                            echo "Published: ".count($this->journal_model->get_user_journals($user->id));
                                        }elseif($user->priviledge == 2){
                                            echo "Review History: ".count($this->journal_model->get_reviewer_journals($user->id));

                                        }elseif($user->priviledge == 1){
                                            echo "Editing History: ".$this->journal_model->editing_currently_count($user->id);

                                        } ?>
                                    </td>

                                </tr>
                                <?php endforeach; ?>

                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>



