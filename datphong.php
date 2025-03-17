<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin phòng</title>
    <link rel="icon" href="./img/core-img/favion-width.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="datphong.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>
    <?php
    if (session_status()) {
        session_start();
    }
    
    if ($_SESSION['uid']==-1) {
      header("location:login.php");
    }

    $conn = mysqli_connect("localhost", "root", "", "hotel");
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }


    $room_id = isset($_GET['room_id']) ? (int)$_GET['room_id'] : 0;

    $room = null;
    if ($room_id > 0) {
        $stmt = $conn->prepare("SELECT room.*, category.* 
                                FROM room 
                                INNER JOIN category ON room.category_id = category.category_id
                                WHERE room.room_id = ?");
        $stmt->bind_param("i", $room_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $room = $result->fetch_assoc();
        } else {
            echo "<p>Không tìm thấy phòng này.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Phòng không hợp lệ.</p>";
    }
    $conn->close();
    ?>

    <?php
    if (isset($_SESSION['type']) && $_SESSION['type'] == 0) {
        include "header_admin.php";
    } else {
        include "header.php";
    }
    ?>

    <form action="thanhtoan.php" method="POST">
        <input type="hidden" name="room_id" value="<?php echo htmlspecialchars($room['room_id'] ?? ''); ?>">

        <div class="room-detail-container">
            <?php if ($room): ?>
                <h2>Thông tin phòng: <?php echo htmlspecialchars($room['room_name']); ?></h2>
                <p>Giá: <?php echo htmlspecialchars($room['room_price']); ?> VND / ngày</p>
                <p>Loại phòng: <?php echo htmlspecialchars($room['name']); ?></p>
                <p>Diện tích: <?php echo htmlspecialchars($room['room_size']); ?></p>
                <p>Sức chứa: <?php echo htmlspecialchars($room['room_capacity']); ?> người</p>
                <p>Dịch vụ: <?php echo htmlspecialchars($room['room_services']); ?></p>
                <img src="rooms/<?php echo htmlspecialchars($room['room_id']); ?>.jpg" alt="Ảnh phòng" style="width: 100%; max-height: 400px;">

                <div class="booking-container">
                    <label for="check-in">Ngày đặt phòng:</label>
                    <input type="date" id="check-in-date" name="check-in-date" class="flatpickr" disabled>


                    <label for="check-in">Chọn ngày nhận phòng:</label>
                    <input type="date" id="check-in" name="check-in" class="flatpickr" placeholder="Chọn ngày bắt đầu">

                    <label for="check-out">Chọn ngày trả phòng:</label>
                    <input type="date" id="check-out" name="check-out" class="flatpickr" placeholder="Chọn ngày trả phòng">
                </div>
            <?php endif; ?>
        </div>

        <div class="customer-info">
            <h3>NHẬP THÔNG TIN KHÁCH HÀNG ĐẶT PHÒNG</h3>
            <label for="customer-name">Họ và tên:</label>
            <input type="text" id="customer-name"
                value="<?php echo isset($_SESSION['firstname'], $_SESSION['lastname'])
                            ? htmlspecialchars($_SESSION['firstname'] . ' ' . $_SESSION['lastname'])
                            : ''; ?>"
                name="customer_name"
                required
                placeholder="Nhập tên người đặt phòng">

            <label for="customer-email">Email:</label>
            <input type="email" id="customer-email"
                value="<?php echo isset($_SESSION['email'])
                            ? htmlspecialchars($_SESSION['email'])
                            : ''; ?>"
                name="customer_email"
                required
                placeholder="Nhập email của bạn">

            <label for="customer-phone">Số điện thoại:</label>
            <input type="tel" id="customer-phone"
                name="customer_phone"
                required
                placeholder="Nhập số điện thoại của bạn">
        </div>


        <div class="payment-btn-container">
            <button type="submit" id="payment-btn" class="btn view-detail-btn btn">Đặt phòng</button>
        </div>
    </form>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        const currentDate = `${yyyy}-${mm}-${dd}`;

        const checkIndateInput = document.getElementById("check-in-date");
    
        const checkInInput = document.getElementById("check-in");
        const checkOutInput = document.getElementById("check-out");

        
        checkIndateInput.setAttribute("min", currentDate);
        checkIndateInput.value = currentDate;
       

        checkInInput.setAttribute("min", currentDate);
        checkInInput.value = currentDate;
        checkOutInput.setAttribute("min", currentDate);

        checkInInput.addEventListener("change", function() {
            const checkInDate = checkInInput.value;
            checkOutInput.setAttribute("min", checkInDate);
        });

        document.getElementById("payment-btn").addEventListener("click", function(event) {
            const customerName = document.getElementById("customer-name").value.trim();
            const customerEmail = document.getElementById("customer-email").value.trim();
            const customerPhone = document.getElementById("customer-phone").value.trim();
            const checkOutDate = checkOutInput.value.trim();

            if (!customerName || !customerEmail || !customerPhone || !checkOutDate) {
                event.preventDefault();
                alert("Vui lòng nhập đầy đủ thông tin để đặt phòng.");
            } else if (isNaN(customerPhone) || customerPhone.length < 9 || customerPhone.length > 10) {
                event.preventDefault();
                alert("Số điện thoại không hợp lệ.");
            }
        });
    </script>
</body>

</html>