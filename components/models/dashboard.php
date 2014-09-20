<?php
require_once MODEL . 'landing.php';
class ModelDashboard extends ModelLanding{	
		public function __construct()
		{
			//parent::__construct();
			session_start();
		}
		

		public function display($vars)
		// this display function pretty much assumes that there is going to be a controller and task set
		// the only question is if there is an $option set, 
		{	
			if ( isset($vars['view']) && isset($vars['option']))
			{
				$view = $this->fetchView($vars['view']);
				$view->display($vars);
			}
			else // not sure what I want to do if not set so we just repeat for now....
			{
				$view = $this->fetchView($vars['view']);
				$view->display($vars);
			}
		}

		public function validate($array)
		 {
		 	
		 	$this->log('ModelDashboard->validate', 'debug.html'); 
			$this->log('ModelDashboard->validate($array)', 'debug.html');
			$this->log($array, 'debug.html');
			$complete = $this->isArrayFull($array);
			if ( $complete !== true)
			{
				$this->log('ModelDashboard->validate>>> ' .  $complete, 'debug.html');
				return $complete;
			}
			return true;
		}

		public function update($vars)
		{
			$mysqli = $this->getDBC();
			$field = $vars['field'];
			$value = $vars['value'];
			$id = $vars['id'];
			// check connection
			if (mysqli_connect_errno() ) 
			{ 
				exit('Connect failed: '. mysqli_connect_error());
			}
			$sql = "SELECT * FROM items WHERE item_id='$id'";
			$result = $mysqli->query($sql);
			if ($result->num_rows > 0)
			{ 
				// item exist update it
				$mysqli->query("UPDATE items SET $field = '$value' WHERE item_id ='$id'");
				return true;

			}
			return false;

		}

		public function deleteUser($vars)
		{
			$this->log('ModelDashboard->deleteUser', 'debug.html');
			$mysqli = $this->getDBC();
			array_shift($vars['formvars']);
			$users = $vars['formvars'];
			$this->log($users, 'debug.html');
			if ( count($users) > 0)
			{
				$mysqli = $this->getDBC();
				// check connection
				if (mysqli_connect_errno() ) 
				{ 
					exit('Connect failed: '. mysqli_connect_error());
				}
				foreach ($users as $user=>$id) 
				{
					$result = false;			
					$stmt = $mysqli->prepare("DELETE FROM users WHERE user_id = ?");
					$stmt->bind_param('i', $user_id);
					$user_id = $id;
					if ($stmt->execute())
					{
						$result=true;

					};
					$this->log(' Delete :' . $result , 'debug.html');
					$this->log($result, 'debug.html');
					$stmt->close();
				}
				return $vars;
			}
			else
			{
				$this->log(' Empty LIst', 'debug.html');
				array_push($vars['results'],'Empty List');
				return $vars;
			}
		}


		public function deleteItem($vars)
		{
			$this->log('ModelDashboard->deleteItem', 'debug.html');
			$mysqli = $this->getDBC();
			array_shift($vars['formvars']);
			$items = $vars['formvars'];
			$this->log($items, 'debug.html');
			if ( count($items) > 0)
			{
				$mysqli = $this->getDBC();
				// check connection
				if (mysqli_connect_errno() ) 
				{ 
					exit('Connect failed: '. mysqli_connect_error());
				}
				foreach ($items as $item=>$id) 
				{
					$result = false;			
					$stmt = $mysqli->prepare("DELETE FROM items WHERE item_id = ?");
					$stmt->bind_param('i', $item_id);
					$item_id = $id;
					if ($stmt->execute())
					{
						$result=true;

					};
					$this->log(' Delete :' . $result , 'debug.html');
					$this->log($result, 'debug.html');
					$stmt->close();
				}
				return $vars;
			}
			else
			{
				$this->log(' Empty LIst', 'debug.html');
				array_push($vars['results'],'Empty List');
				return $vars;
			}
		}

		public function addItem($vars)
		{
			////////////////////////////////////////////////////////////
			$this->log('ModelDashboard->AddItem(' . $vars.')', 'debug.html');
			if (is_array($vars))
			{
				$this->log('**$vars**', 'debug.html');
				$this->log($vars, 'debug.html');
				$this->log('**$vars[formvars]**', 'debug.html');
				$this->log($vars['formvars'], 'debug.html');
			}
			////////////////////////////////////////////////////////////
			$this->display($vars);
			exit;
		}

		public function addFile($vars)
		{
			////////////////////////////////////////////////////////////
			$this->log('ModelDashboard->AddFile(' . $vars.')', 'debug.html');
			$this->log($vars, 'debug.html');
			if ( file_exists( $vars['destination'] ) ) 
			{
				$this->log($vars['destination'] . "already exists", 'debug.html');
				//return false;
			} 
			$destination = $this->SanitizeForSQL($vars['destination']);
			$name = $this->SanitizeForSQL($vars['name']);
			$id=$vars['id'];
			$response = move_uploaded_file($vars['filename'], $vars['destination']);
			if ( $response == true ) 
			{
				//change permissions
				chmod($destination, 0644);
				//echo "Chmodded $destination to 0644";
				//connect to database and store the path in there
				$mysqli = $this->getDBC();
				$query = "INSERT INTO files (file_path, name, item_id) VALUES ('$destination', '$name', $id)";
				$result = $mysqli->query($query) or $this->log($mysqli->error.__LINE__, 'debug.html');
				$this->log($result, 'debug.html');
				if ( $result > 0)
				{
					$this->log(' Insert success', 'debug.html');
					$mysqli->close();
					return $destination;
				}
				$this->log(' Insert failed', 'debug.html');
				return false;
			}
			return false;
		}



		

}//end of class

?>