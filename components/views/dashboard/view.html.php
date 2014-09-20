<?php
class ViewDashboard extends Helper{  
        public function __construct()
        {
              parent::__construct();   
            if ($_SESSION['status'] === 0 )  
            {
                $_SESSION = array();
                session_destroy();
                header('location: index.php?view=login');
                exit;
            }
        }
        
        function display()
        {
            $this->injectSessionIntoThis();
            $this->log('Dashboard View displayed', 'debug.html');
            $this->requireHeader('header' . $_SESSION['status']);
            $ts= (isset($_SESSION['last_active'])) ? $_SESSION['last_active'] : $_COOKIE['last_active'];
            $this->last_logged = 'Your last login: ' . date("M j, Y, g:i a", $ts);
            require_once 'inc/html.source.php';
            $this->requireFooter('footer' . $_SESSION['status']);
        }
    

}//end of class

?>