<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "email" and "password" fields are set in the $_POST array
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Dummy credentials (replace this with actual database check)
        $correctEmail = "test@example.com";
        $correctPassword = "password123";

        // Check if the credentials match
        if ($email == $correctEmail && $password == $correctPassword) {
            echo "<script>alert('Đăng nhập thành công!');</script>";
        } else {
            echo "<script>alert('Đăng nhập thất bại! Email hoặc mật khẩu không đúng.');</script>";
        }
    } else {
        // If the email or password is not set, show an alert
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <title>Đăng nhập</title>
</head>
<body>
    <div class="container">
        <div class="form">
            <span class="title">Đăng nhập</span>
            <form action="login.php" method="post">
                <div class="input-field">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class="uil uil-envelope-alt icon"></i>
                </div>
                <div class="input-field">
                    <input type="password" name="password" class="password" placeholder="Mật khẩu" required>
                    <i class="uil uil-lock icon"></i>
                </div>
                <div class="checkbox-text">
                    <div class="checkbox-content">
                        <input type="checkbox" id="logCheck">
                        <label for="logCheck" class="text">Ghi nhớ tài khoản</label>
                    </div>
                    <a href="forgotpass.html" class="text">Quên mật khẩu</a>
                </div>
                <div class="input-field button">
                    <input type="submit" value="Đăng nhập">
                </div>
                <div class="login-signup">
                    <span class="text">Bạn chưa có tài khoản?
                            <a href="signup.html" class="text signup-link">Đăng kí</a>
                        </span>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
