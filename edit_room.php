<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Aqua Hotel &amp; Resort HTML Template</title>

    <!-- Favicon -->
    <link rel="icon" href="./img/core-img/favicon.png">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <?php
            $rid=$_GET['roomid'];
            $conn=mysqli_connect("localhost","root","","hotel");
            $rname="";
            $cid="";
            $rsize="";
            $rcapacity="";
            $rservice="";
            $rprice="";
            $rnu="";
            if(!$conn)
            {
                die("Can't connect: ".mysqli_connect_error());
            }
            $sql="SELECT * FROM room WHERE room_id=$rid";
            $result=mysqli_query($conn,$sql);
            while ($row=mysqli_fetch_assoc($result)) 
            {
                $rname=$row['room_name'];
                $cid=$row['category_id'];
                $rsize=$row['room_size'];
                $rcapacity=$row['room_capacity'];
                $rservice=$row['room_services'];
                $rprice=$row['room_price'];  
                $rnu=$row['number_room'];  
            }
            mysqli_close($conn);
    ?>
    <?php
        session_start();
        include "header_admin.php";
    ?>
    <h2 style="text-align:center; color: #1cc3b2;">Edit Room</h2>
    <div class="hotel-search-form-area">
            <div class="container-fluid" style="margin-top:7px; width: 500px; margin-bottom:7px;">
                <div class="hotel-search-form">
                    <form action="edit_room_post.php?roomid=<?php echo $rid;?>" method="post">
    
                            <div>
                                <label for="roomname" style="margin-bottom: 0px;">Roomname</label><br>
                                <input type="text" placeholder="Roomname"  name="roomname" autofocus="autofocus" autocomplete="roomname" value="<?php echo $rname;?>" required="required"  style="width:100%;height: 44px; margin-top: 0px; padding: 10px; margin-bottom: 5px;margin-right: 0px;">
                            </div>

                                                                   <!-- Dropdown Danh Mục -->
                        <label for="category_id" style="margin-bottom: 0px;">Category</label> <br>
                        <select name="category_id" id="category_id" required style="width:100%; height: 44px; padding: 10px; margin-bottom: 10px;">
                            <option value="" disabled selected>Select a category</option>
                            <option value="1">Single Room</option>
                            <option value="2">Double Room</option>
                            <option value="3">Deluxe Room</option>
                            <option value="4">Standard Room</option>
                            <option value="5">Family Room</option>
                        </select> <br><br>

                            <div>
                                <label for="roomsize" style="margin-bottom: 0px;">Roomsize</label><br><input type="text" placeholder="Roomsize" name="roomsize" autofocus="autofocus" autocomplete="roomsize" value="<?php echo $rsize;?>" required="required" style="width:100%; height: 44px; margin-top: 0px; padding: 10px; margin-bottom: 5px; margin-right: 0px;">
                            </div>

                        	<div>
                                <label for="roomcapacity" style="margin-bottom: 0px;">Roomcapacity</label><br><input type="text" placeholder="Roomcapacity" name="roomcapacity" autofocus="autofocus" autocomplete="roomcapacity" value="<?php echo $rcapacity;?>" required="required" style="width:100%; height: 44px; margin-top: 0px; padding: 10px; margin-bottom: 5px; margin-right: 0px;">
                            </div>

                            <div>
                                <label for="roomservice" style="margin-bottom: 0px;">Roomservices</label><br><input type="text" placeholder="Roomservices" name="roomservice" autofocus="autofocus" autocomplete="roomservice" value="<?php echo $rservice;?>" required="required" style="width:100%; height: 44px; margin-top: 0px; padding: 10px; margin-bottom: 5px; margin-right: 0px;">
                            </div>

                            <div>
                                <label for="roomprice" style="margin-bottom: 0px;">Roomprice</label><br><input type="text" placeholder="Roomprice" name="roomprice" autofocus="autofocus" autocomplete="roomprice" value="<?php echo $rprice;?>" required="required" style="width:100%; height: 44px; margin-top: 0px; padding: 10px; margin-bottom: 5px; margin-right: 0px;">
                            </div>

                            <div>
                                <label for="number_room" style="margin-bottom: 0px;">Room number</label><br><input type="text" placeholder="roomnumber" name="number_room" autofocus="autofocus" autocomplete="number_room" value="<?php echo $rnu;?>" required="required" style="width:100%; height: 44px; margin-top: 0px; padding: 10px; margin-bottom: 5px; margin-right: 0px;">
                            </div>

                        <button type="submit" class="btn roberto-btn mb-50" style="width:50%; margin-bottom: 10px; margin-left: 25%;">Edit</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
        include "footer.php";
    ?>
    
    <!-- **** All JS Files ***** -->
    <!-- jQuery 2.2.4 -->
    <script src="js/jquery.min.js"></script>
    <!-- Popper -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- All Plugins -->
    <script src="js/roberto.bundle.js"></script>
    <!-- Active -->
    <script src="js/default-assets/active.js"></script>
</body>
</html>
  
