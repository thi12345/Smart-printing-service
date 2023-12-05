
var numberSelect = document.getElementById("numberSelect");
var customNumberInput = document.getElementById("customNumber");

numberSelect.addEventListener("change", function () {
    var selectedValue = numberSelect.value;

    if (selectedValue === "custom") {
        // Nếu chọn "Tự điền", hiển thị input để nhập số
        customNumberInput.style.display = "inline-block";
    } else {
        // Nếu chọn số từ 1 đến 6, ẩn input
        customNumberInput.style.display = "none";
    }

    // Hiển thị thông báo hoặc thực hiện các thao tác khác dựa trên giá trị được chọn
    document.getElementById("selectedNumber").textContent = "Bạn đã chọn: " + selectedValue;
});


function checkFileAndSubmit() {
    var fileInput = document.getElementById("fileInput");

    if (fileInput.files.length == 0) {
        alert("Vui lòng chọn một file.");
    } else {
        // Submit the form
        document.getElementById("uploadForm").submit();
    }
}





// function uploadFile() {
//     var formData = new FormData();
//     var fileInput = document.getElementById('fileInput');
//     var preview = document.getElementById('pdf-preview');

//     if (fileInput.files.length > 0) {
//         var file = fileInput.files[0];
//         formData.append('uploadedFile', file);

//         fetch('/Upload/uploadFile.php', {
//             method: 'POST',
//             body: formData
//         })
//             .then(response => response.json())
//             .then(data => {
//                 if (data.success) {
//                     // Hiển thị file dựa trên kiểu file
//                     switch (file.type) {
//                         case 'application/pdf':
//                             preview.innerHTML = '<embed src="' + data.path + '" width="210" height="297" type="application/pdf">';
//                             break;
//                         // Các case khác cho các loại file được hỗ trợ
//                     }
//                 } else {
//                     alert('Failed to upload file');
//                 }
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//             });
//     } else {
//         alert("Please select a file to upload.");
//     }
// }

