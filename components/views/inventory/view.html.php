<?php
require_once './lib/toolkit.php';
class ViewInventory extends Toolkit {	
		public function __construct()
		{		
			parent::__construct();

		}
		
		function display($vars)
	    	{
	    		$this->source = VIEW . $vars['view'] . '/html.source.php';
	    		if ( isset($vars['option']) && isset($vars['view']) )
	    		{
	    			
	    			if ( $vars['option'] === 'add' )
		    		{
		    			$this->log('Option is Add', 'debug.html');
		    			$this->source = VIEW . $vars['view'] . '/' . $vars['option'] . '/html.source.php';
		    			$this->option = 'add';
		    			if ($vars['submitted'] === 1)
						{
							$this->submitted = 1;
							$validated = $this->validate($_POST); // expand validation once there is a better ide of what is needed
							if ( $validated !== true)
							{
								$this->Warning($validated);
							}
							else
							{
								if ( $vars['complete'] !== true) 
								{
									$this->log('Ask user to completely fill out form', 'debug.html');
									$this->Warning($vars['complete']);	
								}
								$result = $this->addItemtoDB($vars['formvars']);    						
								if ( $result === 1)
								{							
									$this->Success('<strong> ' . $vars['formvars']['title'] . '</strong> was added to your Inventory.',$vars);
									exit;

								}
								else
								{
									$this->Warning('Something went wrong', $vars);
								}

							}
															
						}
				}
				else if ( $vars['option'] == 'filter')
	    			{
	    				$this->log('Option is Filter with filter - ' . $vars['filter'] . ' - ' . $vars['filter2'], 'debug.html');
	    				$this->log($vars, 'debug.html');
	    				$this->option = 'filter';
	    				$this->submitted = 0;
	    				$this->source = VIEW . $vars['view'] . '/html.source.php';
	    				
	    				if ($vars['searchFilter'] != null)
	    				{
	    					$this->searchFilter = $vars['searchFilter'];
	    					$this->log('Search Filter - ' . $this->searchFilter, 'debug.html');
	    				}
	    				if ($vars['filter'] != null)
	    				{
	    					$this->filter = $vars['filter'];
	    					$this->log('Search Filter - ' . $this->filter, 'debug.html');
	    				}
	    				if ($vars['filter2'] != null)
	    				{
	    					$this->filter2 = $vars['filter2'];
	    					$this->log('Search Filter2 - ' . $this->filter2, 'debug.html');
	    				}
	    				if ($vars['filter3'] != null && $vars['filter3'] != '')
	    				{
	    					$this->filter3 = $vars['filter3'];
	    					$this->log('Search Filter3 - ' . $this->filter3, 'debug.html');
	    				}
	    				// if ($vars['filter3'] != null)
	    				// {
	    				// 	$this->log('ViewBrowse->display->getBrowseList w/ filter3 & searchFitler', 'debug.html');
				    	// 	$this->browse_list = $this->getInventoryList($this->filter, $this->filter2);
	    				// }

	    				// $this->log('ViewBrowse->display->getBrowseList with filter1', 'debug.html');
	    				$this->browse_list = $this->getInventoryList();
	    			}
	    			else if ( $vars['option'] == 'edit' )
	    			{
	    				$this->log('Option is edit', 'debug.html');
	    				$this->log('ViewBrowse->Edit->', 'debug.html');
	    				$this->option = 'edit';
	    				$this->id = $vars['id'];
	    				$this->source = VIEW . $vars['view'] . '/' . $vars['option'] . '/html.source.php';		
	    				$this->item_info = $this->getItemInfo($this->id);
	    				$this->image_info = $this->getImageInfo();
	    				$this->log('Image Info', 'debug.html');
	    				if ($this->image_info[1] == '' ){$this->image_info[1] = 'upload/default-no-image.png';}
	    				$this->log($this->image_info, 'debug.html');

	    			}

	    		}
	    		else
	    		{
	    			$this->log('No options and No Submits', 'debug.html');
	    			$this->source = VIEW . $vars['view'] . '/html.source.php';
	    		}
	    		$this->alertDisplay=$vars['alertDisplay'];
	    		$this->alertType = $vars['alertType'];
	    		$this->alertMessage = $vars['alertMessage'];
	    		$this->alertHeader = $vars['alertHeader'];
	    		$this->pageRender();		
	    		
		}


		private function pageRender()
		{
			
			$this->requireHeader('header' . $_SESSION['status']);
			$this->log($this->source, 'debug.html');
			require_once "$this->source";
			$this->requireFooter('footer' . $_SESSION['status']);
			
		}

