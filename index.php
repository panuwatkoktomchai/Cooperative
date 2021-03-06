<?php
// error_reporting(0);
include "connection/connectMysql.php";
$company = "select * from companies where id = 1";
$material = "select * from materials order by amount asc limit 7";
$countOrder = "select count(*) as material from order_material where month(created_at) = ".date('m');
$produce = "select count(*) as material from produce where month(created_at) = ".date('m');
$waitOrder = "select count(*) as material from order_material where order_status = 0 and month(created_at) = ".date('m');
$finishOrder = "select count(*) as material from order_material where order_status = 1 and month(created_at) = ".date('m');
$countOrder = $conn->query($countOrder);
$material = $conn->query($material);
$company = $conn->query($company);
$waitOrder = $conn->query($waitOrder);
$finishOrder = $conn->query($finishOrder);
$produce = $conn->query($produce);
$company = $company->fetch_assoc();
$countOrder = $countOrder->fetch_assoc();
$waitOrder = $waitOrder->fetch_assoc();
$finishOrder = $finishOrder->fetch_assoc();
$produce = $produce->fetch_assoc();
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
<?php include "layout/header.php" ?>

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> หน้าหลัก </b></h5>
  </header>
  <div class="w3-row-padding w3-margin-bottom">
    [ ข้อมูลประจำเดือนปัจจุบัน ]<br>
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $countOrder['material'] ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>สั่งซื้อวัสดุ</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $waitOrder['material'] ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>รอรับวัสดุ</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $finishOrder['material'] ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>รับวัสดุแล้ว</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $produce['material'] ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>สั่งผลิต</h4>
      </div>
    </div>
  </div>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-third">
        <h5>รูปสหกรณ์</h5>
        <p class="w3-center"><img src="<?php echo $company['image'] ?>" class="w3-circle" style="height:206px;width:206px" alt="Avatar"></p>
      </div>
      <div class="w3-twothird">
        <h5>จำนวนคงหลือวัสดุต่ำสุด</h5>
        <table class="w3-table w3-striped w3-white">
          <?php foreach($material as $key=>$value) { ?>
          <tr>
            <td><i class="fa fa-user w3-text-blue w3-large"></i></td>
            <td><?php echo $value['title'] ?></td>
            <td><i><?php echo $value['amount'] ?> หน่วย</i></td>
          </tr>
          <?php } ?>
          <!-- <tr>
            <td><i class="fa fa-bell w3-text-red w3-large"></i></td>
            <td>Database error.</td>
            <td><i>15 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-users w3-text-yellow w3-large"></i></td>
            <td>New record, over 40 users.</td>
            <td><i>17 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-comment w3-text-red w3-large"></i></td>
            <td>New comments.</td>
            <td><i>25 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-bookmark w3-text-blue w3-large"></i></td>
            <td>Check transactions.</td>
            <td><i>28 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-laptop w3-text-red w3-large"></i></td>
            <td>CPU overload.</td>
            <td><i>35 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-share-alt w3-text-green w3-large"></i></td>
            <td>New shares.</td>
            <td><i>39 mins</i></td>
          </tr> -->
        </table>
      </div>
    </div>
  </div>
  <hr>

  <!-- <div class="w3-container w3-row">
    <div class="w3-container w3-border w3-card-2 w3-white" >
        <h4 class="w3-blue-gray w3-padding w3-round">ข้อมูลสหกรณ์</h4>
        <h4 class="w3-center">รูปภาพ</h4>
        <p class="w3-center"><img src="<?php echo $company['image'] ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
        <hr>
        <p><i class="fa fa-id-card fa-fw w3-margin-right w3-text-theme"></i> <?php echo $company['company'] ?></p>
        <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>  <?php echo $company['address'] ?></p>
        <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i>  <?php echo $company['phone'] ?></p>
        <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i>  <?php echo $company['fax'] ?></p>
    </div>
  </div>

  <div class="w3-container">
    <div class="w3-quarter w3-margin">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>52</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>สั่งซื้อวัสดุ</h4>
      </div>
    </div>

    <div class="w3-quarter w3-margin">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>52</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>รับวัสดุ</h4>
      </div>
    </div>

    <div class="w3-quarter w3-margin">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>52</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>สั่งผลิต</h4>
      </div>
    </div>

    <div class="w3-quarter w3-margin">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>52</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>สั่งผลิต</h4>
      </div>
    </div>
  </div> -->


<?php include "layout/footer.php" ?>
</div>
  </body>
  </html>