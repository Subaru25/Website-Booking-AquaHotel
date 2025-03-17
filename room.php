<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$conn = mysqli_connect("localhost", "root", "", "hotel");

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

$chon_phong = "";
if (isset($_GET['category_id']) && $_GET['category_id'] != "") {
    $chon_phong = " WHERE room.category_id = " . mysqli_real_escape_string($conn, $_GET['category_id']);
}

$sql = 'SELECT room.*, category.* 
        FROM room 
        INNER JOIN category 
        ON room.category_id = category.category_id' . $chon_phong;

$result = mysqli_query($conn, $sql);

function getAverageRating($conn, $room_id) {
    $sql = "SELECT AVG(rating) AS avg_rating FROM danh_gia WHERE room_id = " . (int)$room_id;
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $avg_rating = isset($row['avg_rating']) ? $row['avg_rating'] : 0;
    return is_numeric($avg_rating) ? round($avg_rating, 1) : 0;
}

function getBookingCount($conn, $room_id) {
    $sql = "SELECT COUNT(*) AS booking_count FROM thanh_toan WHERE room_id = " . (int)$room_id;
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    return isset($row['booking_count']) ? $row['booking_count'] : 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book phòng</title>
    <link rel="icon" href="./img/core-img/favion-width.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="room.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    if (isset($_SESSION['type']) && $_SESSION['type'] == 0) {
        include "header_admin.php";
    } else {
        include "header.php";
    }
    ?>

    <div class="breadcrumb-area bg-img bg-overlay" style="background: url(img/bg-img/16.jpg);">
        <div class="container h-100">
            <div class="breadcrumb-connect text-center">
                <h2 class="page-title">Our Room</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Room</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="roberto-rooms-area section-padding-100-0">
        <div class="container">
            <h1>DANH MỤC PHÒNG</h1>
            <div class="col-12 col-lg-12">
                <div class="room-type-buttons mb-4">
                    <button><a href="room.php?category_id=1" class="btn room-type-btn">Single room</a></button>
                    <button><a href="room.php?category_id=2" class="btn room-type-btn">Double room</a></button>
                    <button><a href="room.php?category_id=3" class="btn room-type-btn">Deluxe room</a></button>
                    <button><a href="room.php?category_id=4" class="btn room-type-btn">Standard room</a></button>
                    <button><a href="room.php?category_id=5" class="btn room-type-btn">Resort room</a></button>
                    <button><a href="room.php" class="btn room-type-btn">Tất cả</a></button>
                </div>
            </div>

            <div class="col-12">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $room_class = strtolower(str_replace(' ', '-', $row['room_name']));
                        $avg_rating = getAverageRating($conn, $row['room_id']); // Get the correct average rating
                        $room_status = $row['room_status'];
                        $booking_count = getBookingCount($conn, $row['room_id']); // Get the correct booking count
                        $status_message = ($room_status == 'Còn phòng') ? 'Còn phòng' : 'Hết phòng';

                        echo '<div class="room-connect ' . $room_class . ' single-room-area d-flex align-items-center mb-50 visible">
                                <div class="room-thumbnail">
                                    <img src="rooms/' . $row["room_id"] . '.jpg" alt="Room Image">
                                </div>
                                <div class="room-details">
                                    <h2>' . $row["room_name"] . " - " . $avg_rating . " / 5" . '(' . $booking_count . ')</h2>
                                    <h4>Gía : ' . $row["room_price"] . ' VND <span>/ Day</span></h4>
                                    <h5>Type: <span>' . $row["name"] . '</span></h5>
                                    <h6>Status: <span>' . $status_message . '</span></h6>
                                    <div class="room-feature" style="margin-top: 20px;">
                                        <h6>Size: <span>' . $row["room_size"] . ' m²</span></h6>
                                        <h6>Capacity: <span>' . $row["room_capacity"] . ' người</span></h6>
                                        <h6>Bed: <span>King beds</span></h6>

                                        <div class="d-flex flex-wrap mb-4">';
                        // Hiển thị các dịch vụ của phòng
                        $room_services = json_decode($row['room_services'], true); 
                        foreach ($room_services as $service_id) {
                            $service_sql = "SELECT * FROM service WHERE id = $service_id";
                            $service_result = mysqli_query($conn, $service_sql);
                            if (mysqli_num_rows($service_result) > 0) {
                                $service_row = mysqli_fetch_assoc($service_result);
                                // Hiển thị tên và biểu tượng dịch vụ
                                echo '<span class="badge badge-info mr-2 mb-2">' . $service_row["servicename"] . '</span>';
                            }
                        }

                        echo '</div>
                                        <a href="gioithieu.php" class="view-detail-btn">Giới thiệu</a>
                                        <a href="#" class="view-detail-btn" onclick="checkRoomStatus(' . $row['room_id'] . ', \'' . $room_status . '\')">Đặt phòng tại đây</a>
                                        <a href="room_detail.php?roomid=' . $row['room_id']. '" class="view-detail-btn">
                                            View Details <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>';
                    }
                } else {
                    echo "<p>Không có phòng phù hợp với yêu cầu của bạn.</p>";
                }
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
       <!-- Partner Area Start -->
       <div class="partner-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="partner-logo-content d-flex align-items-center justify-content-between wow fadeInUp" data-wow-delay="300ms">
                        <!-- Single Partner Logo -->
                        <a href="#" class="partner-logo"><img src="img/core-img/p1.png" alt=""></a>
                        <!-- Single Partner Logo -->
                        <a href="#" class="partner-logo"><img src="img/core-img/p2.png" alt=""></a>
                        <!-- Single Partner Logo -->
                        <a href="#" class="partner-logo"><img src="img/core-img/p3.png" alt=""></a>
                        <!-- Single Partner Logo -->
                        <a href="#" class="partner-logo"><img src="img/core-img/p4.png" alt=""></a>
                        <!-- Single Partner Logo -->
                        <a href="#" class="partner-logo"><img src="img/core-img/p5.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Partner Area End -->

    <?php include 'footer.php'; ?>

    <script>
        function checkRoomStatus(roomId, status) {
            if (status === 'Hết phòng') {
                alert('Phòng này đã được đặt. Bạn không thể đặt nữa!');
            } else {
                window.location.href = 'datphong.php?room_id=' + roomId;
            }
        }

        function filterRooms(room_name) {
            let rooms = document.querySelectorAll('.room-connect');
            rooms.forEach(function(room) {
                room.classList.remove('visible');
            });

            if (room_name === '') {
                rooms.forEach(function(room) {
                    room.classList.add('visible');
                });
            } else {
                let selectedRooms = document.querySelectorAll('.room-connect');
                selectedRooms.forEach(function(room) {
                    if (room.querySelector('h2').innerText.includes(room_name)) {
                        room.classList.add('visible');
                    }
                });
            }
        }
    </script>

    


    <!-- **** All JS Files ***** -->
    <!-- jQuery 2.2.4 -->
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
