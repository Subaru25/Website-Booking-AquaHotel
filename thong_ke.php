<?php 
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    $conn = mysqli_connect("localhost", "root", "", "hotel");
    if(!$conn){
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    $sql_statistic = 'SELECT room_status, COUNT(*) AS total FROM room GROUP BY room_status';
    $result_statistic = mysqli_query($conn, $sql_statistic);
    
    $sql_revenue = 'SELECT SUM(room_price) AS total_revenue FROM room WHERE room_status = "Đã đặt"';
    $result_revenue = mysqli_query($conn, $sql_revenue);
    $revenue_data = mysqli_fetch_assoc($result_revenue);

    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê phòng</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="room.css">
    <link rel="stylesheet" href="thong_ke.css">
</head>
<body>
<?php 
        if(isset($_SESSION['type']) && $_SESSION['type'] == 0){
            include "header_admin.php";
        }else{
            include "header.php";
        }
    ?>
    <div class="room-statistics">
        <h2>Thống kê phòng</h2>
        <div class="statistics-content">
            <?php while ($stat = mysqli_fetch_assoc($result_statistic)) { ?>
                <p><strong>Phòng <?php echo ($stat['room_status'] == 'Trống') ? 'trống' : 'đã đặt'; ?>:</strong> <?php echo $stat['total']; ?> phòng</p>
            <?php } ?>
            <p><strong>Tổng doanh thu từ các phòng đã đặt:</strong> <?php echo number_format($revenue_data['total_revenue'], 0, ',', '.') . ' VND'; ?></p>
        </div>
    </div>
                <?php 
                    include 'footer.php';
                ?>
</body>
</html>
