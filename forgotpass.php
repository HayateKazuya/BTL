<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baitaplon";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/forgotpass.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <title>Đăng nhập và Đăng kí</title>
</head>

<body>
    <div class="container">
        <form action="forgotpass.php" method="POST">
            <div class="forms">
                <div class="form forgotpassword">
                    <span class="title">Quên mật khẩu</span>
                    <form action="#" method="post">
                        <div class="input-field">
                            <input type="text" placeholder=" Hãy nhập Email hoặc SĐT của bạn" required>
                            <i class="uil uil-envelope-alt icon"></i>
                        </div>
                        <div class="input-field button">
                            <input type="submit" value="Khôi phục tài khoản">

                        </div>
                        <div class="login-signup">
                            <span class="text">Bạn vẫn còn nhớ tài khoản của mình?
                                <a href="login.html" class="text login-link">Đăng nhập</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </form>
    </div>
</body>

</html>