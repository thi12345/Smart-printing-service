<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="login.css">
        <title>Login</title>
    </head>
    <?php
        include "db/db_connect.php";
        $tableName = "number_page";
        // Truy vấn kiểm tra tồn tại của bảng trong cơ sở dữ liệu
        $sql1 = "SHOW TABLES LIKE '$tableName'";
        $result = $con->query($sql1);

        // Kiểm tra kết quả
        if ($result->num_rows > 0) {
            
        } else {
            $sql = " CREATE TABLE number_page (
                id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
                `name` varchar(50) NOT NULL ,
                mssv INT(7) NOT NULL UNIQUE,
                page_increase INT(10) NOT NULL DEFAULT 0 ,
                page_circle INT(10) NOT NULL DEFAULT 0 ,
                time_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
            if ($con->query($sql)){

            }
            else {
                echo "create table failed";
            }
        }

        // Đóng kết nối đến cơ sở dữ liệu
        
    ?>
    <?php
        include "db/db_insert.php";
        $username = "";
        $MSSV = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $MSSV = $_POST["MSSV"];
            session_start();
            $_SESSION['variable1'] = $_POST['username']; // Lấy giá trị của biến từ form
            $_SESSION['variable2'] = $_POST['MSSV']; // Lấy giá trị của biến khác từ form
            // Chuyển hướng sang trang khác sau khi lưu giá trị vào session
        }

        if (ValidName($username) && ValidNumber($MSSV)){
            $id = "";
            $sql = "SELECT * FROM number_page
                    WHERE '$MSSV' = mssv ";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) == 0){
                $mysql = " INSERT INTO number_page (id , `name` , mssv) 
                VALUES ('$id', '$username', '$MSSV')
                ";
                mysqli_query($con, $mysql);
            }
            else {
                $row = mysqli_fetch_array($result);
            }
            
            header("Location: home.php");
        }
        else header("Location: ");
        
    ?>
    <body>
        <div class = "logo">
        </div>
        
        <div class = "login">
            <h1>Đăng nhập</h1>
            <form action="" style="height: 90%;" method="POST">
                <p id="name">Tên sinh viên</p>
                <input type="text" value="<?= $username?>" id="username" name="username" required>
                <p style="height: 4%"><?php 
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {echo isValidName($_POST["username"]);
                    echo $myVariable; }
                ?></p>
                <p id="MSSV">Mã số sinh viên</p>
                <input type="number" value="<?= $MSSV?>" id="MSSV" name="MSSV" required>
                <p style="height: 3%"><?php 
                    if ($_SERVER["REQUEST_METHOD"] == "POST") echo isValidNumber($_POST["MSSV"]); 
                ?></p>
                <p id="nothing"></p>
                <input type="submit" value="Đăng nhập">
            </form>
            
        </div>
    </body>
</html>