<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website for the Nigerian Geophysical Society.">
    <meta name="author" content="">

    <title>NGS</title>

    <!-- Font Awesome -->
    <link href="<?= base_url('vendor/font-awesome/css/font-awesome.css') ?>" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Style CSS -->
    <link href="<?= base_url('vendor/css/style.css') ?>" rel="stylesheet">

</head>

<body>

<!--=============================== Navbar ===========================-->
<nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top" style="background-color:#000;">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="<?= base_url()?>">NGS</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="<?= isset($page['home'])?$page['home']:""?>">
                    <a href="<?= base_url()?>">HOME</a>
                </li>
                <li class="<?= isset($page['about'])?$page['about']:""?>">
                    <a href="<?= base_url('about')?>">ABOUT</a>
                </li>
                <li class="<?= isset($page['leaders'])?$page['leaders']:""?>">
                    <a href="<?= base_url('leaders')?>">LEADERSHIP</a>
                </li>
                <li>
                    <a href="<?= base_url('members')?>">MEMBERSHIP</a>
                </li>
                <li>
                    <a href="#">MEETINGS</a>
                </li>
                <li>
                    <a href="https://editor.niggs.org" target="_blank">EDITORIALS</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--============================ End of Navbar =======================-->
