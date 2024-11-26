<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baitaplon";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['password'], $_POST['confirm_password'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        if ($password !== $confirmPassword) {
            echo "<script>
            alert('Mật khẩu không trùng khớp, vui lòng nhập lại!');
            window.location.href = 'signup.html';
            </script>";
            exit();
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash password securely


        $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $hashedPassword);


        if ($stmt->execute()) {
            echo "<script>
                        alert('Đăng kí thành công!');
                        window.location.href = 'login.html';
                    </script>";
            exit();
        }
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
    <title>Đăng ký</title>
</head>

<body>
    <div class="container">
        <form action="signup.php" method="POST">
            <div class="form">
                <span class="title">Đăng kí</span>

                <div class="input-field">
                    <input type="text" name="name" placeholder="Họ và tên" required>
                    <i class="uil uil-user icon"></i>
                </div>

                <div class="input-field">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class="uil uil-envelope-alt icon"></i>
                </div>

                <div class="input-field">
                    <input type="text" name="phone" placeholder="Số điện thoại" required>
                    <i class="uil uil-phone icon"></i>
                </div>

                <div class="input-field">
                    <input type="password" name="password" class="password" placeholder="Mật khẩu" required>
                    <i class="uil uil-lock icon"></i>
                </div>

                <div class="input-field">
                    <input type="password" name="confirm_password" class="password" placeholder="Nhập lại mật khẩu"
                        required>
                    <i class="uil uil-lock icon"></i>
                </div>

                <div class="input-field button">
                    <input type="submit" value="Đăng kí">
                </div>

                <div class="login-signup">
                    <span class="text">Bạn đã có tài khoản?
                        <a href="login.html" class="text login-link">Đăng nhập</a>
                    </span>
                </div>
            </div>
        </form>
    </div>
</body>

</html>