
<style type="text/css">
body{
  background:rgba(0,0,0,0.64);
}
fieldset {

}
.pad {
  padding-top: 1%;
}
.pad2 {
  padding-top: 2%;
}
option {
      background: #F5F5F5;
      color:black;
      outline:none;
      text-align: center;
      font-size: 14px;
    }


</style>


 
  
<fieldset>
  <br>
<form id="add-form" class="table-condensed" action="index.php?controller=dashboards&task=addItem&view=inventory&option=add" method="POST">

<!-- filler-->
<div class="row-fluid">
        <div class="span12">
                <div class="control-group">
                        <?php 
                                if (!empty($this->alertMessage))
                                {
                                echo '<div style=" position:absolute; text-align:center; padding:10px; font-size:20pt;left:25%;width:30%; top:40%;" id="alert" class="span4 offset1 '. $this->alertDisplay .'">';  
                                echo '<div style="height:100px; postion:relative;" class="' . $this->alertType .'">';  
                                echo '<a class="close" data-dismiss="alert" style="font-size:1em;">×</a> ';
                                echo '<br><br><strong>' . $this->alertHeader .'</strong>' . $this->alertMessage;
                                echo '</div>';
                                echo '</div>';
                                }
                        ?>
                <div>
        </div>
</div>

<br>
<div class="row-fluid">
        <!-- Title-->
        <div class="span7 well">
                <div class="control-group">
                        <div class="row-fluid">
                        <span class="label label-info span8 offset2 text-center pad">Title</span>
                        </div>
                        <br>
                        <div class="row-fluid">
                        <input id="title" name="title" value="<?=$this->formvars['title']?>" class="input-large span10 offset1 required" type="text">
                        </div>    
                </div>
        </div>
        
        <!-- Location-->
        <div class="span5 well">
                <div class="control-group">
                        <div class="row-fluid">
                        <span class="label label-info span8 offset2 text-center pad">Location</span>
                        </div>
                        <br>
                        <div class="row-fluid">
                        <input id="location" name="location" value="<?=$this->formvars['location']?>" class="input-large span10 offset1 required" type="text">
                        </div>    
                </div>
        </div>
</div>

