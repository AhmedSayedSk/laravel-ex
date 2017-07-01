<?php

/* Translation */
$TR = "admin_panel.AN";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.sub-header')
    <title>documentations (beta)</title>

    <link rel="stylesheet" type="text/css" href="./packages/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/custom/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css">
</head>
<body>
    <nav id="navbar-1" class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">
            <img alt="Brand" src="./assets/icons/logo-icon.png" width="24px" title='{{ trans("$TR.T23") }}'>
            <b>{{ $global_setting->site_name }}</b>
          </a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="/products">{{ trans("$TR.T4") }}</a></li>
            <li><a href="/admin">dashboard</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
        <dir class="row">
            <div class="col-md-3">
                
            </div>
            <div class="col-md-9">
                dropzone
                don't forget to edit php.ini file
                Image operations tend to be quite memory exhausting because image handling libraries usually 'unpack' all the pixels to memory. A JPEG file of 3MB can thus easily grow to 60MB in memory and that's when you've probably hit the memory limit allocated for PHP.

                As far I remember, XAMP only allocates 128 MB RAM for PHP.

                Check your php.ini and increase the memory limit, e.g.:

                memory_limit = 512MB

                can't run more than 1 seed in 1 shoot, only first seed will runs cuz not do interpoletion
            </div>
        </dir>
    </div>
</body>
</html>

