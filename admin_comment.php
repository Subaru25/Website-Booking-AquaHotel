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
	<h2 style="text-align:center; color: #1cc3b2;">Manage Comment</h2>
    <?php
    	$conn=mysqli_connect("localhost","root","","hotel");
		if (!$conn) {
			die("Can't connect".mysqli_connect_error());
		}
		$sql = 'SELECT room.*, signup.*, comment.*
        FROM comment 
        INNER JOIN signup
        ON comment.id = signup.id
        INNER JOIN room
        ON comment.room_id = room.room_id';
        // $sql = 'SELECT * FROM comment';

		$result=mysqli_query($conn,$sql);
		if (mysqli_num_rows($result)>0) {

			echo "<table>
			<tr>
			<th>RoomName</th>
			<th>User</th>
            <th>Comment</th>
            <th>Time</th>

			<th>Edit Rooms</th>
			</tr>
			";
			while ($row=mysqli_fetch_assoc($result)) {
				echo "<tr>
						<td>".$row['room_name']."</td>
                        <td>".$row['firstname']."</td>
						<td>".$row['comment_text']."</td>
                        <td>".$row['comment_date']."</td>


                            <td>
                           
                               
                                <a href='admin_delete_comment.php?comment_id=".$row['comment_id']."'><button type='button'>Delete</button></a>
                            </td>
					  </tr>";
			}
		}
		else{
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