<?php
session_start();
$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . "/Upload/uploads/"; // Sử dụng đường dẫn tuyệt đối
$latestFile = $uploadDirectory . $_SESSION['latestFile'];
$fileType = strtolower(pathinfo($latestFile, PATHINFO_EXTENSION));

if ($fileType == 'png' || $fileType == 'jpeg' || $fileType == 'jpg') {
    $relativePath = "/Upload/uploads/" . $_SESSION['latestFile'];
    echo "<img src='{$relativePath}' alt='Latest Uploaded File' style='max-width:100%; max-height:100%;'>";
} elseif ($fileType == 'pdf') {
    $relativePath = "/Upload/uploads/" . $_SESSION['latestFile'];
    echo "<embed src='{$relativePath}' type='application/pdf' width='100%' height='100%'/>";
} elseif ($fileType == 'doc' || $fileType == 'docx') {
    $relativePath = "http://" . $_SERVER['HTTP_HOST'] . "/Upload/uploads/" . $_SESSION['latestFile'];
    $googleDocsUrl = "https://docs.google.com/gview?url=" . urlencode($relativePath) . "&embedded=true";
    echo "<iframe src='" . $googleDocsUrl . "' style='width:100%; height:500px;' frameborder='0'></iframe>";
} else {
    echo "File format not supported for preview.";
}
?>
