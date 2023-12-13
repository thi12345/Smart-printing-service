document.addEventListener('DOMContentLoaded', () => {
    // thoi gian tu dong countdown
    // Countdown Timer JavaScript
    var savedCountdown = localStorage.getItem('countdownTime');
    var pagesLeft = parseInt(localStorage.getItem('pagesLeft') || '10'); // Lấy số trang còn lại hoặc mặc định là 10

    // Hàm để cài đặt lại thời gian đếm ngược
    function resetCountdown() {
        var newCountDownDate = new Date();
        newCountDownDate.setDate(newCountDownDate.getDate() + 0);
        newCountDownDate.setHours(newCountDownDate.getHours() + 0);
        newCountDownDate.setMinutes(newCountDownDate.getMinutes() + 5);
        newCountDownDate.setSeconds(newCountDownDate.getSeconds() + 15);
        localStorage.setItem('countdownTime', newCountDownDate);
        return newCountDownDate;
    }

    var countDownDate = savedCountdown ? new Date(savedCountdown) : resetCountdown();

    // Update the countdown every 1 second
    var x = setInterval(function () {
        var now = new Date().getTime();
        var distance = countDownDate - now;

        if (distance < 0) {
            // Cộng thêm 10 trang và cài đặt lại thời gian đếm ngược
            pagesLeft += 30;
            localStorage.setItem('pagesLeft', pagesLeft.toString());
            document.querySelector('.pages-left p').textContent = "Số trang còn lại của bạn là " + pagesLeft;

            // Cài đặt lại thời gian đếm ngược và tiếp tục đếm
            countDownDate = resetCountdown();
            distance = countDownDate - now; // Tính lại khoảng cách thời gian sau khi cài đặt lại
        }

        // Tính toán và hiển thị thời gian còn lại
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("timer").innerHTML = " sau " + days + " ngày " + hours + " giờ " + minutes + " phút " + seconds + " giây ";
    }, 1000);

    //ket thuc ham countdown

    // adjust the input values margin box
    function adjustInputValue(event) {
        let value = parseFloat(event.target.value);
        let maxValue = parseFloat(event.target.max);

        if (value < 0) {
            event.target.value = 0;
        } else if (value > maxValue) {
            event.target.value = maxValue;
        } else {
            event.target.value = value.toFixed(2);
        }
    }

    // Attach the function to each input element
    document.querySelectorAll('.margin-box input[type=number]').forEach(input => {
        input.addEventListener('change', adjustInputValue);
    });

    const toggleSteps = (showStep1) => {
        document.getElementById('step1').style.display = showStep1 ? 'block' : 'none';
        document.getElementById('step2').style.display = showStep1 ? 'none' : 'block';
    };
    //hit cancel, redirect to PRINT PROPERTIES
    var cancelButton = document.querySelector('.actions button:nth-child(2)'); // Selecting the second button in the 'actions' div
    //
    cancelButton.addEventListener('click', function () {
        window.location.href = "../Printproperties/proprint.php"; // Redirect to 'proprint.html'
    });

    toggleSteps(true); // Initialize with step1 shown

    document.querySelector('.actions button[type="button"]').onclick = () => toggleSteps(false);
    document.getElementById('backButton').onclick = () => toggleSteps(true);

    // printrange to>= from
    var fromPage = document.getElementById('fromPage');
    var toPage = document.getElementById('toPage');
    var printRangeRadios = document.getElementsByName('printRange');

    function togglePageInputs() {
        var pagesSelected = document.querySelector('input[name="printRange"]:checked').value === 'pages';

        // Enable or disable the inputs
        fromPage.disabled = !pagesSelected;
        toPage.disabled = !pagesSelected || !fromPage.value;

        // Clear the values if "All Pages" is selected
        if (!pagesSelected) {
            fromPage.value = '';
            toPage.value = '';
        }
    }

    // Event listener for radio buttons
    Array.from(printRangeRadios).forEach(function (radio) {
        radio.addEventListener('change', togglePageInputs);
    });

    // Event listener for the 'From' page input
    fromPage.addEventListener('change', function () {
        let fromValue = parseFloat(fromPage.value);

        // Reset to 1 if the value is negative
        if (fromValue < 0) {
            fromPage.value = 1;
        } else {
            // Round to the nearest integer
            fromPage.value = Math.floor(fromValue);
        }

        // Update the 'To' field accordingly
        if (fromPage.value) {
            toPage.disabled = false;
            toPage.min = fromPage.value;
            toPage.value = Math.max(toPage.value, fromPage.value);
        } else {
            toPage.disabled = true;
        }
    });

    // Event listener for the 'To' page input
    toPage.addEventListener('change', function () {
        let toValue = parseFloat(toPage.value);
        toPage.value = Math.floor(toValue);
        if (parseInt(toPage.value) < parseInt(fromPage.value)) {
            toPage.value = fromPage.value;
        }
    });

    // Initialize the state of the page inputs on page load
    togglePageInputs();

});
