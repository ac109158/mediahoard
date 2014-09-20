<div class="container-fluid"> <!-- add user form --> 
      <div class="row-fluid">
            <div class="span12">
                  <div class="box">
                        <div class="modal-body">
                              <div class="well">
                                    <ul class="nav nav-tabs">
                                          <li class="active"><a href="#login" data-toggle="tab">Contact</a></li>
                                          <li class=""><a href="#profile" data-toggle="tab">Profile</a></li>
                                          <li class=""><a href="#shipping" data-toggle="tab">Shipping </a></li>
                                          <li class=""><a href="#mailing" data-toggle="tab">Mailing</a></li>
                                          <li class=""><a href="#billing" data-toggle="tab">Billing</a></li>
                                    </ul>
                                          <div id="myTabContent" class="tab-content">
                                                <div class="tab-pane active in" id="login">
                                                            <div class="control-group">
                                                                  <!-- MESSAGE BOX --> 
                                                                  <!-- <div class="row">  
                                                                        <div id="alert" class="span4 offset1 <?=$this->alertDisplay?>">  
                                                                              <div class="<?=$this->alertType?>">  
                                                                                    <a class="close" data-dismiss="alert">×</a>  
                                                                                    <strong><?=$this->alertHeader?></strong> <?=$this->alertMessage?>
                                                                              </div>  
                                                                        </div>  
                                                                  </div> -->
                                                                  <!-- MESSAGE BOX --> 
<!-- <<<<<<<<<<<<<<<<<<<<<<<<<< -->                                                                 
<!-- Quick Add Content --> 
<!-- Username -->
<legend>Contact Info</legend>
<form id="tab" action="<?=$this->action?>" method="POST">

<div class="control-group">
    <div class="row">  
      <div id="alert" class="span4 offset1 <?=$this->alertDisplay?>">  
            <div class="<?=$this->alertType?>">  
                  <a class="close" data-dismiss="alert">×</a>  
                        <strong><?=$this->alertHeader?></strong> <?=$this->alertMessage?>
             </div> 
      </div>
    </div>  
</div>



<label>Username</label>
<input type="text" name="username" value="<?=$this->formvars['username']?>" class="input-xlarge">
<input type='hidden' name='submitted' id='submitted' value='1'/>
<label>First Name</label>
<input type="text" name="f_name" value="<?=$this->formvars['f_name']?>" class="input-xlarge">
<label>Last Name</label>
<input type="text" name="l_name" value="<?=$this->formvars['l_name']?>" class="input-xlarge">
<label>Email</label>
<input type="email" name="email" value="<?=$this->formvars['email']?>" class="input-xlarge">
<label>Phone</label>
<input type="text" name="phone" value="<?=$this->formvars['phone']?>" class="input-xlarge">
<label>Password</label>
<input id="password" name="password"  value="<?=$this->formvars['password']?>"class="input-xlarge" type="password">
<label>Confirm Password</label>
<input id="confirm_password" name="confirm_password"  value="<?=$this->formvars['confirm_password']?>"class="input-xlarge" type="password">
<hr>
<button id='submit' name="submit" value='1' class="btn btn-primary">Add User</button>
</div>
</form>
<!-- END Quick Add Content --> 
<!-- >>>>>>>>>>>>>>>>>>>>>>>>>> -->  
                                                                  </div>
                                                                  <div class="tab-pane fade" id="profile">
<!-- <<<<<<<<<<<<<<<<<<<<<<<<<< -->                                                                 
<!-- Profile Content --> 
<legend>Profile</legend>

<!-- END Quick Add Content --> 
<!-- >>>>>>>>>>>>>>>>>>>>>>>>>> -->  
                                                                  </div>
                                                                  <div class="tab-pane fade" id="shipping">
<!-- <<<<<<<<<<<<<<<<<<<<<<<<<< -->                                                                 
<!-- Shipping Content --> 
<legend>Shipping</legend>
<form id="tab" action="<?=$this->action?>" method="POST">
<label>Shipping1</label>
<input type="text" name="shipping1" value="<?=$this->shipping1?>" class="input-xlarge">
<label>Shipping2</label>
<input type="text" name="shipping2" value="<?=$this->shipping2?>" class="input-xlarge">
<label>City</label>
<input type="text" name="city" value="<?=$this->city?>" class="input-xlarge">
<label>State</label>
<input type="text" name="state" value="<?=$this->state?>" class="input-xlarge">
<label>Zip Code</label>
<input type="text" name="zipcode" value="<?=$this->zipcode?>" class="input-xlarge">
<hr>
<button id='submit' name="submit" value='1' class="btn btn-primary">Update</button>
</form>

<!-- END Shipping Content --> 
<!-- >>>>>>>>>>>>>>>>>>>>>>>>>> --> 
                                                                  </div>
                                                                  <div class="tab-pane fade" id="mailing">
<!-- <<<<<<<<<<<<<<<<<<<<<<<<<< -->                                                                 
<!-- Mailing  Content --> 
<legend>Mailing</legend>
<form id="tab" action="<?=$this->action?>" method="POST">
<label>Mailing1</label>
<input type="text" name="mailing1" value="<?=$this->mailing1?>" class="input-xlarge">
<label>Mailling2</label>
<input type="text" name="mailing2" value="<?=$this->mailing2?>" class="input-xlarge">
<label>City</label>
<input type="text" name="city" value="<?=$this->city?>" class="input-xlarge">
<label>State</label>
<input type="text" name="state" value="<?=$this->state?>" class="input-xlarge">
<label>Zip Code</label>
<input type="text" name="zipcode" value="<?=$this->zipcode?>" class="input-xlarge">
<hr>
<button id='submit' name="submit" value='1' class="btn btn-primary">Update</button>
</form>
<!-- END Mailing Content --> 
<!-- >>>>>>>>>>>>>>>>>>>>>>>>>> --> 
                                                                  </div>
                                                                  <div class="tab-pane fade" id="billing">
<!-- <<<<<<<<<<<<<<<<<<<<<<<<<< -->                                                                 
<!-- Billing Content --> 
<legend>Billing Content</legend>
<!-- END Billing Content --> 
<!-- >>>>>>>>>>>>>>>>>>>>>>>>>> --> 
                                                                  </div>
                                                            </div> <!-- End of Control Group  --> 

                                                </div>
                                          </div>
                                </div>
                        </div>
                </div>                
        </div>
</div>

