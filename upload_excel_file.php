
<?php 
	include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Excel file in database</title>
</head>
<body>
	
	<?php
	  if (isset($_POST["upload"])) {
	  	// print_r($_FILES["myfile"]);
	  	$filename=$_FILES["myfile"]["name"];
	  	$tmpname=$_FILES["myfile"]["tmp_name"];
	  	// echo $filename;
	  	// echo $tmpname;
	  	//let find the extension of file
	  	$fileExtension=pathinfo($filename,PATHINFO_EXTENSION);
	  	// echo $fileExtension;
	  	//define allowed extension
	  	$allowedType=array('csv');
	  	if (!in_array($fileExtension,$allowedType)) {
	  	
               echo "invalid file extension";
	  		
	  	}
	  	else
	  	{
	  		$handle=fopen($tmpname,"r");
            $str="";
	  		 // print_r(fgetcsv($handle));
             $str="INSERT INTO class1 (NAME,COURSE) VALUES";
	       while (($myData=fgetcsv($handle,1000,','))!==false){
	  			// $id=$myData[0];
	  			$name=$myData[0];
         	  	$course=$myData[1];
                $name=mysqli_real_escape_string($conn,$name);
	  			// echo $name;
	  			$str=$str."('".$name."','".$course."'),";
	  			 
            }
               $str=rtrim($str,',');

                echo $str;
	  			// echo $query."<br>";
                $run=mysqli_query($conn,$str);
	  		
	  		if (!$run) {
	  			die("error in uploading file".mysql_error());

	  		}
	  		else{
	  			echo "file uploaded successfully";
	  		}
	  	}

	  	
	  }
	  ?>
	<form action="" method="POST" enctype="multipart/form-data">
		<h3>upload your excel file</h3>
		<input type="file" name="myfile" value="" accept=".csvshivu">
		<input type="submit" name="upload" value="upload">
		

	</form>

</body>
</html>


