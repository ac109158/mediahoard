<?php
class ModelApp {
		public function __construct()
		{
		session_start();
		$this->user_table = DB_USERS_TABLE;
		}

		public function display($vars)
		{
			require_once './lib/helper.php';
			$helper = new Helper();
			$view = $helper->fetchView($vars['view']);
			$view = $this->injectVarsIntoObject($view, $vars);
			$view->display();
		}

		public function login($vars)
		{
			require_once './lib/helper.php';
			$helper = new Helper();
			$_SESSION['status'] = 1;
			header('location:index.php?controller=app&task=display');
		}

		public function injectVarsIntoObject($obj, $vars)
		{
			foreach ($vars as $key => $value) {
				$obj->$key = $value;
			}
			return $obj;
		}



		public function validateRegisterForm($vars=null)
		{
			require_once './lib/helper.php';
			$helper = new Helper();
			if ( !$helper->isMatch($_POST['password'], $_POST['confirm_password'] ) )
			{
				return 'Passwords do not match';
			}
			if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			{
				return 'Email invalid';
			}
			if (!$this->validatePhone($_POST['phone']))
			{
				return 'Phone is invalid';
			}
			$conn = $this->getDBC();
			$vars = $this->CollectRegistrationSubmission();
			if ( !$this->IsFieldUnique('username', $vars['username']) ) { return 'Username Unavailable';}
			if ( !$this->IsFieldUnique('email', $vars['email']) ) { return 'Email is already in use';}
			if ( !$this->IsFieldUnique('phone', $vars['phone']) ) { return 'Email is already in use';}
			$qry = $this->getRegisterQuery($vars);
			$result = mysqli_query($conn, "$qry");
			if (mysqli_affected_rows($conn) == 1)
				{
				 	return true;
				} else
				{
					return "Registration Unsuccessful";
				}
			exit;
		}

		private function CollectRegistrationSubmission()
		{
			$vars=array();

			$vars['f_name'] = $this->Sanitize($_POST['f_name']);
			$vars['l_name'] = $this->Sanitize($_POST['l_name']);
			$vars['email'] = $this->Sanitize($_POST['email']);
			$vars['phone'] = $this->numbersOnly($_POST['phone']);
			$vars['username'] = $this->Sanitize($_POST['username']);
			$vars['password'] = $this->Sanitize($_POST['password']);
			return $vars;
		}

		private function getDBC()
		{

			$conn= mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die("Error " . mysqli_error($con));
			return $conn;


		}

		private function getRegisterQuery($vars)
		{
			$confirm_code = $this->MakeConfirmationMd5($vars['email']);
			$invite_code = $this->MakeConfirmationMd5($vars['email']);
			$vars['confirmcode'] = $confirmcode;
			$insert_query = 'INSERT INTO ' . $this->user_table . ' (
			f_name,
			l_name,
			email,
			phone,
			username,
			password,
			confirm_code,
			invite_code
			)
			values
			(
			"' . $vars['f_name'] . '",
			"' . $vars['l_name'] . '",
			"' . $vars['email'] . '",
			"' . $vars['phone'] . '",
			"' . $vars['username'] . '",
			"' . md5($vars['password']) . '",
			"' . $confirm_code . '",
			"' . $invite_code . '"
			);';
			return $insert_query;
		}

		private function IsFieldUnique($field, $value)
		{
			$conn = $this->getDBC();
			//$field = $this->SanitizeForSQL($field);
			$qry = "SELECT username FROM users WHERE $this->Sanitize($field) ='".$this->Sanitize($value)."'";
			$result = mysqli_query($conn, $qry);
			if($result && mysqli_num_rows($result) > 0) { return false; }
			return true;
		}





		public function sendEmail($vars)
		{
			require_once 'lib/class.phpmailer.php';
			$mailer = new PHPMailer();
			$mailer->CharSet = 'utf-8';
			$mailer->AddAddress($vars['email'],$vars['name']);
			$mailer->Subject = 'CS-4000 PHP';
			$mailer->From = 'acook20@dmail.dixie.edu';
			$mailer->Body ="Hello ".$vars[name]."\r\n\r\n".
			"Thanks for submitting your contact information.\r\n".
			$vars[name]."\r\n ".
			$vars[phone]."\r\n".
			$vars[email]."\r\n".
			$vars[gender]."\r\n".
			$vars[interests]."\r\n".
			$vars[comments]."\r\n".
			"\r\n".
			"Regards,\r\n".
			"Webmaster\r\n".
			'Andy Cook';

			if ( !$mailer->Send() ) {return false;}
			return true;
		}


		public function log($data, $file='debug.html', $path = null, $method = null)
		{
			$outBuffer = '';
			$filepath  = (isset($path)) ? $path . $file : 'storage/logs'. $file;
			$method  = (isset($$method)) ? $method : 'a';
			$file_handle = fopen("$filepath", $method) or die('Cannot open file:  '.$filepath);
			if ( is_array($data))
			{
				foreach ($data as $key => $value)
				{
					$outBuffer .= $key . ':'  . $value . '\r\n';
				}
				$outBuffer .= '*ER*' . '\r\n';
			}
			else
			{
				$outBuffer .= $data;
			}

			echo $file_handle . $outBuffer;

			fwrite($file_handle, $outBuffer);
			fclose($file_handle);
		}

		function Sanitize($str,$remove_nl=true)
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

		function SafeDisplay($value)
		{
		if(empty($_POST[$value_name]))
		{
			return'';
		}
		return htmlentities($_POST[$value]);
		}

		public function numbersOnly($string)
		{
		    return preg_replace('/\D/', '', $string);
		}

		function StripSlashes($str)
		{
		if(get_magic_quotes_gpc())
			{
			$str = stripslashes($str);
			}
		return $str;
		}

		private function MakeConfirmationMd5($email)
		{
			$randno1 = rand();
			$randno2 = rand();
			return md5($email.$this->rand_key.$randno1.''.$randno2);
		}

		public function validatePhone($string)
	{
		$numbersOnly = preg_replace('/\D/', '', $string);
		$numberOfDigits = strlen($numbersOnly);
		if ($numberOfDigits >=10 && $numberOfDigits <= 12)
		{
		return true;
		} else
		{
		return false;
		}
	}


}//end of class

?>
