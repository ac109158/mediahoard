<?php
class ViewContact{	
		public function __construct()
		{
			
			
		}
		
		function display()
	    	{
	    		require_once './lib/helper.php';
			$helper = new Helper();

	    		$helper->requireHeader('header' . $_SESSION['status']);
	    		require_once 'html.source.php';
	    		$helper->requireFooter('footer' . $_SESSION['status']);
		}
		

}//end of class

?>