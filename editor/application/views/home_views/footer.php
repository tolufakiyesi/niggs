<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
<script src="<?= base_url('graphics/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('graphics/js/jquery.easing.min.js') ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/js/bootstrap.min.js') ?>"></script>

<!-- Theme JavaScript -->
<script src="<?= base_url('graphics/js/navbareffect.js') ?>"></script>
<script src="<?= base_url('graphics/js/NGS.js') ?>"></script>

</body>

</html>
