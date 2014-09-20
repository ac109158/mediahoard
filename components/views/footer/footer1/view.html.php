      </div>

      <hr>

      <footer class="footer">
        <span class='span2'>&copy; Company 2013</span>
      </footer>

    </div> <!-- /container -->

</body>
<?php require_once VIEW . 'dashboard/inc/modal.php';?>
</html>

<!-- Scripts -->
      
 <script src="<?=BOOTSTRAP?>js/bootstrap.js"></script> <?// run Bootstrap?>
  <script src="<?=JS?>custom-form-elements.js"></script> <?// run Bootstrap?>
 <script>
 $(document).ready(function(){
$('a.back').click(function(){
    parent.history.back();
    return false;
});
});
 </script>
