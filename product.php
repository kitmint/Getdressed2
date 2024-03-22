<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Page</title>
  <link rel="stylesheet" href="product_style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
  integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
  crossorigin="anonymous" referrerpolicy="no-referrer" />  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;  
        display: block;  
        background-Color: #ffffff;
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
        width: 100%;
    }

    header h1 {
        margin: 30px;
    }

    a {
        color: black;
        text-decoration: none;
    }

    header .home {
        border-style: none;
        background-color: #ffffff;
        border-radius: 100%;
        padding: 10px;
        font-size: 20px;
        margin-top: 30px;
        margin-left: 30px;
        display: flex;
        justify-content: left;
        position: fixed;
        color: #333;
    }

    main {
        padding-bottom: 70px;
    }

    section {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        padding: 20px;
        
    }

    .morepic {
        display: flex;
        width: -webkit-fill-available;
        height: 350px;
    }

    .IMG {
        border-radius: 30px;
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .sub-img-group{
        margin-top: 10px;
        display: flex;
        scroll-snap-type: x mandatory;
        overflow-x: auto;  
    }

    .sub-img-col{
        display: flex;
        margin: 5px;
        min-width: 100px;
        width: 100px;
        height: 100px;
    }

    .subIMG {
        border-radius: 20px;
        scroll-snap-align: center;
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .tag {
        display: inline-flex;
        width: 100%;
        max-height: 20px;
        font-size: 15px;
        padding: 10px;
    }

    .tag h4 {
        margin: 5;
        padding-left: 5px;
    }

    .tag i{
        color: #ffc812;
        font-size: 20px;
    }
    .tag p {
        margin: 5;
        padding-left: 5px;
    }

    .detail {
        width: 100%;
        margin: 10;
    }

    .detail h1 {
        padding-right: 50px;
    }

    .detail i {
        border-style: none;
        background-color: #ffffff;
        border-radius: 100%;
        font-size: 30px;
        top: 615px;
        right: 0;
        margin-right: 40px;
        position: absolute;
        color: #333;
    }

    .size {
        display: inline-flex;
        width: 100%;
    }

    .color{
        width: 30px;
        height: 30px;
        background: none;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        -o-border-radius: 50%;
        margin-right: 12px;
        cursor: pointer;
        transition: all 0.5s ease;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -ms-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
    }

    .color-blue{
        background-color: #085ea0;
    }
    .color-yellow{
        background-color: #c0b50d;
    }
    .color-red{
        background-color: #8b0516;
    }
    .color-black{
        background-color: #242424;
    }
    .color-white{
        background-color: #ededed;
    }
    .color:hover{
        box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.3);
    }
    .active-color{
        box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.3);
    }
    .color-groups{
        margin: 0;
        width: 100%;
        position: static;
        font-size: 15px;
        display: inline-flex;
        max-height: fit-content;
        left: 0;
        /*margin-top: 10px;
        margin-bottom: 10px;*/
    }

    .color-groups h3 {
        margin: 5;
    }

    .BottomBar {
        background-color: #ffffff00;
        display: flex;
        justify-content: center;
        bottom: 0;
        left: 0;
        position: fixed;
        text-align: center;
        width: 100%;
        margin-bottom: 20px;
        height: 50px;
    }

    .BottomBar a {
        margin: 10px;
        width: fit-content;
        height: fit-content;
        border-style: solid;
        border-width: 1px;
        border-color: #C08552;
        background-color: #C08552;
        color: #ffffff;
        font-size: 20px;
        border-radius: 50px;
        padding: 15px;
        white-space: nowrap;
    }
  </style>
</head>

