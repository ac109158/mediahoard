<?php 
session_start(); 
$_SESSION['write'] = ( isset($_SESSION['write']) ) ? $_SESSION['write'] : 'w';
$_SESSION['status'] = ( isset($_SESSION['status']) ) ? $_SESSION['status'] : 0;
$_SESSION['attempts'] = ( isset($_SESSION['attempts']) ) ? $_SESSION['attempts'] : 6;
if ($_COOKIE)
{
	setcookie('last_active', $_COOKIE['sign_in']);
	
	

}else
{
	pass;
}

ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_NOTICE);

	/**
	 *Written by Andy Cook8/21/13
	 *This program is to build out the projects for CS-4000 PHP Class	 *
	 */
/* Get the controller from the url
*******************************************************/

function main()
{
	require_once './lib/helper.php';
	require_once './lib/config.php';
	$helper = new Helper();
	$helper->log('**internal index.php control***', 'debug.html'); 
	$helper->log('START', 'debug.html','w');
	// $helper->log('START', 'debug.html');
	$helper->log('$_SESSION["attempts"] = ' . $_SESSION['attempts'], 'debug.html');
	if ($_SESSION['redirect'] == true)
	{
		require_once 'inc/redirect.php';
		$helper->log('**redirect control***', 'debug.html'); 
		$helper->execute($vars['controller'] , $vars['task'], $vars ) ; // (controller, task)
		exit;

	}
	else
	{
		$url = $helper->urlToArray();
		$helper->log($url, 'debug.html'); 
		if ( !isset($url['controller']) || !isset($url['task']) )
		{
			$helper->log('Controller or task not set', 'debug.html');
			$_REQUEST['view'] = 'landing';
			$helper->execute('landings', 'display'); // (controller, task)
			exit;
		}
		$helper->log('**index control***', 'debug.html'); 
		$helper->execute($url['controller'] , $url['task']) ; // (controller, task)
		exit;

	}

	
}
                                           
/**********************************************************
**                   
*/
main();	
?>