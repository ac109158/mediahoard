<?php
require_once './lib/toolkit.php';
class ViewBrowse extends Toolkit{	
		public function __construct()
		{
			parent::__construct();
			// if ( $_SESSION['status'] !== '1')
			// {
			// 	$this->index('dashboards', 'logout');
			// }	
		}
		
		function display($vars)
	    	{
	    		$this->log('ViewBrowse->display ', 'debug.html');
	    		$this->view = $vars['view'];
	    		$this->source = VIEW . $this->view . '/html.source.php';
	    		if ( $_SESSION['role'] == '2' && $vars['option'] = 'admin') 
	    		{
	    			////////////////////////////////////////////////////////////
	    			$this->option = $vars['option'];
	    			$this->filter = $vars['filter'];
	    			$this->log('Display for Admin: If #1', 'debug.html');
	    			$this->source = VIEW . $this->view . '/' .$this->option . '/html.source.php';
	    			$this->browse_list =$this->getAdminBrowseList($this->filter);		    		

	    		}
	    		else if ( isset($vars['option']) )
	    		{

	    			if ( $vars['option'] == 'filter'  )
	    			{
	    				if ($vars['searchFilter'] != null && $vars['searchFilter'] != '')
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
		    			////////////////////////////////////////////////////////////
		    			$this->log($vars['option'] . '&' . $vars['filter'] . 'are set: If #2', 'debug.html');				
			    		// $this->browse_list =$this->getBrowseList($this->filter);
			    		$this->browse_list =$this->getBrowseList();
			    		$this->source = VIEW . $this->view . '/html.source.php';
		    		}
		    		else if ( $vars['option'] == 'item' )
		    		{
		    			$this->log( 'Set for Item Option', 'debug.html');	    			
		    			$this->option = $vars['option'];
		    			$this->id = $vars['id'];
		    			$this->item_info = $this->getItemInfo($this->id);
			    		$this->source = VIEW . $this->view . '/' . $this->option . '/html.source.php';

		    		}
	    		}
	    		else 
	    		{
	    			////////////////////////////////////////////////////////////
	    			$this->log('Default Option : else clause', 'debug.html');
	    		} 
	    		$this->pageRender(); 		
	    		
		}

		private function pageRender()
		{
			$this->requireHeader('header' . $_SESSION['status']);
			$this->log($this->source, 'debug.html');
	    		require_once("$this->source");
	    		$this->requireFooter('footer' . $_SESSION['status']);
		}


