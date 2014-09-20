<link rel="stylesheet" href="<?=BOOTSTRAP?>prettyCheckable/prettyCheckable.css">
<script src="<?=BOOTSTRAP?>prettyCheckable/prettyCheckable.js"></script>
<style type="text/css">
body {
    font-size: 14pt;
}

</style>



<div class="row-fluid">

        <div class="span12"><!-- sets up row 1 --> 
                <div class="row-fluid"> 
                        <div class="span3 well"><!-- container --> 
                        <div class="row-fluid">
                                <div class="span12"><div class="span10 offset1 text-center label label-info">Status</div></div>
                        </div>
                        <br>
                        <div class="row-fluid">
                                <div class="span12"><div class="span12 text-center alert"><?=$this->item_info['status']?></div></div>
                        </div> <!-- Title Container --> 
                </div>

                
                <div class="span6 well"><!-- container --> 
                        <div class="row-fluid">
                                <div class="span12"><div class="span10 offset1 text-center label label-info">Title</div></div>
                        </div>
                        <br>
                        <div class="row-fluid">
                                <div class="span12"><div class="span12 text-center alert"><?=$this->item_info['title']?></div></div>
                        </div>
                </div>

                <div class="span3 well"><!-- container --> 
                        <div class="row-fluid">
                                <div class="span12"><div class="span10 offset1 text-center label label-info">Location</div></div>
                        </div>
                        <br>
                        <div class="row-fluid">
                                <div class="span12"><div class="span12 text-center alert"><?=$this->item_info['location']?></div></div>
                        </div>
                </div>

        </div><!-- close row 1 --> 
        </div>
</div>




<div class="row-fluid">
        <div class="span12"><!-- sets up row 1 --> 
                <div class="row-fluid"> 

                        <div class="span2 well"><!-- container --> 
                        <div class="row-fluid">
                                <div class="span12"><div class="span10 offset1 text-center label label-info">Year</div></div>
                        </div>
                        <br>
                        <div class="row-fluid">
                                <div class="span12"><div class="span12 text-center alert"><?=$this->item_info['year']?></div></div>
                        </div> <!-- Title Container --> 
                        
                        <div class="row-fluid">
                                <div class="span12"><div class="span10 offset1 text-center label label-info">Director</div></div>
                        </div>
                        <br>
                        <div class="row-fluid">
                                <div class="span12"><div class="span12 text-center alert"><?=$this->item_info[13]?></div></div>
                        </div> <!-- Title Container --> 

                         <div class="row-fluid">
                                <div class="span12"><div class="span10 offset1 text-center label label-info">Genre</div></div>
                        </div>
                        <br>
                        <div class="row-fluid">
                                <div class="span12"><div class="span12 text-center alert"><?=$this->item_info[14]?></div></div>
                        </div> <!-- Title Container --> 
                        
                         <div class="row-fluid">
                                <div class="span12"><div class="span10 offset1 text-center label label-info">Rating</div></div>
                        </div>
                        <br>
                        <div class="row-fluid">
                                <div class="span12"><div class="span12 text-center alert"><?=$this->item_info['rating_id']?></div></div>
                        </div> <!-- Title Container --> 

                </div>

                
                <div class="span8 well"><!-- container --> 
                        <div class="row-fluid">
                                <div class="span12" style="height:400px"><?php require_once('html.tabs.php'); ?>
                                </div>

                        </div>
                </div>

                 <div class="span2 well"><!-- container --> 
                        <div class="row-fluid">
                                <div class="span12"><div class="span10 offset1 text-center label label-info">Category</div></div>
                        </div>
                        <br>
                        <div class="row-fluid">
                                <div class="span12"><div class="span12 text-center alert"><?=$this->item_info['category_id']?></div></div>
                        </div>

                        <div class="row-fluid">
                                <div class="span12"><div class="span10 offset1 text-center label label-info">Type</div></div>
                        </div>
                        <br>
                        <div class="row-fluid">
                                <div class="span12"><div class="span12 text-center alert"><?=$this->item_info['type_id']?></div></div>
                        </div>

                        <div class="row-fluid">
                                <div class="span12"><div class="span10 offset1 text-center label label-info">Condition</div></div>
                        </div>
                        <br>
                        <div class="row-fluid">
                                <div class="span12"><div class="span12 text-center alert"><?=$this->item_info['condition_id']?></div></div>
                        </div>

                        <div class="row-fluid">
                                <div class="span12"><div class="span10 offset1 text-center label label-info">Privacy</div></div>
                        </div>
                        <br>
                        <div class="row-fluid">
                                <div class="span12"><div class="span12 text-center alert"><?=$this->item_info['privacy_id']?></div></div>
                        </div>

                </div>

        </div><!-- close row 1 --> 
</div>
</div>



<div class="row-fluid">

        <div class="span12"><!-- sets up row 1 --> 
                <div class="row-fluid"> 


                        <div class="span12 well"><!-- container --> 
                        <div class="row-fluid">
                                <div class="span12"><div class="span10 offset1 text-center label label-info">Image Links to other items in search ...</div></div>
                        </div>
                        <br>
                        <div class="row-fluid thumbnail">
                                <div style="height:108px;" class="span12"> </div>
                        </div> <!-- Title Container --> 
                </div>

        </div><!-- close row 1 --> 
        </div>
</div>