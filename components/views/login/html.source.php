 <div class="" id="loginModal">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Have an Account?</h3>
    </div>
    <div class="modal-body">
    <div class="well">
    <ul class="nav nav-tabs">
    <li class="<? if ( $this->option == 'login' ) { echo 'active';}?>"><a href="#login" data-toggle="tab">Login</a></li>
    <li class="<? if ( $this->option == 'create' ) { echo 'active';}?> "><a href="#create" data-toggle="tab">Create Account</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
    <div class="tab-pane <? if ( $this->option != 'create' ) { echo 'active';}?> in" id="login">
    <form class="form-horizontal" action="<?=$this->action1?>" method="POST">
    <input type='hidden' name='l_submitted' id='l_submitted' value='1'/>
    <fieldset>
    <div id="legend">
    <legend class="">Sign In</legend>
    </div>

    <div class="control-group">

    <div class="row">  
    <div id="alert" class="span4 offset1 <?=$this->alertDisplay?>">  
    <div class="<?=$this->alertType?>">  
    <a class="close" data-dismiss="alert">×</a>  
    <strong><?=$this->alertHeader?></strong> <?=$this->alertMessage?>
    </div>  
    </div>  
    </div>
    <br>

    <!-- Username -->
    <label class="control-label" for="l_username" value="<?=$this->l_username?>">Username</label>
    <div class="controls">
    <input type="text" id="l_username" name="l_username" value="<?=$this->formvars['l_username']?>" class="input-xlarge">
    </div>
    </div>
    <div class="control-group">
    <!-- Password-->
    <label class="control-label" for="l_password">Password</label>
    <div class="controls">
    <input type="password" id="l_password" name="l_password" value="<?=$this->formvars['l_password']?>" class="input-xlarge">
    </div>
    </div>
    <div class="control-group">
    <!-- Button -->
    <div class="controls">
    <button class="btn btn-success">Login</button>
    </div>
    </div>
    </fieldset>
    </form>
    </div>
    <div class="tab-pane fade <? if ( $this->option == 'create' ) { echo 'active';}?>" id="create">
    <form id="tab" action="<?=$this->action2?>" method="POST">
    <input type='hidden' name='submitted' id='submitted' value='1'/>
    <input type='hidden'  class='spmhidip' name='<?php echo $vars['spamTrapInputName'] ?>' />
    <label>Username</label>
    <input type="text" name="username" value="<?=$this->username?>" class="input-xlarge">
    <label>First Name</label>
    <input type="text" name="f_name" value="<?=$this->f_name?>" class="input-xlarge">
    <label>Last Name</label>
    <input type="text" name="l_name" value="<?=$this->l_name?>" class="input-xlarge">
    <label>Email</label>
    <input type="email" name="email" value="<?=$this->email?>" class="input-xlarge">
    <label>Phone</label>
    <input type="text" name="phone" value="<?=$this->phone?>" class="input-xlarge">
    <label>Password</label>
    <input id="password" name="password"  value="<?=$this->password?>"class="input-xlarge" type="password">
    <label>Confirm Password</label>
    <input id="confirm_password" name="confirm_password"  value="<?=$this->confirm_password?>"class="input-xlarge" type="password">
    <hr>
    <button id='submit' name="submit" value='1' class="btn btn-primary">Create Account</button>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div>
   