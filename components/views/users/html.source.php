 <link rel="stylesheet" href="<?=BOOTSTRAP?>prettyCheckable/prettyCheckable.css">
<script src="<?=BOOTSTRAP?>prettyCheckable/prettyCheckable.js"></script>

   <h1>Users</h1>
    <table class="table table-hover table-striped table-bordered">
    <form class="form-search" action="index.php?controller=dashboards&task=display&view=users&option=filter" method ="POST">
    <select  name="searchFilter"class="selectpicker" data-style="btn-inverse" placeholder="<?=$this->searchFilter?>">
    <option name="nameFilter" value="name" <?php if ($this->searchFilter == 'name') { echo 'selected="selected"';}?>>Search by Name</option>
    <option name="usernameFilter" value="username" <?php if ($this->searchFilter == 'username') { echo 'selected="selected"';}?>>Search by Username</option>
    <option name="emailFilter" value="email" <?php if ($this->searchFilter == 'email') { echo 'selected="selected"';}?>>Search by Email</option>
    <option name="idFilter" value="id" <?php if ($this->searchFilter == 'id') { echo 'selected="selected"';}?>>Search by Id</option>
    </select>
    <div class="input-append">
    <input type="text" name="filter" value="<?=$this->filter?>" placeholder = "Look for ..." class="span2 search-query">
    <button type="submit" class="btn"><i class="icon-search"></i></button>
    </div>
    </form>
    <form class="form-horizontal" action="index.php?controller=dashboards&task=deleteUser&view=users&option=filter>" method="POST">
    <input type='hidden' name='d_u_submitted' id='d_u_submitted' value='1'/>
    <thead id='users'>    
    <tr>
    <th style="width:0px;"><input type="checkbox"></th>
    <th class="span2">Name</th>
    <th class="span2">Username</th>
    <th class="span2">Role</th>
    <th class="span2">Email</th>
    <th class="span2">Last Active</th>
    <th class="span2">Registered</th>
    <th class="span1">ID</th>
    </tr>    
    </thead>    
    
    <tbody>
    <?=$this->user_list?>    
    </tbody>
    </table>

    <button id="delete-button" type="submit" class="btn btn-danger">
  <i class="icon-trash icon-white"></i>Delete
    </button>    
    </form>
    <div class="row-fluid">
    <a href="index.php?controller=dashboards&task=display&view=users&option=add"><div class="row-fluid span2 pull-right btn-success btn-large">
    <span class="icon-plus offset1"></span><span> Add User</span>
    </div></a>
<script>



</script>


