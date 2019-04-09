<?php 

include "../../../connection/connectMysql.php";
$sqlGet = "select * from customers where id = ".$_REQUEST['id'];
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
        <h5 class="w3-left"><b><i class="fa fa-user-circle"></i> เพิ่มข้อมูลลูกค้า</b></h5>
        <?php if(isset($_SESSION['alert'])) { ?>
         <div class="w3-panel w3-<?php echo $_SESSION['alert']['color'] ?> w3-animate-opacity w3-display-topright" style="index:100; margin-top:120px; width:500px;">
            <h3><?php echo $_SESSION['alert']['status'] ?>!</h3>
            <p><?php echo $_SESSION['alert']['message'] ?></p>
        </div> 
        <?php 
                unset($_SESSION['alert']);
            } 
        ?> 
    <a href="/cooper/view/setting/customer/show.php" class="w3-btn w3-blue-gray w3-margin-bottom w3-right w3-xlarge w3-round"><i class="fa fa-arrow-left" aria-hidden="true"> ย้อนกลับ</i></a>
</header>

<div class="w3-row-padding">
    <div class="w3-col m12">
    <div class="w3-card w3-round w3-white">
        <div class="w3-container w3-padding">

<form class="" 
    action="code/update.php?id=<?php echo $data['id'] ?>" 
    method="post" 
    enctype="multipart/form-data">

    
    <p><h3>ชื่อ</h3>
    <input value="<?php echo $data['firstname'] ?>" class="w3-input"required name="data[firstname]" type="text"></p>

    <p><h3>นามสกุล</h3>
    <input value="<?php echo $data['lastname'] ?>" class="w3-input" required name="data[lastname]" type="text"></p>

    <p><h3>เบอร์</h3>
    <input value="<?php echo $data['phone'] ?>" class="w3-input" required name="data[phone]" type="text"></p>

    <p><h3>รหัสบัตรประชาชน</h3>
    <input value="<?php echo $data['idcard'] ?>" type="text" name="data[idcard]" required class="w3-input"></p>
    <p><h3>เพศ</h3><br>
    <input class="w3-radio" type="radio" name="data[gender]" value="1" <?php if($data['gender']==1){ echo "checked"; } ?> >
    <h3>ชาย</h3></p>
    <p>
    <input class="w3-radio" type="radio" name="data[gender]" value="0" <?php if($data['gender']==0){ echo "checked"; } ?> >
    <h3>หญิง</h3></p>
    <p>

    <p><h3 >ที่อยู่</h3>
    <textarea class="w3-input" required name="data[address]" cols="30" rows="10"><?php echo $data['address'] ?></textarea></p>

    <p><h3>วันเกิด</h3>
    <input value="<?php echo $data['birthday'] ?>" class="w3-input" required type="date" name="data[birthday]"></p>

    <p><h3>รูปภาพ</h3><br>
    <img src="<?php echo $data['image'] ?>" alt="">
    <input type="hidden" value="<?php echo $data['image'] ?>" name="data[image]">
    <input type="file" name="filUpload" class="w3-input" ></p>
    
    <input type="submit" value="บันทึก" class="w3-btn w3-round-large w3-green">
    <br><br>
</form>

    </div>
</div>
</div>
</div>

<?php include "../../../layout/footer.php" ?>
</div>
  </body>
  </html>