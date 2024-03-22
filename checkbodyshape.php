<?php 

    session_start();
    require_once 'config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Dressed</title>
    <link rel="stylesheet" href="checkbodyshape.css">
    <style>
        .skip{
            display: block;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="../AppLogo.jpg" alt="get dressed logo" class="image">
    </div>
    <div class="container1">
        <h1>Enter your size</h1>
        <img src="../bodyimg.jpg" alt="body" class="bodyim">
        
    <form action="shapeDB.php" method="post" id="myForm"> <!-- Assuming your PHP script is in process_form.php -->
        <div class="input-size">
            <label for="shoulder">Shoulder:</label>
            <input type="text" id="shoulder" name="shoulder">
            <h for="Centimeter">Inch</h>
        </div>
        <div class="input-size">
            <label for="bust">Bust:</label>
            <input type="text" id="bust" name="bust">
            <h for="Centimeter">Inch</h>
        </div>
        <div class="input-size">
            <label for="waist">Waist:</label>
            <input type="text" id="waist" name="waist">
            <h for="Centimeter">Inch</h>
        </div>
        <div class="input-size">
            <label for="hip">Hips:</label>
            <input type="text" id="hip" name="hip">
            <h for="Centimeter">Inch</h>
        </div>

        <div>
            <script>
                const form = document.getElementById("myForm");
                const calculateButton = document.getElementById("calculate");

                form.addEventListener("input", function () {
                let isFormValid = true;

                for (let i = 0; i < form.length - 2; i++) {
                    if (form[i].value.trim() === "") {
                    isFormValid = false;
                    break;
                    }
                }

                calculateButton.disabled = !isFormValid;
                });
            </script>
            
            <div class="btn">
                <button type="button" id="calculate" onclick="calculateShape()">CALCULATE</button>
                <button type="reset" id="clear">CLEAR</button>
            </div>

            <div class="skip"><p> If you don't know your size <a href="Home.php"> Skip > </a></p></div>

        </div>
    </form>
        <ad>1 Inch = 2.54 Centimeters</ad>
    <script>
        function getShape(shoulder, bust, waist, hip) {
        // code for the method body
        var shape = "SHAPE";
        if (isNaN(shoulder) || isNaN(bust) || isNaN(waist) || isNaN(hip) ||
            shoulder === "" || bust === "" || waist === "" || hip === "") {
            return shape;
        } else {
        //Check Rectangle
        if (shoulder >= (bust * 0.95) && shoulder <= (bust * 1.05)) {
            if (hip >= (bust * 0.95) && hip <= (bust * 1.05)) {
            if (bust - waist <= 0.26 * bust && bust - waist >= 0.24 * bust) {
                shape = "rectangle";
            }
            }
        }
            return shape;
        }}
        function calculateShape() {
            // Validate form before calculating
            if (validateForm()) {
                // Perform calculation logic here
                document.getElementById("myForm").submit(); // Submit the form if validation passes
                 // Perform calculation logic here
                const shoulder = document.getElementById("shoulder").value;
                const bust = document.getElementById("bust").value;
                const waist = document.getElementById("waist").value;
                const hip = document.getElementById("hip").value;
                const result = getShape(parseInt(shoulder), parseInt(bust), parseInt(waist), parseInt(hip));
                console.log(result);

          // Send the result data to the PHP file as a form field
        const formData = new FormData();
        formData.append('result', result);
        formData.append('shoulder', shoulder);
        formData.append('bust', bust);
        formData.append('waist', waist);
        formData.append('hip', hip);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'shapeDB.php', true);
        xhr.send(formData);

        // Assuming you want to display the result on the page
        window.location.href = result + ".html";

            } else {
                alert("Please fill out all the form fields."); // Display an alert if validation fails
            }
        }

        function validateForm() {
            // Add your validation logic here
            var shoulder = document.getElementById("shoulder").value;
            var bust = document.getElementById("bust").value;
            var waist = document.getElementById("waist").value;
            var hip = document.getElementById("hip").value;

            // You can customize the validation conditions based on your requirements
            return shoulder !== "" && bust !== "" && waist !== "" && hip !== "";
        }
    </script>
</body>
    </div>
</body>
</html>