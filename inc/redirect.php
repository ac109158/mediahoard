<?php
if ( true) 
{
	$vars = array();
	if (isset($_SESSION['controller']))
	{
		$vars['controller'] = $_SESSION['controller'];
		// unset($_SESSION['controller']);
	}

	if (isset($_SESSION['task']))
	{
		$vars['task'] = $_SESSION['task'];
		unset($_SESSION['task']);
	}

	if (isset($_SESSION['view']))
	{
		$vars['view'] = $_SESSION['view'];
		unset($_SESSION['view']);
	}

	if (isset($_SESSION['option']))
	{
		$vars['option'] = $_SESSION['option'];
		unset($_SESSION['option']);
	}

	if (isset($_SESSION['searchFilter']))
	{
		$vars['searchFilter'] = $_SESSION['searchFilter'];
		unset($_SESSION['searchFilter']);
	}

	if (isset($_SESSION['filter']))
	{
		$vars['filter'] = $_SESSION['filter'];
		unset($_SESSION['filter']);
	}

	if (isset($_SESSION['filter2']))
	{
		$vars['filter2'] = $_SESSION['filter2'];
		unset($_SESSION['filter2']);
	}

	if (isset($_SESSION['filter3']))
	{
		$vars['filter3'] = $_SESSION['filter3'];
		unset($_SESSION['filter3']);
	}

	if (isset($_SESSION['alertType']))
	{
		$vars['alertType'] = $_SESSION['alertType'];
		unset($_SESSION['alertType']);
	}

	if (isset($_SESSION['alertHeader']))
	{
		$vars['alertHeader'] = $_SESSION['alertHeader'];
		unset($_SESSION['alertHeader']);
	}

	if (isset($_SESSION['alertMessage']))
	{
		$vars['alertMessage'] = $_SESSION['alertMessage'];
		unset($_SESSION['alertMessage']);
	}

	if (isset($_SESSION['alertType']))
	{
		$vars['alertType'] = $_SESSION['alertType'];
		unset($_SESSION['alertType']);
	}

	if (isset($_SESSION['url']))
	{
		$vars['url'] = $_SESSION['url'];
		unset($_SESSION['url']);
	}

	
	$_SESSION['path'] = 'true';
	unset($_SESSION['redirect']);

	$helper->log($vars, 'debug.html');
	$helper->log("Redirect Complete", 'debug.html');
}

