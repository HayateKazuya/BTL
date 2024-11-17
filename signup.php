<?php
// Initialize variables to hold the form input values and error messages
$name = '';
$email = '';
$phone = '';
$password = '';
$confirmPassword = '';
$errorMessage = '';
$successMessage = '';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    if (isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['password'], $_POST['confirm_password'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        // Check if password and confirm password match
        if ($password !== $confirmPassword) {
            $errorMessage = "Mật khẩu không khớp. Vui lòng nhập lại.";
        } else {
            // Dummy data for successful registration (replace with your database logic)
            $successMessage = "Đăng kí thành công!";

            header("Location: login.html");
            exit();
        }
    } else {
        $errorMessage = "Vui lòng nhập đầy đủ thông tin.";
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
    <title>Đăng kí</title>
</head>

<body>
    <div class="container">
        <div class="form">
            <span class="title">Đăng kí</span>

            <!-- Display success or error message -->
            <?php if ($successMessage): ?>
                <script>alert('<?php echo $successMessage; ?>');</script>
            <?php elseif ($errorMessage): ?>
                <script>alert('<?php echo $errorMessage; ?>');</script>
            <?php endif; ?>

            <form action="signup.php" method="post">
                <div class="input-field">
                    <input type="text" name="name" placeholder="Họ và tên" value="<?php echo htmlspecialchars($name); ?>" required>
                    <i class="uil uil-user icon"></i>
                </div>
                <div class="input-field">
                    <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
                    <i class="uil uil-envelope-alt icon"></i>
                </div>
                <div class="input-field">
                    <input type="text" name="phone" placeholder="Số điện thoại" value="<?php echo htmlspecialchars($phone); ?>" required>
                    <i class="uil uil-phone icon"></i>
                </div>
                <div class="input-field">
                    <input type="password" name="password" class="password" placeholder="Mật khẩu" required>
                    <i class="uil uil-lock icon"></i>
                </div>
                <div class="input-field">
                    <input type="password" name="confirm_password" class="password" placeholder="Nhập lại mật khẩu" required>
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
            </form>
        </div>
    </div>
</body>

</html>
