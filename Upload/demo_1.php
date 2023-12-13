<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Website</title>
    <link rel="stylesheet" href="demo_2.css">
    

</head>

<body>
    <img src="picture/Logo-DH-Bach-Khoa-HCMUT 1.png" alt="Logo">
        <h2>ĐẠI HỌC QUỐC GIA TP.HCM<br>TRƯỜNG ĐẠI HỌC BÁCH KHOA</h2>
        <p id="info">Họ và tên: 
          <?php 
          include "db/db_insert.php";
          $retrievedVariable1 = "";
          $retrievedVariable2 = "";
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
            <p>Số trang còn lại của bạn là: <span id="page">
              <?php 
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
                   
                  
                
              ?>
              
              <script>
                   

                  setInterval(function() {document.getElementById("page").innerHTML = <?= $page ?>}, 1000);
              </script></span></p>
        </div>
        <div id="time">
            <p>Bạn sẽ nhận được 30 trang miễn phí sau:<span id="countdown"></span></p>
        </div>
        <hr>
    <div id="taskbar">
        <button id="home"><a href="../home.php">Trang chủ</a></button><button id="buy"><a href="../buy.php">Mua trang in</a></button><button
            id="inf"><a href="#">Thông tin sinh viên</a></button><button id="help"><a href="../help.php">Trợ giúp và phản
                hồi</a></button><button id="print"><a href="demo_1.php">In</a></button>
    </div>

    <!-- Submenu for PRINT, shown in a new row -->
    <div class="print-submenu">
        <ul>
            <li><a href="demo_1.php" class="active">Tải tài liệu</a></li>
            <li><a href="../Printproperties/proprint.php">Chỉnh sửa thuộc tính</a></li>
            <li><a href="../Choose printer/choose.php">Chọn máy in</a></li>
        </ul>
    </div>
    <div class="Upload">
        <div class="horizontal-line"></div>
        <div class="box">
            <div class="rectangle"></div>
        </div>
        <div class="box1">
            <p class="p">Hướng dẫn sử dụng dịch vụ</p>
            <div class="frame">
                <div class="div-wrapper">
                    <p class="text-wrapper">Kích thước tối đa cho các tập tin : 500 MB</p>
                </div>
                <div class="div-wrapper-1">
                    <div class="text-wrapper-2">Upload</div>
                </div>
                <div class="div-wrapper-2">
                    <div class="text-wrapper-3">Printer</div>
                </div>
                <div class="div-wrapper-3">
                    <div class="text-wrapper-4">Properties</div>
                </div>
                <img class="arrow" src="picture/arrow.png" />
                <img class="arrow0" src="picture/arrow.png" />
                <div class="div-2">
                    <p class="p">Kiểu dữ liệu hợp lệ :</p>
                    <img class="PDF" src="picture/PDF.png" />
                    <img class="DOC" src="picture/DOC.png" />
                    <img class="PPT" src="picture/PPT.png" />
                    <img class="PNG" src="picture/PNG.png" />
                    <img class="JPEG" src="picture/JPEG.png" />
                </div>
            </div>
        </div>
        <div class="box0">
            <div class="frame0">
                <div class="overlap-group">
                    <div class="rectangle"></div>
                    <a href="demo_2.html" class="text-wrapper">Xác nhận</a>
                </div>
                <div class="overlap">
                    <div class="div"></div>
                    <div class="text-wrapper-2">Hủy</div>
                </div>
                <div class="div-wrapper">
                    <a href="demo_2.php" class="text-wrapper-3">Tải lên</a>
                </div>
                <p class="p">Chọn tài liệu cần in:</p>
                <div class="text-wrapper-4">Thông số cần in:</div>
                <div class="overlap-2">
                    <label for="numberSelect">Số bản cần photo :</label>
                    <select id="numberSelect" name="number">
                        <!-- Tùy chọn từ 1 đến 6 -->
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <!-- Tùy chọn tự điền -->
                        <option value="custom">Tự chọn</option>
                    </select>

                </div>
            </div>
        </div>

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