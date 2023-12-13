
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>University Website</title>
    <link rel="stylesheet" href="home.css" />
    <style>
      body {
        margin: 0;
      }

      /* Áp dụng cho tất cả các ảnh trong lớp "full-width-img" */
      .full-width-img {
        width: 100vw;
        height: auto;
        display: block;
        margin: 0 auto;
      }
      
        .image-group img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: auto;
        }
    </style>
  </head>

  <body>
  <img src="Logo-DH-Bach-Khoa-HCMUT 1.png" alt="Logo">
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
            <button id="home"><a href="home.php">Trang chủ</a></button><button id="buy"><a href="buy.php">Mua trang in</a></button><button id="inf"><a href="#"></a>Thông tin sinh viên</button><button id="help"><a href="help.php">Trợ giúp và phản hồi</a></button><button id="print"><a href="./Upload/demo_1.php">In</a></button>
        </div>
    <section class="content">
      <div class="post">
        <div class="post-content">
          <div class="post-detail">
            <h2>
              Ứng dụng in thông minh dành cho sinh viên
            </h2>
            <br>
            <p class="description">
              Dịch vụ in ấn trường Đại học Bách Khoa TPHCM được mở ra đem đến cho sinh viên một lựa chọn mới trong việc in ấn tài liệu. <br> 
              Người dùng dịch vụ có thể tự do lựa chọn kiểu tài liệu mà mình muốn in với những thao tác vô cùng đơn giản và hoàn toàn tự động với thời gian ngắn.   
            </p>
            <button class="btn-post">
              Read more
            </button>
          </div>
        </div>

        <div class="post-img">
          <div class="image-group">
            <img src="https://lh5.googleusercontent.com/xMMIhC0V2Ev3n3sMgusMwcRckRC3Rw-N1OO2jbVCH3YovN17PnzA1MPiGXUSx1__cTpGGqkByokJq__Dco2a-e0GMcbYtdvHVfskzK3YnIpNpsGdjnyaI7q7sthA0PT1iSMk69jwImZb8GqTcA" width ="70%"/>    
          </div>
        </div>
      </div>

      
      <div class="product">
        <h2>
          Các loại máy in sử dụng nhiều nhất
        </h2>
        
        <div class="product-list">
          <div class="product-items">
            <div class="image-group">
              <img src="https://cdn.glitch.global/44dfe08a-9964-4a96-a7f1-c60596117fd2/thumbnails%2Fm%C3%A1y%20in%201.jpg?1700318885435" width="50%"/>
            </div>
            <div class="product-details">
              <h4>
                HP Laser LaserJet MFP 
              </h4>
            </div>              
          </div>
          
          <div class="product-items">
            <div class="image-group">
              <img margin="auto" src="https://cdn.glitch.global/44dfe08a-9964-4a96-a7f1-c60596117fd2/thumbnails%2Fm%C3%A1y%20in%202-2.jpg?1700318465852" width="50%">
            </div>
            <div class="product-details">
              <h4>
                HP Laser LaserJet CP1025
              </h4>
            </div>              
          </div>
          
          <div class="product-items">
            <div class="image-group">
              <img src="https://cdn.glitch.global/44dfe08a-9964-4a96-a7f1-c60596117fd2/thumbnails%2Fm%C3%A1y%20in%203.jpg?1700319087218" width="50%"/>
            </div>
            <div class="product-details">
              <h4>
                Epson Styplus PHOTO
              </h4>
            </div>              
          </div>
          
          <div class="product-items">
            <div class="image-group">
              <img src="https://cdn.glitch.global/44dfe08a-9964-4a96-a7f1-c60596117fd2/thumbnails%2Fm%C3%A1y%20in%204.jpg?1700329278802" width="50%"/>
            </div>
            <div class="product-details">
              <h4>
                HP LaserJet Pro M12A
              </h4>
            </div>              
          </div>
        
          <div class="product-items">
            <div class="image-group">
              <img src="https://cdn.glitch.global/44dfe08a-9964-4a96-a7f1-c60596117fd2/thumbnails%2Fm%C3%A1y%20in%205.jpg?1700329287504" width="50%"/>
            </div>
            <div class="product-details">
              <h4>
                HP Neverstop Laser 1000w
              </h4>
            </div>    
          </div>
          
        </div>
        

        
      </div>
      
    </section>

    <!-- Add other settings fields similarly -->

    <div class="actions">
      <select name="apply-to">
        <option value="whole-document">Whole Document</option>
        <!-- Add other options if needed -->
      </select>
      <button type="button"><a href="'Choose printer'/choose.php"></a>Chọn máy in</button>
      <button type="button"><a href="Upload/demo_1.php"></a>In ngay</button>
      <button type="button"><a href="help.php">Help</a></button>
    </div>
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