<link rel="stylesheet" href="<?=BOOTSTRAP?>prettyCheckable/prettyCheckable.css">
<script src="<?=BOOTSTRAP?>prettyCheckable/prettyCheckable.js"></script>
<style type="text/css">
    .input-field {
        height:58px;
        overflow: auto;
    }

    .label-wrapper {
        height:58.25px;
        max-height: 58.25px;
    }
    .select-wrapper {
        height:58px;
        max-height: 58px;
    }
    .input-field > input{
        height:35px;
        font-weight: bold;
        text-align: center;
        
        
    }

    .input-field > select{
        height:35px;
        font-weight: bold;
        text-align: center;
        padding-left: 17px;
        padding-top: 8px;
    }

    .field {

    }

    select {
        outline:0;
        outline: none;
    }
    option {
        outline:0;
    }

     .labeler{
        height:35px;
        font-weight: bold;
        text-align: center;
        padding-left: 35px;
    }

.checkbox, .radio {
    width: 19px;
    height: 25px;
    padding: 0 5px 0 0;
    background: url(css/images/checkbox.png) no-repeat;
    display: block;
    clear: left;
    float: left;
}
.radio {
    background: url(css/images/radio.png) no-repeat;
}
.select {
    position: absolute;
    width: 90px; /* With the padding included, the width is 190 pixels: the actual width of the image. */
    height: 21px;
    padding: 0 24px 0 8px;
    color: #fff;
    font: 12px/21px arial,sans-serif;
    /*background: url(css/images/select.png) no-repeat right;*/
    overflow: hidden;
}

</style>



<div class="row-fluid">

        <div class="span12"><!-- sets up row 1 --> 
                <div class="row-fluid"> 
                        <div class="span3 field well"><!-- container --> 



                        <div class="row-fluid">

                            <div class="span12"><div class="span10 offset1 text-center label label-info">Status</div><span ><i id="status-edit" class="icon-edit pull-right"></i><i id="status-update" class="icon-refresh pull-right hidden"></i><span></div>
                        </div>
                        <br>
                        <div id="status-label" class="row-fluid">
                                <div class="span12 label-wrapper"><div id="status-label-text" class="span12 text-center alert labeler"><?=$this->item_info['12']?></div></div>
                        </div> <!-- Title Container --> 
                        <div id="status-input" class="row-fluid hidden input-field">
                                <input id="status" name="status" maxlength="30" value="<?=$this->item_info[12]?>" class="span10 offset1" type="text">    
                        </div>
                </div>

                
                <div class="span6 well"><!-- container --> 
                        <div class="row-fluid">
                                <div class="span12"><div class="span10 offset1 text-center label label-info">Title</div><span ><i id="title-edit"class="icon-edit pull-right"></i><i id="title-update"class="icon-refresh pull-right hidden"></i><span></div>
                        </div>
                        <br>
                        <div id="title-label" class="row-fluid">
                                <div class="span12 label-wrapper"><div id="title-label-text" class="span12 text-center alert labeler"><?=$this->item_info[2]?></div></div>
                        </div>
                        <div id="title-input" class="row-fluid hidden input-field">
                                <input id="title" name="title" maxlength="80" value="<?=$this->item_info[2]?>" class="span10 offset1" type="text">    
                        </div>
                </div>

                <div class="span3 well"><!-- container --> 
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="span10 offset1 text-center label label-info">
                                    Location
                                </div>
                                    <span ><i id="location-edit" class="icon-edit pull-right"></i><i id="location-update"class="icon-refresh pull-right hidden"></i><span>
                                </div>
                            </div>
                            <br>
                            <div id="location-label" class="row-fluid">
                                <div class="span12 label-wrapper">
                                    <div id="location-label-text" class="span10 offset1 text-center alert labeler">
                                        <?=$this->item_info[5]?>
                                    </div>
                                </div>
                             </div>
                            <div id="location-input" class="row-fluid hidden input-field">
                                <input class="span10 offset1" id="location" name="location" value="<?=$this->item_info[5]?>" type="text">    
                            </div>
                        </div>  
                </div>
        </div><!-- close row 1 --> 
</div>




