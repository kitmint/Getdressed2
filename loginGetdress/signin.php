<?php session_start(); ?>
<!--หน้าเข้าสู่ระบบ-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Getdress</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    .create {
        text-align: center;
    }

    .morepic {
        display: flex;
        width: -webkit-fill-available;
        height: 250px;
        margin-bottom: 30px;
    }

    .IMG {
        border-radius: 30px;
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }
    </style>
</head>
<body>

    <div class="container">
        <div class="create">

            <div class="morepic">
                <img src="Shopping.png" width="100%" id="MainImg" class="IMG" alt=""> <!--รูปภาพหลัก -->
            </div> 
            <h3>Welcome to</h3>
            <h1>Get Dressed</h1>
        </div>

        <form action="signin_db.php" method="post">
            <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>

            <div class="data">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="block"><input type="email" class="form-control" name="email" aria-describedby="email" placeholder="Enter your Email"></div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="block"><input type="password" class="form-control" name="password" placeholder="Enter your Password"></div>
                </div>
            </div>

            <div class="sub"><button type="submit" name="signin" class="btn btn-primary">Sign In</button></div>

        </form>
        
        <div class="sub"><p>Don't have an account? <a href="index.php">Sign Up</a></p></div>
    </div>
    
</body>
</html>