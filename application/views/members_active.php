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
                    <a href="">MEMBERSHIP</a>
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
        <h2 class="section-heading">MEMBERSHIP</h2><hr>
        <h4 class="section-subheading">Login into your NGS account or create an account if you're yet to have one.</h4>
    </div>
</div>
<div class="row">
<div class="col-md-6 col-md-offset-3">
<div class="panel panel-login">
<div class="panel-heading">
    <div class="row">
        <div class="col-xs-6">
            <a href="#" class="<?=$page['login'] ?>" id="login-form-link">Login</a>
        </div>
        <div class="col-xs-6">
            <a href="#" class="<?=$page['register'] ?>" id="register-form-link">Register</a>
        </div>
    </div>
    <hr>
</div>
<div class="panel-body">
<div class="row">
<div class="col-lg-12">
<?php if (validation_errors()) : ?>
    <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
            <?= validation_errors() ?>
        </div>
    </div>
<?php endif; ?>
<?php if (isset($error)) : ?>
    <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    </div>
<?php endif; ?>

<form id="login-form" action="<?= base_url('login') ?>" method="" role="form" style="display: block;">
    <div class="form-group">
        <p class="text-danger"> <?= form_error('email') ?> </p>
        <input type="text" name="login_userdetail" id="email" tabindex="1" class="form-control" placeholder="NGS Email or Username" value="<?= set_value('email')?>" >
    </div>
    <p class="text-danger"> <?= form_error('password') ?> </p>
    <div class="form-group">
        <input type="password" name="login_password" id="password" tabindex="2" class="form-control" placeholder="Password">
    </div>
    <div class="form-group checkbox checkbox-success text-center">
        <input id="checkbox3" type="checkbox">
        <label for="checkbox3">Remember Me</label>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <a href="" tabindex="5" class="forgot-password">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="register-form" action="<?= base_url('register') ?>" method="post" role="form" style="display: none;">
    <p class="form-section">Personal Information</p>
    <div class="form-group">
        <?php echo form_error('firstname'); ?>
        <input type="text" name="firstname" id="firstname" tabindex="1" class="form-control" placeholder="First Name" value="<?= set_value('firstname')?>">
    </div>
    <div class="form-group">
        <?php echo form_error('middlename'); ?>
        <input type="text" name="middlename" id="middlename" tabindex="1" class="form-control" placeholder="Middle Name" value="<?= set_value('middlename')?>">
    </div>
    <div class="form-group">
        <?php echo form_error('lastname'); ?>
        <input type="text" name="lastname" id="lastname" tabindex="1" class="form-control" placeholder="Last Name" value="<?= set_value('lastname')?>">
    </div>
    <div class="form-group text-center">
        <div class="radio radio-info radio-inline">
            <input type="radio" id="inlineRadio1" value="m" name="gender" <?= set_radio('gender', 'm') ?> required>
            <label for="inlineRadio1">Male</label>
        </div>
        <div class="radio radio-inline">
            <input type="radio" id="inlineRadio2" value="f" name="gender" <?= set_radio('gender', 'f') ?>>
            <label for="inlineRadio2">Female</label>
        </div>
    </div>
    <div class="form-group">
        <p class="text-danger"> <?php echo form_error('email'); ?> </p>
        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="<?= set_value('email')?>">
    </div>
    <div class="form-group">
        <input type="text" name="phoneno" id="phoneno" tabindex="1" class="form-control" placeholder="Phone No" value="<?= set_value('phoneno')?>">
    </div>

    <p class="form-section">Educational Information</p>
    <div class="form-group">
        <?php echo form_error('education'); ?>
        <span>Highest Education Level</span>
        <select class="education-level" name="education" required>
            <option selected disabled>Select Highest Education Level</option>
            <option value="PhD" <?= set_select('education', 'PhD') ?>>PhD</option>
            <option value="MPhil" <?= set_select('education', 'MPhil') ?>>MPhil</option>
            <option value="MSc" <?= set_select('education', 'MSc') ?>>MSc</option>
            <option value="PG Dip" <?= set_select('education', 'PG Dip') ?>>PG Dip</option>
            <option value="BSc" <?= set_select('education', 'BSc') ?>>BSc</option>
            <option value="HND" <?= set_select('education', 'HND') ?>>Higher Diploma</option>
            <option value="OND" <?= set_select('education', 'OND') ?>>Ordinary Diploma</option>
        </select>
    </div>
    <div class="form-group">

        <span>Affliation</span>
        <?php echo form_error('affliation'); ?>
        <input type="text" name="affliation" id="affliation" tabindex="1" class="form-control" placeholder="" value="<?= set_value('affliation')?>">
    </div>
    <div class="form-group">
        <span>Address</span>
        <?php echo form_error('address'); ?>
        <input type="text" name="address" id="address" tabindex="1" class="form-control" placeholder="" value="<?= set_value('address')?>">
    </div>
    <div class="form-group">
        <span>Town/City</span>
        <?php echo form_error('city'); ?>
        <input type="text" name="city" id="city" tabindex="1" class="form-control" placeholder="" value="<?= set_value('city')?>">
    </div>
    <div class="form-group">
        <span>State/Province</span>
        <?php echo form_error('state'); ?>
        <input type="text" name="state" id="state" tabindex="1" class="form-control" placeholder="" value="<?= set_value('state')?>">
    </div>
    <div class="form-group">
        <?php echo form_error('country'); ?>
        <span>Country</span>
        <select class="education-level" name="country" >
            <option value=""  disabled selected>Select</option>
            <option value="Nigeria" <?= set_select('country', 'Nigeria') ?>>Nigeria</option>
            <option value="Ghana" <?= set_select('country', 'Ghana') ?>>Ghana</option>
            <option value="Kenya" <?= set_select('country', 'Kenya') ?>>Kenya</option>
            <option value="Togo" <?= set_select('country', 'Togo') ?>>Togo</option>
            <option value="South Africa" <?= set_select('country', 'South Africa') ?>>South Africa</option>
            <option value="Cameroon" <?= set_select('country', 'Cameroon') ?>>Cameroon</option>
            <option value="Chad" <?= set_select('country', 'Chad') ?>>Chad</option>
        </select>
    </div>
    <div class="form-group">
        <?php echo form_error('mailing-address'); ?>
        <span>Mailing Address (If different from address.)</span>
        <input type="text" name="mailing-address" id="mailing-address" tabindex="1" class="form-control" placeholder="" value="<?= set_value('mailing-address')?>">
    </div>

    <div class="form-group">
        <?php echo form_error('primary-interest'); ?>
        <span>Primary Research Interest</span>
        <select class="education-level" name="primary-interest" required >
            <option value=""  disabled selected>Select</option>
            <option value="astronomy" <?= set_select('primary-interest', 'astronomy') ?>>Astronomy and Planetary Science</option>
            <option value="atmosphere" <?= set_select('primary-interest', 'atmosphere') ?>>Atmospheric Science</option>
            <option value="hydro" <?= set_select('primary-interest', 'hydro') ?>>Hydrological Science</option>
            <option value="ocean" <?= set_select('primary-interest', 'ocean') ?>>Ocean Science</option>
            <option value="solar" <?= set_select('primary-interest', 'solar') ?>>Solar and Terrestrial Science</option>
            <option value="solid" <?= set_select('primary-interest', 'solid') ?>>Solid Earth Science</option>

        </select>
    </div>



    <?php echo form_error('research-interest'); ?>
    <p class="form-section">Other Research Interests</p>
    <div class="form-group checkbox checkbox-success">
        <input id="astronomy" type="checkbox" value="astronomy" name="research-interest[]" <?= set_checkbox('research-interest', 'astronomy') ?>>
        <label for="astronomy">Astronomy and Planetary Science</label><br>
        <input id="atmosphere" type="checkbox" value="atmosphere" name="research-interest[]" <?= set_checkbox('research-interest', 'atmosphere') ?>>
        <label for="atmosphere">Atmospheric Science</label><br>
        <input id="hydro" type="checkbox" value="hydro" name="research-interest[]" <?= set_checkbox('research-interest', 'hydro') ?>>
        <label for="hydro">Hydrological Science</label><br>
        <input id="ocean" type="checkbox" value="ocean" name="research-interest[]" <?= set_checkbox('research-interest', 'ocean') ?>>
        <label for="ocean">Ocean Science</label><br>
        <input id="solar" type="checkbox" value="solar" name="research-interest[]" <?= set_checkbox('research-interest', 'solar') ?>>
        <label for="solar">Solar and Terrestrial Science</label><br>
        <input id="solid" type="checkbox" value="solid" name="research-interest[]" <?= set_checkbox('research-interest', 'solid') ?>>
        <label for="solid">Solid Earth Science</label><br>
    </div>

    <p class="form-section">Referee</p>
    <div class="form-group">
        <?php echo form_error('referee-name'); ?>
        <span>Name</span>
        <input type="text" name="referee-name" id="referee-name" tabindex="1" class="form-control" placeholder="" value="<?= set_value('referee-name')?>">
    </div>
    <div class="form-group">
        <?php echo form_error('referee-affliation'); ?>
        <span>Affliation</span>
        <input type="text" name="referee-affliation" id="referee-affliation" tabindex="1" class="form-control" placeholder="" value="<?= set_value('referee-affliation')?>">
    </div>
    <div class="form-group">
        <?php echo form_error('referee-rank'); ?>
        <span>Rank</span>
        <input type="text" name="referee-rank" id="referee-rank" tabindex="1" class="form-control" placeholder="" value="<?= set_value('referee-rank')?>">
    </div>
    <div class="form-group">
        <?php echo form_error('referee-phone'); ?>
        <span>Phone No</span>
        <input type="text" name="referee-phone" id="referee-phone" tabindex="1" class="form-control" placeholder="" value="<?= set_value('referee-phone')?>">
    </div>
    <div class="form-group">
        <?php echo form_error('referee-email'); ?>
        <span>Email</span>
        <input type="text" name="referee-email" id="referee-email" tabindex="1" class="form-control" placeholder="" value="<?= set_value('referee-email')?>">
    </div>
    <div class="form-group">
        <div class="col-sm-6 col-sm-offset-3">
            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
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
                <form class="contact-form" name="contact-form" method="post" action="" role="form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" required="required" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" required="required" placeholder="Email address">
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
