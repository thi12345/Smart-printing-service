<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="help.css">
        <title>Login</title>
        <?php
            $email = "";
            $idea = "";
            $problem = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST["email"];
                $idea = $_POST["idea"];
                $problem = $_POST["problem"];
            }
            function isValidEmail($email){
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    return "Invalid email!";
                } 
                else {
                    return "Valid email!";
                } 
            }
            function isStr($str) {
                $arr="!@#$%^&*()_+*/[]{}:;<>/?\|0123456789";
                for ($i = 0; $i < strlen($str); $i++){
                    for ($j = 0; $j < strlen($arr); $j++){
                        if ($str[$i]===$arr[$j] || $str[$i]==="'" || $str[$i]==='"'){
                            return FALSE;
                        }
                    }
                }
                return TRUE;
            }
            function isValidIdea($idea){
                if (!isStr($idea)){
                    return "Invalid idea!";
                }
                else return "Valid idea!";
            }
            function isValidProblem($problem){
                if (!isStr($problem)){
                    return "Invalid problem!";
                }
                else return "Valid problem!";
            }

            function ValidEmail($email){
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    return FALSE;
                } 
                else {
                    return TRUE;
                } 
            }
            function ValidIdea($idea){
                if (!isStr($idea)){
                    return FALSE;
                }
                else return TRUE;
            }
            function ValidProblem($problem){
                if (!isStr($problem)){
                    return FALSE;
                }
                else return TRUE;
            }
            if (ValidEmail($email) && ValidIdea($idea)&& ValidProblem($problem)){
                header("Location: help1.php");
            }
            else header ("Location: ");
        ?>
        <script>
            var soTrangHienTai = 5; // Số trang hiện tại là 5
            var soNgayThem = 30;
            var currentDate = new Date();
            currentDate.setDate(currentDate.getDate() + soNgayThem);
            // Sử dụng ngày sau 30 ngày để thay đổi số trang
            // Ví dụ: thêm số trang tương ứng với số ngày
            soTrangHienTai += 30;
            alert soTrangHienTai;
            document.getElementById("page").innerHTML=soTrangHienTai;
        </script>
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
            <p>Số trang còn lại của bạn là: <span id="page"><?php
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
            ?></span></p>
        </div>
        <div id="time">
            <p>Bạn sẽ nhận được 30 trang miễn phí sau <span id="countdown"></span></p>
        </div>
        <hr>
        <div id="taskbar">
            <button id="home"><a href="home.php">Trang chủ</a></button><button id="buy"><a href="buy.php">Mua trang in</a></button><button id="inf"><a href="#"></a>Thông tin sinh viên</button><button id="help"><a href="help.php">Trợ giúp và phản hồi</a></button><button id="print"><a href="./Upload/demo_1.php">In</a></button>
        </div>
        <p>Phản hồi ý kiến</p>
        <br>
        <hr>
        <form action="" style="height: 60%" method="post">
            <p style="height: 15%"></p>
            <label id=label for="email">Email</label>
            <br>
            <input type="text" id="email" value="<?php if ($email === "") echo "abc@gmail.com"; else echo $email;?>" name="email" required>
            <p style="height: 3%; margin-left: 35%;"><?php 
                if ($_SERVER["REQUEST_METHOD"] == "POST") echo isValidEmail($_POST["email"]); 
            ?></p>
            <label for="idea">Ý kiến của bạn</label>
            <br>
            <input type="text" id="idea" value="Ý kiến" name="idea" required>
            <p style="height: 3%; margin-left: 35%;"><?php 
                if ($_SERVER["REQUEST_METHOD"] == "POST") echo isValidIdea($_POST["idea"]); 
            ?></p>
            <label for="problem">Vấn đề bạn gặp phải (nếu có)</label>
            <br>
            <input type="text" id="problem" value="Vấn đề" name="problem" required>
            <p style="height: 3%; margin-left: 35%;"><?php 
                if ($_SERVER["REQUEST_METHOD"] == "POST") echo isValidProblem($_POST["problem"]);
                echo $problem; 
            ?></p>
            <p style="height:25%"></p>
            <input type="submit" id="submit" style="background-color: #5838B3;" value="Xác nhận">
            <br>
            <p style="height:5%"></p>
            
        </form>
        <button id="return" style="background-color: #E31B4B;"><a href="home.php">Quay lại</a></button>
        
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