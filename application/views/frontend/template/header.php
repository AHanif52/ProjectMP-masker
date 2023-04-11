<!DOCTYPE html>

<!-- ========================================================= * Sneat -
Bootstrap 5 HTML Admin Template - Pro | v1.0.0
============================================================== * Product Page:
https://themeselection.com/products/sneat-bootstrap-html-admin-template/ *
Created by: ThemeSelection * License: You must have a valid license purchased in
order to legally use the theme for your project. * Copyright ThemeSelection
(https://themeselection.com)
========================================================= -->
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="<?php echo base_url()?>assets/frontend/assets/"
    data-template="vertical-menu-template-free">
    <head>
        <meta charset="utf-8"/>
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

        <title>Grandezza.id</title>

        <meta name="description" content=""/>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com"/>
        <link
            rel="preconnect"
            href="https://fonts.gstatic.com"
            crossorigin="crossorigin"/>
        <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet"/>
        <link
            href="<?php echo base_url('assets/sbadmin2/vendor/fontawesome-free/css/all.min.css'); ?>"
            rel="stylesheet"
            type="text/css">

        <!-- Icons. Uncomment required icon fonts -->
        <link
            rel="stylesheet"
            href="<?php echo base_url()?>assets/frontend/assets/vendor/fonts/boxicons.css"/>

        <!-- Core CSS -->
        <link
            rel="stylesheet"
            href="<?php echo base_url()?>assets/frontend/assets/vendor/css/core.css"
            class="template-customizer-core-css"/>
        <link
            rel="stylesheet"
            href="<?php echo base_url()?>assets/frontend/assets/vendor/css/theme-default.css"
            class="template-customizer-theme-css"/>
        <link
            rel="stylesheet"
            href="<?php echo base_url()?>assets/frontend/assets/css/demo.css"/>

        <!-- Vendors CSS -->
        <link
            rel="stylesheet"
            href="<?php echo base_url()?>assets/frontend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css"/>

        <!-- Page CSS -->

        <!-- Helpers -->
        <script
            src="<?php echo base_url()?>assets/frontend/assets/vendor/js/helpers.js"></script>

        <!--! Template customizer & Theme config files MUST be included after core
        stylesheets and helpers.js in the <head> section -->
        <!--? Config: Mandatory theme config file contain global vars & default theme
        options, Set your preferred theme option in this file. -->
        <script src="<?php echo base_url()?>assets/frontend/assets/js/config.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar layout-without-menu">
            <div class="layout-container">
                <!-- Layout container -->
                <div class="layout-page">
                    <!--Header-->
                    <!-- Navbar -->
                    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                            <!--Logo-->
                            <div class="navbar-nav align-items-center">
                                <a class="navbar-brand" href="<?php echo base_url('Frontend')?>">
                                    <img src="<?php echo base_url()?>assets/gambar/logo.jpg" class="w-px-40">
                                    Grandezza.id
                                </a>
                            </div>

                            <ul class="navbar-nav align-items-center ms-auto">
                                <!-- Search -->
                                <?php echo form_open('frontend/keyword') ?>
                                <div class="navbar-nav-center align-items-center" >
                                    <div class="nav-item d-flex align-items-center">
                                    <div class="input-group">
                                        <span class="input-group-text border-0 shadow"><i class="bx bx-search fs-4 lh-0"></i></span>
                                        <input
                                            type="text"
                                            class="form-control border-0 shadow"
                                            name="keyword"
                                            placeholder="Search..."
                                            aria-label="Search..."/>
                                    </div>
                                    </div>
                                </div>
                                <?php echo form_close()?>
                                <!-- /Search -->
                            </ul>
                            <ul class="navbar-nav flex-row align-items-center ms-auto">
                                <!-- Place this tag where you want the button to render. -->
                                <!--Cart-->
                                <?php
                                //menampilkan jumlah cart pada notification
                                $keranjang = $this->cart->contents();
                                $jml_item = 0;
                                foreach ($keranjang as $key => $value) {
                                    $jml_item = $jml_item + $value['qty'];}
                                ?>
                                    <a class="nav-link" href="<?php echo site_url('belanja/index')?>">
                                        <i class="bx bx-cart"></i>
                                        <span class="badge badge-center rounded-pill bg-label-danger"><?= $jml_item ?></span>
                                    </a>
                                    

                                <!-- Notifications Dropdown Menu -->

                                <!-- User -->
                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                    <?php if ($this->session->userdata('userName') == "") { ?>
                                    <a class="nav-link" href="<?= base_url('frontend/login') ?>">
                                        <span class="brand-text font-weight-light">Login</span>
                                        <img
                                            src="<?php echo base_url() ?>/assets/frontend/assets/img/avatars/2.png"
                                            alt="Logo"
                                            class="w-px-40 rounded-circle">
                                    </a>
                                <?php } else { ?>
                                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                        <a
                                            class="nav-link dropdown-toggle hide-arrow"
                                            href="javascript:void(0);"
                                            data-bs-toggle="dropdown">
                                            <div class="avatar avatar-online">
                                                <img
                                                    src="<?php echo base_url('gambar/profil/'.$this->session->userdata('foto')) ?>"
                                                    alt="Logo"
                                                    class="w-px-40 rounded-circle"/>
                                            </div>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar avatar-online">
                                                                <img
                                                                    src="<?php echo base_url('gambar/profil/'. $this->session->userdata('foto')) ?>"
                                                                    alt="Logo"
                                                                    class="w-px-40 rounded-circle"/>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h5 class="mb-0 fw-semibold"><?= $this->session->userdata('namapelanggan') ?></h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="dropdown-divider"></div>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="<?= base_url('akunmember/akun') ?>">
                                                    <i class="bx bx-user me-2"></i>
                                                    <span class="align-middle">Akun Saya</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="<?= base_url('pesanan_saya') ?>">
                                                    <span class="d-flex align-items-center align-middle">
                                                        <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                                        <span class="flex-grow-1 align-middle">Pesanan Saya</span>
                                                        <span
                                                            class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20"><?php echo $total_asset; ?></span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="<?= base_url('pesanan_saya/history') ?>">
                                                    <span class="d-flex align-items-center align-middle">
                                                        <i class="flex-shrink-0 bx bx-history me-2"></i>
                                                        <span class="flex-grow-1 align-middle">Riwayat Transaksi</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <div class="dropdown-divider"></div>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?= base_url('akunmember/logout') ?>">
                                                        <i class="bx bx-power-off me-2"></i>
                                                        <span class="align-middle">Log Out</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <?php } ?>
                                        <!--/ User -->
                                    </ul>
                                </div>
                            </nav>
                <!-- / Navbar -->