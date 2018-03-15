<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <!-- ==================== Login and Register Section ================ -->
    <section id="login-register">
        <div class="container">
            <div id="page-wrapper" style="min-height: 600px;">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">EDITORIAL MANAGER</h2><hr>
                        <h4 class="section-subheading"><p>Login to NGS Editorial Manager if you already have an account </p> or Register if you are yet to have one.</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-login">
                            <div class="panel-heading" style="margin-top: 30px">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <a href="#" class="active" id="login-form-link">Login</a>
                                    </div>
                                    <div class="col-xs-6">
                                        <a href="#" id="register-form-link">Register</a>
                                    </div>
                                </div>
                                <hr>
                            </div>
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

                                        <form id="login-form" name="login_form" action="<?= base_url('login') ?>" method="post" role="form" style="display: block;" onSubmit="return validate()">

                                            <div class="form-group">
                                                <div class="text-danger"> <?= form_error('login_username') ?> </div>
                                                <input type="text" class="form-control" id="login_username" name="login_username" placeholder="Username" tabindex="1" value="<?= set_value('login_username')?>" required>
                                            </div>

                                            <div class="form-group">
                                                <div class="text-danger"> <?= form_error('login_password') ?> </div>
                                                <input type="password" class="form-control" name="login_password" id="login_password" tabindex="2" placeholder="Password" required>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6 col-sm-offset-3">
                                                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-default" value="Log In">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="text-center">
                                                            <a href="<?= base_url('forgot_password')?>" tabindex="5" class="forgot-password">Forgot Password?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <form id="register-form" method="post" role="form" style="display: none;">
                                            <div class="form-group">
                                                <div class="text-danger"> <?php echo form_error('username'); ?></div>
                                                <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="<?= set_value('username')?>" required>

                                            </div>
                                            <div class="form-group">
                                                <div class="text-danger"> <?php echo form_error('email'); ?> </div>
                                                <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="<?= set_value('email')?>" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="text-danger"> <?php echo form_error('firstname'); ?></div>
                                                <input type="text" name="firstname" id="firstname" tabindex="1" class="form-control" placeholder="First Name" value="<?= set_value('firstname')?>" required>

                                            </div>
                                            <div class="form-group">
                                                <div class="text-danger"><?php echo form_error('othernames'); ?></div>
                                                <input type="text" name="othernames" id="othernames" tabindex="1" class="form-control" placeholder="Other Names" value="<?= set_value('othernames')?>">
                                            </div>
                                            <div class="form-group">
                                                <div class="text-danger"><?php echo form_error('lastname'); ?></div>
                                                <input type="text" name="lastname" id="lastname" tabindex="1" class="form-control" placeholder="Last Name" value="<?= set_value('lastname')?>" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="text-danger"> <?php echo form_error('phoneno'); ?> </div>
                                                <input type="text" name="phoneno" id="phoneno" tabindex="1" class="form-control" placeholder="Phone Number" value="<?= set_value('phoneno')?>" required>
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


                                            <p class="form-section">Educational Information</p>
                                            <div class="form-group">
                                                <div class="text-danger"><?php echo form_error('qualification'); ?></div>

                                                <select class="education-level form-control" name="qualification" required>
                                                    <option selected disabled hidden>Select Highest Education Level</option>
                                                    <option value="PhD" <?= set_select('qualification', 'PhD') ?>>PhD</option>
                                                    <option value="MPhil" <?= set_select('qualification', 'MPhil') ?>>MPhil</option>
                                                    <option value="MSc" <?= set_select('qualification', 'MSc') ?>>MSc</option>
                                                    <option value="PG Dip" <?= set_select('qualification', 'PG Dip') ?>>PG Dip</option>
                                                    <option value="BSc" <?= set_select('qualification', 'BSc') ?>>BSc</option>
                                                    <option value="HND" <?= set_select('qualification', 'HND') ?>>Higher Diploma</option>
                                                    <option value="OND" <?= set_select('qualification', 'OND') ?>>Ordinary Diploma</option>
                                                </select>
                                            </div>
                                            <div class="form-group">

                                                <label>Area of Research Relevance</label>
                                                <select class="education-level form-control" name="relevance" required >
                                                    <option disabled selected>Select</option>
                                                    <option value="astronomy" <?= set_select('relevance', 'astronomy') ?>>Astronomy and Planetary Science</option>
                                                    <option value="atmosphere" <?= set_select('relevance', 'atmosphere') ?>>Atmospheric Science</option>
                                                    <option value="hydro" <?= set_select('relevance', 'hydro') ?>>Hydrological Science</option>
                                                    <option value="ocean" <?= set_select('relevance', 'ocean') ?>>Ocean Science</option>
                                                    <option value="solar" <?= set_select('relevance', 'solar') ?>>Solar and Terrestrial Science</option>
                                                    <option value="solid" <?= set_select('relevance', 'solid') ?>>Solid Earth Science</option>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter a password" required>
                                                <p class="help-block">At least 6 characters</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="password_confirm">Confirm password</label>
                                                <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm your password" required>
                                                <p class="help-block">Must match your password</p>
                                            </div>
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-default" value="Register">
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
    </section>
    <!-- ================= End Of Login and Register Section ============ -->



    <script>
        function validate()
        {
            if(document.login_form.priviledge.selectedIndex=="0")
            {
                alert ( "Please Select Role!");
                return false;
            }

            return true;
        }
    </script>

    <!-- jQuery -->
    <script src="<?= base_url('vendor/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('vendor/js/jquery.easing.min.js') ?>"></script>
    <script src="<?= base_url('vendor/js/membership.js') ?>"></script>
<?php if (isset($register_fallback)):?>
    <script src="<?= base_url('vendor/js/register_fallback.js') ?>"></script>
<?php endif; ?>