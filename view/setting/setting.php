<?php 
error_reporting(1);
include "../../connection/connectMysql.php";
$data = "SELECT * FROM cooperative.companies;";
$data = $conn->query($data);
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
<?php include "../../layout/header.php"; ?>

<header class="w3-container" style="padding-top:22px">
        <h5><b><i class="fa fa-dashboard"></i> ข้อมูลพื้นฐานสหกรณ์</b></h5>
</header>
    <div class="w3-row">
        <div class="w3-col m3 l3">
        
        <!-- <div class="w3-card-4 w3-white w3-margin">
            <img src="<?php echo $data['image'] ?>" alt="Norway" style="width:100%">
            <div class="w3-container w3-center">
                <h4 class="w3-center">โลโก้</h4>
                <p class="w3-center"> <?php echo $data['company']; ?> </p>
            </div>
        </div> -->

        </div>
        <div class="w3-col m9 l9">

            <!-- <div class="w3-card-2 w3-round w3-white w3-margin">
            <h3 class="w3-blue-gray w3-padding">เกี่ยวกับสหกรณ์</h3>
                <div class="w3-container">
                    <p><i class="fa fa-male fa-fw w3-margin-right w3-text-theme"></i>  <?php echo $data['company']; ?> </p>
                    <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>  <?php echo $data['address']; ?> </p>
                    <p><i class="fa fa-phone-square fa-fw w3-margin-right w3-text-theme"></i> <?php echo $data['phone']; ?></p>
                    <p><i class="fa fa-fax fa-fw w3-margin-right w3-text-theme"></i> <?php echo $data['fax']; ?> </p>
                </div>
            </div>

            <div class="w3-margin">
                <a href="/cooper/view/setting/cooperative/setting-company.php" class="w3-button w3-round w3-blue-gray w3-xlarge"><i class="fa fa-cogs w3-text-orange" aria-hidden="true"></i>  ตั้งค่าข้อมูลสหกรณ์ </a>
            </div> -->
        </div>
    </div>

    <div class="w3-row-padding">
        <div class="w3-quarter w3-margin-bottom">
            <a href="/cooper/view/setting/cooperative/setting-company.php" style="text-decoration: none;">
            <div class="w3-container w3-card-3 w3-hover-gray w3-blue-gray w3-padding-16">
                <div class="w3-left"><i class="fa fa-cog w3-text-light w3-xxxlarge"></i></div>
                <div class="w3-right">
                <!-- <h3>52</h3> -->
                <i class="fa fa-cogs w3-text-orange" aria-hidden="true"></i>
                </div>
                <div class="w3-clear"></div>
                <h4> สหกรณ์ </h4>
            </div>
            </a>
        </div>

        <div class="w3-quarter w3-margin-bottom">
            <a href="/cooper/view/setting/customer/show.php" style="text-decoration: none;">
            <div class="w3-container w3-card-3 w3-hover-gray w3-blue-gray w3-padding-16">
                <div class="w3-left"><i class="fa fa-users w3-text-light w3-xxxlarge"></i></div>
                <div class="w3-right">
                <!-- <h3>52</h3> -->
                <i class="fa fa-cogs w3-text-orange" aria-hidden="true"></i>
                </div>
                <div class="w3-clear"></div>
                <h4> ลูกค้า </h4>
            </div>
            </a>
        </div>

        <div class="w3-quarter w3-margin-bottom">
            <a href="materail_type/show.php" style="text-decoration: none;">
            <div class="w3-container w3-card-3 w3-hover-gray w3-blue-gray w3-padding-16">
                <div class="w3-left"><i class="fa fa-gavel w3-text-light w3-xxxlarge"></i></div>
                <div class="w3-right">
                <!-- <h3>52</h3> -->
                <i class="fa fa-cogs w3-text-orange" aria-hidden="true"></i>
                </div>
                <div class="w3-clear"></div>
                <h4> ประเภทวัสดุอุปกรณ์ </h4>
            </div>
            </a>
        </div>

        <div class="w3-quarter w3-margin-bottom">
            <a href="materail/show.php" style="text-decoration: none;">
            <div class="w3-container w3-card-3 w3-hover-gray w3-blue-gray w3-padding-16">
                <div class="w3-left"><i class="fa fa-gavel w3-text-light w3-xxxlarge"></i></div>
                <div class="w3-right">
                <!-- <h3>52</h3> -->
                <i class="fa fa-cogs w3-text-orange" aria-hidden="true"></i>
                </div>
                <div class="w3-clear"></div>
                <h4> วัสดุอุปกรณ์ </h4>
            </div>
            </a>
        </div>

        <div class="w3-quarter w3-margin-bottom">
            <a href="product/show.php" style="text-decoration: none;">
            <div class="w3-container w3-card-3 w3-hover-gray w3-blue-gray w3-padding-16">
                <div class="w3-left"><i class="fa fa-cart-plus w3-text-light w3-xxxlarge"></i></div>
                <div class="w3-right">
                <!-- <h3>52</h3> -->
                <i class="fa fa-cogs w3-text-orange" aria-hidden="true"></i>
                </div>
                <div class="w3-clear"></div>
                <h4> สินค้า </h4>
            </div>
            </a>
        </div>

        <div class="w3-quarter w3-margin-bottom">
            <a href="material_products/show.php" style="text-decoration: none;">
            <div class="w3-container w3-card-3 w3-hover-gray w3-blue-gray w3-padding-16">
                <div class="w3-left"><i class="fa fa-cart-plus w3-text-light w3-xxxlarge"></i></div>
                <div class="w3-right">
                <!-- <h3>52</h3> -->
                <i class="fa fa-cogs w3-text-orange" aria-hidden="true"></i>
                </div>
                <div class="w3-clear"></div>
                <h4> วัสดุในการผลิตสินค้า </h4>
            </div>
            </a>
        </div>

        <div class="w3-quarter w3-margin-bottom">
            <a href="compansation/show.php" style="text-decoration: none;">
            <div class="w3-container w3-card-3 w3-hover-gray w3-blue-gray w3-padding-16">
                <div class="w3-left"><i class="fa fa-money w3-text-light w3-xxxlarge"></i></div>
                <div class="w3-right">
                <!-- <h3>52</h3> -->
                <i class="fa fa-cogs w3-text-orange" aria-hidden="true"></i>
                </div>
                <div class="w3-clear"></div>
                <h4> ค่าตอบแทนพนักงาน </h4>
            </div>
            </a>
        </div>

        <div class="w3-quarter w3-margin-bottom">
            <a href="distributor/show.php" style="text-decoration: none;">
            <div class="w3-container w3-card-3 w3-hover-gray w3-blue-gray w3-padding-16">
                <div class="w3-left"><i class="fa fa-id-card w3-text-light w3-xxxlarge"></i></div>
                <div class="w3-right">
                <!-- <h3>52</h3> -->
                <i class="fa fa-cogs w3-text-orange" aria-hidden="true"></i>
                </div>
                <div class="w3-clear"></div>
                <h4> ตัวแทนจำหน่าย </h4>
            </div>
            </a>
        </div>
        
    </div>

<?php include "../../layout/footer.php" ?>
</div>
  </body>
  </html>