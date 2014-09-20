<!-- <div class="container-fluid"> <!-- add user form --> 
<div class="row-fluid">
        <div class="span12">
            <div class="box">
                <div class="row-fluid">
                    <div class="span12">                        
                        <div class="modal-body">
                            <ul class="nav nav-tabs nav-pills">
                                <li  class="nav-pill active"><a href="#login" data-toggle="tab">Image</a></li>
                                <li class="nav-pill"><a href="#profile" data-toggle="tab">Description</a></li>
                                <li class="nav-pill"><a href="#shipping" data-toggle="tab">Review </a></li>
                                <li class="nav-pill"><a href="#mailing" data-toggle="tab">Comments</a></li>
                                <a class="badge badge-important pull-right back" href="#close" data-toggle="tab">Close</a>
                            </ul>
                        </div>
                    </div>
                </div>                    
                <div class="row-fluid"> 
                    <div class="span12">    
                        <div id="imageContent" style="overflow:hidden;"class="tab-content">              
                            <div class="row-fluid">
                                <div class="span7">                                                    
                                    <ul class="thumbnails hidden-phone">
                                        <li class="span12">
                                            <div style="height:250px;" class="thumbnail">
                                                <img id="item-image" data-src="holder.js/300x200" src="<?=$this->image_info[1]?>" Style ="max-height:200px; max-width:300px;" alt="">
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="span12">Thumbnail labels        </div>
                                    <div class="span12">Thumbnail caption...</div>
                                </div>
                                <div class="span5">
                                    <form id="imageForm" action="http://acook.php.cs.dixie.edu/cs4000/media/index.php?controller=dashboards&task=addFile&view=inventory&option=edit&id=<?=$this->id?>" method="post" enctype="multipart/form-data">                                                       
                                        <label class="span12" for="file">Filename:</label>
                                        <input class="span12"  type="file" name="file" id="file"><br><br>
                                        <label class="span12" for="file">URL Path:</label>Send 
                                        <input class="span12" type="url" name="url" id="url"><br>
                                        <input type='hidden' name="id" value="<?=$this->id?>"/>
                                        <input class="span8 offset2" type="submit" value="Submit">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>                
    </div>