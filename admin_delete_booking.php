<!DOCTYPE html>
<html>
<body>
	<?php
	$room_id=$_GET['room_id'];
	$conn=mysqli_connect("localhost","root","","hotel");
	if(!$conn)
	{
		die("Can't connect".mysqli_connect_error());
	}

    $update_sql = "UPDATE room SET room_status = 'Còn phòng' WHERE room_id = '$room_id'";
    
	$sql="DELETE FROM thanh_toan WHERE room_id=$room_id";

    
	if (mysqli_query($conn,$sql)) {
		header("location:admin_room_booking.php");
	}
	else
	{
		echo "<script>alert('Can't delete row!')</script>";
	}
	mysqli_close($conn);
	?>
</body>
</html>