<?php
session_start();
// ob_start();
?>

<link rel="stylesheet" href="./public/assets/css/authentication.css" />

<section>
    <div class="row">
        <div class="col-6 d-flex align-items-center justify-content-center flex-column">
            <img src="./public/assets/img/login.png" alt="">
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

<!-- Add firebase SDK -->
<script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-auth-compat.js"></script>
<script src="./public/js/firebase-config.js"></script>


<!-- Include jQuery library if not already included -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    firebase.initializeApp(firebaseConfig);
    render();
    
    var phone; // Declare the phone variable at the global level
    
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
    function redirectToPage(role, phone) {
        $.ajax({
            type: 'POST',
            url: './public/backend/redirect.php',
            data: {
                role: role,
                phone: phone
            },
            success: function(response) {
                console.log(response);

                // Redirect to the page returned in the response
                window.location.href = response;
            },
            error: function(error) {
                console.log("Error: " + error.responseText);
            }
        });
    }

    function saveUserData() {
        $.ajax({
            type: 'POST',
            url: './public/backend/auth.php',
            data: {
                phone: phone
            },
            success: function(response) {
                // console.log(response);

                // Parse JSON response (if applicable)
                var data = JSON.parse(response);
                // console.log(data);

                // Check if 'role' is present in the response
                if (data && data.role) {
                    // Redirect based on the user's role
                    redirectToPage(data.role, phone);
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