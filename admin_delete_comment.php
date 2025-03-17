<!DOCTYPE html>
<html>
<body>
	<?php
	$comment_id=$_GET['comment_id'];
	$conn=mysqli_connect("localhost","root","","hotel");
	if(!$conn)
	{
		die("Can't connect".mysqli_connect_error());
	}

    
	$sql="DELETE FROM comment WHERE comment_id=$comment_id";

    
	if (mysqli_query($conn,$sql)) {
		header("location:admin_comment.php");
	}
	else
	{
		echo "<script>alert('Can't delete row!')</script>";
	}
	mysqli_close($conn);
	?>
</body>
</html>