<?php
// Start session
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "", "hotel");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch room ID and validate
if (!isset($_GET['roomid']) || !is_numeric($_GET['roomid'])) {
    die("Invalid room ID.");
}
$rid = intval($_GET['roomid']);

// Fetch room details
$stmt = $conn->prepare("SELECT * FROM room WHERE room_id = ?");
if (!$stmt) {
    die("Error preparing room query: " . $conn->error);
}
$stmt->bind_param("i", $rid);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $rname = htmlspecialchars($row['room_name']);
    $rsize = htmlspecialchars($row['room_size']);
    $rcapacity = htmlspecialchars($row['room_capacity']);
    $rservice = json_decode($row['room_services'], true); // Decode JSON into array
    $rprice = htmlspecialchars($row['room_price']);
} else {
    die("Room not found.");
}

$stmt->close();

// Handle Review Form Submission
if (isset($_POST['submit_review'])) {
    $customer_name = htmlspecialchars($_POST['customer_name']);
    $rating = intval($_POST['rating']);
    $comment = htmlspecialchars($_POST['comment']);

    // Validate rating (should be between 1 and 5)
    if ($rating >= 1 && $rating <= 5) {
        // Insert review into the database
        $review_stmt = $conn->prepare("INSERT INTO danh_gia (room_id, customer_name, rating, comment) VALUES (?, ?, ?, ?)");
        $review_stmt->bind_param("isis", $rid, $customer_name, $rating, $comment);

        if ($review_stmt->execute()) {
            echo "<p class='success'>Your review has been submitted!</p>";
        } else {
            echo "<p class='error'>There was an error submitting your review. Please try again.</p>";
        }

        $review_stmt->close();
    } else {
        echo "<p class='error'>Rating must be between 1 and 5.</p>";
    }
}

// Check if the user has made a payment for this room
$show_review_form = false;
if (isset($_SESSION['uid'])) {
    $customer_id = $_SESSION['uid']; // Get the current user's customer_id
    $payment_check_stmt = $conn->prepare("SELECT * FROM thanh_toan WHERE room_id = ? AND customer_id = ?");
    $payment_check_stmt->bind_param("ii", $rid, $customer_id);
    $payment_check_stmt->execute();
    $payment_result = $payment_check_stmt->get_result();

    // If a payment record exists, show the review form
    $show_review_form = ($payment_result->num_rows > 0);
    $payment_check_stmt->close();
}

// Display Room Info
?>
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

