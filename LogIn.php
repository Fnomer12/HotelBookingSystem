<?php
session_start();
include_once "connection.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Enable error reporting for debugging (remove in production)
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Get user input
    $Email = mysqli_real_escape_string($conn, $_POST["Email"]);
    $Password = $_POST["Password"];

    // Validate input fields
    if (empty($Email) || empty($Password)) {
        echo "<script>alert('All fields are required!');</script>";
    } else {
        // Prepare and execute SQL query
        $stmt = mysqli_prepare($conn, "SELECT Password FROM SignUp WHERE Email = ?");
        mysqli_stmt_bind_param($stmt, "s", $Email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Verify password
            if (password_verify($Password, $row["Password"])) {
                $_SESSION['user_email'] = $Email; // Store user session
                echo "<script>alert('Login Successful!'); window.location.href='Booking.php';</script>";
                exit();
            } else {
                echo "<script>alert('Incorrect password. Try again.');</script>";
            }
        } else {
            echo "<script>alert('Email not found. Please sign up first.');</script>";
        }

        // Close statement and connection
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | Basin Volta Hotel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #2c3e50, #4ca1af);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            flex-direction: column;
            overflow-y: auto;
        }
        video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        .container {
            background: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.3);
            width: 320px;
            text-align: center;
            margin-bottom: 20px;
        }
        h2 { margin-bottom: 15px; }
        .form-group { 
            margin-bottom: 15px; 
            text-align: left; 
            position: relative; 
        }
        label { display: block; font-weight: bold; }
        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input { background: #ffffff; color: #333; }
        button {
            background: #27ae60;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover { background: #219150; }
        .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        #message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <video autoplay loop muted playsinline>
        <source src="Page.mov" type="video/mp4">
    </video>

    <div class="header">
        <h2 style="font-family: fantasy">Basin Volta</h2> 
        <h3 style="font-style: oblique; font-family: fantasy;">Hotels&#8482;</h3>  
    </div>

    <div class="container">
        <h2>Log In</h2>
        <form method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="Password" required>
                <span class="eye-icon" onclick="togglePassword('password', this)">👁️</span>
            </div>
            <p id="message"></p>
            <button type="submit" name = "save" >Log In</button>
        </form>
    </div>

    <script>
        function togglePassword(fieldId, icon) {
            let input = document.getElementById(fieldId);
            if (input.type === "password") {
                input.type = "text";
                icon.textContent = "🙈";
            } else {
                input.type = "password";
                icon.textContent = "👁️";
            }
        }
    </script>
</body>
</html>







