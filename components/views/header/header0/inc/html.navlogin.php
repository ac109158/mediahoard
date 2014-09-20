<form   id="formID" class="navbar-form offset3 pull-right" action="index.php?controller=landings&task=display&view=login&option=login" method="POST"> <?// adds offset3?>
<input type='hidden' name='l_submitted' id='l_submitted' value='1'/>
<input class="span2 validate[required] text-input" type="text" name="l_username" id="l_username" placeholder="Username" data-errormessage-value-missing="Required!">
<input class="span2 validate[required] text-input" type="password" name="l_password" id="l_password" placeholder="Password" data-errormessage-value-missing="Required!">
<button type="submit" class="btn">Sign in</button>
</form>