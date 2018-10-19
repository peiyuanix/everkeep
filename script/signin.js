$(document).ready(function () {
    $("#signin_submit").click(function () {

        closeTip();

        let form = new FormData();
        let email = $("#email").val();
        let password = $("#password").val();
        let password_sha1 = SHA1(password);

        if(false) {

        }

        form.append("email", email);
        form.append("password", password_sha1);

        $.ajax({
            url: "../server/signin.php",
            type: 'post',
            data: form,
            processData: false,
            contentType: false,
            success: function (response_data) {
                console.log(response_data);
                let response = JSON.parse(response_data);
                if (response['code'] == 0) {

                    console.log("登录成功");
                    alert("登录成功");
                    window.location.href="../index.php";
                }
                else if (response['code'] == 76) {
                    console.error("登录失败: " + response_data);
                    // sendErrorNotification("注册失败");
                    sendEmailTip("用户不存在，请先注册再登录。");
                }
                else if (response['code'] == 70) {
                    console.error("登录失败: " + response_data);
                    // sendErrorNotification("注册失败");
                    sendEmailTip("邮箱格式错误");
                }
                else if (response['code'] == 75) {
                    console.error("登录失败: " + response_data);
                    // sendErrorNotification("注册失败");
                    sendPasswordTip("密码格式错误");
                }
                else if (response['code'] == 73) {
                    console.error("登录失败: " + response_data);
                    // sendErrorNotification("注册失败");
                    sendPasswordTip("密码错误");
                }
                else {
                    console.error("登录失败: " + response_data);
                    // sendErrorNotification("注册失败");
                    sendEmailTip("未知错误");
                }

            },
            error: function (e) {
                console.error("登录失败： " + e);
                // sendErrorNotification("注册失败，请检查网络状态！");
            },
        });
    });
});

function sendEmailTip(msg) {
    $(".email_tip").text(msg).slideDown();
}

function sendPasswordTip(msg) {
    $(".password_tip").text(msg).slideDown();
}

function closeTip() {
    $(".password_tip, .email_tip").hide();
}

function closeEmailTip() {
    $(".email_tip").hide();
}

function closePasswordTip() {
    $(".password_tip").hide();
}