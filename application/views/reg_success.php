<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<!-- ============================= Executives ======================= -->
<section id="leaders" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Registration Successful</h2><hr>
                <h3 class="section-subheading text-muted">Please check your email to confirm your account and proceed.</h3>
                <p>Username: <?=isset($user) ? $user['username'] : 'Username'  ?> <br>
                Password: <?=isset($user) ? $user['password'] : 'Password'  ?>
                </p>

            </div>
        </div>

    </div>
</section>
<!-- ========================== End Of Executives =================== -->




