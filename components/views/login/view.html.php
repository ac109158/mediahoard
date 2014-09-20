<?php
class ViewLogin extends Helper{  
        public function __construct()
        {
            
            parent::__construct();
        }
        
        function display($vars)
        
            {
                $this->log('Login View Displayed', 'debug.html');
                if ( $vars['formvars'] != null )
                {
                    $this->formvars = $vars['formvars'];
                    $this->log(' Injecting vars into $this', 'debug.html');               
                    $this->alertType = $vars['alertType'];
                    $this->alertHeader = $vars['alertHeader'];
                    $this->alertMessage = $vars['alertMessage'];            
                }



                
                $this->action1 = 'index.php?controller=landings&task=display&view=login&option=login'; //sets action for login form
                $this->action2 = 'index.php?controller=landings&task=display&view=login&option=create'; //sets action for register form
                //unset($_POST);

                $this->requireHeader('header' . $_SESSION['status']);
                require_once  'html.source.php';
                $this->requireFooter('footer' . $_SESSION['status']);
        }
        

}//end of class

?>