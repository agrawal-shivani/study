<?php

//index.php

include('config.php');

include 'header.php';             

?>
<!DOCTYPE html>
<html>
 <head>
  <title>AJAX</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
 </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center">Multi Select Dynamic Dependent Select box using PHP Ajax</h2>
   <br /><br />
   <div style="width: 500px; margin:0 auto">
    <div class="form-group">
     <label>First Level Category</label><br />
     <select id="first_level" name="first_level[]" class="form-control">
     <?php
        global $id;
        $temp=1;
        $getMaster1 = $master->getSession($id); 
                    if($getMaster1['status'])
                    {
                    foreach ($getMaster1['sessionList'] as $getMaster){                          
      echo '<option value="'.$getMaster["id"].'">'.$getMaster["sessionName"].'</option>';
         }
       }
     ?>
     </select>
    </div>
    <div class="form-group">
     <label>Second Level Category</label><br />
     <select id="second_level" name="second_level[]" class="form-control">
  
     </select>
    </div>
    <div class="form-group">
     <label>Third Level Category</label><br />
     <select id="third_level" name="studentName[]" multiple class="form-control">

     </select>
    </div>
   </div>
  </div>
 </body>
</html>
<script>
$(document).ready(function(){

$(document).on('change','#first_level',function(){
  var ID = $(this).val();
  $.ajax({
  type:'POST',
  url:'auto-load-session-class.php',
  data:'id='+ID,
  success:function(html){
  $('#second_level').html(html);
  // $('#second_level').multiselect('rebuild');
  }
  });
  });

 $(document).on('change','#second_level',function(){   //load student
    var ID1 = $(this).val();
    $.ajax({
    type:'POST',
    url:'load-student-check.php',
    data:'sid='+ID1,
    success:function(data){
    $('#third_level').html(data);
    $('#third_level').multiselect('rebuild');
    }
    });
    });


 $('#third_level').multiselect({
  nonSelectedText: 'Select Third Level Category',
  buttonWidth:'400px'
 });

});
</script>