
<!-- PHP -->
<?php
    include "../../connection/connectMysql.php";
    $strGet = "SELECT * FROM cooperative.employee a left join (SELECT employee_id, sum(compansation) as sum_com FROM compansation_list group by employee_id) b on a.id = b.employee_id;";
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
        <h5 class="w3-left"><b><i class="fa fa-user-circle"></i> เบิกค่าตอบแทนพนักงาน</b></h5>
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
            <h3><i class="w3-xlarge fa fa-info-circle"></i> ค้นหาชื่อ</h3>
                
            <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-search"></i></div>
                <div class="w3-rest">
                <input id="myInput" class="w3-input w3-border" name="first" type="text" placeholder="ค้นหาชื่อ">
                </div>
            </div>

            <table id="datableCustomer"  class="display w3-table">
                <thead>
                <tr class="w3-blue-gray">
                    <th>รหัสพนักงาน</th>
                    <th> ชื่อ </th>
                    <th>นามสกุล</th>
                    <th> เบอร์ </th>
                    <th> รายได้ทั้งหมด </th>
                    <th> จำนวนเบิกทั้งหมด </th>
                    <th> จำนวนเงินที่เบิกได้จริง </th>
                    <th> เบิก </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($materials as $key=>$value) {?>
                    <tr class="w3-center">
                        <td><?php echo $value['id'] ?></td>
                        <td><?php echo $value['firstname'] ?></td>
                        <td><?php echo $value['lastname'] ?></td>
                        <td><?php echo $value['phone'] ?></td>
                        <td><?php echo $value['sum_com'] ?></td>
                        <td><?php  ?></td>
                        <td><?php echo $value['sum_com'] ?></td>
                        <td>
                            <?php if($value['sum_com'] != ''){ ?>
                                <a href="detail.php?emp_id=<?php echo $value['id'] ?>" class="w3-button w3-round w3-green">เบิกเงิน</a>
                            <?php } ?>
                        </td>
                    </tr>

                <?php } ?>
                </tbody>
            </table>
            </div>
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
//   const myForm = document.getElementById('alert');
//   myForm.style.display = 'block';
//   setTimeout(() => {
//     myForm.style.display = 'none';
//   }, 8000);
</script>