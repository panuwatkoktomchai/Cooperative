
<!-- PHP -->
<?php
    include "../../connection/connectMysql.php";
    $strGet = "select * from users where id =".$_SESSION['user']['id'];
    $res = $conn->query($strGet);
    $data = $res->fetch_assoc();
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
    <header class="w3-container" style="padding-top:22px">
         <h5 class="w3-left"><b><i class="fa fa-wrench"></i> แก้ใขข้อมูลผู้ใช้งาน</b></h5>
         <?php if(isset($_SESSION['alert'])) { ?>
         <div id="alert" class="w3-panel w3-<?php echo $_SESSION['alert']['color'] ?> w3-animate-opacity w3-display-topright" style="index:100; margin-top:120px; width:500px;">
            <h3><?php echo $_SESSION['alert']['status'] ?>!</h3>
            <p><?php echo $_SESSION['alert']['message'] ?></p>
        </div> 
        <?php 
                unset($_SESSION['alert']);
            } 
        ?> 
        <a href="/cooper/view/setting/setting.php" class="w3-btn w3-blue-gray w3-margin-bottom w3-right w3-xlarge"><i class="fa fa-arrow-left" aria-hidden="true"> ย้อนกลับ</i></a>
    </header>
    <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
            
              <form enctype="multipart/form-data" action="code/save.php?id=<?php echo $data['id'] ?>&file=<?php echo $data['image'] ?>" method="post" >
                <p>
                ชื่อ
                    <input value="<?php echo $data['name'] ?>" autofocus class="w3-input w3-padding-16" type="text" placeholder="ชื่อ" required name="data[name]">
                </p>
                <p>
                อีเมล
                <input value="<?php echo $data['email'] ?>" autofocus class="w3-input w3-padding-16" type="text" placeholder="อีเมล" required name="data[email]">
                </p>
                <p>
                รหัสบัครประชาชน
                <input value="<?php echo $data['phone'] ?>" autofocus class="w3-input w3-padding-16" type="text" placeholder="รหัสบัครประชาชน" required name="data[phone]">
                </p>
                <p>
                 เบอร์โทรติดต่อ
                    <input value="<?php echo $data['phone'] ?>" class="w3-input w3-padding-16" type="text" placeholder="" required name="data[phone]">
                </p>
                <p>
                 ที่อยู่
                    <textarea class="w3-input w3-padding-16" required placeholder="" name="data[address]" cols="30" rows="10"> <?php echo $data['address'] ?></textarea>
                </p>
                <p>
                 รูปภาพ <span style="color:red;"> * หากไม่ต้องการเปลี่ยนรูป ไม่ต้องระบุรูปภาพ</span>
                    <img src="" alt="" width="20%"><br>
                    <input type="file" id="filUpload" name = "filUpload">
                </p>
                <p>
                    <button class="w3-button w3-blue w3-round w3-block w3-padding-large w3-large" type="submit">
                    <i class="fa fa-paper-plane"></i> บันทึก
                    </button>
                </p>
            </form>
            
            </div>
          </div>
        </div>
      </div>

<?php include "../../layout/footer.php" ?>
</div>
  </body>
  </html>

  <script>
  const myForm = document.getElementById('alert');
  myForm.style.display = 'block';
  setTimeout(() => {
    myForm.style.display = 'none';
  }, 3000);
</script>