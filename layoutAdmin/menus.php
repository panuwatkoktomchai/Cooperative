<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-container">
        <h4 class="w3-center">ผู้ดูแลระบบ</h4>
        <p class="w3-center"><img src="<?php echo $_SESSION['user']['image']; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
        <p><a href="/cooper/view/profile/edit.php">แก้ใข</a></p>
        <hr>
        <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> <?php echo $_SESSION['user']['name'] ?></p>
        <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>  <?php echo $_SESSION['user']['email'] ?></p>
        <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i>  <?php echo $_SESSION['user']['phone'] ?></p>
    </div>
  </div>
  <hr>
  <div class="w3-bar-block">
    <a href="/cooper/index.php" class="w3-bar-item w3-button w3-light-gray w3-hover-blue-gray"><i class="fa fa-home"></i>  หน้าหลัก</a>
    <a href="/cooper/view/setting/setting.php" class="w3-bar-item w3-button w3-light-gray w3-hover-blue-gray"><i class="fa fa-cog"></i>  จัดการข้อมุลพื้นฐาน</a>
    <!-- <button onclick="myFunction('Demo1')" class="w3-btn w3-block w3-light-gray w3-left-align w3-hover-blue-gray"> <i class="fa fa-list"></i> การผลิต </button>
      <div id="Demo1" style="padding-left:20px" class="w3-hide">
        <a href="/cooper/view/orderMaterial/form.php" class="w3-bar-item w3-button w3-padding"><i class="w3-text-orange fa fa-file-text fa-fw"></i>  สั่งซื้อวัสดุ</a>
        <a href="/cooper/view/reciveMaterial/recive.php" class="w3-bar-item w3-button w3-padding"><i class="w3-text-orange fa fa-truck fa-fw"></i>  รับวัสดุ</a>
        <a href="/cooper/view/produce/form.php" class="w3-bar-item w3-button w3-padding"><i class="w3-text-orange fa fa-legal fa-fw"></i>  สั่งผลิต</a>
      </div>
    <button onclick="myFunction('report')" class="w3-btn w3-block w3-light-gray w3-left-align w3-hover-blue-gray"> <i class="fa fa-list"></i> รายงาน </button>
      <div id="report" style="padding-left:20px" class="w3-hide">
        <a href="/cooper/view/report/orderMaterial/index.php" class="w3-bar-item w3-button w3-padding"><i class="w3-text-orange fa fa-file-text fa-fw"></i>  รายงานสั่งซื้อวัสดุ</a>
        <a href="/cooper/view/report/reciveMaterial/index.php" class="w3-bar-item w3-button w3-padding"><i class="w3-text-orange fa fa-file-text fa-fw"></i>  รายงานรับวัสดุ</a>
        <a href="/cooper/view/report/produceProduct/index.php" class="w3-bar-item w3-button w3-padding"><i class="w3-text-orange fa fa-truck fa-fw"></i>  รายงานสั่งผลิต</a>
      </div> -->
  </div>
</nav>
