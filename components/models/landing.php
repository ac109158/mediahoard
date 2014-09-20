<?php
require_once './lib/toolkit.php';
class ModelLanding extends Toolkit{	
		public function __construct()
		{
			parent::__construct();
			session_start();
			$this->tablename = 'users';
		}
		
		public function display($vars)
		{
			$view = $this->fetchView($vars['view']);
			$view->display($vars);
		}



		public function validateRegisterForm($vars)
		{

			$this->log("<hr><hr>validateRegisterForm(".$vars . ')', 'debug.html');
			if ( !$this->isMatch($_POST['password'], $_POST['confirm_password'] ) ) 
			{
				$this->log('Passwords do not match', 'debug.html');
				$vars['response'] = 'Passwords do not match';
				return $vars;
			}
			if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			{
				$this->log('Email invalid', 'debug.html');
				$vars['response'] = 'Email invalid';
				return $vars;
			}
			if (!$this->validatePhone($_POST['phone'])) 
			{
				$this->log('Phone is Invalid', 'debug.html');
				$vars['response'] = 'Phone is invalid';
				return $vars;
			}
			$vars = $this->CollectRegistrationSubmission();
			$this->log('CollectRegistrationSubmission', 'debug.html');
			$this->log($vars, 'debug.html');
			//IsFieldUnique($table, $field, $value)
			if ( !$this->IsFieldUnique('users', 'username', $vars['username']) ) { $vars['response'] =  'Username Unavailable'; return $vars;}
			if ( !$this->IsFieldUnique('users', 'email', $vars['email']) ) { $vars['response'] = 'Email is already in use'; return $vars;}
			if ( !$this->IsFieldUnique('users', 'phone', $vars['phone']) ) { $vars['response'] = 'Email is already in use'; return $vars;}
			$result = $this->insertRegisterQuery($vars);
			$this->log('Results of register query were:' . $result . '<br><hr><hr>', 'debug.html');
			if ($result == true) 
			{
				$vars['response'] = 'true';
				return $vars;
			}
			$vars['response'] = "Something went wrong";
			return $vars;
		}

		private function CollectRegistrationSubmission()
		{
			$formvars=array();

			$formvars['f_name'] = $this->Sanitize($_POST['f_name']);
			$formvars['l_name'] = $this->Sanitize($_POST['l_name']);
			$formvars['email'] = $this->Sanitize($_POST['email']);		 
			$formvars['phone'] = $this->numbersOnly($_POST['phone']);	
			$formvars['username'] = $this->Sanitize($_POST['username']);
			$formvars['password'] = $this->Sanitize($_POST['password']);
			return $formvars;
		} 

		private function insertRegisterQuery($vars)
		{
			$success = 0;
			$this->log('insertRegisterQuery(' . $vars. ')', 'debug.html');
			$mysqli = $this->getDBC(DB_HOST, DB_USER, DB_PASS , DB_NAME);

			if($stmt = $mysqli -> prepare("INSERT INTO users ( f_name, l_name, email, phone, username, password, confirm_code, invite_code, last_logged) values (?,?,?,?,?,?,?,?,?)"))
			{
				$stmt->bind_param('sssisssss', $f_name, $l_name, $email, $phone, $username, $password, $confirm_code, $invite_code, $last_logged);   // bind $sample to the parameter
				$f_name = $this->SanitizeForSQL($vars['f_name']);
				$l_name = $this->SanitizeForSQL($vars['l_name']);
				$email = $this->SanitizeForSQL($vars['email']);
				$phone = $this->SanitizeForSQL($vars['phone']);
				$username = $this->SanitizeForSQL($vars['username']);
				$password = md5(SALT . $vars['password']);
				$confirm_code = $this->MakeConfirmationMd5($vars['email']);
				$invite_code = $this->MakeConfirmationMd5($vars['username']);
				$last_logged = time();


				/* Execute it */
				if ($stmt->execute()) 
				{ // exactly like this!
    				$success = 1;
				}
				/* Bind results */
				//$stmt -> bind_result($result);

				/* Fetch the value */
				$stmt -> fetch();
				/* Close statement */
				$stmt -> close();				
			}
			$mysqli->close();
			$this->log("insertRegisterQuery() << " . $success, 'debug.html');
			return $success;
		}			


