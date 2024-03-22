<?php
    // Connect to server and select database.
        include("config.php");
        // $objCon = mysqli_connect($servername, $username, $password, $dbname); // สมมติว่าไฟล์ config.php มีตัวแปรเหล่านี้
        mysqli_query($objCon, "SET NAMES UTF8");
    // เมื่อมีการรับค่าจากหมวดหมู่ ค่าจะแทนใน$Body แล้วเลือกหมวดที่ต้องการ
    if(isset($_GET['id_Type'])) {
        $Body = $_GET['id_Type'];
        $sql = "SELECT * FROM dresses WHERE BDType = '$Body'";
        $result = $objCon->query($sql);
    } else {
        $sql = "SELECT * FROM dresses";
        $result = $objCon->query($sql);
    }
        $sqltype = "SELECT * FROM bdtype"; //สร้างอีกตาราง ชื่อ bdtype ที่มีเฉพาะหมวดหมู่ของรูปร่างเท่านั้น
        $resulttype = $objCon->query($sqltype);
?>
        
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Dress</title>
    <link rel="stylesheet" type="text/css" href="main_style.css">
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

        .Search{
            background-color: #86BA90;
            justify-content: none;
            left: 20px;
            margin: 20px;
            border-radius: 20px;
            padding: 10px;
            width: auto;
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
            padding-top: 230px;
            padding-bottom: 70px;
        }

        .product {
            border-style: solid;
            border-color: #e1e1e1;
            border: none;
            border-radius: 5px;
            padding: 10px;
            margin: 5px;
            width: 120px;
            height: fit-content;
            text-align: center
        }

        .menu {
            display: flex;
            justify-content: center;
            bottom: 0;
            left: 0;
            position: fixed;
            text-align: center;
            width: 421px;
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

        .bodytype {
            margin-left: 10px;
            margin-right: 10px;
            display: flex;
            scroll-snap-type: x mandatory;
            overflow-x: scroll;
        }

        .bodytype a {
            margin: 10px;
            width: fit-content;
            height: fit-content;
            border-style: solid;
            border-width: 1px;
            border-color: #C08552;
            color: #333;
            font-size: 12px;
            border-radius: 20px;
            padding: 10px;
            white-space: nowrap;
        }

        .bodytype a :hover{
            padding: 20px;
            margin: 10px;
            border-style: none;
            width: fit-content;
            height: fit-content;
            border-style: solid;
            background-color: #C08552;
            color: #ffffff;
            border-radius: 20px;
            padding: 10px;
            white-space: nowrap;
        }

        .bodytype a :focus{
            background-color: red;
        }


        .PicDress {
            margin: 5px;
            float: left;
            width: 110px;

        }
    </style>
</head>
<body>
    <script>
    document.getElementById("colorButton").addEventListener("click", function() {
  this.classList.toggle("clicked");
});</script>
    <header>
        <a href="Me.php" class="me">
            <i class="bi bi-list"></i>
        </a>
        <h1>Get Dressed</h1>
        <form id="search-container" class="Search">
            <button id="search-button" onclick="performSearch()">
                <i class="bi bi-search"></i>
            </button>
            <input type="text" id="search-input" placeholder="Search">
        </form>

        <nav>
           <div class="bodytype",id="colorButton">
            <a href="Home.php">  All  </a>
            <?php while($rowtype = $resulttype->fetch_assoc()): ?>
                <a href="Home.php?id_Type=<?php echo $rowtype['BDType'];?>"> <?php echo $rowtype['BDType']; ?> </a>
            <?php endwhile ?>

            </div>
        </nav>
    </header>

    <section>

        <?php while($row = $result->fetch_assoc()): 
          //  $row = $result->fetch_assoc();
           // print_r($row);
        ?>
        <?php $imageURL = 'Dress/'.$row['Pic_Dress']; ?>

        <div class="product">
            <!--เพิ่มตรงนี้จากของเฟรชเพื่อเชื่อมไปหน้า product -->
            <a href="product.php?id=<?php echo $row['ID']?>">
            <!-- _____________________________________-->
            <img src="<?php echo $imageURL; ?>" alt="Product" width="100%" class= "PicDress">
            <p><?php echo $row['Name_Dress']; ?></p>
            <p class = "Shop"><?php echo $row['Shop']; ?></p>
            </a>
        </div>
        <?php endwhile ?>

        <!-- Add more products as needed -->
    </section>
    
    <nav class="menu">
        <div class="main">
            <a href="Home.php"><i class="bi bi-house-door-fill"></i></a>
            <a href="Like.php"><i class="bi bi-heart"></i></a>
            <a><i class="bi bi-chat-dots"></i></a>
            <a><i class="bi bi-bell"></i></a>
            <a href="userprofile.php"><i class="bi bi-person"></i></a>
        </div>
    </nav>

    <script>
        
    </script>
</body>
</html>
