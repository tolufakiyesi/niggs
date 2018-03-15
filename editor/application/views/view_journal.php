<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">


    <section class="article-single">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                    <div class="article-body">
                        <p class="lead">
                            <h2>Title: <?=$journal->title ?> </h2>
                        </p>

                        <p>

                            Status: <?=$status?> </br>

                        </p>

                        <p> Abstract: </br> <?=$journal->abstract ?></p>

                        <b><a href="<?= base_url('journal/download/'.$journal->journalfile) ?>">Download</a> a copy of the file</b>
                    </div><!--end of article body-->
                </div>
            </div><!--end of row-->

            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="author-details">
                        <img alt="Author" src="../public/assets/img/team-small-1.png">
                        <h5><?= $this->user_model->get_username_from_user_id($journal->author_id); ?></h5>
                        <p>
                            Baba Dudu is a freelance writer and conservationist. He currently works as the Admissions Coordinator and oversees communications at the Seymour Marine Discovery Center in Ibadan, Nigeria.
                        </p>
                        <ul class="social-icons">
                            <li>
                                <a href="#">
                                    <i class="icon social_twitter"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="icon social_facebook"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="icon social_tumblr"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!--end of row-->

        </div><!--end of container-->
    </section>
</div>
