<?php
session_start();
require_once 'loginGetdress/config/db.php';

// ตรวจสอบการเข้าสู่ระบบของผู้ใช้หรือผู้ดูแลระบบ
if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else if (isset($_SESSION['admin_login'])) {
    $admin_id = $_SESSION['admin_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} 

// การอัปโหลดรูปโปรไฟล์ของผู้ใช้
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_picture"])) {
    $target_dir = "picture/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // ตรวจสอบว่าไฟล์เป็นภาพหรือไม่
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check === false) {
        $uploadOk = 0;
    }

    // ตรวจสอบว่าไฟล์มีอยู่แล้วหรือไม่
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // ตรวจสอบขนาดของไฟล์
    if ($_FILES["profile_picture"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // อนุญาตเฉพาะรูปแบบไฟล์ที่เป็นไปได้
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
    }

    // ถ้าผ่านการตรวจสอบทั้งหมด ก็อัปโหลดไฟล์
    if ($uploadOk) {
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);

        // อัปเดตชื่อไฟล์ในฐานข้อมูล
        $filename = basename($_FILES["profile_picture"]["name"]);
        $updateStmt = $conn->prepare("UPDATE users SET filename = :filename WHERE id = :id");
        $updateStmt->bindParam(':filename', $filename);
        $updateStmt->bindParam(':id', $user_id);
        $updateStmt->execute();

        // รีเฟรชหน้าเพื่อแสดงรูปภาพที่อัปเดตแล้ว
        header("Location: userprofile.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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
            background-color: #e1e1e1;
            justify-content: center;
            position: fixed;
            display: block;
            color: rgb(0, 0, 0);
            text-align: center;
            padding: 5px;
            height: auto;
            width: 100%;
        }

        header h1 {
            margin: 30px;
        }

        a {
            color: black;
            text-decoration: none;
        }

        section {
            height: auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
            padding-bottom: 60px;
            
        }

        .profile {
            background-color: #c085525c;
            width: 100%;
            border-radius: 30px;
            font-size: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 20px rgba(0,0,0, 0.3);
        }

        .profile h4 {
            text-align: center;
        }

        .bi-three-dots-vertical {
            font-size: 25px;
            margin-top: 40px;
            margin-left: 330px;
            justify-content: center;
            position: absolute;
            display: flex;
            top: 0;
            color: rgb(0, 0, 0);
        }

        .propic {
            display: flex;
            justify-content: center;
            top: 0;
            left: 0;
            margin-top: 25px;
            margin-bottom: 10px;
            margin-left: 134px;
            background-color: none;
            width: 100px;
            height: 100px;
            border-radius: 50px;
        }

        .propic i {
            position: relative;
            display: block;
            margin-top: 70px;
            margin-left: -30px;
            background-color: #ffffff;
            font-size: 20px;
            border-style: none;
            border-radius: 50px;
            height: fit-content;
            padding: 8px;
        }

        .userpf {
            background-color: black;
            border-radius: 100px;
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .info {
            width: 100%;
            font-size: 18px;
            padding-left: 30px;
            display: flex;
            white-space: nowrap;
        }

        .datapf {
            margin-right: 45px;
            position: absolute;
            right: 0;
            display: flex;
            text-align: end;
        }

        .shape {
            display: flex;
            background-color: #86ba9080;
            width: 100%;
            height: 350px;
            border-radius: 30px;
            font-size: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 20px rgba(0,0,0, 0.3);
        }

        .shapepic {
            border-radius: 20px;
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .bodypic {
            margin-top: 80px;
            margin-left: 20px;
            display: flex;
            justify-content: center;
            background-color: none;
            width: 120px;
            height: 180px;
            border-radius: 30px;
        }

        .body a {
            text-decoration: underline;
        }

        .body {
            margin-top: 30px;
            margin-left: 160px;
            position: absolute;
            display: block;
            height: fit-content;
        }

        .bodysize {
            width: 100%;
            height: fit-content;
            font-size: 18px;
            text-align: center;
            display: flex;
            white-space: nowrap;
            position: relative;
        }

        .bodysize a {
            text-decoration: underline;
            padding: 20px;
            padding-left: 15px;
        }

        .edit {
            padding: 10px;
            display: flex;
            position: absolute;
            width: fit-content;
            height: fit-content;
            border-radius: 20px;
            border-style: none;
            background-color: #F5F3BB;
            font-size: 15px;
            right: 0;
            margin-top: 290px;
            margin-right: 40px;
        }
        .edit2 {
            padding: 10px;
            display: inline;
            position: absolute;
            width: fit-content;
            height: fit-content;
            border-radius: 20px;
            border-style: none;
            background-color: #F5F3BB;
            font-size: 15px;
            margin: auto;
            right: 0;

        }

        .help {
            border-radius: 20px;
            background-color: #F5F3BB;
            height: fit-content;
            width: 100%;
            padding: 25px;
            text-align: center;
            margin-bottom: 20px;
            box-shadow: 0 0 20px rgba(0,0,0, 0.3);
        }

        .about {
            border-radius: 20px;
            background-color: #86ba9080;
            height: fit-content;
            width: 100%;
            padding: 25px;
            text-align: center;
            margin-bottom: 20px;
            box-shadow: 0 0 20px rgba(0,0,0, 0.3);
        }

        .account {
            border-radius: 20px;
            background-color: #00000018;
            height: fit-content;
            width: 100%;
            padding: 25px;
            text-align: center;
            margin-bottom: 20px;
            box-shadow: 0 0 20px rgba(0,0,0, 0.3);
        }

        .menu {
            display: flex;
            justify-content: center;
            bottom: 0;
            left: 0;
            position: fixed;
            text-align: center;
            width: 100%;
            margin-bottom: 10px;
            height: 50px;
        }

        .main {
            padding: 10px;
            background-color: #F5F3BB;
            border-radius: 20px;
        }

        .menu a {
            justify-content: center;
            padding: 10px;
        }

        .menu i {
            font-size: 20px;
            margin: 10px;
        }
    </style>
</head>
<body>

    <section >
        <div class="profile">

            <a href="edit.php"><i class="bi bi-three-dots-vertical"></i></a>

            <div class="propic">
                <img src="picture/<?php echo $row['filename']; ?>" class="userpf" alt="Profile Picture" />
                <a href="uploaduserprofile.php"><i class="bi bi-camera-fill"></i></a>
            </div>

            <h4><?php echo $row['firstname'] . " " . $row['lastname']; ?></h4>

            <div class="info">
                <p>E-mail</p>
                <p class="datapf"><?php echo $row['email']; ?></p>
            </div>

            <div class="info">
                <p>Phone </p>
                <p class="datapf"><?php echo $row['phonenumber']; ?></p>
            </div>
            
        </div>

        <div class="shape">
            <div class="bodypic">
                <img src="Profile/rect.jpg" class="shapepic" alt="Profile Picture" />
            </div>

            
            <div class="body">
                <a>Shape</a>
                <p> <?php echo $row['Shape']; ?></p>

                <div class="bodysize">
                    <a>Shoulder</a>
                    <p> <?php echo $row['shoulder']; ?> inch</p>
                </div>

                <div class="bodysize">
                    <a>Bust</a>
                    <p><?php echo $row['bust']; ?> inch</p>
                </div>

                <div class="bodysize">
                    <a>Waist</a>
                    <p><?php echo $row['waist']; ?> inch</p>
                </div>

                <div class="bodysize">
                    <a>Hips</a>
                    <p><?php echo $row['hip']; ?> inch</p>
                </div>
            </div>

            <div class="edit">
                <a href="user_data.php?id=$user_id"><i class="bi bi-pencil-square"></i> แก้ไข</a>
            </div>
        </div>

        <div class="help">
            <a>ศูนย์การช่วยเหลือ</a>
        </div>

        <div class="about">
            <a>เกี่ยวกับ</a>
        </div>

        <div class="account">
            <a  href="loginGetdress/logout.php">ลงชื่อออก</a>
        </div>
    </section>

    <nav class="menu">
        <div class="main">
            <a href="Home.php"><i class="bi bi-house-door"></i></a>
            <a href="Like.php"><i class="bi bi-heart"></i></a>
            <a href="#"><i class="bi bi-chat-dots"></i></a>
            <a href="#"><i class="bi bi-bell"></i></a>
            <a href="userprofile.php"><i class="bi bi-person-fill"></i></a>
        </div>
    </nav>
  </body>
</html>
