<div class="span3">
  <div class="well sidebar-nav">
    <center><span class="span12 label date">Today is <?=DATE?></span></center>
     <div class="row span12"></div>
    <center><span class="span12 label label-info"><?=$this->last_logged?></span></center>
    <ul class="nav nav-list">
      <li class="nav-header">Browse Hoard</li>
      <li class="active"><a href="index.php?controller=dashboards&task=display&view=browse&option=filter&filter=2"Link</a>Books</li>
      <li><a "index.php?controller=dashboards&task=display&view=inventory&option=filter&filter=3&filter2=1">Movies</a></li>
      <li><a href="index.php?controller=dashboards&task=display&view=browse&option=filter&filter=3">Music</a></li>
      <li><a href="index.php?controller=dashboards&task=display&view=browse&option=filter&filter=4">games</a></li>
      <li><a href="index.php?controller=dashboards&task=display&view=browse&option=filter&filter=5">Other</a></li>
      <li class="nav-header">My Inventory</li>
      <li><a href="index.php?controller=dashboards&task=display&view=inventory&option=filter&filter=1&filter2=1">My Books</a></li>     
      <li><a href="index.php?controller=dashboards&task=display&view=inventory&option=filter&filter=2&filter2=1">My Movies</a></li>
      <li><a href="index.php?controller=dashboards&task=display&view=inventory&option=filter&filter=3&filter2=1">My Music</a></li>
      <li><a href="index.php?controller=dashboards&task=display&view=inventory&option=filter&filter=4&filter2=1">My Games</a></li>
      <li><a href="#">Link</a></li>
      <li><a href="#">Link</a></li>
      <li class="nav-header">Add New ..</li>
      <li><a href="#">Link</a></li>
      <li><a href="#">Link</a></li>
      <li><a href="#">Link</a></li>
    </ul>
  </div><!--/.well -->
</div><!--/span-->
<div class="span9">
  <script src="<?=FOOTER?>inc/time.js"></script> <?// run time hover?>