<body>
  
  <header>
        <a href = "Home.php" class="home">
          <i class="fa-solid fa-arrow-left-long"></i>
        </a>
  </header>

  <main>
  
    <section id="productdetail">
    <?php
    // เชื่อมกับดาต้าเบส(Table dresses)
        include("config.php");
        mysqli_query($objCon, "SET NAMES UTF8");
        $ID = $_GET['id'];
        
        if(isset($_GET['id_Type'])) {
          $Body = $_GET['id_Type'];
          $sql = "SELECT * FROM dresses WHERE BDType = '$Body'";
          $result = $objCon->query($sql);
      } else {
        $sql = "SELECT * FROM dresses WHERE ID = $ID";
        $result = $objCon->query($sql);
      }
          $sqltype = "SELECT * FROM bdtype"; //สร้างอีกตาราง ชื่อ bdtype ที่มีเฉพาะหมวดหมู่ของรูปร่างเท่านั้น
          $resulttype = $objCon->query($sqltype);
    ?> 
    
    <?php while($row = $result->fetch_assoc()): ?>
    <?php // กำหนดตัวแปรข้อมูล
      $imageURL = 'Dress/'.$row['Pic_Dress'];  // : ลิ้ง(ที่อยู่)รูปภาพ 
      $Shape = $row['BDType'];                 // : Shape ex. Pear Rectangle

    ?>
      <!--ส่วนแสดงรูปภาพ -->
      <div class="morepic">
        <img src="<?php echo $imageURL; ?>" width="100%" id="MainImg" class="IMG" alt=""> <!--รูปภาพหลัก --> 
      </div>  

        <div class="sub-img-group"> <!--รูปภาพย่อย -->  
          <div class="sub-img-col">
          <img src="<?php echo $imageURL; ?>" width="100%" id="MainImg" class="subIMG" alt="">
          </div>
          <div class="sub-img-col">
          <img src="<?php echo $imageURL; ?>" width="100%" id="MainImg" class="subIMG" alt="">
          </div>
          <div class="sub-img-col">
          <img src="<?php echo $imageURL; ?>" width="100%" id="MainImg" class="subIMG" alt="">
          </div> 
        </div>
      
     
      <div class="tag">
        <!--แสดง tag shape (Link ไป main ได้)--> 
        <i class="bi bi-star"></i>
      <?php while($rowtype = $resulttype->fetch_assoc()): ?>
      <?php if($rowtype['BDType']==$Shape): ?>
      <a href="Home.php?id_Type=<?php echo $rowtype['BDType']; ?>">
      <h4>#<?php echo $Shape; ?></h4>
      </a>
      <?php endif; ?>
      <?php endwhile; ?>
      </div>

      <div class="detail">
        <!--แสดงผลชื่อ,ข้อมูลเสื้อผ้า--> 
        <h1><?php echo $row['Name_Dress'];?> </h1>
        <i class="bi bi-heart"></i>
        <span><p><?php echo $row['Detail'];?></p></span>
      </div>
      <!--ส่วนเลือกสีเสื้อผ้า--> 
    <div class = "color-groups">
        <h3>Color : </h3>
        <div class = "color color-white active-color"></div>
        <div class = "color color-black"></div>
        <div class = "color color-yellow"></div>
        <div class = "color color-blue"></div>
        <div class = "color color-red"></div>
    </div>

    <div class="size">
        <!--ส่วนเลือกไซส์เสื้อผ้า--> 
        <h3>Size : 
        <select>
          <option> select size </option>
          <option> S </option>
          <option> M </option>
          <option> L </option>
          <option> Xl </option>
          <option> 2Xl </option>
        </select>
        </h3>
    </div>
      
      
    </section>
  </main>

  <footer>
      <nav class="BottomBar">
        <!--ปุ่มลองเสื้อผ้ากับลิ้งไปร้านค้า--> 
        <a class="navLink" id="shopBTN" href="<?php echo  $row['Link']; ?>"><i class="bi bi-handbag-fill"></i> Go to Shop &nbsp</a></li>
        <a class="navLink" id="tryBTN" href="trydress.html"><i class="fa-solid fa-camera"></i> Try this &nbsp</a></li>
       
      </nav>
  </footer>
  <?php endwhile ?>
  
</body>
</html>