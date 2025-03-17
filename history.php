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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th {
            background-color: #1cc3b2;
            padding: 10px;
            text-align: left;
            color: #fff;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #d1f1ed;
        }
        table td, table th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        table td {
            color: #555;
        }
        h2 {
            margin-top: 20px;
        }
    </style>

</head>

<body>
    <?php
    session_start();
    include "header.php";
    ?>
    <h2 style="text-align:center; color: #1cc3b2;">Lịch sử đặt phòng</h2>

    <?php
    // Kết nối tới cơ sở dữ liệu
    $conn = new mysqli("localhost", "root", "", "hotel");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Truy vấn dữ liệu từ bảng thanh_toan
    $stmt = $conn->prepare("SELECT * FROM thanh_toan WHERE customer_id = ?");
    $stmt->bind_param("i", $_SESSION['uid']);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra kết quả
    if ($result->num_rows > 0) {
        echo "<table>
        <tr>
            <th>ID</th>
            <th>Room ID</th>
            <th>Customer Name</th>
            <th>Customer Email</th>
            <th>Customer Phone</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Total Price</th>
            <th>Registration Date</th>
        </tr>";

        // Lặp qua các dòng dữ liệu
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . htmlspecialchars($row['id']) . "</td>
                <td>" . htmlspecialchars($row['room_id']) . "</td>
                <td>" . htmlspecialchars($row['customer_name']) . "</td>
                <td>" . htmlspecialchars($row['customer_email']) . "</td>
                <td>" . htmlspecialchars($row['customer_phone']) . "</td>
                <td>" . htmlspecialchars($row['check_in']) . "</td>
                <td>" . htmlspecialchars($row['check_out']) . "</td>
                <td>" . number_format($row['total_price'], 0) . " VND</td>
                <td>" . htmlspecialchars($row['reg_date']) . "</td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align: center; color: #555;'>No payment records found.</p>";
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();
    ?>

    <!-- JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/roberto.bundle.js"></script>
    <script src="js/default-assets/active.js"></script>
</body>

</html>
