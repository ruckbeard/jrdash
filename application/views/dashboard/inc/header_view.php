<!doctype html>
<html lang="en">
    <head>
        <title>Test</title>
        <link rel="stylesheet" href="<?= base_url() ?>public/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?= base_url() ?>public/css/style.css" />

        <script src="<?= base_url() ?>public/js/jquery.js"></script>
        <script src="<?= base_url() ?>public/js/bootstrap.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">jrDash</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">User</a></li>
                        <li><a href="<?= site_url('dashboard/logout') ?>">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="wrapper">