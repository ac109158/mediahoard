 <link rel="stylesheet" href="<?=BOOTSTRAP?>prettyCheckable/prettyCheckable.css">
<script src="<?=BOOTSTRAP?>prettyCheckable/prettyCheckable.js"></script>

    <table class="table table-hover table-striped table-bordered">
    <h1><?=$this->filter?></h1>

    <form class="form-search" action="index.php?controller=dashboards&task=display&view=browse&option="<?=$this->filter?>"method ="POST">
    <div class="input-append">
    <input type="text" name="filter" value="<?=$this->filter?>" class="span2 search-query">
    <button type="submit" class="btn"><i class="icon-search"></i></button>
    </div>
    </form>
    
    <thead>    
    <tr>
    <th class="span3">Title</th>
    <th class="span5">Description</th>
    <th class="span1">Year</th>
    <th class="span1">Type</th>
    <th class="span1">Condition</th>
    <th class="span1">Rating</th>
    <th class="span2">Owner</th>
    <th class="span3">Link</th>
    </tr>    
    </thead>    
    
    <tbody>
    <?=$this->browse_list?>   
    </tbody>
    
    </table>