		public function CheckLoginInDB($username,$password)
		{
			$this->log('CheckLoginInDB' .'(' . $username.',' . $password .')', 'debug.html');
			$mysqli = $this->getDBC(DB_HOST, DB_USER, DB_PASS , DB_NAME);
			$this->log('DB >>>'. gettype($mysqli), 'debug.html'); 
			/* Create a prepared statement */
			if($stmt = $mysqli -> prepare("SELECT CONCAT(f_name, ' ', l_name) as name, email, user_id, role, last_logged FROM users WHERE username=? AND password=?")) {

			/* Bind parameters
			s - string, b - blob, i - int, etc */
			$stmt -> bind_param('ss', $username, $pwdmd5);
			$username = $this->SanitizeForSQL($username);
			$pwdmd5 = md5(SALT . $password);
			/* Execute it */
			$stmt -> execute();
			/* Bind results */
			$stmt -> bind_result($name, $email, $id, $role, $last_logged);
			/* Fetch the value */
			if ($stmt -> fetch() == 1)
			{
				$_SESSION['name']  = $name;
				$_SESSION['email'] = $email;				
				$_SESSION['id'] = $id;
				$_SESSION['role'] = $role;
				$_SESSION['last_active'] = $last_logged;			
				$_SESSION['status'] = 1;
				$time = time();
				$this->updateUserField('last_logged', $time);
				$stmt -> close();
				$mysqli -> close();
				return true;
			}			
			else 
			{
				$result = false;
				$this->log('Invalid Credential', 'debug.html');
				$stmt -> close();
				$mysqli -> close();
				return false;
			}

			
			}
			
		}

		private function IsFieldUnique($field, $value)
		{
		        $this->log("IsFieldUnique(" . $field . ',' . $value .")", 'debug.html');
		        $mysqli = $this->getDBC(DB_HOST, DB_USER, DB_PASS , DB_NAME);
		        // //$field = $this->SanitizeForSQL($field);
		        // $qry = "SELECT username FROM users WHERE $this->Sanitize($field) ='".$this->Sanitize($value)."'";
		        // $result = mysqli_query($conn, $qry);                 
		        if($stmt = $mysqli -> prepare("SELECT id FROM users WHERE $this->Sanitize($field) =?")) 
		        {

		        /* Bind parameters
		        s - string, b - blob, i - int, etc */
		        $stmt -> bind_param('s', $value);
		        $value = $this->Sanitize($field);

		        /* Execute it */
		        $stmt -> execute();

		        /* Bind results */
		        $stmt -> bind_result($result);

		        /* Fetch the value */
		        $stmt -> fetch();

		        /* Close statement */
		        $stmt -> close();
		        }

		        /* Close connection */
		        $mysqli -> close();
		        $this->log('IsFieldUnique << ' . !$result . '<br><hr>', 'debug.html');
		        if ( $result > 0) {return false;}
		        return true;
		}

		private function updateUserField($field, $value)
		{
			$this->log('updateUserField(' . $field .',' . $value . ')', 'debug.html');
			$mysqli = $this->getDBC(DB_HOST, DB_USER, DB_PASS , DB_NAME);

			if($stmt = $mysqli->prepare("UPDATE users SET $field= ? WHERE id=?"))
			{
				$this->log($field .'-' . $value, 'debug.html');
				$stmt->bind_param('ss', $new_value, $id);   // bind $sample to the parameter
				$new_value= $value;
				$id = $this->SanitizeForSQL($_SESSION['id']);
				$this->log($new_value .'-' . $id, 'debug.html');
				/* Execute it */
				$stmt->execute();
				$this->log('<<' . $stmt->affected_rows, 'debug.html');
				$stmt->close();				
			}
			$mysqli->close();
			return;
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


		private function MakeConfirmationMd5($email)
		{
			$randno1 = rand();
			$randno2 = rand();		
			return md5($email.$this->rand_key.$randno1.''.$randno2);
		}

		

}//end of class

?>