		private function validate($array) // this needs to actually do something at some point but it walks through the motions
		 {	
		 	////////////////////////////////////////////////////////////
			$this->log('ViewInventory->validate($array)', 'debug.html');
			$this->log($array, 'debug.html');
			////////////////////////////////////////////////////////////

			$complete = $this->isArrayFull($array);
			if ( $complete !== true)
			{
				////////////////////////////////////////////////////////////
				$this->log('ViewInventory->validate>>> ' .  $complete, 'debug.html');
				return $complete;
			}
			////////////////////////////////////////////////////////////
			$this->log(' ViewInventory->validate>>> Success', 'debug.html');
			return true;
		}


		private function addItemtoDB($vars)
		{
			$success = 0;
			////////////////////////////////////////////////////////////
			$this->log('ViewInventory->addItemtoDB', 'debug.html');
			$mysqli = $this->getDBC();
			$sql = 'SELECT title FROM items WHERE ( title="' . $vars['title'] . '" AND owner_id="'. $_SESSION['id'] . '")';
			$result = $mysqli->query($sql) or die($mysqli->error.__LINE__);
			if ( $result->num_rows > 0)
			{
				$result->close();
				$this->Warning('This title has already been added to your Inventory');
				exit;
			}
			if($stmt = $mysqli -> prepare("INSERT INTO items ( owner_id, title, description, location, category_id, type_id, condition_id, privacy_id, rating_id, year, link) values (?,?,?,?,?,?,?,?,?,?,?)"))
			{
				$stmt->bind_param('isssiiiiiis', $owner_id, $title, $description, $location, $category_id, $type_id, $condition_id, $privacy_id, $rating_id, $year, $link);   // bind $sample to the parameter
				$owner_id = $_SESSION['id'];
				$title= $this->SanitizeForSQL($vars['title']);
				$description = $this->SanitizeForSQL($vars['description']);
				$location = $this->SanitizeForSQL($vars['location']);
				$category_id = $this->SanitizeForSQL($vars['category']);
				$this->filter = $category_id;
				$type_id = $this->SanitizeForSQL($vars['type']);
				$this->filter2 = $category_id;
				$condition_id = $this->SanitizeForSQL($vars['condition']);
				$privacy_id = $this->SanitizeForSQL($vars['privacy']);
				$rating_id = $this->SanitizeForSQL($vars['rating']);
				$year = $this->SanitizeForSQL($vars['year']);
				$link = $this->SanitizeForSQL($vars['link']);
				

				/* Execute it */
				if ($stmt->execute()) 
				{ // exactly like this!
    				$success = 1;
				}
				$this->log(mysqli_error($mysqli), 'debug.html');
				/* Bind results */
				//$stmt -> bind_result($result);

				/* Fetch the value */
				$stmt -> fetch();
				/* Close statement */
				$stmt -> close();				
			}

			$mysqli->close();

			////////////////////////////////////////////////////////////
			$this->log("addItemtoDB() << " . $success, 'debug.html');
			return $success;


		}

