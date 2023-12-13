<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="buy_successful.css">
        <title>Login</title>
    </head>
    <body>
        <img src="Logo-DH-Bach-Khoa-HCMUT 1.png" alt="Logo">
        <h2>ĐẠI HỌC QUỐC GIA TP.HCM<br>TRƯỜNG ĐẠI HỌC BÁCH KHOA</h2>
        <p id="info">Họ và tên: 
          <?php 
            session_start();
            if(isset($_SESSION['variable1']) && isset($_SESSION['variable2'])) {
                $retrievedVariable1 = $_SESSION['variable1'];
                $retrievedVariable2 = $_SESSION['variable2'];
                echo "<strong>".$retrievedVariable1."</strong>". "<br>"; // Hiển thị giá trị của biến 1 đã lưu từ trang trước
                echo "MSSV: ".$retrievedVariable2; // Hiển thị giá trị của biến 2 đã lưu từ trang trước
            } else {
                echo "Biến không tồn tại";
            }
          ?>
        <br>Khoa khoa học và kỹ thuật máy tính</p>
        <hr>
        <div  id="pages">
            <p>Số trang còn lại của bạn là: <?php 
                include "db/db_connect.php";
                function countdown($time) {
                    $remain = time() -  $time + 6 * 60 * 60;
                    return ($remain);
                }
                $sql = " SELECT time_create FROM number_page
                        WHERE mssv = '$retrievedVariable2'";
                $result = mysqli_query($con, $sql);  
                $row = mysqli_fetch_array($result);
                $time = strtotime($row['time_create']);
                $timer = 50;
                $circle_pages = floor(countdown($time)/$timer) * 30;
                $sql1 = " UPDATE number_page SET page_circle = '$circle_pages'
                        WHERE mssv = '$retrievedVariable2'";
                mysqli_query($con, $sql1);  
                

                $sql1 = " SELECT * 
                FROM number_page
                WHERE mssv = '$retrievedVariable2'";
                $result = mysqli_query($con, $sql1);  
                $row = mysqli_fetch_array($result);
                $page = $row['page_increase'] + $row['page_circle'];
                echo $page;
            ?></p>
        </div>
        <div id="time">
            <p>Bạn sẽ nhận được 30 trang miễn phí sau:<span id="countdown"></span></p>
        </div>
        <hr>
        <div id="taskbar">
        <button id="home"><a href="home.php">Trang chủ</a></button><button id="buy"><a href="buy.php">Mua trang in</a></button><button id="inf">Thông tin sinh viên</button><button id="help"><a href="help.php">Trợ giúp và phản hồi</a></button><button id="print">Print</button>
        </div>
        <p>Mua giấy in</p>
        <br>
        <hr>
        <p style="height: 15%"></p>
        <button id="thanks">
            <p>Cảm ơn bạn đã mua hàng</p>
        </button>
        <br>
        <p style="height:10%"></p>
        <button type="submit" id="submit" style="background-color: #5838B3;"><a href="home.php">Về trang chủ</a></button>
        <button type="submit" id="submit" style="background-color: #E31B4B;"><a href="buy.php" style="color: #FFFFFF">Mua tiếp trang in</a></button>
        
    </body>
</html>


<script>
  // Thời gian đích đến (định dạng: "YYYY-MM-DD HH:MM:SS")
  
  
  function startCountdown(endTime) {
  var timer = setInterval(function() {
    var now = new Date().getTime();
    var timeLeft = endTime - now;

    if (timeLeft <= 0) {
      clearInterval(timer);
      // Tại đây, bạn có thể cập nhật thời gian đích mới nếu cần thiết
      var newEndTime = endTime + 1000 * <?php echo $timer?>;/* Thời gian đích mới, ví dụ: endTime + (24 * 60 * 60 * 1000) để thêm 1 ngày */
      startCountdown(newEndTime); // Bắt đầu lại chu kỳ đếm ngược với thời gian đích mới
    } else {
      var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
      var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

      // Hiển thị thời gian đếm ngược
      
      document.getElementById("countdown").innerHTML = days + " ngày " + hours + " giờ "
      + minutes + " phút " + seconds + " giây còn lại";
    }
  }, 1000); // Cập nhật mỗi giây
}
var endTime = "<?php $sql = " SELECT time_create FROM number_page
                              WHERE mssv = '$retrievedVariable2'";
                $result = mysqli_query($con, $sql);  
                $row = mysqli_fetch_array($result);
                $time = $row['time_create'];
                echo $time ;
                ?>";
// Thời gian đích ban đầu
var initialEndTime = new Date(endTime).getTime();
startCountdown(initialEndTime);
</script>