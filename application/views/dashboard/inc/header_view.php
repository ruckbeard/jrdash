<!doctype html>
<html lang="en">
    <head>
        <title>Test</title>
        <link rel="stylesheet" href="<?= base_url() ?>public/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?= base_url() ?>public/css/style.css" />

    </head>
    <body>

        <div class="navbar navbar-inverse" role="navigation">
            <div class="container">
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
                        <ul class="nav navbar-nav navbar-left">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">User</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?= site_url('dashboard/logout') ?>">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="wrap" class="container">

            <div id="error" class="alert alert-danger"> </div>
            <div id="success" class="alert alert-success"> </div>