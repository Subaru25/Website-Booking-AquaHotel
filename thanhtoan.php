<?php
session_start();

$conn = new mysqli("localhost", "root", "", "hotel");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_id = $_POST['room_id'] ?? 0;
    $customer_id = $_SESSION['$customer_id'] ?? '';
    $customer_name = $_POST['customer_name'] ?? '';
    $customer_email = $_POST['customer_email'] ?? '';
    $customer_phone = $_POST['customer_phone'] ?? '';
    $check_in = $_POST['check-in'] ?? '';
    $check_out = $_POST['check-out'] ?? '';

    if (empty($customer_name) || empty($customer_email) || empty($customer_phone) || empty($check_in) || empty($check_out)) {
        die("Thông tin khách hàng hoặc thời gian không đầy đủ.");
    }

    $stmt = $conn->prepare("SELECT * FROM room WHERE room_id = ?");
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();
    } else {
        die("Không tìm thấy phòng này.");
    }

    $stmt->close();
    $conn->close();
} else {
    die("Không có dữ liệu gửi tới.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="thanhtoan.css">
</head>

<body>
<div class="container">
    <h1>Thông tin đặt phòng</h1>
    <p><strong>Tên khách hàng:</strong> <?php echo htmlspecialchars($customer_name); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($customer_email); ?></p>
    <p><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($customer_phone); ?></p>
    <p><strong>Ngày nhận phòng:</strong> <?php echo htmlspecialchars($check_in); ?></p>
    <p><strong>Ngày trả phòng:</strong> <?php echo htmlspecialchars($check_out); ?></p>

    <h2>Thông tin phòng</h2>
    <p><strong>Tên phòng:</strong> <?php echo htmlspecialchars($room['room_name']); ?></p>
    <p><strong>Giá phòng:</strong> <?php echo number_format($room['room_price'], 0) . '.000 VND'; ?> / ngày</p>

    <h2>Tổng tiền</h2>
    <?php
    $check_in_date = new DateTime($check_in);
    $check_out_date = new DateTime($check_out);
    $interval = $check_in_date->diff($check_out_date);
    $days_stayed = $interval->days;

    $total_price = $days_stayed * $room['room_price'];
    echo "<p><strong>Tổng tiền:</strong> " . number_format($total_price, 0) . ".000 VND</p>";
    ?>

    <form action="xulythanh_toan.php" method="POST" id="nhan">
        <input type="hidden" name="room_id" value="<?php echo htmlspecialchars($room_id); ?>">
        <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($customer_id); ?>">
        <input type="hidden" name="customer_name" value="<?php echo htmlspecialchars($customer_name); ?>">
        <input type="hidden" name="customer_email" value="<?php echo htmlspecialchars($customer_email); ?>">
        <input type="hidden" name="customer_phone" value="<?php echo htmlspecialchars($customer_phone); ?>">
        <input type="hidden" name="check-in" value="<?php echo htmlspecialchars($check_in); ?>">
        <input type="hidden" name="check-out" value="<?php echo htmlspecialchars($check_out); ?>">
        <input type="hidden" name="total_price" value="<?php echo htmlspecialchars($total_price); ?>">

        <button type="button" onclick="confirmPayment()">Thanh toán</button>
        <button type="button" onclick="window.location.href='room.php';">Quay lại trang đặt phòng</button>
    </form>

    <script>
        function confirmPayment() {
            if (confirm("Bạn có chắc chắn muốn thanh toán không?")) {
                document.getElementById("nhan").submit();
            } else {
                alert("Bạn đã hủy thanh toán thành công.");
            }
        }
    </script>
</div>
</body>
</html>
