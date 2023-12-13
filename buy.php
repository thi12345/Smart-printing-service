<?php
    
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="style.css">
        <title>Login</title>
        <?php
            include "db/db_connect.php";
            session_start();
            $retrievedVariable1="";
            $retrievedVariable2="";
            if(isset($_SESSION['variable1']) && isset($_SESSION['variable2'])) {
                $retrievedVariable1 = $_SESSION['variable1'];
                $retrievedVariable2 = $_SESSION['variable2'];
            }

            $email = "";
            $name = "";
            $number = "";
            $valid = 0;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST["email"];
                $name = $_POST["name"];
                $number = $_POST["number"];
            }
            function isValidEmail($email){
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    return "Invalid email!";
                } 
                else {
                    return "Valid email!";
                } 
            }
            function isName($str) {
                $arr="!@#$%^&*()_+*/[]{}:;,<.>/?\|0123456789";
                for ($i = 0; $i < strlen($str); $i++){
                    for ($j = 0; $j < strlen($arr); $j++){
                        if ($str[$i]===$arr[$j] || $str[$i]==="'" || $str[$i]==='"'){
                            return FALSE;
                        }
                    }
                }
                return TRUE;
            }
            function isValidName($name){
                if ((strlen($name)<5 || strlen($name)>25) || !isName($name)){
                    return "Invalid name!";
                }
                else return "Valid name!";
            }
            function isValidNumber($number){
                $options = ["options" => ["min_range" => 5, "max_range" => 50]]; 
                if (!filter_var($number, FILTER_VALIDATE_INT, $options)){
                    return "Invalid number!";
                }
                else {
                    return "Valid number!";
                }
            }


            function ValidEmail($email){
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    return FALSE;
                } 
                else {
                    return TRUE;
                } 
            }
            function ValidName($name){
                if ((strlen($name)<5 || strlen($name)>25) || !isName($name)){
                    return FALSE;
                }
                else return TRUE;
            }
            function ValidNumber($number){
                $options = ["options" => ["min_range" => 5, "max_range" => 50]]; 
                if (!filter_var($number, FILTER_VALIDATE_INT, $options)){
                    return FALSE;
                }
                else {        
                    return TRUE;
                }
            }
            
            if (ValidEmail($email) && ValidName($name) && ValidNumber($number)) {
                $sql1 = " UPDATE number_page SET page_increase = page_increase + '$number'
                        WHERE mssv = '$retrievedVariable2'";
                mysqli_query($con, $sql1); 
                header("Location: buy_successful.php");
            }
            else {
                header("Location: ");
            }
        ?>
         
    </head>
    <body>
        <img src="Logo-DH-Bach-Khoa-HCMUT 1.png" alt="Logo">
        <h2>ĐẠI HỌC QUỐC GIA TP.HCM<br>TRƯỜNG ĐẠI HỌC BÁCH KHOA</h2>
        <p id="info">Họ và tên: 
          <?php 
            echo "<strong>".$retrievedVariable1."</strong>". "<br>"; // Hiển thị giá trị của biến 1 đã lưu từ trang trước
            echo "MSSV: ".$retrievedVariable2; // Hiển thị giá trị của biến 2 đã lưu từ trang trước
          ?>
        <br>Khoa khoa học và kỹ thuật máy tính</p>
        <hr>
        <div  id="pages">
            <p>Số trang còn lại của bạn là: <span id="page"><?php 
           
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
            $sql = " SELECT time_create FROM number_page
                      WHERE mssv = '$retrievedVariable2'";
            $result = mysqli_query($con, $sql);  
            $row = mysqli_fetch_array($result);
            $time = strtotime($row['time_create']);
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
            <p>Bạn sẽ nhận được 30 trang miễn phí sau:<span id="countdown"></span></p>
        </div>
        <hr>
        <div id="taskbar">
            <button id="home"><a href="home.php">Trang chủ</a></button><button id="buy"><a href="buy.php">Mua trang in</a></button><button id="inf"><a href="#"></a>Thông tin sinh viên</button><button id="help"><a href="help.php">Trợ giúp và phản hồi</a></button><button id="print"><a href="./Upload/demo_1.php">In</a></button>
        </div>
        <div  id="b">
            <p>Mua giấy in</p>
            <br>
            <hr>
            <br>
            
            
            <form action="" style="height: 80%" method="post">
                <label for="email" >Email</label>
                <br>
                <input type="text" id="email"  name="email" value="<?php echo $email;?>" required>
                <p style="height: 3%"><?php 
                    if ($_SERVER["REQUEST_METHOD"] == "POST") echo isValidEmail($_POST["email"]); 
                ?></p>
                <label for="name">Họ tên sinh viên</label>
                <br>
                <input type="text" id="name" value="<?= $retrievedVariable1;?>" name="name" required>
                <p style="height: 3%"><?php 
                    if ($_SERVER["REQUEST_METHOD"] == "POST") echo isValidName($_POST["name"]); 
                ?></p>
                <label for="number">Nhập số trang hợp lệ</label>
                <br>
                <input type="number" id="number" value="0" name="number" required>
                <p style="height: 3%"><?php 
                    if ($_SERVER["REQUEST_METHOD"] == "POST") echo isValidNumber($_POST["number"]); 
                ?></p>
                <p style="height:15%"></p>
                <input type="submit" style="background-color: #5838B3;" value="Xác nhận">
                
                
            </form>
            <input type="submit" id="return" style="background-color: #E31B4B;" value="Hủy bỏ">
        </div>
        
        <div style="display: inline-block; width: 2.5%; height: 60%; background-color: #D9D9D9; float: left"></div>
        <div  id="h">
            <p style="margin-left: 5%;">Hướng dẫn sử dụng dịch vụ</p>
            <br>
            <hr>
            <p style="margin-left: 5%;">Lưu ý: để mua trang, bạn cần điền đầy đủ tất cả các thông tin bên trái và bấm xác nhận, hệ thống đảm bảo thông tin của bạn được bảo mật</p>
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