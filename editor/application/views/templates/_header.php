<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NGS</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <script src="http://www.google.com/jsapi" type="text/javascript"></script>

    <script type="text/javascript">google.load("jquery", "1.3.2");</script>

    <!-- css -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/header-style.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<header id="site-header">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="https://niggs.org">NGS</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) : ?>

                        <li><a href="<?= base_url('profile') ?>">Profile</a></li>
                        <li><a href="<?= base_url('user/logout') ?>">Logout</a></li>

                    <?php endif; ?>
                </ul>
            </div><!-- .navbar-collapse -->
        </div><!-- .container-fluid -->
    </nav><!-- .navbar -->
</header><!-- #site-header -->

<main id="site-content" role="main">





<div class="w3-sidebar w3-bar-block w3-collapse w3-card-2 w3-animate-left" style="width:200px;" id="mySidebar">


    <div role="search">
        <form id="rtd-search-form" class="wy-form" action="" method="get">
            <input type="text" name="q" placeholder="Search docs">
            <input type="hidden" name="check_keywords" value="yes">
            <input type="hidden" name="area" value="default">
        </form>
    </div>
    <ul>
        <li class="toctree-l1"><a class="reference internal" href="<?=base_url('user') ?>">Welcome User</a><ul class="simple">
            </ul>
        </li>
    </ul>
    <ul>
        <li class="toctree-l1"><a class="reference internal" href="<?=base_url('journal/create') ?>">Submit a Publication</a>





        </li>
    </ul>
    <ul>
        <li class="toctree-l1"><a class="reference internal" href="<?= base_url('user/journals')?>">Track Your Journal</a>
            <ul>
                <li class="toctree-l2"><a class="reference internal" href="">View Report</a></li>

            </ul>

        </li>
    </ul>
    <?php if ($_SESSION['priviledge'] === 1) : ?>


        <ul>
            <li class="toctree-l1"><a class="reference internal" href="<?= base_url('editor') ?>">Editor</a>
                <ul>
                    <li class="toctree-l2"><a class="reference internal" href="<?= base_url('editor/journals') ?>">Unreviewed Journals: <?=$this->journal_model->unreviewed_model_count() ?></a></li>
                    <li class="toctree-l2"><a class="reference internal" href="<?= base_url('editor/editing') ?>">Editing Currently: <?=$this->journal_model->editing_currently_count($_SESSION['user_id']) ?></a></li>
                    <li class="toctree-l2"><a class="reference internal" href="<?= base_url('editor/update') ?>">Action Required For: <?=count( $this->journal_model->get_updates_for_editor($_SESSION['user_id']) ) ?></a></li>
                    <li class="toctree-l2"><a class="reference internal" href="<?= base_url('editor/users') ?>">View Users List</a></li>
                </ul>


            </li>
        </ul>

    <?php elseif ($_SESSION['priviledge'] === 3 ): ?>
        <ul>
            <li class="toctree-l1"><a class="reference internal" href="">Roles</a>
                <ul>
                    <li class="toctree-l2"><a class="reference internal" href="<?= base_url('user/request/') ?>">Become A Reviewer</a></li>
                    <li class="toctree-l2"><a class="reference internal" href="<?= base_url('user/request') ?>">Become An Editor</a></li>

                </ul>

            </li>
        </ul>

    <?php elseif ($_SESSION['priviledge'] === 2 ): ?>
        <ul>
            <li class="toctree-l1"><a class="reference internal" href="<?=base_url('reviewer') ?>">Revieweing: <?=$this->journal_model->reviewer_unreviewed_count($_SESSION['user_id']) ?></a>
                <ul>
                    <li class="toctree-l2"><a class="reference internal" href="<?= base_url('reviewer/update') ?>">Journals Awaiting Your Update:  <?=count( $this->journal_model->get_updates_for_reviewer($_SESSION['user_id']) ) ?></a></li>

                </ul>

            </li>
        </ul>





    <?php endif; ?>

</div>
