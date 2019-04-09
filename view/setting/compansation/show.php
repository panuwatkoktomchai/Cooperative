
<!-- PHP -->
<?php
    include "../../../connection/connectMysql.php";
    $strGet = "select compansation.*, products.title as product from compansation left join products on compansation.product_id = products.id";
    $products = $conn->query($strGet);
?>

<!-- HTML -->

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

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<header class="w3-container" style="padding-top:22px">
        <h5 class="w3-left"><b><i class="fa fa-user-circle"></i> ข้อมูลตอบแทนพนักงาน</b></h5>
    <a href="/cooper/view/setting/setting.php" class="w3-btn w3-blue-gray w3-margin-bottom w3-right w3-xlarge w3-round"><i class="fa fa-arrow-left" aria-hidden="true"> ย้อนกลับ</i></a>
</header>

<div class="w3-row-padding">
    <div class="w3-col m12">
    <div class="w3-card w3-round w3-white">
        <div class="w3-container w3-padding">
        <?php if(isset($_SESSION['alert'])) { ?>
         <div id="alert" class="w3-panel w3-<?php echo $_SESSION['alert']['color'] ?> w3-animate-opacity w3-display-topright" style="index:100; margin-top:120px; width:500px;">
            <h3><?php echo $_SESSION['alert']['status'] ?>!</h3>
            <p><?php echo $_SESSION['alert']['message'] ?></p>
        </div> 
        <script>
            window.scrollTo(0, 0);
        </script>
        <?php 
                unset($_SESSION['alert']);
            } 
        ?> 
        <a class="w3-button w3-xlarge w3-green w3-round w3-margin" href="add.php"> <i class="fa fa-plus" aria-hidden="true"></i> เพิ่ม</a>
        <table id="datableCustomer"  class=" display">
        <thead>
            <tr class="w3-blue-gray">
            <th>..</th>
            <th> รหัสสินค้า </th>
            <th> สินค้า </th>
            <th> ราคาตอบแทน ต่อหน่วย </th>
            <th>...</th>
            </tr>
            </thead>
            <?php foreach ($products as $key=>$value) {?>
            <tr class="w3-center">
                <td><?php echo $key+1;  ?></td>
                <td><?php echo $value['product_id'];  ?></td>
                <td><?php echo $value['product'];  ?></td>
                <td><?php echo $value['price'];  ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $value['id'] ?>" class="w3-button w3-blue w3-round-large"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <button onclick="document.getElementById('<?php echo $value['id'] ?>').style.display='block'" class="w3-button w3-red w3-round-large"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </td>
            </tr>

            <!-- บล็อกถามก่อนลบ -->
            <div id="<?php echo $value['id'] ?>" class="w3-modal w3-round">
                <div class="w3-modal-content w3-animate-top w3-card-3">
                <header class="w3-container w3-blue-gray"> 
                    <span onclick="document.getElementById('<?php echo $value['id'] ?>').style.display='none'" 
                    class="w3-button w3-display-topright">&times;</span>
                    <h2>ยืนยันการทำงาน</h2>
                </header>
                <div class="w3-container w3-center">
                    <p>ต้องการลบข้อมูล หรือไม่ ?</p>
                </div>
                <footer class="w3-container w3-light-gray w3-center">
                    <p>
                        <a href="code/delete.php?id=<?php echo $value['id'] ?>" class="w3-button w3-red w3-round-large">ยืนยัน</a>
                        <a href="#" onclick="document.getElementById('<?php echo $value['id'] ?>').style.display='none'"  class="w3-button w3-blue-gray w3-round-large">ยกเลิก</a>
                    </p>
                </footer>
                </div>
            </div>
            <!-- end บล็อกถามก่อนลบ -->
            <?php } ?>
        </table>
    </div>
</div>
</div>
</div>

<?php include "../../../layout/footer.php" ?>
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#datableCustomer').DataTable();
} );
</script>
<script>
  const myForm = document.getElementById('alert');
  myForm.style.display = 'block';
  setTimeout(() => {
    myForm.style.display = 'none';
  }, 3000);
</script>