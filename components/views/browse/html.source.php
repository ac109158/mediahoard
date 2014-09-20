<style>

input::-moz-focus-inner { 
  border: 0; 
}

a {
   outline: 0;
}
option {
    text-align: left;
    font-size: .9em;
    background-color: white;
    color: black;
    width:100%;
    position: relative;
    left:-100px;
    top:30px;
    padding-left: 20px;
}

.css-select {
   -moz-appearance:window;
   text-align: center;
   background-repeat: no-repeat;
   background-position: right;
   outline:0;
   font-size: 20pt;
   height:50px;
   min-width:120;
   max-width: 140px;
}

@-moz-document url-prefix() {
.css-select-moz{
     font-size: 20pt;
     background-repeat: no-repeat;
     background-position:right;
     padding-right: 20px;
     outline: 0;
     height:50px;
     min-width: 120px;
     max-width: 140px;
  }
} 

</style>


<div class="row-fluid" style="font-size:2em; background:#DBDBDB; padding:0px 5px; border-radius: 5px;" >
    <div class="span12"></div>
    <div class="span12">
        <div class="span9">
        <form class="form-search" action="index.php?controller=dashboards&task=display&view=browse&option=filter&action=setFilter" method ="POST">
        <span style="font-size:1.5em;"class="css-select-moz">Hoard</span><br>
        <div class="span12"></div>
        <select class="css-select" id="filter" name="filter">
            <option name="category" id="category-0"  value="0">All</option>
            <option name="category" id="category-1"  value="1">Books</option>
            <option name="category" id="category-2"  value="2">Movies</option>
            <option name="category" id="category-2"  value="3">Music</option>
            <option name="category" id="category-4"  value="4">Games</option>
            <option name="category" id="category-5"  value="5">Other</option>
            <!-- <option id="category-6"  value="5">Link</option>
            <option id="category-7"  value="5">Image</option>
            <option id="category-8"  value="5">Warranty</option>
            <option id="category-9"  value="5">Other</option> -->
        </select>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span5">
        <?php if ( $this->alertMessage != null)
        {
            echo '<div id="alert" class="span12' . $this->alertDisplay .'">';
            echo '<div class="' . $this->alertType .'">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>' . $this->alertHeader .'</strong> ' .  $this->alertMessage ;
            echo '</div>';
            echo '</div>';

        }
        ?>
    </div>
    
</div>
<div class="row-fluid">
    <div class="span12">
    <select class="span3" id="filter2" placeholder="Type" name="filter2">
            <option name="type" id="type-0"  value="0">All Types</option>
            <option name="type" id="type-1"  value="1">Hard Copy</option>
            <option name="type" id="type-2"  value="2">Digital</option>
            <option name="type" id="type-2"  value="3">Online </option>
            <option name="type" id="type-4"  value="4">Susbcription</option>
            <option name="type" id="type-5"  value="5">Other</option>
            <!-- <option id="type-6"  value="5">Link</oType - ption>
            <option id="type-7"  value="5">Image</option>
            <option id="type-8"  value="5">Warranty</option>
            <option id="type-9"  value="5">Other</option> -->
    </select> 
    <select id="filter3" name="filter3" placeholder="<?=$this->filter3?>" class="span3" data-style="btn-inverse">
    <option name="field" value="title" selected="selected">Search by Title</option>
    <option name="field" value="status">Search by Status</option>
    <option name="field" value="location">Search by Location</option>
    <option name="field" value="description">Search by Description</option>
    </select>


    <div class="input-append">
    <input  type="text" id="searchFilter" name="searchFilter"  placeholder = "Look for ..." class="span12">
    <input type='hidden' name='s_f_i_submitted' id='s_f_i_submitted' value='1'/>
    <button type="submit" class="btn"><i class="icon-search"></i></button>
    </div>
    </div>
</div>
    </form>

    <form>
    <table class="table table-hover table-striped table-bordered">
    
    <thead>    
    <tr>
    <?php 
    if ($_SESSION['role'] == '2')
    {
        echo '<th style="width:0px;"><input disabled="disabled" class="check-all" type="checkbox"></th>';
    }
    ?>
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


    <script type="text/javascript">
    var checkboxes = $("input[type='checkbox']");
    $('#check-all').on('click', function () {$(checkboxes).prop('checked', true)});
    $('input.itembox').on('click', function() 
    {
        $('#delete-button').removeClass('hidden');
    });
    $('#delete-button').attr("disabled");
    checkboxes.click(function() {
    $('#delete-button').attr("disabled", !checkboxes.is(":checked"));
    });
    $("#filter").val('<?=$this->filter?>');
    $("#filter2").val('<?=$this->filter2?>');
    $("#filter3").val("<?=$this->filter3?>");               
    $("#searchFilter").val("<?=$this->searchFilter?>");               


    </script>

