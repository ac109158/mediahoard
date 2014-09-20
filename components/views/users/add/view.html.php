<?php
class ViewAdd	
{
		public function __construct()
		{		
			
		}
		
		function display($vars)
	    	{
	    		$this->log('Add User View Displayed', 'debug.html');
	   		require_once "html.source.php";	    		
		}

		public function validate()
		 {
		 	
			require_once './lib/toolkit.php';
			$toolkit = new Toolkit();
			$toolkit->log('ViewAdd->validate()', 'debug.html');
			$toolkit->log('ViewAdd->validate', 'debug.html');
			$complete = $toolkit->isArrayFull($_POST);
			if ( $complete !== true)
			{
				$toolkit->log($complete, 'debug.html');
				return $complete;
			}
			return true;
		}
		

}//end of class

?>