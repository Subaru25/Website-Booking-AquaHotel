<!DOCTYPE html>
<html>
<body>
	<?php
        $rid=$_GET['roomid'];
        $rname="";
        $cid="";
        $rsize="";
        $rcapacity="";
        $rservice="";
        $rprice="";
        $rnu="";
        
  
        
            $rname=$_POST['roomname'];
            $cid=$_POST['category_id'];
            $rsize=$_POST['roomsize'];
            $rcapacity=$_POST['roomcapacity'];
            $rservice=$_POST['roomservice'];
            $rprice=$_POST['roomprice'];
            $rnu=$_POST['number_room'];

            $conn=mysqli_connect("localhost","root","","hotel");
            if(!$conn)
            {
                die("Can't connect: ".mysqli_connect_error());
            }

            $sql="UPDATE room SET room_name='$rname' ,category_id = '$cid' ,room_size='$rsize',room_capacity='$rcapacity',room_services='$rservice',room_price='$rprice' ,number_room='$rnu' WHERE room_id='$rid' " ;
                   
            if(mysqli_query($conn,$sql))
            {
                header("location:admin_room.php");
            }
         ?>
</body>
</html>