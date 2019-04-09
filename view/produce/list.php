
<!-- PHP -->
<?php
    include "../../connection/connectMysql.php";
    $strGet = "select * from products";
    $materials = $conn->query($strGet);
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
<?php include "../../layout/header.php" ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<header class="w3-container" style="padding-top:22px">
        <h5 class="w3-left"><b><i class="fa fa-user-circle"></i> สั่งผลิตสินค้า</b></h5>
    <!-- <a href="" class="w3-btn w3-blue-gray w3-margin-bottom w3-right w3-xlarge w3-round"><i class="fa fa-arrow-left" aria-hidden="true"> ย้อนกลับ</i></a> -->
</header>

<div class="w3-row-padding">
    <div class="w3-col m12">
    <div class="w3-card w3-round w3-white">
        <div class="w3-container w3-padding">

            <!-- alert -->
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
            <!-- end alert -->

            <div class="w3-panel w3-topbar w3-border-green w3-border">
            <h3><i class="w3-xlarge fa fa-info-circle"></i> เลือกรายการสินค้า</h3>
                
            <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-search"></i></div>
                <div class="w3-rest">
                <input id="myInput" class="w3-input w3-border" name="first" type="text" placeholder="ค้นหาชื่อ">
                </div>
            </div>

            <form action="code/addOrder.php" method="post" >
            <table id="datableCustomer"  class="display">
                <thead>
                <tr class="w3-blue-gray">
                    <th>...</th>
                    <th> จำนวน </th>
                    <th>รหัส</th>
                    <th> สินค้า </th>
                    <th> ราคา </th>
                    <th> ขนาด </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($materials as $key=>$value) {?>
                    <tr class="w3-center">
                        <td><input type="checkbox" class="w3-check" name="<?php echo $value['id'] ?>"> </td>
                        <td><input type="number" required class="w3-input w3-border" disabled name="data[<?php echo $value['id'] ?>]" id="<?php echo $value['id'] ?>"></td>
                        <td><?php echo $value['id']  ?></td>
                        <td><?php echo $value['title']  ?></td>
                        <td><?php echo $value['price']  ?></td>
                        <td><?php echo $value['size'] ?></td>
                    </tr>

                <?php } ?>
                </tbody>

                <!-- alertMaterial -->
                <div id="alertMaterial" class="w3-modal w3-animate-opacity" <?php echo isset($_SESSION['alertCompare'])? 'style="display:block;"': ''; ?> >
                    <div class="w3-modal-content">
                        <header class="w3-container w3-teal"> 
                            <h2>แจ้งจำนวนวัสดุขาด</h2>
                        </header>
                        <ul class="w3-ul w3-hoverable">
                            <?php foreach($_SESSION['alertCompare'] as $value){ ?>
                            <li><?php echo $value; ?></li>
                            <?php } 
                                unset($_SESSION['alertCompare']);
                            ?>                                
                        </ul>
                        <footer class="w3-container w3-blue-gray w3-padding">
                            <a href="../orderMaterial/list.php" class="w3-button w3-green">ไปหน้าสั่งวัสดุ</a>
                        <button type="button" onclick="document.getElementById('alertMaterial').style.display='none'" class="w3-button w3-red">ยกเลิก</button>
                        </footer>
                    </div>
                </div>
                <!-- end alertMaterial -->

            </table>
            </div>
            <button type="submit" class="w3-button w3-green w3-round">ยืนยันการสั่งซื้อ</button>
            </form>
        </div>
    </div>
    </div>
</div>

<?php include "../../layout/footer.php" ?>
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#datableCustomer').DataTable({
        ordering:false,
    });

    $('#myInput').on( 'keyup', function () {
        table.search( this.value ).draw();
    } );

} );

$('input[type=checkbox]').on('click',function(){
    var id = this.name
    if(this.checked){
        var alement = $('#'+id);
        alement.prop('disabled', false);
        alement.focus()
        
    }else{
        $('#'+id).prop('disabled', true);
    }
    
})
</script>

<script>
  const myForm = document.getElementById('alert');
  myForm.style.display = 'block';
  setTimeout(() => {
    myForm.style.display = 'none';
  }, 8000);
</script>