		private function getInventoryList()
		// This will take $filter as an arg and if it  is set will set the query to only look for records where the name is similar to the  
		//$filter param. otherwise retrieves all of the users
		{
			//connection
			$mysqli = $this->getDBC();
			// Check for errors
			if (mysqli_connect_errno())
			{
			   $this->log(mysqli_connect_error(), 'debug.html');
			}
			//prepare statement
			if ($this->filter != '0')
			{
				$this->log('1.0', 'debug.html');
				if($this->filter2 != '0')
				{
					if ( isset($this->filter) && isset($this->filter2) && isset($this->filter3) && isset($this->searchFilter))
					{
						$this->log('1.1.1', 'debug.html');
						$sql = 'SELECT * from items WHERE (category_id = "' . $this->filter . '" AND owner_id = "' . $_SESSION['id'] . '" AND  ' . $this->filter3 . ' LIKE "%' . $this->searchFilter . '%")  ORDER BY title';	
					}
					else if ( isset($this->filter) && isset($this->filter2) )
					{
						$this->log('1.1.2', 'debug.html');
						$sql = 'SELECT *  from items WHERE (category_id = "' . $this->filter . '" AND type_id = "' . $this->filter2 . '" AND  owner_id = "' . $_SESSION['id'] . '")  ORDER BY title';	
					}
					else if ($this->filter != null)
					{
						$this->log('1.1.3', 'debug.html');
						$sql = 'SELECT *  from items WHERE (category_id = "' . $this->filter . '" AND owner_id = "' . $_SESSION['id'] . '")  ORDER BY title';	
					}
					else
					{
						$this->log('1.1.4', 'debug.html');
						$sql = 'SELECT * from items WHERE (category_id = "' . $this->filter . '" AND owner_id = "' . $_SESSION['id'] . '") ORDER BY title';	
					}

				}
				else
				{
					if ( isset($this->filter) && isset($this->filter2) && isset($this->filter3) && isset($this->searchFilter))
					{
						$this->log('1.2.1', 'debug.html');
						$sql = 'SELECT * from items WHERE (category_id = "' . $this->filter . '" AND owner_id = "' . $_SESSION['id'] . '" AND ' . $this->filter3 . ' LIKE "%' . $this->searchFilter . '%")  ORDER BY title';	
					}
					else if ( isset($this->filter) && isset($this->filter2) )
					{
						$this->log('1.2.2', 'debug.html');
						$sql = 'SELECT *  from items WHERE (category_id = "' . $this->filter . '" AND owner_id = "' . $_SESSION['id'] . '")  ORDER BY title';	
					}
					else if ($this->filter != null)
					{
						$this->log('1.2.3', 'debug.html');
						$sql = 'SELECT *  from items WHERE (category_id = "' . $this->filter . '" AND owner_id = "' . $_SESSION['id'] . '")  ORDER BY title';	
					}
					else
					{
						$this->log('1.2.4', 'debug.html');
						$sql = 'SELECT * from items WHERE (category_id = "' . $this->filter . '" AND owner_id = "' . $_SESSION['id'] . '") ORDER BY title';	
					}

				}
				
			}
			else 
			{
				$this->log('2.0', 'debug.html');
				if ($this->filter2 != 0)
				{
					$this->log('Find All Categories', 'debug.html');
					if ( isset($this->filter) && isset($this->filter2) && isset($this->filter3) && isset($this->searchFilter))
					{
						$this->log('2.1.1', 'debug.html');
						$sql = 'SELECT * from items WHERE (owner_id = "' . $_SESSION['id'] . '" AND  ' . $this->filter3 . ' LIKE "%' . $this->searchFilter . '%")  ORDER BY title';	
					}
					else if ( isset($this->filter) && isset($this->filter2) )
					{
						$this->log('2.1.2', 'debug.html');
						$sql = 'SELECT *  from items WHERE (type_id = "' . $this->filter2 . '" AND  owner_id = "' . $_SESSION['id'] . '")  ORDER BY title';	
					}
					else if ($this->filter != null)
					{
						$this->log('2.1.3', 'debug.html');
						$sql = 'SELECT *  from items WHERE (owner_id = "' . $_SESSION['id'] . '")  ORDER BY title';	
					}
					else
					{
						$this->log('2.1.4', 'debug.html');
						$sql = 'SELECT * from items WHERE ( owner_id = "' . $_SESSION['id'] . '") ORDER BY title';	
					}

				}
				else 
				{
					if ( isset($this->filter3) && isset($this->searchFilter))
					{
						$this->log('2.2.1', 'debug.html');
						$sql = 'SELECT * from items WHERE (owner_id = "' . $_SESSION['id'] . '" AND  ' . $this->filter3 . ' LIKE "%' . $this->searchFilter . '%")  ORDER BY title';	
					}
					else
					{
						$this->log('2.2.2', 'debug.html');
						$sql = 'SELECT *  from items WHERE (owner_id = "' . $_SESSION['id'] . '")  ORDER BY title';	
					}

				}
				

			}
			

			$this->log($sql, 'debug.html');
			if(!$result = $mysqli->query($sql))
			{
			    die('There was an error running the query [' . $mysqli->error . ']');
			}
			$filter_rows = '';
			while($row = $result->fetch_assoc())
			{
			    $filter_rows .=     '<tr><td style="width:5px;"><input  type="checkbox" class="itembox prettyinput" value='.$row['item_id'].' id="pi'.$row['item_id'].'" name="pi' . $row['item_id']. ' "/></td><td class="text-center"><a class="badge badge-info" href="index.php?controller=dashboards&task=display&view=inventory&option=edit&id=' . $row['item_id'].'"a>' . $row['title'] . '</a></td><td>' . $row['status'] .  '</td><td class="hidden-phone">'. substr($row['description'],0,20)  . '</td><td class="hidden-phone">' . $row['year'] . "</td><td>" . $row['location'] . '</td><td class="hidden-phone">'. $row['condition_id'] . "</td><td>" . $row['rating_id'] . '</td><td class="hidden-phone">' . $row['privacy_id'] . "</td><td>" . $row['link'] . "</td></tr>";
			}
			$this->log('Total rows updated: ' . $mysqli->affected_rows, 'debug.html'); 
			$result->free();
			return $filter_rows;

		}


