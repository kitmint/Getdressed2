<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "getdressed";

    $objCon = mysqli_connect($servername, $username, $password, $dbname);



    // ตรวจสอบการเชื่อมต่อ
    if (!$objCon) {
        die("การเชื่อมต่อล้มเหลว: " . mysqli_connect_error());
    }
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    
    }
?>