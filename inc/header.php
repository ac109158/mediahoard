
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
     <title><?php echo $title= (isset($vars['title'])) ? $vars['title'] : 'CS-4000'; ?></title>   
    <link rel="stylesheet" type="text/css" href="<?php echo CSS .'bootstrap/css/bootstrap.css' ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE ?>" /> 
    <link rel="stylesheet" type="text/css" href="<?php echo CSS. 'validationEngine.jquery.css' ?>" /> 

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="<?php echo JS.'jquery.validationEngine-en.js' ?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo JS.'jquery.validationEngine.js' ?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo JS.'jquery.maskedinput.min.js' ?>" type="text/javascript" charset="utf-8"></script>

<!-- <script src="<?php echo JS.'ajax.js' ?>"></script>     -->
</head>
<body id="<?php echo $vars['tab']; ?>">
<div id="container"> <!-- main container -->
<div id='landing_header'>
			<div id = "logo">
				<a href="<?php echo URL ?>"><?php echo SITENAME . SLOGAN ;?></a>
				<div id='landing_date'>
				<span class='date' style = "font-size:.8em;"><?php echo DATE;?></span>
				</div> <!-- end of landing date -->	
			</div> <!-- end of logo -->
			<div id="landing_nav">
				<ul id = "landing_links_list">				
				<li><a class='link' id="loginnav" href="index.php">Home</a></li>
				<li><a  class='link' id="registernav" href="index.php?view=about">About</a></li>
				<li><a class='link' href="index.php?view=inventory">Inventory</a></li>
				<li><a class='link' href="index.php?view=catalog">Catalog</a></li>
				</ul>						
			</div> <!-- end of landing_nav -->		
		</div> <!-- end of landing_header -->
			<div style="clear:both"></div>