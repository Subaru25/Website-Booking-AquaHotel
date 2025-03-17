<?php
session_start(); 


$conn = mysqli_connect("localhost", "root", "", "hotel");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['room_id'])) {

    $room_id = mysqli_real_escape_string($conn, $_POST['room_id']);
    $customer_id = $_SESSION['uid'] ?? ''; 
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
    $customer_phone = mysqli_real_escape_string($conn, $_POST['customer_phone']);
    $check_in = mysqli_real_escape_string($conn, $_POST['check-in']);
    $check_out = mysqli_real_escape_string($conn, $_POST['check-out']);
    $total_price = mysqli_real_escape_string($conn, $_POST['total_price']);


    if (empty($room_id) || empty($customer_id) || empty($customer_name) || empty($customer_email) || empty($customer_phone) || empty($check_in) || empty($check_out) || $total_price <= 0) {
        die("Dữ liệu không hợp lệ hoặc không đầy đủ.");
    }

    $sql = "INSERT INTO thanh_toan (room_id, customer_id, customer_name, customer_email, customer_phone, check_in, check_out, total_price)
            VALUES ('$room_id', '$customer_id', '$customer_name', '$customer_email', '$customer_phone', '$check_in', '$check_out', '$total_price')";
    if (mysqli_query($conn, $sql)) {
        $message = "Thanh toán thành công.";
    } else {
        $message = "Lỗi khi thanh toán: " . mysqli_error($conn);
    }
} else {
    $message = "Dữ liệu không hợp lệ.";
}


mysqli_close($conn);
?>




<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Phòng</title>
    <link rel="stylesheet" href="xulythanh_toan.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Thông tin thanh toán</h1>
            <p><?php echo htmlspecialchars($message); ?></p>
        </div>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['room_id'])): ?>
            <table class="info-table">
                <tr>
                    <th>ID phòng</th>
                    <td><?php echo htmlspecialchars($room_id); ?></td>
                </tr>
                <tr>
                    <th>Tên khách hàng</th>
                    <td><?php echo htmlspecialchars($customer_name); ?>(<?php echo htmlspecialchars($customer_id); ?>)</td>
                </tr>
                <tr>
                    <th>Email khách hàng</th>
                    <td><?php echo htmlspecialchars($customer_email); ?></td>
                </tr>
                <tr>
                    <th>Số điện thoại</th>
                    <td><?php echo htmlspecialchars($customer_phone); ?></td>
                </tr>
                <tr>
                    <th>Ngày nhận phòng</th>
                    <td><?php echo htmlspecialchars($check_in); ?></td>
                </tr>
                <tr>
                    <th>Ngày trả phòng</th>
                    <td><?php echo htmlspecialchars($check_out); ?></td>
                </tr>
                <tr>
                    <th>Tổng tiền</th>
                    <td><?php echo htmlspecialchars($total_price) . ".000 VND"; ?></td>
                </tr>
            </table>
        <?php endif; ?>

        <div class="button-container">
            <form action="room.php" method="get">
                <button type="submit" class="btn btn-secondary">Quay lại trang đặt phòng</button>
            </form>
            <form action="danh_gia.php" method="get">
                <button type="submit" class="btn btn-primary">Đánh giá và bình luận</button>
            </form>
        </div>
    </div>
</body>
</html>

