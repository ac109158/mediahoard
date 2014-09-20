<?php
class ControllerLandings extends Helper
{	
		public function __construct()
		{
			$this->log('ControllerLandings', 'debug.html'); 
			parent::__construct();
			session_start();
			$this->model = $this->fetchModel('landing'); // set primary model
		}
		
		public function display($vars=null)
		{
			$this->log('ControllerLandings->display('.$vars.')', 'debug.html');
			$this->log('The POST variables are:', 'debug.html');
			$this->log($_POST, 'debug.html');
			if ($vars == null)
			{
				$vars= array();
				$vars = $this->urlToArray();
				$this->log('$vars initiated to:', 'debug.html');
				$this->log($vars, 'debug.html');
			}
			if ( isset( $_POST['l_submitted'] ) && $vars['option'] == 'login' )
			{				
				$this->log('Process Login Request', 'debug.html');
				$vars['formvars'] = $this->CollectFormSubmission();
				$vars = $this->sign_in($vars);
			}
			else if ( isset($_POST['submitted']) && $vars['option'] == 'create' )
			{
				$this->log('Process Register Request', 'debug.html');
				$vars['formvars'] = $this->CollectFormSubmission();
				$vars = $this->register($vars);
			}
			else if ( $vars['controller'] && $vars['task'] && $vars['view'] )
			{
				$this->log('Process URL request:', 'debug.html');
			}			
			else 
			{
				$this->log(' Process default', 'debug.html');
				$vars['view'] = 'landing';				
			}
			$this->model->display($vars);
		}


		

		private function register($vars)
		{
			$this->log('ControllerLandings->register('.$vars.')', 'debug.html');
			$this->log('register()', 'debug.html'); 			
			$complete = $this->model->isArrayFull($_POST);
			if ($complete !== true)
			{
				$this->log($complete, 'debug.html');
				$vars = $this->Warning($complete, $vars);
				return $vars;
			}
			$vars = $this->model->validateRegisterForm($vars);
			$this->log(' RESPONSE was ' . $vars['response'] , 'debug.html');
			if ( $vars['response'] !== 'true')
			{
				$this->log($result, 'debug.html');
				$vars = $this->Warning($vars['response'], $vars);
				return $vars;
			} else 
			{
				$_POST = array();
				$vars = $this->Success('Registration Successful', $vars);
				return $vars;
			}
			
		}

		private function sign_in($vars)
		{
			$this->log('ControllerLandings->sign-in', 'debug.html'); 
			//testing log
			if ( $_COOKIE['restriction']  != false) {
				$msg = '<br><center>Your account has been locked for security purposes.</center><br>';
				$msg .= '<center>Please try again at a later time!</center><br>';
				$vars = $this->Warning($msg, $vars);
				return $vars;
			}
			if (isset($_POST['l_submitted']))
			{
				$this->log('sign_in', 'debug.html');		
				$this->log($_POST, 'debug.html');
				//validate login form
				$form_completed = $this->model->isArrayFull($_POST);
				if ( $form_completed !== true) 
				{	
					$this->log('Form Complete >>' . $form_completed, 'debug.html');
					$vars = $this->invalidSignIn($vars);
					return $vars;
				} 
				$this->log('Form Complete >>' . $form_completed, 'debug.html');
				//validate credentials
				$username = $this->request($_POST['l_username']);
				$password = $this->request($_POST['l_password']);
				if ( !$this->model->CheckLoginInDB($username, $password) ) 
				{
					$vars = $this->invalidSignIn($vars);
					return $vars;
				}
				$this->log('Login Succesful', 'debug.html');
				// User is now active
				// set cookie variables
				setcookie('sign_in',time());
				// set session variables
				// direct to dashboard
				header('location:index.php?controller=dashboards&task=display&view=dashboard');
				exit;
			}
			header('location:index.php?controller=landings&task=display&view=login');
			//exit
			exit;			
		}

		private function invalidSignIn($vars)
		{
			$this->log('ControllerLandings->invalidSignIn', 'debug.ht ml');

			$this->log('invalidSignIn()', 'debug.html');
			if ($_SESSION['attempts'] === 0 ) 
			{
				setcookie('restriction', time() + (1800) ,time() + (1800)); // 30 min
				$this->log('Session User has been locked out >>>' . $_COOKIE['restriction'], 'debug.html');
				$msg = '<br>
				<center>For security purposes you have been locked out.</center><br>';
				$msg .= '<center>Check your registered email for a reset link or try again in 30 minutes.</center><br>';
				$vars = $this->Warning($msg, $vars);
				return $vars;
			}
			$msg = '<br><center>Username/Password cannot be found.</center><br>';
			if ($_SESSION['attempts'] < 6 )
			{
				$this->log('Invalid Sign In >> Attempts ' . $_SESSION['attempts'], 'debug.html');
				$msg .= '<center>You have ' . $_SESSION['attempts'] . ' attempt remaining</center>';				
			}
			$msg .= '<br><br>';
			$_SESSION['attempts']--;
			$this->log('$_SESSION["attempts"] = ' . $_SESSION['attempts'], 'debug.html');

			$vars = $this->Warning($msg, $vars); 
			return $vars;

		}

		private function Warning($msg,$vars)
		{
			$this->log('ControllerLandings->Warning', 'debug.html');
			$vars['alertType'] = 'alert-error';
			$vars['alertHeader' ] = '<br><center>Warning!</center><hr>';
			$vars['alertMessage'] = '<center>'. $msg . '</center><br>';
			return $vars;
		}

		private function Success($msg, $vars)
		{
			$this->log('ControllerLandings->Sucess', 'debug.html');
			$vars['alertType'] = 'alert-success';
			$vars['alertHeader' ] = '<br><center>Success!</center><hr>';
			$vars['alertMessage'] = '<center>'.$msg . '</center><br>';
			return $vars;
		}

		public function validate()
		{
			
			$complete = $this->fetchModel('landing', 'validateForm');
			if ($complete !== true) 
			{
				$vars['msg'] = $complete;
				$vars['msgColor'] = 'red';
				$this->display($vars); 
				exit;
			}
			foreach ($_POST as $key => $value) {
				$vars[$key] = $value;
			}
			$delivery = $this->fetchModel('landing', 'sendEmail', $vars);
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
		


		
}		

?>