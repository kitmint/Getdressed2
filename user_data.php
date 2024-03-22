<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Body Shape Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #008CBA;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin-left: 10px;
            display: inline-block;
        }

        .btn-secondary:hover {
            background-color: #006080;
        }

        p {
            margin-top: 20px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>

    <!-- Your HTML form for collecting measurements -->
    <form method="POST" action="save_body_shape.php">
        <input type="hidden" name="id" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">
        <label for="shoulder">Shoulder Circumference (in inches):</label>
        <input type="text" id="shoulder" name="shoulder" required>
        <br>
        <label for="bust">Bust Circumference (in inches):</label>
        <input type="text" id="bust" name="bust" required>
        <br>
        <label for="waist">Waist Circumference (in inches):</label>
        <input type="text" id="waist" name="waist" required>
        <br>
        <label for="hip">Hip Circumference (in inches):</label>
        <input type="text" id="hip" name="hip" required>
        <br>
        <button type="submit">Calculate Body Shape</button>


        <a href="userprofile.php" class="btn btn-secondary">My Profile</a>
    </form>

    <!-- Display the calculated body shape -->
    <?php

    // Check if there's a body shape response
    if (isset($_GET['Shape'])) {
        $bodyShapeResponse = $_GET['Shape'];
        echo '<p>Calculated Body Shape: ' . $bodyShapeResponse . '</p>';
    }
    ?>

</body>
</html>




