<?php
// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "hotel");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Kiểm tra và lấy giá trị `room_id` từ URL
if (isset($_GET['room_id']) && !empty($_GET['room_id'])) {
    $room_id = mysqli_real_escape_string($conn, $_GET['room_id']);

    // Truy vấn trạng thái hiện tại của phòng
    $sql_check_status = "SELECT room_status FROM room WHERE room_id = '$room_id'";
    $result = mysqli_query($conn, $sql_check_status);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $current_status = $row['room_status'];

        // Chuyển đổi trạng thái
        $new_status = ($current_status === 'Còn phòng') ? 'Hết phòng' : 'Còn phòng';

        // Cập nhật trạng thái mới
        $update_sql = "UPDATE room SET room_status = '$new_status' WHERE room_id = '$room_id'";
        if (mysqli_query($conn, $update_sql)) {
            echo "<script>alert('Trạng thái phòng đã được cập nhật thành $new_status');</script>";
            echo "<script>window.location.href = 'admin_room_booking.php';</script>";
        } else {
            echo "<script>alert('Không thể cập nhật trạng thái phòng: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Không tìm thấy phòng với ID đã cung cấp!');</script>";
        echo "<script>window.location.href = 'admin_room_booking.php';</script>";
    }
} else {
    echo "<script>alert('Không tìm thấy ID phòng để cập nhật!');</script>";
    echo "<script>window.location.href = 'admin_room_booking.php';</script>";
}

// Đóng kết nối
mysqli_close($conn);
?>
