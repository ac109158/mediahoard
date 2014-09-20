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
     <script type="text/javascript" src="<?=BOOTSTRAP?>select/bootstrap-select.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=BOOTSTRAP?>select/bootstrap-select.css">

    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.js"></script>
    
     <!-- <link href=" <?=BOOTSTRAP?>css/bootstrap.css" rel="stylesheet">
     <link href=" <?=BOOTSTRAP?>select/bootstrap-select.css" rel="stylesheet"> -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script> 
    <script src="./js/jquery.ae.image.resize"></script>
     
    <style type="text/css">
      body {
      }
      #main-nav {
        position: relative;
      }
      body {
      margin-top:50px;
      }
    </style>
    <link href="<?=BOOTSTRAP?>css/bootstrap-responsive.css" rel="stylesheet">

  </head>

<body>
<div class="row-fluid" >
        <div class="span12" >
                <div class="row-fluid" >
                        <div class="navbar navbar-inverse navbar-fixed-top span12">
                                        <div class="row-fluid" >
                                                <div class="navbar-inner span12">
                                                        <div class="row-fluid">
                                                                <div class="container">
                                                                        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                                                                <span class="icon-bar"></span>
                                                                                <span class="icon-bar"></span>
                                                                                <span class="icon-bar"></span>
                                                                        </button>
                                                                        <a class="brand span2" href="index.php?controller=dashboards&task=display&view=dashboard">MEDIA HOARD</a>
                                                                         <div class="nav-collapse collapse">
                                                                                <ul class="nav span6" id="main-nav">
                                                                                        <li class="dropdown span3">
                                                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">View Hoard<b class="caret"></b></a>
                                                                                                <ul class="dropdown-menu">
                                                                                                        <li><a href="index.php?controller=dashboards&task=display&view=browse&option=filter&filter=1">Books</a></li>
                                                                                                        <li><a href="index.php?controller=dashboards&task=display&view=browse&option=filter&filter=2">Movies</a></li>
                                                                                                        <li><a href="index.php?controller=dashboards&task=display&view=browse&option=filter&filter=3">Music</a></li>
                                                                                                        <li><a href="index.php?controller=dashboards&task=display&view=browse&option=filter&filter=4">games</a></li>
                                                                                                        <li><a href="index.php?controller=dashboards&task=display&view=browse&option=filter&filter=5">Other</a></li>
                                                                                                </ul>
                                                                                        </li>
                                                                                        <li class="dropdown span3">
                                                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> My Inventory<b class="caret"></b></a>
                                                                                                <ul class="dropdown-menu">
                                                                                                        <li><a href="index.php?controller=dashboards&task=display&view=inventory&option=add">Add new ...</a></li>
                                                                                                        <li class="nav-header">Category</li>
                                                                                                        <li><a href="index.php?controller=dashboards&task=display&view=inventory&option=filter&filter=1&filter2=0">My Books</a></li>
                                                                                                        <li><a href="index.php?controller=dashboards&task=display&view=inventory&option=filter&filter=2&filter2=0">My Movies</a></li>
                                                                                                        <li><a href="index.php?controller=dashboards&task=display&view=inventory&option=filter&filter=3&filter2=0">My Music</a></li>
                                                                                                        <li><a href="index.php?controller=dashboards&task=display&view=inventory&option=filter&filter=4&filter2=0">My Games</a></li>
                                                                                                        <li><a href="index.php?controller=dashboards&task=display&view=inventory&option=filter&filter=0&filter2=0">All</a></li>
                                                                                                </ul>
                                                                                        </li>
                                                                                        <li class="dropdown span3">
                                                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings<b class="caret"></b></a>
                                                                                                <ul class="dropdown-menu">
                                                                                                <li><a data-toggle="modal" href="#profile">Profile</a></li>
                                                                                                <li><a data-toggle="modal" href="#notifications">Notifications</a></li>
                                                                                                <li><a data-toggle="modal" href="#privacy">Privacy</a></li>
                                                                                                </ul>
                                                                                        </li>
                                                                                        <?php if ( $_SESSION['role'] == 2 ) { require_once 'inc/view.html.php'; } ?>
                                                                                </ul>
                                                                                <form class="navbar-search span2 action" action="index.php?controller=dashboards&task=display&view=browse&option=filter" method="POST">
                                                                                        <input type="text" id="searchFilter2" name="searchFilter" class="search-query" placeholder="Search Hoard">
                                                                                        <input type="hidden" name="filter" value="0">
                                                                                        <input type="hidden" name="filter2" value="0">
                                                                                        <input type="hidden" name="filter3" value="title">
                                                                                        <input type='hidden' name='s_f_i_submitted' id='s_f_i_submitted' value='1'/>
                                                                                </form>
                                                                                <a href="index.php?controller=dashboards&task=logout" class="btn btn-danger span1 pull-right">Logout</a>
                                                                        </div><!--/.nav-collapse -->
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                
                                        </div>
                                </div>
                        </div>
                </div>

<div class="container">
      