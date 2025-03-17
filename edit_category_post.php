<!DOCTYPE html>
<html>
<body>
	<?php
        $cid=$_GET['category_id'];
        $cname="";
        $cdes="";
        $ctype="";
     
  
        
            $cname=$_POST['name'];
            $cdes=$_POST['description'];
            $ctype=$_POST['type'];
         

            $conn=mysqli_connect("localhost","root","","hotel");
            if(!$conn)
            {
                die("Can't connect: ".mysqli_connect_error());
            }

            $sql="UPDATE category SET name='$cname' ,description='$cdes',type='$ctype' WHERE category_id='$cid' " ;
                   
            if(mysqli_query($conn,$sql))
            {
                header("location:edit_room_directory.php");
            }
         ?>
</body>
</html>