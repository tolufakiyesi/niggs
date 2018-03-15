<!doctype html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>NGS</title>

    <script src="http://www.google.com/jsapi" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <!-- Bootstrap core CSS     -->
    <link href="<?= base_url('vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('vendor/css/dashboard.css') ?>" rel="stylesheet"/>
		<link href="<?= base_url('vendor/font-awesome/css/font-awesome.css') ?>" rel="stylesheet" />


</head>

<body>
<div class="wrapper">
    <div class="sidebar">
			<div class="sidebar-wrapper">
            <div class="logo">
                <a href="<?=base_url()?>" class="simple-text">NGS</a>
            </div>

            <ul class="nav">
                <li >
                    <a href="profile">
                        <i class="fa fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="active">
                    <a href="<?= base_url('edit') ?>">
                        <i class="fa fa-cog"></i>
                        <p>Update Profile</p>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('password') ?>">
                        <i class="fa fa-lock"></i>
                        <p>Change Password</p>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('members_list') ?>">
                        <i class="fa fa-list-ol"></i>
                        <p>View Members List</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Update Profile</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">

                        <li>
                            <a href="<?= base_url('logout')?>">
                                <p><i class="fa fa-power-off"></i>Log out</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

				<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content">
                                <?= form_open_multipart() ?>
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

                                    <div class="icon-holder">
                                        <img src="<?= base_url('vendor/img/excos/e1.png') ?>" class="icon img-circle">
                                        <label for="file-upload" class="custom-file-upload">
                                            <i class="fa fa-cloud-upload"></i> Change<br>
                                            <span class="filename"></span>
                                        </label>
                                        <input id="file-upload" name="file-upload" type="file" style="display: none"/>
                                    </div>
																	<div class="row">
																			<div class="col-md-6">

																					<div class="form-group">
																							<label>First Name</label>
																							<input type="text" class="form-control" disabled placeholder="first-name" name="firstname" value="<?=$user->firstname ?>">
																					</div>
																			</div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Middle Name</label>
                                                                                    <input type="text" class="form-control" name="middlename" disabled placeholder="middle-Name" value="<?=$user->middlename ?>">
                                                                                </div>
                                                                            </div>

																	</div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="lastname" disabled placeholder="Last-Name" value="<?=$user->lastname ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Qualification</label>
                                                <input type="text" class="form-control" name="qualification" disabled placeholder="Ph.D., M.D. etc" value="<?=$user->education ?>">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email" disabled placeholder="Email" value="<?=$user->email ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" class="form-control" name="phone" disabled placeholder="Phone No" value="<?= $user->phone?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <input type="text" class="form-control" name="gender" disabled placeholder="Male or Female" value="<?=$user->gender == 'm' ? 'Male': 'Female' ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" name="address" placeholder="Home Address" value="<?=$user->address ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Town/City</label>
                                                <input type="text" class="form-control" name="town" placeholder="town" value="<?=$user->town ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>State/Province</label>
                                                <input type="text" class="form-control" name="state" placeholder="state" value="<?=$user->state ?>">
                                            </div>
                                        </div>
										<!--<div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" class="form-control" name="country" placeholder="country" value="<?= $user->country?>">
                                            </div>
                                        </div>-->
                                    </div>

																		<div class="row">

																				<div class="col-md-6">
																						<div class="form-group">
																								<label>Mailing Address</label>
																								<input type="text" class="form-control" name="mailing_addr" placeholder="mailing-address" value="<?= $user->mailing_addr?>">
																						</div>
																				</div>
                                                                                <div class="col-md-6">
                                                                                    <div class="text-danger"> <?= form_error('affiliation') ?> </div>
                                                                                    <div class="form-group">
                                                                                        <label>Affiliation</label>
                                                                                        <input type="text" class="form-control" name="affiliation" placeholder="Affiliation" value="<?= $user->affiliation?>">
                                                                                    </div>
                                                                                </div>
																		</div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>About Me</label>
                                                <textarea rows="5" class="form-control" name="about" placeholder="Tell us something about you" value="Mike"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Enter Password to Save Changes:</label>
                                                <input type="password" class="form-control" name="password" placeholder="password" required>
                                            </div>
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



</div>



</body>

    <!--   Core JS Files   -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="<?= base_url('vendor/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('vendor/js/jquery.min.js') ?>" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
        $("input:file").change(function (){
            var fileName = $(this).val();
            $(".filename").html(fileName);
        });
    });
</script>

</html>
