<!DOCTYPE html>
<html>
<body>
	<?php
	$category_id=$_GET['category_id'];
	$conn=mysqli_connect("localhost","root","","hotel");
	if(!$conn)
	{
		die("Can't connect".mysqli_connect_error());
	}
	$sql="DELETE FROM category WHERE category_id=$category_id";
	if (mysqli_query($conn,$sql)) {
		header("location:edit_room_directory.php");
	}
	else
	{
		echo "<script>alert('Can't delete row!')</script>";
	}
	mysqli_close($conn);
	?>
</body>
</html>