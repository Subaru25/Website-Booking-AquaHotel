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
            $cid=$_GET['category_id'];
            $conn=mysqli_connect("localhost","root","","hotel");
            $cname="";
            $cdes="";
            $ctype="";
        
            if(!$conn)
            {
                die("Can't connect: ".mysqli_connect_error());
            }
            $sql="SELECT * FROM category WHERE category_id=$cid";
            $result=mysqli_query($conn,$sql);
            while ($row=mysqli_fetch_assoc($result)) 
            {
                $cname=$row['name'];
                $cdes=$row['description'];
                $ctype=$row['type'];
            
            }
            mysqli_close($conn);
    ?>
    <?php
        session_start();
        include "header_admin.php";
    ?>
    <h2 style="text-align:center; color: #1cc3b2;">Edit Category</h2>
    <div class="hotel-search-form-area">
            <div class="container-fluid" style="margin-top:7px; width: 500px; margin-bottom:7px;">
                <div class="hotel-search-form">
                    <form action="edit_category_post.php?category_id=<?php echo $cid;?>" method="post">
    
                            <div>
                                <label for="name" style="margin-bottom: 0px;">Category Name</label><br>
                                <input type="text" placeholder="Category Name"  name="name" autofocus="autofocus" autocomplete="name" value="<?php echo $cname;?>" required="required"  style="width:100%;height: 44px; margin-top: 0px; padding: 10px; margin-bottom: 5px;margin-right: 0px;">
                            </div>

                            <div>
                                <label for="description" style="margin-bottom: 0px;">Description</label><br><input type="text" placeholder="description" name="description" autofocus="autofocus" autocomplete="description" value="<?php echo $cdes;?>" required="required" style="width:100%; height: 44px; margin-top: 0px; padding: 10px; margin-bottom: 5px; margin-right: 0px;">
                            </div>

                        	<div>
                                <label for="type" style="margin-bottom: 0px;">Type</label><br><input type="text" placeholder="type" name="type" autofocus="autofocus" autocomplete="type" value="<?php echo $ctype;?>" required="required" style="width:100%; height: 44px; margin-top: 0px; padding: 10px; margin-bottom: 5px; margin-right: 0px;">
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
  