<div class="row-fluid">
        <div class="span12"><!-- sets up row 1 --> 
                <div class="row-fluid">
                        <div class="span2 well"><!-- container -->
                            <!-- Year --> 
                            <div class="row-fluid">
                            <div class="span12">
                                <div class="span8 offset2 text-center label label-info">
                                    Year
                                </div>
                                    <span ><i id="year-edit" class="icon-edit pull-right"></i><i id="year-update"class="icon-refresh pull-right hidden"></i><span>
                                </div>
                            </div>
                            <br>
                            <div id="year-label" class="row-fluid">
                                <div class="span12 select-wrapper">
                                    <div id="year-label-text" class="span10 offset1 text-center alert labeler">
                                        <?=$this->item_info[4]?>
                                    </div>
                                </div>
                             </div>
                            <div id="year-input" class="row-fluid hidden input-field">
                                <select class=" span10 offset1 required" id="year" name="year"  value="<?=$this->formvars['year']?>"></select>   
                            </div>

                            <!-- Content --> 
                            <div class="row-fluid">
                            <div class="span12">
                                <div class="span8 offset2 text-center label label-info">
                                    Content
                                </div>
                                    <span ><i id="content-edit" class="icon-edit pull-right"></i><i id="content-update"class="icon-refresh pull-right hidden"></i><span>
                                </div>
                            </div>
                            <br>
                            <div id="content-label" class="row-fluid">
                                <div class="span12 select-wrapper">
                                    <div id="content-label-text" class="span10 offset1 text-center alert labeler">
                                        <?=$this->item_info[13]?>
                                    </div>
                                </div>
                             </div>
                            <div id="content-input" class="row-fluid hidden input-field">
                                <select class=" span10 offset1 required" id="content" name="content"  value="<?=$this->formvars['content']?>">
                                        <option name="content" id="content-1"  value="1">G</option>
                                        <option name="content" id="content-2"  value="2">PG</option>
                                        <option name="content" id="content-2"  value="3">PG-13</option>
                                        <option name="content" id="content-4"  value="4">R</option>
                                        <option name="content" id="content-5"  value="5">Mature</option>
                                            
                                </select>   
                            </div>

                            <!-- Genre --> 
                            <div class="row-fluid">
                            <div class="span12">
                                <div class="span8 offset2 text-center label label-info">
                                    Genre
                                </div>
                                    <span ><i id="genre-edit" class="icon-edit pull-right"></i><i id="genre-update"class="icon-refresh pull-right hidden"></i><span>
                                </div>
                            </div>
                            <br>
                            <div id="genre-label" class="row-fluid">
                                <div class="span12 select-wrapper">
                                    <div id="genre-label-text" class="span10 offset1 text-center alert labeler">
                                        <?=$this->item_info[10]?>
                                    </div>
                                </div>
                             </div>
                            <div id="genre-input" class="row-fluid hidden input-field">
                                <select class=" span10 offset1 required" id="genre" name="genre"  value="<?=$this->formvars['genre']?>"></select>   
                            </div>

                            <!-- Rating --> 
                            <div class="row-fluid">
                            <div class="span12">
                                <div class="span8 offset2 text-center label label-info">
                                    Rating
                                </div>
                                    <span ><i id="rating-edit" class="icon-edit pull-right"></i><i id="rating-update"class="icon-refresh pull-right hidden"></i><span>
                                </div>
                            </div>
                            <br>
                            <div id="rating-label" class="row-fluid">
                                <div class="span12 select-wrapper">
                                    <div id="rating-label-text" class="span10 offset1 text-center alert labeler">
                                        <?=$this->item_info[10]?>
                                    </div>
                                </div>
                             </div>
                            <div id="rating-input" class="row-fluid hidden input-field">
                                <select class=" span10 offset1 required" id="rating" name="rating"  value="<?=$this->formvars['rating']?>">
                                    <option name="rating" id="category-1"  value="1">Meh</option>
                                    <option name="rating" id="category-2"  value="2">blah</option>
                                    <option name="rating" id="category-2"  value="3">Ok</option>
                                    <option name="rating" id="category-5"  value="4">Awesome</option>
                                    <option name="rating" id="category-6"  value="5">Woot</option>
                                </select>   
                            </div>

                </div>

                
                <div class="span8 well"><!-- container --> 
                        <div class="row-fluid">
                                <div class="span12" style="height:431px"><?php require_once('html.tabs.php'); ?>
                                </div>

                        </div>
                </div>

                 <div class="span2 well"><!-- container --> 

                        <!-- Category --> 
                            <div class="row-fluid">
                            <div class="span12">
                                <div class="span8 offset2 text-center label label-info">
                                    Category
                                </div>
                                    <span ><i id="category-edit" class="icon-edit pull-right"></i><i id="category-update"class="icon-refresh pull-right hidden"></i><span>
                                </div>
                            </div>
                            <br>
                            <div id="category-label" class="row-fluid">
                                <div class="span12 select-wrapper">
                                    <div id="category-label-text" class="span10 offset1 text-center alert labeler">
                                        <?=$this->item_info[6]?>
                                    </div>
                                </div>
                             </div>
                            <div id="category-input" class="row-fluid hidden input-field">
                                <select class=" span10 offset1 required" id="category" name="category"  value="<?=$this->formvars['category']?>">
                                    <option name="category " id="category-1"  value="1">Book</option>
                                    <option name="category " id="category-2"  value="2">Movie</option>
                                    <option name="category " id="category-2"  value="3">Music</option>
                                    <option name="category " id="category-4"  value="4">Game</option>
                                    <option name="category " id="category-5"  value="5">Subscription</option>
                                    <option name="category " id="category-6"  value="5">Link</option>
                                    <option name="category " id="category-7"  value="5">Image</option>
                                    <option name="category " id="category-8"  value="5">Warranty</option>
                                    <option name="category " id="category-9"  value="5">Other</option>
                                </select>   
                            </div>

                            <!-- Type --> 
                            <div class="row-fluid">
                            <div class="span12">
                                <div class="span8 offset2 text-center label label-info">
                                    Type
                                </div>
                                    <span ><i id="type-edit" class="icon-edit pull-right"></i><i id="type-update"class="icon-refresh pull-right hidden"></i><span>
                                </div>
                            </div>
                            <br>
                            <div id="type-label" class="row-fluid">
                                <div class="span12 select-wrapper">
                                    <div id="type-label-text" class="span10 offset1 text-center alert labeler">
                                        <?=$this->item_info[7]?>
                                    </div>
                                </div>
                             </div>
                            <div id="type-input" class="row-fluid hidden input-field">
                                <select class=" span10 offset1 required" id="type" name="type"  value="<?=$this->formvars['type']?>">
                                    <option name="type" id="type-1"  value="1">Hard Copy</option>
                                    <option name="type" id="type-2"  value="2">Digital</option>
                                    <option name="type" id="type-2"  value="3">Online</option>
                                    <option name="type" id="type-4"  value="4">Article</option>
                                    <option name="type" id="type-5"  value="5">Website</option>
                                    <option name="type" id="type-6"  value="5">Link</option>
                                </select>   
                            </div>

                            <!-- Condition --> 
                            <div class="row-fluid">
                            <div class="span12">
                                <div class="span8 offset2 text-center label label-info">
                                    Condition
                                </div>
                                    <span ><i id="condition-edit" class="icon-edit pull-right"></i><i id="condition-update"class="icon-refresh pull-right hidden"></i><span>
                                </div>
                            </div>
                            <br>
                            <div id="condition-label" class="row-fluid">
                                <div class="span12 select-wrapper">
                                    <div id="condition-label-text" class="span10 offset1 text-center alert labeler">
                                        <?=$this->item_info[8]?>
                                    </div>
                                </div>
                             </div>
                            <div id="condition-input" class="row-fluid hidden input-field">
                                <select class=" span10 offset1 required" id="condition" name="condition"  value="<?=$this->formvars['condition']?>">
                                <option name="condition" id="condition-1"  value="1">Poor</option>
                                <option name="condition" id="condition-2"  value="2">Fair</option>
                                <option name="condition" id="condition-2"  value="3">Good</option>
                                <option name="condition" id="condition-4"  value="4">Great</option>
                                <option name="condition" id="condition-5"  value="5">Perfect</option>
                                </select>   
                            </div>

                            <!-- Privacy --> 
                            <div class="row-fluid">
                            <div class="span12">
                                <div class="span8 offset2 text-center label label-info">
                                    Privacy
                                </div>
                                    <span ><i id="privacy-edit" class="icon-edit pull-right"></i><i id="privacy-update"class="icon-refresh pull-right hidden"></i><span>
                                </div>
                            </div>
                            <br>
                            <div id="privacy-label" class="row-fluid">
                                <div class="span12 select-wrapper">
                                    <div id="privacy-label-text" class="span10 offset1 text-center alert labeler">
                                        <?=$this->item_info[9]?>
                                    </div>
                                </div>
                             </div>
                            <div id="privacy-input" class="row-fluid hidden input-field">
                                <select class=" span10 offset1 required" id="privacy" name="privacy"  value="<?=$this->formvars['privacy']?>">
                                        <option name="privacy" id="privacy-1"  value="1">Public</option>
                                        <option name="privacy" id="privacy-2"  value="2">Private</option>
                                        <option name="privacy" id="privacy-2"  value="3">Shared</option>     
                                </select>   
                            </div>
                </div>

        </div><!-- close row 1 --> 
</div>
</div>




</div>

<script>
var id = <?php echo $this->item_info[0];?>;

 for (i = new Date().getFullYear(); i > 1900; i--)
      {

          $('#year').append($('<option />').val(i).html(i));
      }
</script>
<script src="<?php echo VIEW . '/inventory/edit/';?>edit.js" type="text/javascript" charset="utf-8"></script>
