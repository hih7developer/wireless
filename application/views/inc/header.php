<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Wireless Matchup</title>
    <meta name="description" content="" />
    <meta name="author" content="admin" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png') ?>" alt="" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700,700i,800,900&display=swap"
        rel="stylesheet">
    <link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css') ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/animate.css') ?>" media="all" />
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/css/slick.css') ?>" media="all" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/easy-responsive-tabs.css') ?>" />
    <link href="<?php echo base_url('assets/css/jquery.fancybox.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/ion.rangeSlider.css') ?>" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" /> -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css') ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/responsive.css') ?>" />
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body>
    <header>
        <div class="container-fluid">
            <div class="cus_nav_innr d-flex align-items-center justify-content-between">
                <div class="logo_area">
                    <a href="<?php echo $this->config->item('front_url') ?>"><img class="img-fluid dekstop-logo"
                            src="<?php echo base_url('assets/images/logo.png') ?>" alt="" /></a>
                </div>
                <div class="nav_area">
                    <div class="right_nav  d-flex align-items-center">
                        <div class="navbar-header">
                            <nav class="navbar navbar-expand-md">
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo base_url('') ?>">Home</a>
                                        </li>

                                        <?php if(!$this->session->userdata('user_id')): ?>
                                        <li><a href="<?php echo base_url('login') ?>"
                                                class="btn btn-primary common-btn loginbtn <?php echo in_array($this->uri->segment(1), ['login']) ? 'menu-active' : '' ?>">Login</a>
                                        </li>
                                        <li><a href="<?php echo base_url('signup') ?>"
                                                class="btn btn-primary common-btn loginbtn <?php echo in_array($this->uri->segment(1), ['signup']) ? 'menu-active' : '' ?>">Sign Up</a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <?php if($this->session->userdata('user_id')): ?>
                        <div class="hdr-btn dropdown">
                            <a href="javascript:void(0);" class="btn btn-primary common-btn dropdown-toggle">
                                <em><img src="<?php echo base_url('assets/images/user.png') ?>"></em>
                                <span><?php echo $user->name ?></span>
                                <img src="<?php echo base_url('assets/images/etdrt.png') ?>" class="adr">
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo base_url('logout') ?>">Sign Out</a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>