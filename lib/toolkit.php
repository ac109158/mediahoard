<?php
class Toolkit extends Helper {	
		public function __construct()
		{
			parent::__construct();
			$this->sitename = SITENAME;
			$this->rand_key = RAND_KEY;
			$this->admin_email='ac109158@plusonecompany.info';
		}

		public function getDBC($host = DB_HOST, $user = DB_USER, $pass = DB_PASS, $name = DB_NAME) 
		{


			$this->log('getDBC(' .$host.','. $user .',' . '**********' . ',' . $name .')' , 'debug.html');
			$mysqli = new mysqli($host, $user, $pass, $name);
			if ($mysqli->connect_error) 
			{
				die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
			}
			$this->log(' getDBC() << Success... ' . $mysqli->host_info, 'debug.html');
			return $mysqli;
		}


		// getPusherSocket()  will be used for PUSHER functions
		public function getPusherSocket() 
		{
			require_once INC . 'Pusher.php';
			$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
			return $pusher;		
		}

		public function getUrl() 
		{
			$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
			$url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
			$url .= $_SERVER["REQUEST_URI"];
			return $url;
		}



		// form collection

		// isArrayFull($array) takes all of the values of an array and check if they are all set
		// Use on POST, GET to check if all of the fields of a form were filled out - basic validation
		// returns a message to fill in the first empty field it comes to / ignores submit
		public function isArrayFull($array)
		{
			foreach ($array as $value => $contents)
			{
				if (!$contents && $value != 'submit')
				{
					if (!$pos = strpos($value, '_'))
					{
						return 'Please fill in ' . $value;
					}
				$value = str_replace('_', ' ', $value);
				return 'Please fill in '. $value;
				}
			}
			return true;
		}

		// CollectFormSubmission($global= '$_POST') will take all of the values of a super global and pass them into an array
		// removes the html entities


		//validation functions

		// numbersOnly($string) extracts only numbers in a string
		// used for collecting phone number
		public function numbersOnly($string)
		{
		    return preg_replace('/\D/', '', $string);
		}

		// basic phone validation that counts for 7 or 10 or 12 digits in a sring
		// Boolen.. does not modify string
		public function validatePhone($string) 
		{
			$numbersOnly = preg_replace('/\D/', '', $string);
			$numberOfDigits = strlen($numbersOnly);
			if ( $numberOfDigits == 7 || $numberOfDigits ==10 || $numberOfDigits == 11)
			{
			return true;
			} else 
			{
			return false;
			}
		}

		//isMatch($var1, $var2) basic compare function
		// 
		public function isMatch($var1, $var2)
		{
			return $var1 === $var2;
		}




		//Sanitization functions

		public function Sanitize($str,$remove_nl=true)
		{
		$str = $this->StripSlashes($str);	
		if($remove_nl)
			{
			$injections = array('/(\n+)/i',
			'/(\r+)/i',
			'/(\t+)/i',
			'/(%0A+)/i',
			'/(%0D+)/i',
			'/(%08+)/i',
			'/(%09+)/i'
			);
			$str = preg_replace($injections,'',$str);
			}	
		return $str;
		} 


		function StripSlashes($str)
		{
		if(get_magic_quotes_gpc())
			{
			$str = stripslashes($str);
			}
		return $str;
		}

		function GetSpamTrapInputName()
		{
		return 'sp'.md5('KHGdnbvsgst'.$this->rand_key);
		}
		
		public function GetLoginSessionVar()
		{
			$retvar = md5($this->$rand_key);
			$retvar = 'usr_'.substr($retvar,0,10);
			return $retvar;
		}

		function SanitizeForSQL($str)
		{
			$ret_str = addslashes( $str );
			return $ret_str;
		}



		// testing functions

		
}
