<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid" style="margin-bottom: 30px;">
    <div class="row">
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
        <div class="col-md-10">
            <div class="page-header">
                <h1>Edit Profile</h1>
            </div>
            <?= form_open() ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $user->username ?>" placeholder="Enter a username" required>
                <p class="help-block">At least 4 characters, letters or numbers only</p>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user->email ?>" placeholder="Enter your email" required>
                <p class="help-block">A valid email address</p>
            </div>
            <div class="form-group">
                <label for="firstname">Firstname</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $user->firstname ?>" required>
            </div>
            <div class="form-group">
                <label for="othernames">Other names</label>
                <input type="text" class="form-control" id="othernames" name="othernames" value="<?= $user->othernames ?>" >
            </div>
            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $user->lastname ?>" required>

            </div>

            <div class="form-group">
                <label for="qualification">Qualification</label>
                <select class="education-level form-control" name="qualification" required>
                    <option selected disabled hidden>Select Highest Education Level</option>
                    <option value="PhD" <?= $user->qualification == "PhD" ? "selected": ""?>>PhD</option>
                    <option value="MPhil" <?= $user->qualification == "MPhil" ? "selected": ""?>>MPhil</option>
                    <option value="MSc" <?= $user->qualification == "MSc" ? "selected": ""?>>MSc</option>
                    <option value="PG Dip" <?= $user->qualification == "PG Dip" ? "selected": ""?>>PG Dip</option>
                    <option value="BSc" <?= $user->qualification == "BSc" ? "selected": ""?>>BSc</option>
                    <option value="HND" <?= $user->qualification == "HND" ? "selected": ""?>>Higher Diploma</option>
                    <option value="OND" <?= $user->qualification == "OND" ? "selected": ""?>>Ordinary Diploma</option>
                </select>
            </div>
            <div class="form-group">
                <label>Gender &nbsp;&nbsp; </label>
                <label class="radio-inline">
                    <input type="radio" name="gender" value="male" <?= set_value('gender', $user->gender) == 'male' ? "checked" : "" ?> required>Male
                </label>
                <label class="radio-inline">
                    <input type="radio" name="gender" value="female" <?= set_value('gender', $user->gender) == 'female' ? "checked" : "" ?> >Female
                </label>
            </div>


            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter current password" required>
                <p class="help-block">Enter your password to save</p>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-default" value="Save">
            </div>
            </form>
        </div>
    </div><!-- .row -->

</div><!-- .container -->
