<?php
include("db.php");
$name=$_GET['Name'];
$query="DELETE FROM class where name='$name'";
$data=mysqli_query($conn,$query);
if($data)
{
	// echo "row deleted.<a href='select.php'>check updated list here</a>";
    echo "row deleted"; 
    ?>

    <META HTTP-EQUIV="Refresh" CONTENT="0 URL=http://localhost/php/select.php">  



    <?php
}
else
{
	echo "unable to delete the row";
}


?>
