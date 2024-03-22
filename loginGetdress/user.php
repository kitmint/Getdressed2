<?php //หน้า Welcome ของ User

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['user_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <?php 

            if (isset($_SESSION['user_login'])) {
                $user_id = $_SESSION['user_login'];
                $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        ?>
        <img src="logo.png" height="250" width="250"style="display: block; margin: 0 auto;">
        <div style="text-align: center;">
            <h1 class="mt-4">Welcome, <?php echo $row['firstname'] . ' ' . $row['lastname'] ?></h1>
            <!--<h1>Welcome to</h1>
            <h1>Get Dressed</h1>-->
            <h1 class="mt-4" style="font-size: 24px; font-family: 'Arial', sans-serif; color: #333; font-weight: normal;">Let's find your style and make yourself</h1>
            <h1 class="mt-4" style="font-size: 24px; font-family: 'Arial', sans-serif; color: #333; font-weight: normal;">more confident</h1>  
        </div>
        <br>  
        <div style="text-align: center;">
            <a href="/checkbodyshape.php" class="btn btn-primary" style="background-color: #C08552; display: inline; font-size: 24px;">Get started!</a>
        </div>
        <div style="text-align: center; align-items: center">
        <a href="logout.php" class="btn btn-danger" >Logout</a>
        </div>
    </div>
    <script src='scrollFunction.js'></script>
</body>
</html>

