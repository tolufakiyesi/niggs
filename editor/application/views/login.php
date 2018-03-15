<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
    <div class="row col-md-10 col-md-offset-1">
        <?php if (validation_errors()) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (isset($message)) : ?>
            <div class="col-md-12">
                <div class="alert <?= isset($messagetype) ? $messagetype : 'alert-danger'?>" role="alert">
                    <?= $message ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-12">
            <div class="page-header">
                <h1>Login</h1>
            </div>
            <form name="form" method="post" onSubmit="return validate()">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Your password" required>
            </div>
            <div class="form-group">
                <label for="password">Login As</label>
                <select name="priviledge" required>
                    <option selected disabled>Select</option>
                    <option value="3">Author</option>
                    <option value="2">Reviewer</option>
                    <option value="1">Editor</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-default" value="Login">
            </div>
            </form>
            <div class="text text-center"><a href="<?=base_url('forgot_password')?>">Forgot Password?</a></div>
        </div>
    </div><!-- .row -->
</div><!-- .container -->


<script>
    function validate()
    {
        if(document.form.priviledge.selectedIndex=="0")
        {
            alert ( "Please Select Role!");
            return false;
        }

        return true;
    }
</script>