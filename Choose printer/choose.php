<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printing Service</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <img src="image/Logo-DH-Bach-Khoa-HCMUT 1.png" alt="Logo">
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
    <div id="pages">
        <p>Số trang còn lại của bạn là:<span id="page"></span></p>
    </div>
    <div id="time">
        <p>Bạn sẽ nhận được 30 trang miễn phí sau:<span id="remaining"></span></p>
    </div>
    <hr>
    <div id="taskbar">
        <button id="home"><a href="../home.php">Trang chủ</a></button><button id="buy"><a href="../buy.php">Mua trang in</a></button><button
            id="inf"><a href="#">Thông tin sinh viên</a></button><button id="help"><a href="../help.php">Trợ giúp và phản
                hồi</a></button><button id="print"><a href="../Upload/demo_1.php">In</a></button>
    </div>



    <!-- Submenu for PRINT, shown in a new row -->
    <div class="print-submenu">
        <ul>
            <li><a href="../Upload/demo_1.php">Tải tài liệu</a></li>
            <li><a href="../Printproperties/proprint.php">Chỉnh sửa thuộc tính</a></li>
            <li><a href="choose.php" class="active">Chọn máy in</a></li>
        </ul>
    </div>
    <!--  SETTING BOX -->
    <!--  STEP 1 -->
    <div id="step1" class="settings-box">
        <form id="printingForm" onsubmit="return validateForm()">
            <fieldset class="margin-box">
                <legend>CHỌN MÁY IN</legend>
                <div class="row">
                    <div class="column">
                        <label for="building">Chọn hoặc nhập tòa nhà:</label>
                        <select id="building" onchange="updateFloorOptions()">
                            <option value="h1">H1</option>
                            <option value="h2">H2</option>
                            <option value="h3">H3</option>
                            <option value="h6">H6</option>
                        </select>
                    </div>
                    <div class="column">
                        <label for="floor">LẦU</label>
                        <select id="floor" value="1">
                            <!-- Tùy chọn sẽ được cập nhật bằng JavaScript -->
                        </select>
                    </div>
                    <div class="row">
                        <div class="column">
                            <label for="right-margin">ID MÁY IN</label>
                            <input type="text" id="printer-id" placeholder="Nhập ID máy in">
                            <span id="id-error" style="color: red;"></span>
                        </div>
                    </div>
            </fieldset>

            <!-- preview  menu -->
            <fieldset class="preview-box">
                <legend>HƯỚNG DẪN CHỌN MÁY IN</legend>
                <p>-Tòa nhà: chọn tòa nhà nơi có máy in bạn muốn in ở đó</p>
                <p>-Lầu: chọn lầu nơi có máy in còn hoạt động</p>
                <p>-ID: chọn ID máy in còn hoạt động</p>
            </fieldset>

            <div class="actions">
                <button type="button"><i class="fas fa-check"></i> Xác nhận</button>
                <button type="button"><i class="fas fa-times"></i>Hủy</a></button>
                <button type="button"><i class="fas fa-question-circle"></i><a href="../help.php"> Trợ giúp</a></button>
            </div>

        </form>
    </div>


    <div id="step2" class="settings-box2">
        <div class="settings-container">
            <div class="notification-container">
                <div class="notification-icon">
                    <i class="fas fa-check-circle"></i> <!-- Use an SVG or an image here if you prefer -->
                </div>
                <div class="notification-message">
                    <h2>IN THÀNH CÔNG</h2> <!-- This will be below the check icon -->
                
                    <p>Vui lòng đến quầy để nhận thành phẩm</p>
                </div>
            </div>



            <div class="actions2">
                <button id="backButton"><i class="fas fa-house"></i><a href="../home.php">Quay về Trang chủ</a> </button>
                <button id="Help"><i class="fas fa-question-circle"></i><a href="../help.php">Trợ giúp</a></button>
            </div>
        </div>
    </div>
    <script src="run.js"></script>
    <script>
        function updateFloorOptions() {
            // Lấy giá trị của tòa nhà
            var building = document.getElementById("building").value;
            // Lấy thẻ select của lầu
            var floorSelect = document.getElementById("floor");
            // Xóa các tùy chọn cũ
            floorSelect.innerHTML = "";

            // Thêm các tùy chọn mới tùy thuộc vào tòa nhà được chọn
            var maxFloors = 6; // Giá trị mặc định cho H1
            if (building === "h2") {
                maxFloors = 7;
            } else if (building === "h3" || building === "h6") {
                maxFloors = 8;
            }

            // Tạo các tùy chọn từ 1 đến maxFloors
            for (var i = 1; i <= maxFloors; i++) {
                var option = document.createElement("option");
                option.value = i;
                option.text = i;
                floorSelect.add(option);
            }
        }

        // Gọi hàm để cập nhật tùy chọn lầu khi trang được tải
        updateFloorOptions();
    </script>
    <script>
        // Existing JavaScript code

        // Additional JavaScript for validation
        const validateForm = () => {
            // Validate Printer ID
            let printerId = document.getElementById('printer-id').value;
            let specialCharacters = /[!@#$%^&*(),.?":{}|<>]/;

            if (specialCharacters.test(printerId)) {
                // If the ID contains special characters, show an error message
                document.getElementById('id-error').innerText = "ID cannot contain special characters";
                return false;
            } else {
                // Clear any previous error message
                document.getElementById('id-error').innerText = "";

                // Continue with other form validations if needed

                // Toggle to the next step
                toggleSteps(false);

                return false; // Prevent form submission
            }
        };
    </script>
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