		private function getItemInfo()
		// This will take $filter as an arg and if it  is set will set the query to only look for records where the name is similar to the  
		//$filter param. otherwise retrieves all of the users
		{
			//connection
			$mysqli = $this->getDBC();
			// Check for errors
			if (mysqli_connect_errno())
			{
			   $this->log(mysqli_connect_error(), 'debug.html');
			} 
			// CheckOwner........
			//prepare statement
			if ($_SESSION['role'] !== '2')
			{
				$sql = 'SELECT item_id, owner_id, title, description, year, location, category_id, type_id, condition_id, rating_id, privacy_id, link, status from items WHERE (item_id = "' . $this->id. '" AND  owner_id = "' . $_SESSION['id'] . '")  LIMIT 1';	
			}
			else if ($_SESSION['role'] === '2')
			{
				$sql = 'SELECT item_id, owner_id, title, description, year, location, category_id, type_id, condition_id, rating_id, privacy_id, link, status from items WHERE (item_id = "' . $this->id .'")  LIMIT 1';
			}
			$this->log($sql , 'debug.html');
			if(!$result = $mysqli->query($sql))
			{
			    die('There was an error running the query [' . $mysqli->error . ']');
			}
			$row = $result->fetch_row();
			$this->log($row, 'debug.html');
			$this->log('Total rows updated: ' . $mysqli->affected_rows, 'debug.html'); 
			$result->free();
			return $row;

		}

		private function getImageInfo()
		// This will take $filter as an arg and if it  is set will set the query to only look for records where the name is similar to the  
		//$filter param. otherwise retrieves all of the users
		{
			//connection
			$mysqli = $this->getDBC();
			// Check for errors
			if (mysqli_connect_errno())
			{
			   $this->log(mysqli_connect_error(), 'debug.html');
			} 
			// CheckOwner........
			//prepare statement
			$sql = 'SELECT * from files WHERE (item_id = "' . $this->id .'")  LIMIT 1';
			$this->log($sql , 'debug.html');
			if(!$result = $mysqli->query($sql))
			{
			    die('There was an error running the query [' . $mysqli->error . ']');
			}
			$row = $result->fetch_row();
			$this->log($row, 'debug.html');
			$this->log('Total rows updated: ' . $mysqli->affected_rows, 'debug.html'); 
			$result->free();
			return $row;

		}

		private function Warning($msg)
		{
			$this->log('ViewInventory->Warning()', 'debug.html');
			$this->submitted = 0;
			$this->formvars = $this->CollectFormSubmission();
			$this->alertType = 'alert-error';
			$this->alertHeader = 'Failure!  ';
			$this->alertMessage = $msg;
			$this->log($vars, 'debug.html');
			$this->pageRender();
		}

		private function Success($msg,$vars)
		{
			$this->log($vars['formvars'], 'debug.html');
			$this->log('ViewInventory->Success()', 'debug.html');
			$vars['submitted'] = 0;
			$vars->formvars = array();
			$_SESSION['filter'] = $vars['formvars']['category'];
			$_SESSION['filter2'] = $vars['formvars']['type'];
			$_SESSION['filter3'] = 'title';
			$_SESSION['searchFilter'] = $vars['formvars']['title'];
			$_SESSION['view'] = 'inventory';
			$_SESSION['task'] = 'display';
			$_SESSION['option'] = 'filter';
			$_SESSION['controller']="dashboards";
			$_SESSION['alertType'] = 'alert-success';
			$_SESSION['alertHeader'] = 'Sucess!  ';
			$_SESSION['alertMessage'] = $msg;
			$_SESSION['redirect'] = true;
			$_SESSION['write'] = 'a';
			$_POST = array();
			$this->log($vars, 'debug.html');
			$url_string = 'index.php?controller=dashboards&task=display&view=inventory&option=filter';
			$url_string .= '&filter=' . $vars['formvars']['category'] . '&filter2='. $vars['formvars']['type'] . "&searchFilter=" . $vars['formvars']['title'];
			header('location:' . $url_string);
			exit;
			
		}



		

}//end of class

?>