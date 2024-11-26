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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Escape user inputs to prevent SQL injection
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // SQL query to check for matching email
    $sql = "SELECT * FROM users WHERE email = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // If email exists, check password
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Successful login
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];

                echo "<script>
                        alert('Đăng nhập thành công!!');
                        window.location.href = '#';
                    </script>";
                exit();
            } else {
                // Incorrect password
                echo "<script>
                        alert('Sai mật khẩu! Vui lòng thử lại');
                        window.location.href = 'login.html';
                    </script>";
            }
        } else {
            // Email not found
            echo "<script>
                        alert('Email không tồn tại, vui lòng thử lại');
                        window.location.href = 'login.html';
                    </script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        // Query error
        echo "<script>
        alert('Đã có lỗi xảy ra! Vui lòng thử lại sau');
        window.location.href = 'login.html';
    </script>";
    }
}

// Close the connection
$conn->close();

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
        <form action="login.php" method="POST">
            <div class="form">
                <span class="title">Đăng nhập</span>

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
            </div>
        </form>
    </div>
</body>

</html>