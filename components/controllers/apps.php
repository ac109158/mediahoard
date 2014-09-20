<?php
class ControllerApps
{	
		public function __construct()
		{
			session_start();
			$vars = array(); // init $vars
		}
		
		public function display($vars=null)
		{
			require_once './lib/helper.php';
			$helper = new Helper();
			$vars['view'] = isset($_REQUEST['view'] )  ? $_REQUEST['view'] : 'landing';
			$helper->fetchModel('app', 'display', $vars);		
		}

		public function displayForm($vars=null)
		{
			require_once './lib/helper.php';	
			$vars['view'] = 'form';
			$vars['msg'] = isset($vars['msg'] )  ? $vars['msg'] : 'Please fill out form.';
			$vars['msgColor'] = isset($vars['msgColor'] )  ? $vars['msgColor'] : 'white';
			$helper->fetchModel('app', 'display', $vars);		
		}

		public function validate()
		{
			require_once './lib/helper.php';
			$helper = new Helper();
			$complete = $helper->fetchModel('app', 'validateForm');
			if ($complete !== true) 
			{
				$vars['msg'] = $complete;
				$vars['msgColor'] = 'red';
				ControllerApps::display($vars); 
				exit;
			}
			foreach ($_POST as $key => $value) {
				$vars[$key] = $value;
			}
			$delivery = $helper->fetchModel('app', 'sendEmail', $vars);
			if ( $delivery === true ) 
			{ 
				$vars['msg'] = 'Thank You. An email has been sent.';
				$vars['msgColor'] = 'green';
				$vars['view'] = 'landing';
				$this->display($vars); 
				$thiswrite_to_file($_POST, 'storage.txt', './storage/');
				exit;
			} else 
			{
				$vars['msg'] = 'Thank You. Email Failed';
				$vars['msgColor'] = 'grey';
				$vars['view'] = 'landing';
				$this->display($vars); 
				$this->write_to_file($_POST, 'storage.txt', './storage/');
				exit;

			}
			
					
		}

		public function sign_in($vars=null)
		{
			 require_once './lib/helper.php';
			$helper = new Helper();

			//$complete = $helper->fetchModel('validateForm', "$_POST");
			if ($_REQUEST['username'] != ' ' && $_REQUEST['password'] != ' ')
			{
				$_SESSION['status'] = 1;
				header('location: index.php?view=dashboard');
			}
			exit;			
		}

		public function logout($vars=null)
		{
			$_SESSION = array();
			$_POST = array();
			$_GET = array();
			session_destroy();

			header('location: .');
			exit;
			
		}


		
}		

?>