</head>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    if (isset($_SESSION['type'])) {
        if ($_SESSION['type'] == 0) {
            include "header_admin.php";
        } else {
            include "header.php";
        }
    } else {
        include "header.php";
    }
    ?>
      <!-- Projects Area End -->
      <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/16.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">Rooms details</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="room.php">Rooms</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Room</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin: 0 auto; max-width: 900px; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); padding: 20px;">
        <div class="room-info">

            <div class="room-thumbnail" style="margin-bottom: 20px; text-align: center;">
                <img src="rooms/<?php echo $rid; ?>.jpg" alt="Room Image" style="width:100%; height:auto; border-radius: 8px;">
            </div>
            <h3 style="font-size: 24px; text-align: center; color: #333; margin-bottom: 20px;">Room Name: <?php echo $rname; ?></h3>
            <p style="font-size: 16px; margin-bottom: 10px;"><strong>Room Size:</strong> <?php echo $rsize; ?></p>
            <p style="font-size: 16px; margin-bottom: 10px;"><strong>Capacity:</strong> <?php echo $rcapacity; ?></p>

            <?php
            // Loop over the decoded services and display
            foreach ($rservice as $service_id) {
                if ($service_id > 0) {
                    $service_stmt = $conn->prepare("SELECT * FROM service WHERE id = ?");
                    $service_stmt->bind_param("i", $service_id);
                    $service_stmt->execute();
                    $service_result = $service_stmt->get_result();

                    if ($service_result->num_rows > 0) {
                        $service_row = $service_result->fetch_assoc();
                        echo '<span class="badge badge-info">' . htmlspecialchars($service_row["servicename"]) . '</span> ';
                    }

                    $service_stmt->close();
                }
            }
            ?>

            <p style="font-size: 16px; margin-bottom: 20px;"><strong>Price:</strong> <?php echo number_format($rprice, 0, ',', '.'); ?> $</p>
            <a href="datphong.php?room_id=<?php echo $rid; ?>"><button class="btn btn-success w-100">Book Now</button></a>
        </div>

        <!-- Review Form (only shown if payment is made for this room) -->
        <?php if ($show_review_form): ?>
            <div class="review-form" style="margin-top: 30px;">
                <h4 style="font-size: 20px; margin-bottom: 15px;">Leave a Review</h4>
                <form action="" method="POST">
                    <input type="hidden" name="room_id" value="<?php echo $rid; ?>">

                    <div class="form-group">
                        <label for="customer_name">Your Name:</label>
                        <input type="text" id="customer_name" name="customer_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="rating">Rating (1-5):</label>
                        <input type="number" id="rating" name="rating" class="form-control" min="1" max="5" required>
                    </div>

                    <div class="form-group">
                        <label for="comment">Your Review:</label>
                        <textarea id="comment" name="comment" class="form-control" rows="4" required></textarea>
                    </div>

                    <button type="submit" name="submit_review" class="btn btn-primary">Submit Review</button>
                </form>

            </div>
        <?php else: ?>
            <p style="color: #666;">You need to make a payment for this room before leaving a review.</p>
        <?php endif; ?>

        <!-- Display Reviews -->
        <div class="reviews" style="margin-top: 30px;">
            <h4 style="font-size: 20px; margin-bottom: 15px;">Customer Reviews</h4>
            <?php
            // Fetch reviews for this room
            $reviews_stmt = $conn->prepare("SELECT * FROM danh_gia WHERE room_id = ? ORDER BY created_at DESC");
            $reviews_stmt->bind_param("i", $rid);
            $reviews_stmt->execute();
            $reviews_result = $reviews_stmt->get_result();

            if ($reviews_result->num_rows > 0) {
                while ($review = $reviews_result->fetch_assoc()) {
                    echo '<div class="review">';
                    echo '<strong>' . htmlspecialchars($review['customer_name']) . '</strong>';
                    echo ' <span>(' . $review['created_at'] . ')</span>';
                    echo '<div>Rating: ' . $review['rating'] . '/5</div>';
                    echo '<p>' . htmlspecialchars($review['comment']) . '</p>';
                    echo '</div><hr>';
                }
            } else {
                echo "<p>No reviews yet.</p>";
            }
            ?>
        </div>
    </div>

 <!-- Blog Area Start -->
 <section class="roberto-blog-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center wow fadeInUp" data-wow-delay="100ms">
                        <h6>Our Blog</h6>
                        <h2>Latest News &amp; Event</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Post Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-post-area mb-100 wow fadeInUp" data-wow-delay="300ms">
                        <a href="#" class="post-thumbnail"><img src="img/bg-img/2.jpg" alt=""></a>
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <a href="#" class="post-date">13/11/2024</a>
                            <a href="#" class="post-catagory">Event</a>
                        </div>
                        <!-- Post Title -->
                        <a href="#" class="post-title">Khám Phá Aqua Hotel – Nơi Nghỉ Dưỡng Hoàn Hảo Cho Kỳ Nghỉ Của Bạn</a>
                        <p>Aqua Hotel là điểm đến lý tưởng cho kỳ nghỉ với không gian sang trọng, mang đến trải nghiệm nghỉ dưỡng thoải mái du khách...</p>
                        <a href="index.php" class="btn continue-btn"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>

                <!-- Single Post Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-post-area mb-100 wow fadeInUp" data-wow-delay="500ms">
                        <a href="#" class="post-thumbnail"><img src="img/bg-img/3.jpg" alt=""></a>
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <a href="#" class="post-date">13/11/2024</a>
                            <a href="#" class="post-catagory">Event</a>
                        </div>
                        <!-- Post Title -->
                        <a href="#" class="post-title">Kinh Nghiệm Đặt Phòng Tại Aqua Hotel Với Giá Tốt Nhất</a>
                        <p>Để đặt phòng tại Aqua Hotel với giá tốt nhất, hãy theo dõi khuyến mãi, đặt sớm và sử dụng các ưu đãi thành viên...</p>
                        <a href="index.php" class="btn continue-btn"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>

                <!-- Single Post Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-post-area mb-100 wow fadeInUp" data-wow-delay="700ms">
                        <a href="#" class="post-thumbnail"><img src="img/bg-img/4.jpg" alt=""></a>
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <a href="#" class="post-date">13/11/2024</a>
                            <a href="#" class="post-catagory">Event</a>
                        </div>
                        <!-- Post Title -->
                        <a href="#" class="post-title">Câu Chuyện Khách Hàng – Những Trải Nghiệm Tuyệt Vời Tại Aqua Hotel</a>
                        <p>Khách hàng yêu thích Aqua Hotel vì dịch vụ chu đáo, không gian sang trọng và tiện ích cao cấp, tạo nên những kỷ niệm nghỉ dưỡng đáng nhớ...</p>
                        <a href="index.php" class="btn continue-btn"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Blog Area End -->

    <?php include "footer.php"; ?>
</body>

</html>

<?php
$conn->close();
?>