<!-- Year-->
<div class="row-fluid">
        <div class="span2 well" style="height:150px;" >
                <div class="row-fluid">
                        <span class="label label-info  span8 offset2 text-center ">Year</span>
                </div>
                <br>
                <div class="row-fluid">
                           <div class="control-group span12">
                                <select class=" input-large span10 offset1 required" name="year"  value="<?=$this->item_info[4]?>" id="year">
                                    <option <?php if( $this->formvars['condition'] == '1') echo 'selected="selected"'?> name="category " id="category-0" value=''''>Choose</option>
                                </select>
                           </div>
                </div>
        </div>

<!-- Description -->
        <div class="span10 well">
                <div class="control-group">
                        <div class="row-fluid">
                                <span class="label label-info span8 offset2 pad text-center">Description</span>  
                        </div>
                        <br>
                        <div class="row-fluid">   
                                <div class="control-group span12">             
                                            <input class="input-large span10 offset1 required" id="description" name="description"  value="<?=$this->formvars['description']?>" type="text">
                                            </input>
                                </div> 
                        </div>
                </div>
        </div>
</div>

<div class="row-fluid">
        <div class="span3 well">
                <div class="control-group row-fluid">
                        <span class="label label-info span10 offset1 pad text-center">Category</span>
                </div>
                <div class="row-fluid">
                        <select class="span10 offset1" value="<?=$this->formvars['category']?>" id="category" name="category">
                                <option <?php if( $this->formvars['category'] == '') echo 'selected="selected"'?> name="category " id="category-0" value='''' selected="selected">Choose</option>
                                <option <?php if( $this->formvars['category'] == '1') echo 'selected="selected"'?> name="category " id="category-1"  value="1">Book</option>
                                <option <?php if( $this->formvars['category'] == '2') echo 'selected="selected"'?> name="category " id="category-2"  value="2">Movie</option>
                                <option <?php if( $this->formvars['category'] == '3') echo 'selected="selected"'?> name="category " id="category-2"  value="3">Music</option>
                                <option <?php if( $this->formvars['category'] == '4') echo 'selected="selected"'?> name="category " id="category-4"  value="4">Game</option>
                                <option <?php if( $this->formvars['category'] == '5') echo 'selected="selected"'?> name="category " id="category-5"  value="5">Subscription</option>
                                <option <?php if( $this->formvars['category'] == '6') echo 'selected="selected"'?> name="category " id="category-6"  value="5">Link</option>
                                <option <?php if( $this->formvars['category'] == '7') echo 'selected="selected"'?> name="category " id="category-7"  value="5">Image</option>
                                <option <?php if( $this->formvars['category'] == '8') echo 'selected="selected"'?> name="category " id="category-8"  value="5">Warranty</option>
                                <option <?php if( $this->formvars['category'] == '9') echo 'selected="selected"'?> name="category " id="category-9"  value="5">Other</option>
                        </select>
                </div>
        </div>


        <div class="span3 well">
                <div class="control-group row-fluid">
                        <span class="label label-info span10 offset1 pad text-center">Type</span>
                </div>
                <div class="row-fluid">
                        <select class="span10 offset1" id="type" name="type" >
                                <option <?php if( $this->formvars['type'] == '') echo 'selected="selected"'?> name="type" id="type-0" value='''' selected="selected">Choose</option>
                                <option <?php if( $this->formvars['type'] == '1') echo 'selected="selected"'?> name="type" id="type-1"  value="1">Hard Copy</option>
                                <option <?php if( $this->formvars['type'] == '2') echo 'selected="selected"'?> name="type" id="type-2"  value="2">Digital</option>
                                <option <?php if( $this->formvars['type'] == '3') echo 'selected="selected"'?> name="type" id="type-2"  value="3">Online</option>
                                <option <?php if( $this->formvars['type'] == '4') echo 'selected="selected"'?> name="type" id="type-4"  value="4">Article</option>
                                <option <?php if( $this->formvars['type'] == '5') echo 'selected="selected"'?> name="type" id="type-5"  value="5">Website</option>
                                <option <?php if( $this->formvars['type'] == '6') echo 'selected="selected"'?> name="type" id="type-6"  value="5">Link</option>
                                <!-- <option id="category-7"  value="5">Image</option>
                                <option id="category-8"  value="5">Warranty</option>
                                <option id="category-9"  value="5">Other</option> -->
                        </select>
                </div>
        </div>

        <div class="span3 well">
                <div class="control-group row-fluid">
                        <span class="label label-info span10 offset1 pad text-center">Conditon</span>
                </div>
                <div class="row-fluid">
                        <select class="span10 offset1" id="condition" name="condition">
                                <option <?php if( $this->formvars['condition'] == '') echo 'selected="selected "'?>name="condition" id="condition-0" value='''' selected="selected">Choose</option>
                                <option <?php if( $this->formvars['condition'] == '1') echo 'selected="selected "'?> name="condition" id="condition-1"  value="1">Poor</option>
                                <option<?php if( $this->formvars['condition'] == '2') echo 'selected="selected "'?> name="condition" id="condition-2"  value="2">Fair</option>
                                <option <?php if( $this->formvars['condition'] == '3') echo 'selected="selected "'?>name="condition" id="condition-2"  value="3">Good</option>
                                <option 
                                <?php if( $this->formvars['condition'] == '4') echo 'selected="selected "'?>name="condition" id="condition-4"  value="4">Great</option>
                                <option 
                                <?php if( $this->formvars['condition'] == '5') echo 'selected="selected "'?>name="condition" id="condition-5"  value="5">Perfect</option>
                                <!-- <option id="condition-6"  value="5">Link</option>
                                <option id="condition-7"  value="5">Image</option>
                                <option id="condition-8"  value="5">Warranty</option>
                                <option id="condition-9"  value="5">Other</option> -->
                        </select>
                </div>
        </div>

        <div class="span3 well">
                <div class="control-group row-fluid">
                        <span class="label label-info span10 offset1 pad text-center">Rate</span>
                </div>
                <div class="row-fluid">
                        <select class="span10 offset1" id="rating" name="rating" >
                                <option <?php if( $this->formvars['rating'] == '') echo 'selected="selected"'?> name="rating" id="category-0" value='''' selected="selected">Choose</option>
                                <option <?php if( $this->formvars['rating'] == '1') echo 'selected="selected"'?> name="rating" id="category-1"  value="1">Meh</option>
                                <option <?php if( $this->formvars['rating'] == '2') echo 'selected="selected"'?> name="rating" id="category-2"  value="2">blah</option>
                                <option <?php if( $this->formvars['rating'] == '3') echo 'selected="selected"'?> name="rating" id="category-2"  value="3">Ok</option>
                                <option <?php if( $this->formvars['rating'] == '4') echo 'selected="selected"'?> name="rating" id="category-5"  value="4">Awesome</option>
                                <option <?php if( $this->formvars['rating'] == '5') echo 'selected="selected"'?> name="rating" id="category-6"  value="5">Woot</option>
                                <!-- <option id="category-7"  value="5">Image</option>
                                <option id="category-8"  value="5">Warranty</option>
                                <option id="category-9"  value="5">Other</option> -->
                        </select>
                </div>
        </div>
</div>

<div class="row-fluid">
        <div class="span4 well">
                <div class="control-group row-fluid">
                        <span class="label label-info span10 offset1 pad text-center">Link</span>
                </div>
                <div class="row-fluid">
                        <input id="link" name="link" class="input-xlarge span10 offset1 required" type="text" value="<?=$this->formvars['link']?>" >    
                        <!-- <select class="span10 offset1">
                                <option name="link" id="link-0" value="null" selected="selected">Choose</option>
                                <option name="link" id="link-1"  value="1">Book</option>
                                <option name="link" id="link-2"  value="2">Movie</option>
                                <option name="link" id="link-2"  value="3">Music</option>
                                <option name="link" id="link-4"  value="4">Game</option>
                                <option name="link" id="link-5"  value="5">Subscription</option>
                                <option name="link" id="link-6"  value="5">Link</option>
                                <option name="link" id="link-7"  value="5">Image</option>
                                <option name="link" id="link-8"  value="5">Warranty</option>
                                <option name="link" id="link-9"  value="5">Other</option>
                        </select> -->
                </div>
        </div>


        <div class="span3 well">
                <div class="control-group row-fluid">
                        <span class="label label-info span10 offset1 pad text-center">Content</span>
                </div>
                <div class="row-fluid">
                        <select class="span10 offset1" id="content" name="content">
                                 <option <?php if( $this->formvars['content'] == '') echo 'selected="selected "'?> name="content" id="content-0" value="" selected="selected">Choose</option>
                                <option <?php if( $this->formvars['content'] == '1') echo 'selected="selected"'?>name="content" id="content-1"  value="1">G</option>
                                <option<?php if( $this->formvars['content'] == '2') echo 'selected="selected"'?> name="content" id="content-2"  value="2">PG</option>
                                <option <?php if( $this->formvars['content'] == '3') echo 'selected="selected"'?> name="content" id="content-2"  value="3">PG-13</option>
                                <option <?php if( $this->formvars['content'] == '4') echo 'selected="selected"'?> name="content" id="content-4"  value="4">R</option>
                                <option <?php if( $this->formvars['content'] == '5') echo 'selected="selected"'?> name="content" id="content-5"  value="5">Mature</option>
                               <!--  <option id="content-6"  value="5">Link</option>
                                <option id="content-7"  value="5">Image</option>
                                <option id="content-8"  value="5">Warranty</option>
                                <option id="content-9"  value="5">Other</option> -->
                        </select>
                </div>
        </div>

        <div class="span3 well">
                <div class="control-group row-fluid">
                        <span class="label label-info span10 offset1 pad text-center">Privacy</span>
                </div>
                <div class="row-fluid">
                        <select class="span10 offset1" id="privacy" name="privacy" >
                                <option <?php if( $this->formvars['privacy'] == '') echo 'selected="selected "'?> name="privacy" id="privacy-0" value="" selected="selected">Choose</option>
                                <option <?php if( $this->formvars['privacy'] == '1') echo 'selected="selected "'?> name="privacy" id="privacy-1"  value="1">Public</option>
                                <option<?php if( $this->formvars['privacy'] == '2') echo 'selected="selected "'?> name="privacy" id="privacy-2"  value="2">Private</option>
                                <option <?php if( $this->formvars['privacy'] == '3') echo 'selected="selected "'?> name="privacy" id="privacy-2"  value="3">Shared</option>     
                        </select>
                </div>
        </div>

        <div class="span2 well" style="height:120px;">
                <div class="control-group row-fluid">
                        <input type='hidden' name='a_i_submitted' id='a_i_submitted' value='1'/>
                        <button id="submit" value='submit' class="offset1 span10 btn btn-success">Submit</button>
                </div>
                <div class="row-fluid">
                        <a class="offset1  span10 btn btn-danger back">Cancel</a>
                </div>
        </div>
</div>


</form>
</fieldset>

</div>
</div>


<script src="./js/custom-form-elements.js"></script>

    <script>
    $('.required').blur(function()
      {
          if( !$(this).val()) 
          {
                console.log('emtpy');
                $(this).siblings('span').filter(":first").removeClass('label-info').removeClass('label-success').addClass('label-important');
          }
          else
          {
            $(this).siblings('span').filter(":first").removeClass('label-important').removeClass('label-info').addClass('label-success');
          }


      });
      for (i = new Date().getFullYear(); i > 1900; i--)
      {

          $('#year').append($('<option />').val(i).html(i));
      }

      jQuery('#add-form').submit(function() {

      });

      $('#year').val(<?=$this->formvars['year']?>);


    </script> 



