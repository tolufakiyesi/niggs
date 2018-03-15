<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NGS</title>
    <meta name="description" content="">
    <meta name="author" content="">




    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?= base_url('vendor/metisMenu/metisMenu.min.css')?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('dist/css/sb-admin-2.css')?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= base_url('vendor/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="https://niggs.org">NGS</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">


            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="<?= base_url('profile') ?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="<?= base_url('user/logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="<?= base_url()?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>

                    <li>
                        <a href="<?=base_url('journal/create') ?>"><i class="fa fa-envelope-o fa-fw"></i> Submit a Publication</a>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i> Track Your Articles<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=base_url('user/journals')?>">View Report</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                    <?php if ($_SESSION['priviledge'] === 1) : ?>
                    <li class="active">
                        <a href="#"><i class="fa fa-files-o fa-fw"></i> Editor<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?= base_url('editor/journals') ?>">Unreviewed Articles: <?=$this->journal_model->unreviewed_model_count() ?></a>
                            </li>
                            <li>
                                <a href="<?= base_url('editor/editing') ?>">Editing Currently: <?=$this->journal_model->editing_currently_count($_SESSION['user_id']) ?></a>
                            </li>
                            <li>
                                <a href="<?= base_url('editor/update') ?>">Action Required For: <?=count( $this->journal_model->get_updates_for_editor($_SESSION['user_id']) ) ?></a>
                            </li>
                            <li>
                                <a href="<?= base_url('editor/users') ?>">View Users List</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <?php elseif ($_SESSION['priviledge'] === 3 ): ?>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Roles<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= base_url('user/request/') ?>">Become Reviewer or Editor</a>
                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                    <?php elseif ($_SESSION['priviledge'] === 2 ): ?>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Reviewer<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= base_url('reviewer/update') ?>">Journals Awaiting Your Update:  <?=count( $this->journal_model->get_updates_for_reviewer($_SESSION['user_id']) ) ?></a>
                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
    <!-- Page Content -->
    <div id="page-wrapper">