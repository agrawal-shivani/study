

<?php
include("db.php");
$name= $_GET['Name'];
$rollno= $_GET['rl'];
$classno= $_GET['cl'];
?>


<html>
<head>
</head>
<body>


<form action="" method="GET">
NAME<input type="text" name="name" value="<?php echo $_GET['Name']; ?>"/><br><br>
ROLLNO<input type="text" name="rollno" value="<?php echo $_GET['rl']; ?>"/><br><br>
CLASS<input type="text" name="class" value="<?php echo "$classno" ;?>"/><br><br>
<input type="submit" name="submit" value="update"/> 
</form> 
</body>
</html>


<?php 
 if(isset($_GET['submit']))
{


	$name=$_GET['name'];
	$rollno=$_GET['rollno'];
	$class=$_GET['class'];

	

	 $query="UPDATE class SET name='$name',classId=$class WHERE roolNo='$rollno'";
	 // value of roolNo is not change bcz it is under where condition.
	 echo "$query";

	 $data=mysqli_query($conn,$query);
	 // $total=mysqli_num_rows($data);
	 // echo "$total";



	   if($data)
	  {
	  	echo "<font color='green'>updated successfully.<a href='select.php'>check updated list here</a>";
	  } 
	  else
	  {
	  	echo "Record not updated.<a href='select.php'>check updated list here</a>";
	  } 
	
 }
 
else
 {
	echo "<font color='red'>click on update button to save changes";
 }
 ?>
 
