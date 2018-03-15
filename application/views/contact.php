<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website for the Nigerian Geophysical Society.">
    <meta name="author" content="">

    <title>NGS</title>

    <!-- Font Awesome -->
    <link href="<?= base_url('vendor/font-awesome/css/font-awesome.css') ?>" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Style CSS -->
    <link href="<?= base_url('vendor/css/style.css') ?>" rel="stylesheet">

</head>

<body>

<!--=============================== Navbar ===========================-->
<nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top" style="background-color:#000;">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="<?= base_url()?>">NGS</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li>
                    <a href="<?= base_url()?>">HOME</a>
                </li>
                <li>
                    <a href="<?= base_url('about')?>">ABOUT</a>
                </li>
                <li>
                    <a href="<?= base_url('leaders')?>">LEADERSHIP</a>
                </li>
                <li>
                    <a href="<?= base_url('members')?>">MEMBERSHIP</a>
                </li>
                <li>
                    <a href="#">MEETINGS</a>
                </li>
                <li>
                    <a href="https://editor.niggs.org" target="_blank">EDITORIALS</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--============================ End of Navbar =======================-->


<!-- ============================ Contact  ============================ -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Contact us</h2><hr>

            </div>
        </div>

        <div class="row text-center about">
            <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 text-center">
                <?php if (validation_errors()) : ?>
                    <div class="col-md-12">
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (isset($message)) : ?>
                    <div class="col-md-12">
                        <div class="alert <?= isset($messagetype)?$messagetype : "alert-danger" ?>" role="alert">
                            <?= $message ?>
                        </div>
                    </div>
                <?php endif; ?>
                <form class="contact-form" name="contact-form" method="post" action="<?=base_url('contact_us')?>" role="form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" required="required" placeholder="Email address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Message"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!--
                      <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                          <i class="fa fa-circle fa-stack-2x text-primary"></i>
                          <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="vision-heading">Vision</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto.</p>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto.</p>
                      </div>

                      <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                          <i class="fa fa-circle fa-stack-2x text-primary sr-icons"></i>
                          <i class="fa fa-rocket fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="what-heading">Mission</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni.</p>
                      </div>

                        -->

        </div>
    </div>
</section>
<!-- ========================= End Of About ========================= -->

<hr style="margin-bottom: 4vw; width: 70%; height:1px; margin-top: 2vw;">


<div class="row" style="text-align:center;">
    <div class="col-md-12">
        <span class="copyright">copyright &copy; NGS - 2017</span>
    </div>
</div>
</div>
</footer>
<!-- =========================== End Of Footer ====================== -->


<!--======================== JAVASCRIPT ======================-->
<!-- jQuery -->
<script src="<?= base_url('vendor/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('vendor/js/jquery.easing.min.js') ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url('vendor/bootstrap/js/bootstrap.min.js') ?>"></script>

<!-- Theme JavaScript -->
<script src="<?= base_url('vendor/js/navbareffect.js') ?>"></script>
<script src="<?= base_url('vendor/js/NGS.js') ?>"></script>

</body>

</html>
