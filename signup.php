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
