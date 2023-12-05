<?php
if (!empty($_FILES['file'])) {
    $allowedExtensions = ['pdf', 'docx', 'doc', 'ppt', 'jpeg', 'png'];
    $targetDir = 'uploads/';
    $filename = basename($_FILES['file']['name']);
    $fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (in_array($fileType, $allowedExtensions)) {
        // Sử dụng một tên cố định nhưng giữ lại phần mở rộng gốc
        $fixedFilename = 'fixed_filename.' . $fileType;
        $targetFilePath = $targetDir . $fixedFilename;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
            echo json_encode(['message' => 'File uploaded successfully']);
        } else {
            echo json_encode(['error' => 'Error uploading file']);
        }
    } else {
        echo json_encode(['error' => 'Invalid file format']);
    }
}
?>

