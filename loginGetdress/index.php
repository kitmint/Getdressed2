<?php 

    session_start();
    require_once 'config/db.php';

?>
<!--หน้าสมัครสมาชิก-->
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
        padding-left: 40px;
    }
    </style>
</head>
<body>

    <div class="container">
        <div class="create">
            <h1>Create</h1>
            <h1>your account</h1>
        </div>
        <form action="signup_db.php" method="post">
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
            <?php if(isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php 
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>

            <div class="data">
                <div class="mb-3">
                    <label for="firstname" class="form-label">First name :</label>
                    <div class="block"><input type="text" class="form-control" name="firstname" aria-describedby="firstname" placeholder="Enter your First Name"></div>
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last name :</label>
                    <div class="block"><input type="text" class="form-control" name="lastname" aria-describedby="lastname" placeholder="Enter your Last Name"></div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <div class="block"><input type="email" class="form-control" name="email" aria-describedby="email" placeholder="Enter your Email"></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password :</label>
                    <div class="block"><input type="password" class="form-control" name="password" placeholder="Enter your Password"></div>
                </div>
                <div class="mb-3">
                    <label for="confirm password" class="form-label">Confirm Password :</label>
                    <div class="block"><input type="password" class="form-control" name="c_password" placeholder="Enter your Password"></div>
                </div>
            </div>


            <div class="sub"><button type="submit" name="signup" class="btn btn-primary">Register</button></div>
        
        
        </form>
        
        
        <div class="sub"><p>Already have an account? <a href="signin.php">sign in</a></p></div>
    </div>
    
</body>
</html>