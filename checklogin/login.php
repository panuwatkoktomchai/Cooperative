<?php
include "../connection/connectMysql.php";
$user = $_REQUEST['user'];
$pass = $_REQUEST['pass'];
$sql = "select * from users where email = '".$user."' and password = '".$pass."'";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $data = $res->fetch_assoc();
    $_SESSION['user']['id'] = $data['id'];
    $_SESSION['user']['name'] = $data['name'];
    $_SESSION['user']['phone'] = $data['phone'];
    $_SESSION['user']['email'] = $data['email'];
    $_SESSION['user']['image'] = $data['image'];
    $_SESSION['user']['user_type'] = $data['user_type'];
    switch ($data['user_type']) {
        case 0:
            header('Location:/cooper/admin.php');
            break;
            
        default:
            header('Location:/cooper/index.php');
            break;
    }
}else {
    $_SESSION['alert']['status'] = "ล้มเหลว";
    $_SESSION['alert']['color'] = "red";
    $_SESSION['alert']['message'] = "error";
    header('Location:/cooper/login.php');
}
