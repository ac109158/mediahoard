<?php
require_once './lib/toolkit.php';
class ViewUsers extends Toolkit{	
		public function __construct()
		{
			parent::__construct();
			if ( $_SESSION['role'] !== '2')
			{
				$this->index('dashboards', 'logout');
			}	
		}
		
		function display($vars)
	    	{
	    		if ( isset($vars['view']) )
	    		{

	    			////////////////////////////////////////////////////////////
	    			$this->log(' View is Set', 'debug.html');
	    			$this->view = $vars['view'];
	    			$this->source = VIEW . 'users/html.source.php';
	    			if (isset($vars['option']) )
	    			{
		    			$this->option = $vars['option'];
		    			////////////////////////////////////////////////////////////
		    			$this->log('Option set as '. $this->option, 'debug.html');
			    		if ( $this->option == 'filter' && isset($vars['filter'])){
			    			$this->filter = $vars['filter'];
			    			if (isset($vars['searchFilter']))
			    			{
			    				$this->searchFilter = $vars['searchFilter'];
			    				$this->user_list =$this->getUserList($this->filter, $this->searchFilter);	
			    			}
			    			else
			    			{
			    				$this->searchFilter = 'name';
			    				$this->user_list =$this->getUserList($this->filter);	
			    			}
			    		}
			    		else if ( $this->option == 'add' && $_SESSION['role'] == 2)
			    		{
			    			if (isset( $_POST['submitted'] ))
			    			{
			    				if ( $vars['formvars'] != null )
							{
								$this->formvars = $vars['formvars'];
								$this->log(' Injecting ******vars into $this', 'debug.html');                        
							}
			    			}
			    			$this->alertType = $vars['alertType'];
							$this->alertHeader = $vars['alertHeader'];
							$this->alertMessage = $vars['alertMessage'];   
			    			
			    			$this->log('Add option w/ secure role', 'debug.html');
			    			$this->action = 'index.php?controller=dashboards&task=display&view=users&option=add';
			    			$this->source = VIEW . $this->view . '/' . $this->option . '/html.source.php';
			    			////////////////////////////////////////////////////////////
			    			$this->log(' The source set as' . $this->source, 'debug.html');


			    		}
	    			}
		    		$this->pageRender($vars);
	    		}
	    		
		}

		private function pageRender($vars=null)
		{
			$this->requireHeader('header' . $_SESSION['status']);	    		
	    		require_once $this->source;
	    		$this->requireFooter('footer' . $_SESSION['status']);
		}

		function getUserList($filter=null, $filter2 = null)
		// This will take $filter as an arg and if it  is set will set the query to only look for records where the name is similar to the  
		//$filter param. otherwise retrieves all of the users
		{
			if ( $filter2 == 'id'){ $filter2 = 'user_id';}
			//connection
			$mysqli = $this->getDBC();
			// Check for errors
			if (mysqli_connect_errno())
			{
			   echo mysqli_connect_error();
			}
			//prepare statement
			if ($filter != null && $filter2 != null && $filter2 == 'name')
			{
				$this->log('getUserList(' . $filter . ',' . $filter2 . ') option1', 'debug.html');
				$sql = 'SELECT CONCAT( f_name, " ", l_name) as name, username, role, email, last_logged, registered, user_id from users WHERE (f_name LIKE "%' . $filter . '%" OR l_name LIKE "%' . $filter . '%" ) ORDER BY name';	
			}
			else if ($filter != null && $filter2 != null)
			{
				$this->log('getUserList(' . $filter . ',' . $filter2 . ') option2', 'debug.html');
				$sql = 'SELECT CONCAT( f_name, " ", l_name) as name, username, role, email, last_logged, registered, user_id from users WHERE ( '. $filter2 .' LIKE "%' . $filter . '%" ) ORDER BY name';	
			}
			else if ( $filter != null )
			{
				$this->log('getUserList(' . $filter . ',' . $filter2 . ') option3', 'debug.html');
				$sql = 'SELECT CONCAT( f_name, " ", l_name) as name, username, role, email, last_logged, registered, user_id from users WHERE (f_name LIKE "%' . $filter . '%" OR l_name LIKE "%' . $filter . '%" ) ORDER BY name';
			}
			else
			{
				$this->log('getUserList(' . $filter . ',' . $filter2 . ') option4', 'debug.html');
				$sql = 'SELECT CONCAT( f_name, " ", l_name) as name, username, role, email, last_logged, registered, user_id from users ORDER BY name';
			}

			if(!$result = $mysqli->query($sql))
			{
			    die('There was an error running the query [' . $mysqli->error . ']');
			}
			$user_rows = '';
			while($row = $result->fetch_assoc())
			{
			    $user_rows .=     '<tr><td><input type="checkbox" name="user' . $row['user_id'] .'" class="prettyinput userbox" value='.$row['user_id'].' id="'.$row['user_id'].'" name="pi' . $row['user_id']. ' "/></td><td><a href="index.php?controller=dashboard&task=edituser&view=users&option=' . $row['user_id'] .'"a>' . $row['name'] . "</a></td><td>" . $row['username'] . "</td><td>" . $row['role'] . "</td><td>". $row['email'] . "</td><td>" . $row['last_logged'] . "</td><td>" . $row['registered'] . "</td><td>" . $row['user_id'] . "</td></tr>";
			}
			$this->log('Total rows updated: ' . $mysqli->affected_rows, 'debug.html'); 
			$result->free();
			return $user_rows;

		}

		

}//end of class

?>