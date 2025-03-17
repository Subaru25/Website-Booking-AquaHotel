<?php
    session_start();
?>
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
<?php
// session_start();
// if (!isset($_SESSION['user'])) {
//     header("Location: login.php"); // Redirect to login if the user is not logged in
//     exit();
// }

// Connect to the database
$conn = new mysqli("localhost", "root", "", "hotel");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Validate and sanitize room ID
if (!isset($_GET['roomid']) || !is_numeric($_GET['roomid'])) {
    die("Invalid room ID.");
}
$rid = intval($_GET['roomid']);

// Fetch room details
$stmt = $conn->prepare("SELECT room.*, thanh_toan.* 
FROM room 
INNER JOIN thanh_toan ON room.room_id = thanh_toan.room_id
WHERE room.room_id = ?");

$stmt->bind_param("i", $rid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $rname = htmlspecialchars($row['room_name']);
    $rsize = htmlspecialchars($row['room_size']);
    $rcapacity = htmlspecialchars($row['room_capacity']);
    $rservice = htmlspecialchars($row['room_services']);
    $rprice = htmlspecialchars($row['room_price']);
  
    $tregdate = htmlspecialchars($row['reg_date']);
} else {
    die("Room not found.");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
        
        if(isset($_SESSION['type']))
        {
            if($_SESSION['type']==0) 
            {
                include "header_admin.php";
            }
            else{
                include "header.php";
            }
        }
        else
        {
            include "header.php";
        }
     
        
        
    ?>

    
   
    <!-- Projects Area End -->
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/16.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">Show booking</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                               
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
        <div class="container" style="margin: 0 auto; max-width: 900px; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); padding: 20px;">
            <div class="room-info">
                <div class="room-thumbnail" style="margin-bottom: 20px; text-align: center;">
                    <!-- Display room image -->
                    <img src="rooms/<?php echo $rid; ?>.jpg" alt="Room Image" style="width:100%; height:auto; border-radius: 8px;">
                </div>
                <h3 style="font-size: 24px; text-align: center; color: #333; margin-bottom: 20px;">Room name: <?php echo $rname; ?></h3>
              
                <p style="font-size: 16px; margin-bottom: 10px;"><strong>Room Size:</strong> <?php echo $rsize; ?></p>
                <p style="font-size: 16px; margin-bottom: 10px;"><strong>Capacity:</strong> <?php echo $rcapacity; ?></p>
                <p style="font-size: 16px; margin-bottom: 10px;"><strong>Services:</strong> <?php echo $rservice; ?></p>
                <p style="font-size: 16px; margin-bottom: 20px;"><strong>Price:</strong> <?php echo number_format($rprice, 0, ',', '.'); ?> VND</p>
                <p style="font-size: 16px; margin-bottom: 10px;"><strong>Reg date:</strong> <?php echo $tregdate; ?></p>

                <!-- <a href="booknow.php?roomid='.$row['room_id'].'&userid='.$_SESSION['uid'].'" class="btn view-detail-btn">Click here to Book <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a> -->
              
                </a>
                
            </div>
        </div>
    </div>
        </div>
    </div>
 
    
    
    
    
    
</body>
</html>
