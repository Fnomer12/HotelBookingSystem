<?php
ob_start(); // Start output buffering
session_start();
include_once "staffconnection.php"; // Database connection

// Enable error reporting for debugging (optional for production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = mysqli_real_escape_string($conn, $_POST["Email"]);
    $Password = $_POST["Password"];

    if (empty($Email) || empty($Password)) {
        echo "<script>alert('All fields are required!');</script>";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT Password FROM SignUp WHERE Email = ?");
        mysqli_stmt_bind_param($stmt, "s", $Email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($Password, $row["Password"])) {
                $_SESSION['user_email'] = $Email;

                // Redirect to StaffActivities.php
                header("Location: StaffActivities.php");
                exit();
            } else {
                echo "<script>alert('Incorrect password. Try again.');</script>";
            }
        } else {
            echo "<script>alert('Email not found. Please sign up first.');</script>";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: url('stafftrack1.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            width: 320px;
            box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #00796b;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            background-color: #00796b;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #004d40;
        }

        .signup-link {
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Staff Login</h2>
        <form method="POST">
            <input type="email" name="Email" placeholder="Email" required>
            <input type="password" name="Password" placeholder="Password" required>
            <button type="submit" name="save" class="btn">Login</button>
        </form>
        <p class="signup-link">Don't have an account? <a href="StaffSignUp.php">Sign up here</a></p>
    </div>
</body>
</html>

<?php ob_end_flush(); // Flush the output buffer ?>














