document.addEventListener('DOMContentLoaded', () => {

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
