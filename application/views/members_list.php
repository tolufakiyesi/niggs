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
                <a href="<?=base_url() ?>" class="simple-text">NGS</a>
            </div>

            <ul class="nav">
                <li>
                    <a href="<?= base_url('profile')?>">
                        <i class="fa fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('edit')?>">
                        <i class="fa fa-cog"></i>
                        <p>Update Profile</p>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('password')?>">
                        <i class="fa fa-lock"></i>
                        <p>Change Password</p>
                    </a>
                </li>
                <li class="active">
                    <a href="<?= base_url('members_list')?>">
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
                    <a class="navbar-brand" href="#">Members List</a>
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
					<div class="container">
						<div class="row">
								<div class="col-md-4">
											<form action="#" method="">
													<div class="input-group">
															<!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
															<input class="form-control" id="system-search" name="q" placeholder="Search for member by" required>
															<span class="input-group-btn">
																	<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
															</span>
													</div>
											</form>
									</div>
								<div class="col-md-6">You can search for a member by ID, LastName, FirstName, Affiliation or Research Theme</div>
						</div>
						<div class="row">
							<div class="col-md-10">
								 <table class="table table-list-search">
															<thead>
																	<tr>
																			<th>S/N</th>
																			<th>ID</th>
																			<th>Last Name</th>
																			<th>First Name</th>
																			<th>Affliation</th>
																			<th>Research Theme</th>
																	</tr>
															</thead>
															<tbody>
                                                            <?php
                                                                $index = 1;
                                                            if ( isset($members) && !empty($members) ): ?>
                                                                <?php foreach ($members as $member): ?>
                                                                    <tr>
																			<td><?php echo $index;
																			    $index+=1;
																			?></td>
                                                                            <td> <a href="<?= base_url('member/'.$member->username)?>"><?= $member->username?></a> </td>
																			<td><?= $member->firstname?></td>
																			<td><?= $member->lastname?></td>
																			<td><?= $member->referee_name?></td>
																			<td><?= $member->primary_intrest?></td>
																	</tr>
                                                                <?php endforeach; ?>
                                                            <?php else: ?>
                                                                <h2><?= "No registered members yet"?></h2>
                                                            <?php endif; ?>
															</tbody>
													</table>
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
		<script src="<?= base_url('vendor/js/members-list.js') ?>" type="text/javascript"></script>

</html>
