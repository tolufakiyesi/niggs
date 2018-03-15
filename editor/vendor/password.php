<!doctype html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>NGS</title>


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
                <a href="index.html" class="simple-text">NGS</a>
            </div>

            <ul class="nav">
                <li>
                    <a href="profile.html">
                        <i class="fa fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li>
                    <a href="edit-profile.html">
                        <i class="fa fa-cog"></i>
                        <p>Update Profile</p>
                    </a>
                </li>
                <li class="active">
                    <a href="password.html">
                        <i class="fa fa-lock"></i>
                        <p>Change Password</p>
                    </a>
                </li>
                <li>
                    <a href="members-list.html">
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
                    <a class="navbar-brand" href="#">Change Passowrd</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">

                        <li>
                            <a href="#">
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
													<div class="password-change">
														<form id="login-form" action="" method="post" role="form" style="display: block;">
															<i class="display fa fa-unlock-alt text-center"></i>
															<div class="form-group">
																<span>Current Password</span>
			      										<input type="password" name="current-password" id="password" tabindex="2" class="form-control" placeholder="Password">
			      									</div>
			      									<div class="form-group">
																<span>New Password</span>
			      										<input type="password" name="new-password" id="new-password" tabindex="2" class="form-control" placeholder="Password">
			      									</div>
															<div class="form-group">
																<span>Retype New Password</span>
			      										<input type="password" name="retype-new-password" id="retype-new-password" tabindex="2" class="form-control" placeholder="Password">
			      									</div>
			      									<div class="form-group">
			      										<div class="row">
			      											<div class="col-sm-6 col-sm-offset-3">
			      												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Change Password">
			      											</div>
			      										</div>
			      									</div>

			      								</form>
													</div>
                        </div>
                    </div>
                </div>


</div>


</body>

    <!--   Core JS Files   -->
		<script src="<?= base_url('vendor/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('vendor/js/jquery.min.js') ?>" type="text/javascript"></script>

</html>
