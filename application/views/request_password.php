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

<body id="page-top" class="index">

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
                <li class="active">
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

<!-- ==================== Login and Register Section ================ -->
<section id="login-register">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">FORGOT PASSWORD</h2><hr>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <?php if (isset($message)) : ?>
                                    <div class="col-md-12">
                                        <div class="alert <?= isset($messagetype)?$messagetype : "alert-danger" ?>" role="alert">
                                            <?= $message ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <h4>Get a Password Reset Link</h4>

                                <form id="login-form" action="<?= base_url('forgot_password') ?>" method="post" role="form" style="display: block;">
                                    <div class="form-group">

                                        <div class="text-danger"> <?= form_error('userdetail') ?> </div>
                                        <input type="text" name="userdetail" id="userdetail" tabindex="1" class="form-control" placeholder="Email or NGS Username" value="<?= set_value('login_userdetail')?>" >
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Submit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-right">
                                                    <a href="<?= base_url('members')?>" tabindex="5" class="forgot-password">or Login</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================= End Of Login and Register Section ============ -->


<!-- ============================== Footer ========================= -->
<footer id="contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="col-md-7">
                    <h3>Where we are</h3>
                    <p class="text-muted"><i class="fa fa-map-marker"></i>Nigerian Geophysical Society<br>
                        Department of Physics,<br>
                        Tai Solarin University of Education,<br>
                        Ijagun, Ijebu-Ode, Ogun State, Nigeria.
                    </p>
                    <p class="text-muted"><i class="fa fa-phone"></i>+234 813 056 7592 | +234 806 928 9985</p>
                    <p class="text-muted"><i class="fa fa-envelope"></i>secretariat@niggs.org</p>
                </div>
                <div class="col-md-5">
                    <h3>I WANT TO</h3>
                    <ul>
                        <li><a href="#" class="text-muted"><i class="fa fa-sign-in"></i>Join NGS</a></li>
                        <li><a href="#" class="text-muted"><i class="fa fa-money"></i>Donate to NGS</a></li>
                        <li><a href="#" class="text-muted"><i class="fa fa-file-text"></i>Submit a Paper</a></li>
                        <li><a href="#" class="text-muted"><i class="fa fa-search"></i>Find an Event</a></li>
                        <li><a href="#" class="text-muted"><i class="fa fa-user"></i>Volunteer</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6">
                <h3>Leave a message</h3>
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
        </div>
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

<!-- Custom JavaScript -->
<script src="<?= base_url('vendor/js/navbareffect.js') ?>"></script>
<script src="<?= base_url('vendor/js/NGS.js') ?>"></script>
<script src="<?= base_url('vendor/js/membership.js') ?>"></script>

</body>

</html>
