
var numberSelect = document.getElementById("numberSelect");
var customNumberInput = document.getElementById("customNumber");

numberSelect.addEventListener("change", function() {
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
function uploadFile() {
  var fileInput = document.getElementById("fileInput");

  if (fileInput.files.length > 0) {
      var selectedFile = fileInput.files[0];

      // Kiểm tra định dạng của file
      var allowedFormats = ["pdf", "doc", "ppt", "png", "jpg"];
      var fileExtension = selectedFile.name.split('.').pop().toLowerCase();

      if (allowedFormats.includes(fileExtension)) {
          // Tạo FormData để chứa file và các dữ liệu khác (nếu có)
          var formData = new FormData();
          formData.append("file", selectedFile);

          // Gửi dữ liệu bằng cách sử dụng XMLHttpRequest hoặc fetch API
          // Ở đây, tôi sử dụng fetch API như là một ví dụ đơn giản
          fetch("/upload", {
              method: "POST",
              body: formData
          })
          .then(response => response.json())
          .then(data => {
              console.log("File đã được tải lên thành công", data);
          })
          .catch(error => {
              console.error("Lỗi khi tải lên file", error);
          });
      } else {
          alert("Vui lòng chọn một file có định dạng hợp lệ.");
      }
  } else {
      alert("Vui lòng chọn một file.");
  }
}