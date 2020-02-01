
<style>
td{
	padding: 10px; 
}
</style>	

<?php
// 
include("db.php");
$query="SELECT * FROM class";

// echo "$query";
$data=mysqli_query($conn, $query);
$total=mysqli_num_rows($data);
echo"$total";
// $result=mysqli_fetch_assoc($data);


if ($total !=0) {
?>

	<table>

		<tr>
			<th>id</th>
			<th>name</th>
			<th>roolNo</th>
			<th>classId</th>
						
		 </tr>

		
<?php	 

	while ($result=mysqli_fetch_assoc($data))
{
	    // echo $result['name']." ". $result['roolNo']." ". $result[classId]."    ";
	    // echo " <a href='update.php'>edit</a>"."</br>";
		echo "<tr>
		      <td>".$result['id']."</td>

		     <td>".$result['name']."</td>
		     <td>".$result['roolNo']."</td>
		     <td>".$result['classId']."</td>
		    <td><a href='update.php?Name=$result[name]&rl=$result[roolNo]&cl=$result[classId]'>Edit</a></td>
		    <td><a href='delete.php?Name=$result[name]' onclick='return checkdelete()'>Delete</a></td>




		</tr>";

		# code...
	}
}
else
{
	echo "NO record found";
}
// echo $result['name']." ".$result['roolNO']." ".$result['classId'];
//  for(int i=0;i<=$total;i++)
// {
//   echo $result['name']." ". $result['roolNo']." ". $result[classId];
// }
 // $result['name']." ".$result['roolNO']." ".$result
?>
</table>
<script>
	function checkdelete()
	{
		return confirm('Are u sure you want  to delete this data? ');
	}
</script>>
