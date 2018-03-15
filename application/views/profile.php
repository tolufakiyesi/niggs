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
                <a href="<?= base_url()?>" class="simple-text">NGS</a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="<?= base_url('profile')?>">
                        <i class="fa fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li>
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
                    <a class="navbar-brand" href="#">Profile Overview</a>
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

                        <?php if (isset($message)) : ?>
                            <div class="col-md-12 text-center">
                                <div class="alert <?= isset($messagetype)?$messagetype : "alert-danger" ?>" role="alert">
                                    <?= $message ?>
                                </div>
                            </div>
                        <?php endif; ?>


                    <div class="col-sm-12">
                        <div class="card">
													<div class="icon-holder">
															<img src="<?= empty($user->avatar) ? base_url('vendor/img/excos/e1.png') : base_url('images/'.$user->avatar) ?>" class="icon img-circle">
													</div>
													<div class="row">
														<div class="profile-content">
															<div class="col-sm-12 col-md-5">
																<span class="title">Member ID</span>
															</div>
															<div class="col-sm-12 col-md-7">
																<span class="answer"><?= $user->username?></span><hr>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="profile-content">
															<div class="col-sm-12 col-md-5">
																<span class="title">Full Name</span>
															</div>
															<div class="col-sm-12 col-md-7">
																<span class="answer"><?= $user->firstname. ' ' .$user->middlename. ' ' .$user->lastname ?></span><hr>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="profile-content">
															<div class="col-sm-12 col-md-5">
																<span class="title">Affiliaton</span>
															</div>
															<div class="col-sm-12 col-md-7">
																<span class="answer"><?= $user->affiliation ?> </span><hr>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="profile-content">
															<div class="col-sm-12 col-md-5">
																<span class="title">Research Section</span>
															</div>
															<div class="col-sm-12 col-md-7">
																<span class="answer">Astronomy and Planetary Science</span><hr>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="profile-content">
															<div class="col-sm-12 col-md-5">
																<span class="title">NGS Email</span>
															</div>
															<div class="col-sm-12 col-md-7">
																<span class="answer"><?= $user->email ?></span><hr>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="profile-content">
															<div class="col-sm-12 col-md-5">
																<span class="title">Joined NGS</span>
															</div>
															<div class="col-sm-12 col-md-7">
																<span class="answer"><?= $this->member_model->date_formatter($user->date)?></span><hr>
															</div>
														</div>
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
