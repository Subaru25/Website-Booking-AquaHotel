<?php
session_start();
$err="";
$category_id="";
$name="";
$description="";
$type="";

if($_SERVER['REQUEST_METHOD']=="POST")
{
    $category_id=$_POST['category_id'];
    $name=$_POST['name'];
    $description=$_POST['description'];
    $type=$_POST['type'];

    // Kết nối cơ sở dữ liệu
    $conn = mysqli_connect("localhost", "root", "", "hotel");
    if(!$conn)
    {
        die("Can't connect: ".mysqli_connect_error());
    }

    // Thêm dữ liệu vào bảng category
    $sql="INSERT INTO category(category_id, name, description, type) 
          VALUES ('$category_id', '$name', '$description', '$type')";
    if(mysqli_query($conn, $sql))
        echo "<script>alert('Category inserted')</script>";
    else
        echo "<script>alert('Category is not inserted')</script>";

    // Đóng kết nối
    mysqli_close($conn);

    // Điều hướng đến trang khác sau khi thêm thành công
    $arr = $category_id;
    if ($_SERVER['HTTP_REFERER'] == "http://localhost/Roberto-Hotel/index_admin.php") {
        header("location:index.php");
        $_SESSION['category'] = $arr;
    } else {
        header("location:edit_room_directory.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Aqua Hotel &amp; Resort HTML Template</title>

    <link rel="icon" href="./img/core-img/favicon.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <?php
    include "header_admin.php";
    ?>
    
    <div class="hotel-search-form-area">
        <div class="container-fluid" style="margin-top:7px; width: 500px; margin-bottom:7px;">
            <div class="hotel-search-form">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <div style="height: auto; width: 100%;">
                        <div style="display: inline-block;">
                            <label for="category_id" style="margin-bottom: 0px;">Category ID</label><br>
                            <input type="int" placeholder="Enter Category ID" name="category_id" autofocus="autofocus" required="required" style="width:191.50px; height: 44px; margin-top: 0px; padding: 10px; margin-bottom: 5px;margin-right: 0px;">
                        </div>
                        <div style="display: inline-block;">
                            <label for="name" style="margin-bottom: 0px;">Category Name</label><br>
                            <input type="text" placeholder="Category Name" name="name" autofocus="autofocus" required="required" style="width:192px; height: 44px; margin-top: 0px; padding: 10px; margin-bottom: 5px; margin-right: 0px;">
                        </div>
                    </div>
                    <label for="description" style="margin-bottom: 0px;">Description</label>
                    <input type="text" placeholder="Enter Description" name="description" required="required" style="width:100%; height: 44px; padding: 10px; margin-bottom: 5px;">

                    <label for="type" style="margin-bottom: 0px;">Type</label>
                    <input type="text" placeholder="Enter Type" name="type" required="required" style="width:100%; height: 44px; padding: 10px; margin-bottom:5px;">

                    <button type="submit" class="btn roberto-btn mb-50" style="width:50%; margin-bottom: 10px; margin-left: 25%;">Add Category</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    include "footer.php";
    ?>
    
    <!-- **** All JS Files ***** -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/roberto.bundle.js"></script>
    <script src="js/default-assets/active.js"></script>
</body>
</html>
