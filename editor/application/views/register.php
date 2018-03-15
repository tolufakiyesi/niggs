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
        <?php if (isset($error)) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-12">
            <div class="page-header">
                <h1>Register</h1>
            </div>
            <?= form_open() ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username') ?>" placeholder="Enter a username" required>
                <p class="help-block">At least 4 characters, letters or numbers only</p>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>" placeholder="Enter your email" required>
                <p class="help-block">A valid email address</p>
            </div>
            <div class="form-group">
                <label for="firstname">Firstname</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= set_value('firstname') ?>" required>
            </div>
            <div class="form-group">
                <label for="othernames">Other names</label>
                <input type="text" class="form-control" id="othernames" name="othernames" value="<?= set_value('othernames') ?>" >
            </div>
            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?= set_value('lastname') ?>" required>

            </div>
            <div class="form-group">
                <label for="qualification">Qualification</label>
                <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Ph.D., M.D. etc" required>

            </div>
            <div class="form-group">
                <label>Gender &nbsp;&nbsp; </label>
                <label class="radio-inline">
                    <input type="radio" name="gender" value="male" required>Male
                </label>
                <label class="radio-inline">
                    <input type="radio" name="gender" value="female">Female
                </label>
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
            <div class="form-group">
                <input type="submit" class="btn btn-default" value="Register">
            </div>
            </form>
        </div>
    </div><!-- .row -->
</div><!-- .container -->