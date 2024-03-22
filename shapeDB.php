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
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
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

        if ($stmt->rowCount() > 0) {
            // Record updated successfully
            echo "Record updated successfully";
            header('Location: rectangle.html'); // Redirect to success page
            exit;
        } else {
            // Error occurred while updating data
            echo "Error updating data";
        }
    }

    // Close the database connection
    $conn->close();
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
// $result = calculateBodyShape($shoulder, $bust, $waist, $hip);

// Check the calculated body shape and redirect accordingly
// if (isset($result)) {
//     if ($result == "Hourglass Shape") {
//         // Redirect to Hourglass Shape page
//         header('Location: rectangle.html');
//         exit;
//     } elseif ($result == "V-Shape") {
//         // Redirect to V-Shape page
//         header('Location: dressreg.html');
//         exit;
//     } elseif ($result == "Pear Shape") {
//         // Redirect to Pear Shape page
//         header('Location: apple.html');
//         exit;
//     } elseif ($result == "Rectangle Shape") {
//         // Redirect to Rectangle Shape page
//         header('Location: trydress.html');
//         exit;
//     } else {
//         // Error occurred while updating data
//         echo "Error updating data";
//     }
// }
?>