		private function getBrowseList()
		// This will take $filter as an arg and if it  is set will set the query to only look for records where the name is similar to the  
		//$filter param. otherwise retrieves all of the users
		{
			//connection
			$mysqli = $this->getDBC();
			// Check for errors
			if (mysqli_connect_errno())
			{
			   echo mysqli_connect_error();
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
						$sql = 'SELECT * from items WHERE (category_id = "' . $this->filter . '" AND type_id = "' . $this->filter2 . '" AND owner_id <> "' . $_SESSION['id'] . '" AND  ' . $this->filter3 . ' LIKE "%' . $this->searchFilter . '%")  ORDER BY title';	
					}
					else if ( isset($this->filter) && isset($this->filter2) )
					{
						$this->log('1.1.2', 'debug.html');
						$sql = 'SELECT *  from items WHERE (category_id = "' . $this->filter . '" AND type_id = "' . $this->filter2 . '" AND  owner_id <> "' . $_SESSION['id'] . '")  ORDER BY title';	
					}
					else if ($this->filter != null)
					{
						$this->log('1.1.3', 'debug.html');
						$sql = 'SELECT *  from items WHERE (category_id = "' . $this->filter . '" AND owner_id <> "' . $_SESSION['id'] . '")  ORDER BY title';	
					}
					else
					{
						$this->log('1.1.4', 'debug.html');
						$sql = 'SELECT * from items WHERE (category_id = "' . $this->filter . '" AND owner_id <> "' . $_SESSION['id'] . '") ORDER BY title';	
					}

				}
				else
				{
					if ( isset($this->filter) && isset($this->filter2) && isset($this->filter3) && isset($this->searchFilter))
					{
						$this->log('1.2.1', 'debug.html');
						$sql = 'SELECT * from items WHERE (category_id = "' . $this->filter . '" AND owner_id <> "' . $_SESSION['id'] . '" AND ' . $this->filter3 . ' LIKE "%' . $this->searchFilter . '%")  ORDER BY title';	
					}
					else if ( isset($this->filter) && isset($this->filter2) )
					{
						$this->log('1.2.2', 'debug.html');
						$sql = 'SELECT *  from items WHERE (category_id = "' . $this->filter . '" AND owner_id <> "' . $_SESSION['id'] . '")  ORDER BY title';	
					}
					else if ($this->filter != null)
					{
						$this->log('1.2.3', 'debug.html');
						$sql = 'SELECT *  from items WHERE (category_id = "' . $this->filter . '" AND owner_id <> "' . $_SESSION['id'] . '")  ORDER BY title';	
					}
					else
					{
						$this->log('1.2.4', 'debug.html');
						$sql = 'SELECT * from items WHERE (category_id = "' . $this->filter . '" AND owner_id <> "' . $_SESSION['id'] . '") ORDER BY title';	
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
						$sql = 'SELECT * from items WHERE (owner_id <> "' . $_SESSION['id'] . '" AND  ' . $this->filter3 . ' LIKE "%' . $this->searchFilter . '%")  ORDER BY title';	
					}
					else if ( isset($this->filter) && isset($this->filter2) )
					{
						$this->log('2.1.2', 'debug.html');
						$sql = 'SELECT *  from items WHERE (type_id = "' . $this->filter2 . '" AND  owner_id <> "' . $_SESSION['id'] . '")  ORDER BY title';	
					}
					else if ($this->filter != null)
					{
						$this->log('2.1.3', 'debug.html');
						$sql = 'SELECT *  from items WHERE (owner_id <> "' . $_SESSION['id'] . '")  ORDER BY title';	
					}
					else
					{
						$this->log('2.1.4', 'debug.html');
						$sql = 'SELECT * from items WHERE ( owner_id <> "' . $_SESSION['id'] . '") ORDER BY title';	
					}

				}
				else 
				{
					if ( isset($this->filter3) && isset($this->searchFilter))
					{
						$this->log('2.2.1', 'debug.html');
						$sql = 'SELECT * from items WHERE (owner_id <> "' . $_SESSION['id'] . '" AND  ' . $this->filter3 . ' LIKE "%' . $this->searchFilter . '%")  ORDER BY title';	
					}
					else
					{
						$this->log('2.2.2', 'debug.html');
						$sql = 'SELECT *  from items WHERE (owner_id <> "' . $_SESSION['id'] . '")  ORDER BY title';	
					}

				}
				

			}
			

			$this->log($sql, 'debug.html');
			$this->log(' Hit the database', 'debug.html');
			if(!$result = $mysqli->query($sql))
			{
			    die('There was an error running the query [' . $mysqli->error . ']');
			}
			$filter_rows = '';
			while($row = $result->fetch_assoc())
			{
			    $filter_rows .=     '<tr><td class="text-center"><a class="badge badge-info" href="index.php?controller=dashboards&task=display&view=browse&option=item&id=' . $row['item_id'].'"a>' . $row['title'] . "</a></td><td>" . $row['description'] . "</td><td>" . $row['year'] . "</td><td>" . $row['location'] . "</td><td>". $row['condition_id'] . "</td><td>" . $row['rating_id'] . "</td><td>" . $row['privacy_id'] . "</td><td>" . $row['link'] . "</td></tr>";
			}
			$this->log('Total rows updated: ' . $mysqli->affected_rows, 'debug.html'); 
			$result->free();
			return $filter_rows;

		}


		private function getAdminBrowseList($filter=null)
		// This will take $filter as an arg and if it  is set will set the query to only look for records where the name is similar to the  
		//$filter param. otherwise retrieves all of the users
		{
			////////////////////////////////////////////////////////////
			$this->log(' ViewBrowse->getAdminBrowseList(' . $filter .')', 'debug.html');
			if ( $_SESSION['role'] !== '2' )
			{
				$this->index('dashboards', 'logout');
			}
			//connection
			$mysqli = $this->getDBC();
			// Check for errors
			if (mysqli_connect_errno())
			{
			   echo mysqli_connect_error();
			}
			//prepare statement
			if ($filter != null)
			{
				$sql = 'SELECT item_id, owner_id, title, description, year, location, category_id, type_id, condition_id, rating_id, link  from items WHERE (category_id = "' . $filter . '")  ORDER BY title';	
			}
			else
			{
				$sql = 'SELECT item_id, owner_id, title, description, year, location, category_id, type_id, condition_id, rating_id, link  from items ORDER BY title';
			}

			if(!$result = $mysqli->query($sql))
			{
			    die('There was an error running the query [' . $mysqli->error . ']');
			}
			$filter_rows = '';
			while($row = $result->fetch_assoc())
			{
			    $filter_rows .=     '<tr><td><a href="index.php?controller=dashboards&task=display&view=inventory&option=edit&id=' . $row['item_id'].'"a>' . $row['title'] . "</a></td><td>" . $row['description'] . "</td><td>" . $row['year'] . "</td><td>". $row['type_id'] . "</td><td>" . $row['condition_id'] . "</td><td>" . $row['rating_id'] . "</td><td>" . $row['owner_id'] . "</td><td>" . $row['link'] . "</td></tr>";
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
			   echo mysqli_connect_error();
			} 
			// CheckOwner........
			//prepare statement
			if ($_SESSION['status'] !== '0' && $_SESSION['role'] !== '2')
			{
				$this->log('1.0', 'debug.html');
				$sql = 'SELECT item_id, owner_id, title, description, year, location, category_id, type_id, condition_id, rating_id, privacy_id, link, status from items WHERE (item_id = "' . $this->id. '" AND  privacy_id = "1")  LIMIT 1';	
			}
			else if ($_SESSION['status'] !== '0' && $_SESSION['role'] === '2')
			{
				$this->log('2.0', 'debug.html');
				$sql = 'SELECT item_id, owner_id, title, description, year, location, category_id, type_id, condition_id, rating_id, privacy_id, link, status from items WHERE (item_id = "' . $this->id .'")  LIMIT 1';
			}
			$this->log($sql , 'debug.html');
			if(!$result = $mysqli->query($sql))
			{
			    die('There was an error running the query [' . $mysqli->error . ']');
			}
			$row = $result->fetch_assoc();
			$this->log($row, 'debug.html');
			$this->log('Total rows updated: ' . $mysqli->affected_rows, 'debug.html'); 
			$result->free();
			return $row;

		}

		

}//end of class

?>Send 