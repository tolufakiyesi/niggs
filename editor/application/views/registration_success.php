<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>




<div class="container">
    <div class="row page_row">
        <div class="row">
            <div class="page-header text-center">
                <h1 class="page-title">Registration Success</h1>
            </div>
        </div>
        <!-- /.row -->

        <div id="page-wrapper" style="min-height: 600px;">
        <div class="row row-lg">
            <div class="col-md-12">
                <!-- Example Bordered Table -->
                <div class="row">
                    <div class="example-wrap">
                        <div class="page-header">
                            <h3 class="page-title">You have successfully registered.</h3>

                        </div>

                        <div class="text" style="font-size: large;">
                            <p>You are by default an author.</p>
                            <p>Your username is: <?=$username?></p>
                            </br></br>
                            <p> Please <a href="<?= base_url('user/login') ?>"><button class="btn btn-primary">login</button></a> to submit a journal or
                                to apply for a priviledge change if you would like to become a reviewer or an editor.
                            </p>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->







