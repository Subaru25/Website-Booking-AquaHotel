<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'hotel';


$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

$is_room_available = false;
$error_message = "";

if (isset($_POST['search'])) {
    $check_in_date = isset($_POST['check_in']) ? $_POST['check_in'] : null;
    $check_out_date = isset($_POST['check_out']) ? $_POST['check_out'] : null;
    $room_id = isset($_POST['room_id']) ? $_POST['room_id'] : null; 

    if ($check_in_date && $check_out_date && $room_id) {
        if ($check_in_date >= $check_out_date) {
            $error_message = "Ngày trả phòng phải sau ngày nhận phòng.";
        } else {
            $check_in_datetime = $check_in_date . " 00:00:00";  
            $check_out_datetime = $check_out_date . " 23:59:59"; 

            echo "Room ID: $room_id <br>";
            echo "Check-in: $check_in_datetime <br>";
            echo "Check-out: $check_out_datetime <br>";

            $sql = "SELECT * FROM thanh_toan 
                    WHERE room_id = ? 
                    AND (check_in < ? AND check_out > ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sss', $room_id, $check_out_datetime, $check_in_datetime);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $error_message = "Phòng đã được đặt trong khoảng thời gian từ <strong>$check_in_date</strong> đến <strong>$check_out_date</strong>. Vui lòng chọn ngày khác.";
            } else {
                $is_room_available = true;
            }
            $stmt->close();
        }
    } else {
        $error_message = "Vui lòng chọn ngày nhận phòng, ngày trả phòng và ID phòng.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm phòng trống</title>
    <link rel="stylesheet" href="tim_kiem.css">
</head>
<body>
    <div class="container">
        <h1>Tìm kiếm phòng trống</h1>

        <form method="POST" action="">
            <?php
            $current_date = date('Y-m-d');
            ?>
            <label for="room_id">ID phòng:</label>
            <select name="room_id" id="room_id" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <br><br>

            <label for="check_in">Ngày nhận phòng:</label>
            <input type="date" id="check_in" name="check_in" min="<?php echo $current_date; ?>" required>
            <br><br>

            <label for="check_out">Ngày trả phòng:</label>
            <input type="date" id="check_out" name="check_out" min="<?php echo $current_date; ?>" required>
            <br><br>

            <button type="submit" name="search">Tìm phòng trống</button>
        </form>

        <?php 
        if (isset($_POST['search'])) {
            if ($error_message) {
                echo "<div class='error-message'>$error_message</div>";
            } elseif ($is_room_available) {
                echo "<div class='success-message'>Phòng trống có sẵn cho ngày nhận phòng <strong>$check_in_date</strong> và ngày trả phòng <strong>$check_out_date</strong>!</div>";
                echo "<a href='room_detail.php?roomid=$room_id&userid=-1' class='btn-go-back'>Xem phòng</a>";
            }
        }
        ?>

        <a href="index.php" class="btn-go-back">Trang chủ</a>
    </div>
</body>
</html>
