<?php
require_once './lib/toolkit.php';
class ControllerDashboards extends Toolkit
{	
		public function __construct()
		{
			session_start();
			if ($_SESSION['status'] === 0 )  // If you so happen to be logged out, you need to get on out of here
			{
				$_SESSION = array();
				session_destroy();
				header('location: index.php?view=login');
				exit;//------------------->Login Page
			}

			$this->model = $this->fetchModel('dashboard'); // set primary model as $this->model

			///////////////////////////////////////////////////////////////////REMOVE
			$this->log('ModelDashboard set as primary model', 'debug.html');//
			/////////////////////////////////////////////////////////////////
		}

		public function display($vars=null) // The application would like us to display output to the user
		{
			$this->log('This is what the vars look like', 'debug.html');
			$this->log($vars, 'debug.html');
			if ( !isset($vars['view'])) // Lets check to see if this is a re-route or a new job. Controllers will are suppose to provide view in case of a reroute
			{
				$vars['view'] = isset($_REQUEST['view'] )  ? $_REQUEST['view'] : 'dashboard'; // This is a new job gather the details...
				$vars['option'] = $this->request($_REQUEST['option']);
				if ( $vars['option'] == 'filter') 
				{
					$this->log('Filter Options detected and set for Filter', 'debug.html'); // we well need to get all the filters options
					$this->log($_POST, 'debug.html');

					$action = $this->request($_REQUEST['action']);
					$vars['searchFilter'] = $this->request($_REQUEST['searchFilter']);
					$vars['filter'] = $this->request($_REQUEST['filter']);
					$vars['filter2'] = $this->request($_REQUEST['filter2']);
					$vars['filter3'] = $this->request($_REQUEST['filter3']);
					if ( $vars['filter2'] == null) { $vars['filter2'] = '0';}
					if ( $vars['filter3'] == null) { $vars['filter3'] = 'title';}
					if ( $action == "setFilter" ) 
					{
						$vars['controller'] = $this->request($_REQUEST['controller']);
						$vars['task'] = $this->request($_REQUEST['task']);
						$vars['view'] = $this->request($_REQUEST['view']);
						$vars['url'] = $this->getUrl();
						$vars['url'] = str_replace('&action=setFilter', '', $vars['url']);
						$vars['url'] .= '&filter=' . $vars['filter'] . '&filter2=' . $vars['filter2'] . '&filter3=' . $vars['filter3'] . '&searchFilter=' . $vars['searchFilter'];
						$this->redirect($vars);
					}

				}
				else if ( $vars['option'] === 'edit' || $vars['option'] === 'item' ) 
				{
					////////////////////////////////////////////////////////////////////////REMOVE
					$this->log('Filter Options detected and set for Edit', 'debug.html');//
					//////////////////////////////////////////////////////////////////////

					$vars['id'] = $this->request($_REQUEST['id']); // we need an id for these type of options
				}
			}						
			$this->model->display($vars); // Pass job off to the model
			exit;	
		}

