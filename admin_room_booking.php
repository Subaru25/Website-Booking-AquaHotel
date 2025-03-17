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

    <style>
    	table{
    		width: 100%;
    		border-collapse: collapse;
    	}
    	table th{
    		background-color: #1cc3b2;
    		padding-top: 10px;
    		padding-bottom: 10px;
    		text-align: left;
    	}
    	table tr:nth-child(even){background-color: #f2f2f2;}
    	table tr:hover {background-color: #d1f1ed;}
    	table td,table th{
    		border: 1px solid grey;
    		padding: 8px;
    	}

        table a button{
    
            background-color: #4CAF50; /* Màu xanh lá cây */ 
            border: none; color: white; 
            border-radius: 12px; padding: 6px 15px; 
            text-align: center; text-decoration: none;
            display: inline-block; font-size: 16px; 
            font-weight: bold; /* Đặt cỡ chữ đậm */ 
            cursor: pointer; transition: background-color 0.3s ease;
}

button:hover {
    background-color: #1cc3b2; /* Màu xanh lam */
}

    </style>

</head>

<body>
	<?php
		session_start();
		include "header_admin.php"
	?>
	<h2 style="text-align:center; color: #1cc3b2;">Booking</h2>
    <?php
$conn = mysqli_connect("localhost", "root", "", "hotel");
if (!$conn) {
    die("Can't connect" . mysqli_connect_error());
}

$sql = 'SELECT 
    room.*, 
    thanh_toan.*
    FROM 
        room
    INNER JOIN 
        thanh_toan
    ON room.room_id = thanh_toan.room_id';

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

    echo "<table>
    <tr>
        <th>STT</th>
        
        <th>Room Name</th>
        <th>User</th>
        <th>Check in</th>
        <th>Check out</th>
        <th>Phone</th>
        <th>Status</th>
        <th>Status2</th>
        <th>Edit Rooms</th>
    </tr>";

    $stt = 1; // Khởi tạo số thứ tự
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>" . $stt++ . "</td> <!-- Hiển thị số thứ tự -->
            
            <td>" . "<a id='a' href='show_room_booking.php?roomid=" . $row['room_id'] . "'>" . $row['room_name'] . "</a>" . "</td>
            <td>" . $row['customer_name'] . "</td>
            <td>" . $row['check_in'] . "</td>
            <td>" . $row['check_out'] . "</td>
            <td>" . $row['customer_phone'] . "</td>
            <td>" . $row['room_status'] . "</td>
            <td>" . $row['room_status'] . "</td>
            <td>
                <a href='admin_update_room_booking.php?room_id=" . $row['room_id'] . "'><button type='button'>Confirm</button></a>
                <a href='admin_delete_booking.php?room_id=" . $row['room_id'] . "'><button type='button'>Delete</button></a>
            </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "<script>alert('No users in database!!')</script>";
}
?>


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