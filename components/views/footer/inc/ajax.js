// $(document).ready(function() {
//         $('#tab').ajaxForm({
//             target: '#output'
//         });
//     });
$(document).ready(function()
  {
    $("#formID").not('.ignore').validationEngine({promptPosition : "bottomLeft", scroll: false, showOneMessage : true, autoHidePrompt : true, autoHideDelay : 3000});
    //$("#formID").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) });
    $('#formID input').not('.ignore').not('.submit').blur(function(){
      x = $(this).focusout().validationEngine('validate');
      if (x == true || x[1] == true) {
      $(this).removeClass('error');
      $(this).addClass('error');        
      } 
      else 
      {
        $(this).removeClass('error');
         $(this).addClass('validated');
      }
  });
  });
