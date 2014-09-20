<?php
class ViewForm
{	
	public function __construct()
	{
	error_reporting(E_ALL);
	}


		
	public function display()
	    	{

	    	// require_once 'inc/header.php';

		echo  '<form id="contact-form" class="form-horizontal" method = "POST" action="index.php?controller=apps&task=validateForm">';
		echo  '<fieldset>';

		echo  '<!-- Form Name -->';
		echo  '<center><legend style="font-size:20pt;">Contact Form</legend></center>';
		echo  '<input type="hidden" name="submitted" id="submitted" value="1"/>';
		
		echo  '<!-- Text input-->';
		echo  '<div class="control-group">';
		echo  '<label class="control-label" for="name">Name</label>';
		echo  '<div class="controls">';
		echo  '<input id="name" name="name" placeholder="" class="input-xlarge" type="text">';
		echo  '</div>';
		echo  '</div>';

		echo  '<!-- Text input-->';
		echo  '<div class="control-group">';
		echo  '<label class="control-label" for="phone">Phone</label>';
		echo  '<div class="controls">';
		echo  '<input id="phone" name="phone" placeholder="" class="input-xlarge" type="text">';
		echo  '</div>';
		echo  '</div>';

		echo  '<!-- Text input-->';
		echo  '<div class="control-group">';
		echo  '<label class="control-label" for="email">Email</label>';
		echo  '<div class="controls">';
		echo  '<input id="email" name="email" placeholder="" class="input-xlarge" type="text">';
		echo  '</div>';
		echo  '</div>';

		echo  '<!-- Multiple Radios -->';
		echo  '<div class="control-group">';
		echo  '<label class="control-label" for="gender">Gender</label>';
		echo  '<div class="controls">';
		echo  '<label class="radio" for="gender-0">';
		echo  '<input name="gender" id="gender-0" value="Male" checked="checked" type="radio">';
		echo  'Male';
		echo  '</label>';
		echo  '<label class="radio" for="gender-1">';
		echo  '<input name="gender" id="gender-1" value="Female" type="radio">';
		echo  'Female';
		echo  '</label>';
		echo  '</div>';
		echo  '</div>';

		echo  '<!-- Multiple Checkboxes -->';
		echo  '<div class="control-group">';
		echo  '<label class="control-label" for="interests">Interest</label>';
		echo  '<div class="controls">';
		echo  '<label class="checkbox" for="interests-0">';
		echo  '<input name="interests" id="interests-0" value="Computer Science" type="checkbox">';
		echo  'Computer Science';
		echo  '</label>';
		echo  '<label class="checkbox" for="interests-1">';
		echo  '<input name="interests" id="interests-1" value="Visual Technologies" type="checkbox">';
		echo  'Visual Technologies';
		echo  '</label>';
		echo  '<label class="checkbox" for="interests-2">';
		echo  '<input name="interests" id="interests-2" value="IT" type="checkbox">';
		echo  'IT';
		echo  '</label>';
		echo  '<label class="checkbox" for="interests-3">';
		echo  '<input name="interests" id="interests-3" value="Web Development" type="checkbox">';
		echo  'Web Develelopment';
		echo  '</label>';
		echo  '</div>';
		echo  '</div>';

		echo  '<!-- Textarea -->';
		echo  '<div class="control-group">';
		echo  '<label class="control-label" for="comments">Comments:</label>';
		echo  '<div class="controls">';         
		echo  '<textarea id="comments" name="comments">Tell us more about yourself.</textarea>';
		echo  '</div>';
		echo  '</div>';

		echo  '<!-- Button -->';
		echo  '<div class="control-group">';
		echo  '<label class="control-label" for="submit"></label>';
		echo  '<div class="controls">';
		echo  '<button id="submit" value = "submitted" name="submit" class="btn btn-primary">submit</button>';
		echo  '</div>';
		echo  '</div>';
		echo  '<div id="message" style= "text-align: center; color:'.$this->msgColor.'">';
		echo $this->msg;
		echo '</div>';
		echo '<br>';


		// require_once 'inc/footer.php';
		}

}//end of class

?>