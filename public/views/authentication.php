<?php
session_start();
ob_start();

include_once "../../libraries/connectDB.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <link rel="stylesheet" href="../assets/css/base.css" />
    <link rel="stylesheet" href="../assets/fonts/themify-icons/themify-icons.css" />
    <link rel="stylesheet" href="../assets/css/authentication.css" />
    <link href="../../shared/img/logo-icon.png" rel="shortcut icon" type="image/x-icon" />

    <?php
    $pageTitle = "Đăng nhập - Tra cứu đơn hàng";
    ?>
    <title>
        <?php echo $pageTitle ?>
    </title>

</head>

<body>
    <?php include "../components/header.php" ?>

    <section>
        <div class="row">
            <div class="col-6 d-flex align-items-center justify-content-center flex-column">
                <img src="../assets/img/login.png" alt="">
            </div>
            <div class="col-6 d-flex align-items-center justify-content-center flex-column ">
                <div class="border border-light-subtle rounded-3 form">
                    <form action="" method="post">
                        <div id="sender" style="display: block;">
                            <h4 class="w-100 text-center">Tra cứu thông tin đơn hàng</h4>
                            <input class="w-100 p-2 px-3 mb-3 rounded-pill border border-danger-subtle" type="text" id="phone" placeholder="+(84) Nhập số điện thoại" required autofocus>
                            <div class="w-100 mb-3" id="recaptcha-container"></div>
                            <input class="btn btn-outline-success w-100" type="button" id="send" value="TIẾP TỤC" onClick="phoneAuth()">
                        </div>
                    </form>

                    <div id="verifier" style="display: none;">
                        <input type="text" id="verificationcode" class="p-2 mb-3 rounded-pill border border-danger-subtle" placeholder="Nhập mã OTP" required autofocus>
                        <input type="button" id="verify" class="btn btn-outline-success" value="Xác nhận" onClick="codeverify()">
                        <div class="p-conf w-100">Mã OTP hợp lệ!</div>
                        <div class="n-conf">Mã OTP không hợp lệ!</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "../components/footer.php" ?>
</body>

<!-- Add firebase SDK -->
<script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-auth-compat.js"></script>
<script src="../js/firebase-config.js"></script>


<!-- Include jQuery library if not already included -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    var phone; // Declare the phone variable at the global level

    render();

    function render() {
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }

    function setPhoneNumber() {
        phone = document.getElementById('phone').value;

        // Loại bỏ số 0 ở đầu nếu có
        phone = phone.replace(/^0+/, '');

        // Thêm +84 nếu chưa có
        if (!phone.startsWith('+84')) {
            phone = '+84' + phone;
        }
    }

    function phoneAuth() {
        setPhoneNumber();

        firebase.auth().signInWithPhoneNumber(phone, window.recaptchaVerifier)
            .then(function(confirmationResult) {
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;

                document.getElementById('sender').style.display = 'none';
                document.getElementById('verifier').style.display = 'block';
            })
            .catch(function(error) {
                alert(error.message);
            });
    }

    function codeverify() {
        var code = document.getElementById('verificationcode').value;
        coderesult.confirm(code)
            .then(function() {
                document.getElementsByClassName('p-conf')[0].style.display = 'block';
                document.getElementsByClassName('n-conf')[0].style.display = 'none';

                // Gọi PHP để xử lý và lưu dữ liệu người dùng vào cơ sở dữ liệu
                saveUserData();
            })
            .catch(function() {
                document.getElementsByClassName('p-conf')[0].style.display = 'none';
                document.getElementsByClassName('n-conf')[0].style.display = 'block';
            });
    }

    // Tăng cường chức năng chuyển hướng
    function redirectToPage(role) {
        switch (role) {
            case '1':
                window.location.href = '../../admin/views/dashboard.php';
                break;
            case '2':
                window.location.href = '../views/index.php';
                break;
            default:
                window.location.href = '../views/index.php';
        }
    }

    function saveUserData() {
        $.ajax({
            type: 'POST',
            url: '../backend/auth.php',
            data: {
                phone: phone
            },
            success: function(response) {
                console.log(response);

                // Parse JSON response (if applicable)
                var data = JSON.parse(response);

                // Check if 'role' is present in the response
                if (data && data.role) {
                    // Redirect based on the user's role
                    redirectToPage(data.role);
                } else {
                    console.log("Role not found in the response.");
                }
            },
            error: function(error) {
                console.log("Error: " + error.responseText);
            }
        });
    }
</script>


</html>