<?php
session_start();
require_once 'config.php'; // Make sure this file contains your database connection details

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user input
    $shoulder = isset($_POST["shoulder"]) ? htmlspecialchars($_POST["shoulder"]) : '';
    $bust = isset($_POST["bust"]) ? htmlspecialchars($_POST["bust"]) : '';
    $waist = isset($_POST["waist"]) ? htmlspecialchars($_POST["waist"]) : '';
    $hip = isset($_POST["hip"]) ? htmlspecialchars($_POST["hip"]) : '';
    if (isset($_SESSION['user_login'])) {
        $user_id = $_SESSION['user_login'];
        $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Calculate the body shape
    $result = calculateBodyShape($shoulder, $bust, $waist, $hip);
    // Update data in the database
    if ($stmt === false) {
        die("Database error: " . $conn->errorInfo()[2]); // Show error message if query fails
    } else {
        $sql = "UPDATE users SET shoulder = :shoulder, bust = :bust, waist = :waist, hip = :hip, Shape = :result WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'shoulder' => $shoulder,
            'bust' => $bust,
            'waist' => $waist,
            'hip' => $hip,
            'result' => $result,
            'id' => $user_id // Use user_id obtained from session
        ]);
        
    
    }
}


function calculateBodyShape($shoulder, $bust, $waist, $hip) {
    // Calculate Bust-to-Waist Ratio (BWR)
    $bwr = $bust / $waist;

    // Calculate Waist-to-Hip Ratio (WHR)
    $whr = $waist / $hip;

    // Define thresholds for body shapes
    $bwrThreshold = 1.75; // Adjust as needed
    $whrThresholdFemale = 0.85;
    $whrThresholdMale = 0.90;

    // Determine body shape based on ratios
    if ($bwr <= $bwrThreshold) {
        if ($whr <= $whrThresholdFemale) {
            return "Hourglass Shape";
        } elseif ($whr <= $whrThresholdMale) {
            return "V-Shape";
        } else {
            return "Undefined Shape";
        }
    } else {
        if ($whr <= $whrThresholdFemale) {
            return "Pear Shape";
        } elseif ($whr > $whrThresholdFemale && $whr <= $whrThresholdMale) {
            return "Rectangle Shape";
        } else {
            return "Undefined Shape";
        }
    }
}
?>

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
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form {
            margin-bottom: 20px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .btn {
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        p {
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Your HTML form for collecting measurements -->
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <!-- Input fields for measurements here -->

        </form>

        <?php
        // Check if the body shape is available
        if (isset($result)) {
            echo "<p>Your shape: $result</p>";
        }
        ?>
        <br>
        <a href="user_data.php" class="btn">Repeat</a>
        <a href="userprofile.php" class="btn">My Profile</a>
    </div>
</body>
</html>
