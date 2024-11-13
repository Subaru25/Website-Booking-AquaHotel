<!DOCTYPE html>
<html>
<body>
	<?php
	$rid=$_GET['rid'];
	$conn=mysqli_connect("localhost","root","","hotel");
	if(!$conn)
	{
		die("Can't connect".mysqli_connect_error());
	}
	$sql="DELETE FROM room WHERE room_id=$rid";
	if (mysqli_query($conn,$sql)) {
		header("location:admin_room.php");
	}
	else
	{
		echo "<script>alert('Can't delete row!')</script>";
	}
	mysqli_close($conn);
	?>
</body>
</html>