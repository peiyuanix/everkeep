<?php
session_start();
if(!isset($_SESSION['uid_for_psd_reset'])) {
    header("Location: ../page/reset_request.html" );
    die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>小小笔记</title>
    <link type="text/css" rel="stylesheet" href="../css/sign_in_up.css">
    <script src="../lib/js/jquery-3.3.1.min.js"></script>
    <script src="../lib/js/sha1_encode.js"></script>
    <script src="../script/password_reset.js"></script>
    <script src="../script/sign_common.js"></script>
    <script src="../script/topNotification.js"></script>
</head>
<body>
<div>
    <div class="sign_logo"></div>
    <div class="sign_title">设置密码</div>
    <div class="sign_form_container">
        <div class="signup_form_container">
            <input type="password" id="password" class="sign_input" placeholder="密码">
            <div class="password_tip"  >密码不正确</div>
            <button id="modify_password" class="sign_submit">确定修改</button>
        </div>
    </div>
    <div class="go_sign_tip">
        <div class="no_sign">没有账号?</div>
        <div class="go_sign">
            <a href="../page/signup.html">创建账号</a>
        </div>
    </div>
</div>

</body>
</html>