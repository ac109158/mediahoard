<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?=SITENAME?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <!-- <link href="../assets/css/bootstrap.css" rel="stylesheet"> -->
     <link href=" <?=BOOTSTRAP?>css/bootstrap.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="<?=BOOTSTRAP?>css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?=FOOTER?>inc/validationEngine.jquery.css" rel="stylesheet">

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="index.php">MEDIA HOARD</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="index.php">Home</a></li>
              <li><a href="index.php?controller=landings&task=display&view=login">Login</a></li>
              <li><a href="index.php?controller=landings&task=display&view=contact">Contact</a></li>
              <?php if ( $_REQUEST['view'] != 'login' ) { require_once('inc/html.navlogin.php');}?>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">