		private function register($vars) // this register is put in place for an admin to register a user 
			{
				$this->log('Model Dashboards->register('.$vars.')', 'debug.html');
				$this->log('register()', 'debug.html'); 			
				$vars = $this->model->validateRegisterForm($vars); // lets hand this to the model to finish, and pass it exactly what it needs to know
				if ( $vars['response'] !== 'true') //model hands this back and tells us if it was succesful
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
				////////////////////////////////////////////////////////////


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

		private function fetchVars($vars)
		{
			$vars['view'] = $this->request($_REQUEST['view']);
			$vars['view'] = $this->request($_REQUEST['view']);
			$vars['controller'] = $this->request($_REQUEST['controller']);
			$vars['task'] = $this->request($_REQUEST['task']);
			$vars['option'] = $this->request($_REQUEST['option']);
			$vars['action'] = $this->request($_REQUEST['action']);
			$vars['searchFilter'] = $this->request($_REQUEST['searchFilter']);
			$vars['filter'] = $this->request($_REQUEST['filter']);
			$vars['filter2'] = $this->request($_REQUEST['filter2']);
			$vars['filter3'] = $this->request($_REQUEST['filter3']);
			$vars['id'] = $this->request($_REQUEST['id']);
			$vars['formvars'] = $this->collectFormSubmission($_POST); 
			return $vars;
		}

		public function redirect($vars)
		{
			$_SESSION['searchFilter'] = $vars['searchFilter'];
			$_SESSION['filter'] = $vars['filter'];
			$_SESSION['filter2'] = $vars['filter2'];
			$_SESSION['filter3'] = $vars['filter3'];
			$_SESSION['option'] = $vars['option'];
			$_SESSION['controller'] = $vars['controller'];
			$_SESSION['task'] = $vars['task'];
			$_SESSION['view'] = $vars['view'];
			$_SESSION['redirect'] = true;
			$this->log($vars, 'debug.html');
			header('location:' . $vars['url']);		
		}
		

		public function logout($vars=null)
		{
			$_SESSION = array();
			$_POST = array();
			$_GET = array();
			session_destroy();
			$_COOKIE['restriction'] = false;
			$this->log('User Logout', 'debug.html');
			header('location: index.php');
			exit;
			
		}

		public function update()
		{
			$vars = array();
			$vars['field'] = $this->request($_GET['fieldID']);
			$vars['value'] = $this->request($_GET['fieldVal']);
			echo $vars['id'] = $this->request($_GET['id']);
			$response = $this->model->update($vars);
			echo json_encode($response);

			
		}

		public function deleteUser()
		{
			if ($_SESSION['role'] !== '2' )  
				{
				$_SESSION = array();
				session_destroy();
				header('location: index.php?controller=landings&task=display&view=login');
				exit;
			}
			if ( isset( $_POST['d_u_submitted'] ) )
			{
				////////////////////////////////////////////////////////////
				$this->log('Delete Request has been submitted', 'debug.html');
				//if (!$this->model->validate($_POST) ) {$this->log( $validate, 'debug.html'); exit;}
				$vars['formvars'] = $this->collectFormSubmission($_POST);

				////////////////////////////////////////////////////////////
				$this->log('The form variables have been collected', 'debug.html');
				$this->log($vars['formvars'], 'debug.html'); 
				$vars = $this->model->deleteUser($vars);
				$vars['view'] = $this->request($_REQUEST['view']);
				$vars['view'] = $this->request($_REQUEST['view']);
				$vars['controller'] = $this->request($_REQUEST['controller']);
				$vars['task'] = 'display';
				$vars['option'] = $this->request($_REQUEST['option']);
				$this->display($vars);
				
			}
			

			
		}

		public function deleteItem() // The job is to delete item(s) and reroute back to the where the job came from
		{
			//////////////////////////////////////////////////////////////REMOVE
			$this->log('ControllerLandings->deleteItem', 'debug.html');//
			////////////////////////////////////////////////////////////

			if ($_SESSION['status'] !== 1 )  // if you managed to get here without being logged in, you go no further
				{
				$_SESSION = array();
				session_destroy();
				header('location: index.php?controller=landings&task=display&view=login');
				exit; //--------------> Back to login Page
			}
			if ( isset( $_POST['d_i_submitted'] ) ) // Lets make sure this job came from a place where we would expect
			{
				////////////////////////////////////////////////////////////////////////DELETE
				$this->log('Delete Item/s Request has been requested', 'debug.html');//
				//////////////////////////////////////////////////////////////////////

				$vars['formvars'] = $this->collectFormSubmission($_POST); // We should know have a list of ids that should de deleted from the database
				if ( count($vars['formvars']) < 2)
				{
					$this->display($vars);
				}
				/////////////////////////////////////////////////////////////////////////REMOVE
				$this->log('The form variables have been collected', 'debug.html');  ///
				$this->log($vars['formvars'], 'debug.html');						///
				//////////////////////////////////////////////////////////////////////

				$vars = $this->model->deleteItem($vars); // Pass this job off to the model to carry
				// right now we just expect this to happen without any issues
				$vars['controller'] = $this->request($_REQUEST['controller']);
				$vars['view'] = $this->request($_REQUEST['view']);				
				$vars['task'] = 'display';
				$vars['option'] = $this->request($_REQUEST['option']);
				$vars['filter'] = $this->request($_REQUEST['filter']);
				$vars['filter2'] = $this->request($_REQUEST['filter2']);
				$_SESSION['alertType'] = 'alert-info';
				$_SESSION['alertHeader'] = 'Sucess!  ';
				$_SESSION['alertMessage'] = 'Inventory has been removed.';
				$vars['url'] = 'index.php?controller=' . $vars['controller'] . '&task=' . $vars['task'] .'&view=' . $vars['view'] . '&option=' . $vars['option'] . '&filter=' . $vars['filter'] . '&filter2=' . $vars['filter2'];
				$this->redirect($vars);
				exit;//----------> redirect();
				
			}
			

			
		}




		public function addItem()
		{
			/////////////////////////////////////////////////////////DELETE
			$this->log('The POST variables are: ', 'debug.html'); //
			$this->log($_POST, 'debug.html');                    //
			//////////////////////////////////////////////////////

			if ( isset( $_POST['a_i_submitted'] ) ) // Lets check to see that the right form made this request
			{
				//Right now the only reason would be for the admin to add a user

				////////////////////////////////////////////////////////////REMOVE
				$this->log('Form has been submitted', 'debug.html');   ////
				//////////////////////////////////////////////////////////

				$complete = $this->isArrayFull($_POST);// Apparently there was a form routed here lets take a look at what they sent
				if ( $complete !== true) // Lets apply the quickest and dirtiets way to validate a form by checking to see if it at least was filled out completely
				{
					$this->log(' Form was incomplete', 'debug.html');
					$vars['complete'] = $complete;
				}
				else
				{
					$this->log(' Form was filled out completely', 'debug.html');
					$vars['complete'] = true; // we can know ask the question if we want to later...
				}
				// end of quick check for validation. We now know if it was completely filled out but wont act just yet........
				// $vars['controller'] = $this->request($_REQUEST['controller']);
				// $vars['task'] = $this->request($_REQUEST['task']);
				$vars['view'] = $this->request($_REQUEST['view']);// so lets gather all information that might have been attached to this form post shall we
				$vars['option'] = $this->request($_REQUEST['option']);
				$vars['submitted'] = 1; // in case the model needs to ask ...
				$vars['formvars'] = $this->collectFormSubmission($_POST); // wrap the $_POST variables into their own array[formvars] so we can run them through the washing machine...separately...if we want...

				////////////////////////////////////////////////////////////////////////REMOVE 
				$this->log('The form variables have been collected', 'debug.html');////
				$this->log($formvars, 'debug.html');							//////
				/////////////////////////////////////////////////////////////////////
				
				$vars = $this->model->addItem($vars);
				$this->display();
				exit; //------------->register()
				
			}
		}

		public function addFile()
		{
			/////////////////////////////////////////////////////////DELETE
			$this->log('The POST variables are: ', 'debug.html'); //
			$this->log($_POST, 'debug.html');                    //
			//////////////////////////////////////////////////////

			if ( isset( $_FILES['file'] )) // Lets check to see that the right form made this request
			{

				////////////////////////////////////////////////////////////REMOVE
				$this->log('File has been submitted', 'debug.html');   ////
				//////////////////////////////////////////////////////////
				$vars = array();
				$vars = $this->fetchVars($vars);
				$vars['filename'] = $_FILES['file']['tmp_name'];
				$vars['name'] = preg_replace("/[^A-Z0-9._-]/i", "_", $_FILES['file']['name']);
				$vars['folder'] = $this->request($_REQUEST['folder']);
				$vars['destination'] = 'upload/' . $vars['name'];
				$allowed =  array('gif','png' ,'jpg');
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				if( !in_array($ext,$allowed) ) 
				{
					$this->log('File not allowed', 'debug.html');
					//return false;
				}
				else
				{
					$vars['item_image'] = 'holder.js/300x200';
				}
				$vars['item_image'] = $this->model->addFile($vars);
			}
			$vars['task'] = 'display';
			$this->display($vars);

		}

	


		
}		

?>