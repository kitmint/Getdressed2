<?php
session_start();
require_once 'loginGetdress/config/db.php';

if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else if (isset($_SESSION['admin_login'])) {
    $admin_id = $_SESSION['admin_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_picture"])) {
    $target_dir = "picture/";
    $file_name = uniqid() . '_' . basename($_FILES["profile_picture"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check if the file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["profile_picture"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
    }

    // If all checks pass, move the uploaded file to the target directory
    if ($uploadOk) {
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);

        // Update the user's filename in the database
        $updateStmt = $conn->prepare("UPDATE users SET filename = :filename WHERE id = :id");
        $updateStmt->bindParam(':filename', $file_name);
        $updateStmt->bindParam(':id', $user_id);
        $updateStmt->execute();

        // Refresh the page to display the updated image
        header("Location: userprofile.php");
        exit();
    }
    else {
        echo "<script>alert('Please select a file before uploading.');</script>";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;  
            display: block; 
            
        }

        header {
            top: 0;
            background-color: #ffffff;
            justify-content: center;
            position: fixed;
            display: block;
            color: rgb(0, 0, 0);
            text-align: center;
            padding: 5px;
            height: auto;
            width: 412px;
        }

        header h1 {
            margin: 30px;
        }

        a {
            color: black;
            text-decoration: none;
        }

        header .me {
            font-size: 30px;
            margin-top: 30px;
            margin-left: 30px;
            display: flex;
            justify-content: left;
            position: fixed;
            color: #333;
        }

        input {
            border: none;
            background: none;
            padding: 10px;
            size: 200px;
            width: 80%;
            height: 5px;
        }

        button {
            background: none;
            border: none;
        }

        section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
            padding-top: 100px;
            padding-bottom: 70px;
        }
        .propic {
            display: flex;
            justify-content: center;
            top: 0;
            left: 0;
            margin-top: 25px;
            background-color: none;
            width: 200px;
            height: 200px;
            border-radius: 100px;
            background-color: black;
        }

        .userpf {
            border-radius: 100px;
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }
        form{
            text-align: center;
            position: relative;
        }

        input{
            font-size: 15px;
            padding: 10px;
            margin: 20px;
            margin-left: 80px;
            height: auto;
            text-align: center;
            position: relative;
        }

        button{
            border-style: solid;
            border-radius: 30px;
            border-color: #c085525c;
            background-color: #ffffff;
            color: #333;
            font-size: 15px;
            padding: 10px;
        }
    </style>
</head>


<body>
    <header>
        <a class="me" href="userprofile.php">
            <i class="bi bi-chevron-left"></i>
        </a>
        <h1>Profile</h1>
    </header>
    <section>
        <div class="propic">
            <img src="picture/<?php echo $row['filename']; ?>" class="userpf" alt="Profile Picture" />
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" class="mt-3">
            <label for="profile_picture" class="form-label"></label>
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="form-control">
            <button type="submit" class="btn btn-primary mt-2">Upload</button>
        </form>

    </section>
</body>
</html>