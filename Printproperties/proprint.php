<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printing Service</title>
    <link rel="stylesheet" href="stylespro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    <div id="taskbar">
        <button id="home"><a href="../home.php">Trang chủ</a></button><button id="buy"><a href="../buy.php">Mua trang in</a></button><button
            id="inf"><a href="#">Thông tin sinh viên</a></button><button id="help"><a href="../help.php">Trợ giúp và phản
                hồi</a></button><button id="print"><a href="../Upload/demo_1.php">In</a></button>
    </div>


    <!-- Submenu for PRINT, shown in a new row -->
    <div class="print-submenu">
        <ul>
            <li><a href="../Upload/demo_1.php" >Tải tài liệu</a></li>
            <li><a href="proprint.php" class="active">Chỉnh sửa thuộc tính</a></li>
            <li><a href="../Choose printer/choose.php">Chọn máy in</a></li>
        </ul>
    </div>
    <!--  SETTING BOX -->
    <!--  STEP 1 -->
    <div id="step1" class="settings-box">
        <form>
            <fieldset class="margin-box">
                <legend>Margins</legend>
                <div class="row">
                    <div class="column">
                        <label for="top-margin">Top</label>
                        <input type="number" id="top-margin" value="1" min="0" max="20" step="0.1">
                    </div>
                    <div class="column">
                        <label for="left-margin">Left</label>
                        <input type="number" id="left-margin" value="1" min="0" max="20" step="0.1">
                    </div>
                    <div class="column">
                        <label for="gutter">Gutter</label>
                        <input type="number" id="gutter" value="0" min="0" max="20" step="0.1">
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label for="bottom-margin">Bottom</label>
                        <input type="number" id="bottom-margin" value="1" min="0" max="20" step="0.1">
                    </div>
                    <div class="column">
                        <label for="right-margin">Right</label>
                        <input type="number" id="right-margin" value="1" min="0" max="20" step="0.1">
                    </div>
                    <div class="column">
                        <label for="gutter-position">Gutter Position</label>
                        <select id="gutter-position">
                            <option value="Left">Left</option>
                            <option value="Top">Top</option>
                            <!-- Add other options as needed -->
                        </select>
                    </div>
                </div>
            </fieldset>

            <!-- preview  menu -->
            <fieldset class="preview-box">
                <legend>Preview</legend>
                <div class="preview-content" id="file-preview">
                    <script>
                        $(document).ready(function () {
                            $.get("/Printproperties/truysuat.php", function (data, status) {
                                $("#file-preview").html(data);
                            });
                        });
                    </script>
                    <!-- Nội dung xem trước sẽ hiển thị ở đây -->
                </div>

                <div class="apply-to-container">
                    <label for="apply-to">Apply to:</label>
                    <select name="apply-to" id="apply-to">
                        <option value="whole-document">Whole Document</option>
                        <option value="forward">This point forward</option>
                        <!-- Add other options if needed -->
                    </select>
                </div>
            </fieldset>

            <div class="actions">
                <button type="button"><i class="fas fa-arrow-right"></i> Next</button>
                <button type="button"><i class="fas fa-times"></i> Cancel</button>
                <button type="button"><i class="fas fa-question-circle"></i> Help</button>
            </div>

        </form>
    </div>


    <div id="step2" class="settings-box2">
        <!--  print range box -->
        <div class="flex-container">
            <div class="print-ranges-container">
                <fieldset id="printRange">
                    <legend>Print Range</legend>
                    <label>
                        <input type="radio" name="printRange" value="allPages" checked>
                        All Pages
                    </label>
                    <label>
                        <input type="radio" name="printRange" value="pages">
                        Pages
                    </label>
                    From: <input type="number" id="fromPage" name="fromPage" min="1" disabled>
                    To: <input type="number" id="toPage" name="toPage" min="1" disabled>
                </fieldset>
            </div>

            <!--  Copies box -->
            <div class="print-copies-container">
                <fieldset id="Copies">
                    <legend>Copies</legend>
                    <label for="numberOfCopies">Number Of Copies</label>
                    <img src="/Printproperties/image/collated.png" alt="copies" id="collateImage">
                    <input type="number" id="numberOfCopies" name="numberOfCopies" min="1" value="1">
                    <label>
                        <input type="checkbox" id="collate" name="collate">
                        Uncollated
                    </label>
                </fieldset>
            </div>

            <!--  OTHERS box -->
            <div class="settings-container">
                <fieldset id="orientation-color">
                    <legend>Other settings</legend>
                    <legend>Orientation</legend>
                    <label>
                        <input type="radio" name="orientation" value="portrait" checked> Portrait
                    </label>
                    <label>
                        <input type="radio" name="orientation" value="landscape"> Landscape
                    </label>

                    <legend>Color</legend>
                    <label>
                        <input type="radio" name="color" value="color" checked> Color
                    </label>
                    <label>
                        <input type="radio" name="color" value="grayscale"> Grayscale
                    </label>

                    <legend>Double-Sided Printing</legend>
                    <select name="In hai mặt">
                        <option value="off" selected>Off</option>
                        <option value="long-edge">Long-Edge</option>
                        <option value="short-edge">Short-Edge</option>
                    </select>


                    <legend>Paper Size</legend>
                    <select name="paper-size">
                        <option value="A4" selected>A4</option>
                        <option value="A3">A3</option>
                        <option value="letter">Letter</option>
                        <option value="legal">Legal</option>
                    </select>
                </fieldset>
                <div class="actions2">
                    <button id="backButton"><i class="fas fa-arrow-left"></i> Back</button>
                    <button id="OK"><i class="fas fa-check"></i> OK</button>
                    <button id="Help"><i class="fas fa-question-circle"></i> Help</button>
                </div>
            </div>
        </div>
        <script src="runpro.js"></script>
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