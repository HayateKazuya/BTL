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
