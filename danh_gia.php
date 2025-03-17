<?php 
    $conn = mysqli_connect("localhost", "root", "", "hotel");
    if(!$conn) {
        die("Kết nối thất bại: " .mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $room_id = $_POST['room_id'];
        $customer_name = $_POST['customer_name'];
        $rating = $_POST['rating'];
        $comment = $_POST['comment'];

        $sql = "INSERT INTO danh_gia (room_id, customer_name, rating, comment) 
        VALUES ('$room_id', '$customer_name', '$rating', '$comment')";
        $result = mysqli_query($conn, $sql);

        if($result) {
            echo "<script>alert('Cảm ơn bạn đã đánh giá!'); window.location.href= 'room.php';</script>";
        }else{
            echo "<script>alert('Có lỗi xảy ra. Vui lòng thử lại!');</script>";
        }
    }

    mysqli_close($conn);
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đánh gái và bình luận</title>
        <link rel="stylesheet" href="danh_gia.css">
    </head>
    <body>
        <div class="container">
            <h1>Đánh giá và bình luận phòng</h1>
            <form action="danh_gia.php" method="POST">
                <div>
                    <label for="room_id">ID phòng</label>
                    <input type="text" id="room_id" name="room_id" required>
                </div>
                <div>
                    <label for="customer_name">Tên khách hàng</label>
                    <input type="text" id="customer_name" name="customer_name" required>
                </div>
                <div>
                    <label for="reting">Đánh giá (1-5 sao):</label>
                    <select name="rating" id="rating" required>
                        <option value="1">1 sao</option>
                        <option value="2">2 sao</option>
                        <option value="3">3 sao</option>
                        <option value="4">4 sao</option>
                        <option value="5">5 sao</option>
                    </select>
                </div>
                <div>
                    <label for="comment">Bình luận</label>
                    <textarea name="comment" id="comment" rows="4" required></textarea>
                </div>
                <button type="submit">Gửi đánh giá</button>
            </form>
        </div>
        
    </body>
    </html>