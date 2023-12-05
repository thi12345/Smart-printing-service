<?php
session_start(); // Khởi động session

// Đặt đường dẫn tuyệt đối cho thư mục lưu trữ
$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . "/Upload/uploads/";

// Kiểm tra xem thư mục có tồn tại không, nếu không thì tạo
if (!file_exists($uploadDirectory)) {
    if (!mkdir($uploadDirectory, 0777, true)) {
        echo json_encode(['success' => false, 'message' => 'Không thể tạo thư mục lưu trữ.']);
        exit;
    }
}

// Kiểm tra xem có file được tải lên không
if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] == UPLOAD_ERR_OK) {
    // Lấy thông tin file
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Định dạng file cho phép
    $allowedfileExtensions = array('pdf', 'doc', 'docx', 'png', 'jpeg', 'ppt');

    // Kiểm tra định dạng file
    if (in_array($fileExtension, $allowedfileExtensions)) {
        // Sử dụng tên file cố định để thay thế file cũ
        $newFileName = 'latest_uploaded_file.' . $fileExtension;
        $dest_path = $uploadDirectory . $newFileName;

        // Chuyển file tới thư mục lưu trữ
        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            $_SESSION['latestFile'] = $newFileName; // Thiết lập tên file mới nhất

            // Chuyển hướng đến trang demo_4.html (hoặc trang mong muốn)
            header('Location: demo_4.html');
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Lỗi trong quá trình di chuyển file.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Định dạng file không được hỗ trợ.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Vui lòng chọn một file để tải lên.']);
}
?>
