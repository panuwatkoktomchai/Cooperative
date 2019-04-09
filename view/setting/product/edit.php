
<?php
    include "../../../connection/connectMysql.php";
    $sqlGet = "select * from products where id = ".$_GET['id'];
    $data = $conn->query($sqlGet);
    $data = $data->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<title>Cooperative</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">
<?php include "../../../layout/header.php" ?>

<header class="w3-container" style="padding-top:22px">
        <h5 class="w3-left"><b><i class="fa fa-user-circle"></i> เพิ่มข้อมูลสินค้า</b></h5>
        <?php if(isset($_SESSION['alert'])) { ?>
         <div class="w3-panel w3-<?php echo $_SESSION['alert']['color'] ?> w3-animate-opacity w3-display-topright" style="index:100; margin-top:120px; width:500px;">
            <h3><?php echo $_SESSION['alert']['status'] ?>!</h3>
            <p><?php echo $_SESSION['alert']['message'] ?></p>
        </div> 
        <?php 
                echo "<script> window.scrollTo(0, 0); </script>";
                unset($_SESSION['alert']);
            } 
        ?> 
    <a href="/cooper/view/setting/materail_type/show.php" class="w3-btn w3-blue-gray w3-margin-bottom w3-right w3-xlarge w3-round"><i class="fa fa-arrow-left" aria-hidden="true"> ย้อนกลับ</i></a>
</header>

<div class="w3-row-padding">
    <div class="w3-col m12">
        <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
                <form action="code/update.php?id=<?php echo $_GET['id'] ?>" method="post"> 

                     <p><h2>ชื่อสินค้า</h2></p>
                       : <?php echo $data['id']; ?>
                     <p><h2>ชื่อสินค้า</h2></p>
                    <input value="<?php echo $data['title']; ?>" class="w3-input w3"required name="data[title]" type="text">

                    <p><h2>ราคา</h2></p>
                    <input value="<?php echo $data['price']; ?>" class="w3-input w3" required name="data[price]" type="number">

                    <p><h2 >รายละเอียด</h2></p>
                    <textarea class="w3-input w3" required name="data[description]" cols="30" rows="10"><?php echo $data['description']; ?></textarea>

                    <p><h2>จำนวน</h2></p>
                    <input value="<?php echo $data['amount']; ?>" class="w3-input w3" required type="number" name="data[amount]">

                    <p><h2>ขนาด</h2></p>
                    <input value="<?php echo $data['size']; ?>" class="w3-input w3" required type="text" name="data[size]">
                    <input type="submit" value="บันทึก" class="w3-button w3-large w3-round w3-green">
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "../../../layout/footer.php" ?>
</div>
  </body>
  </html>