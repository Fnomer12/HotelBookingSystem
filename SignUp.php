<?php
session_start(); // Start the session
include_once "connection.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $Fullname = mysqli_real_escape_string($conn, $_POST["Fullname"]);
    $Phone_Number = mysqli_real_escape_string($conn, $_POST["Phone_Number"]);
    $Gender = mysqli_real_escape_string($conn, $_POST["Gender"]);
    $Email = mysqli_real_escape_string($conn, $_POST["Email"]);
    $Password = password_hash($_POST["Password"], PASSWORD_DEFAULT); // Hash the password

    // Check if the email already exists
    $checkStmt = mysqli_prepare($conn, "SELECT * FROM SignUp WHERE Email = ?");
    mysqli_stmt_bind_param($checkStmt, "s", $Email);
    mysqli_stmt_execute($checkStmt);
    $result = mysqli_stmt_get_result($checkStmt);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already exists! Try another one.');</script>";
    } else {
        // Insert user data into database using a prepared statement
        $stmt = mysqli_prepare($conn, "INSERT INTO SignUp (Fullname, Phone_Number, Gender, Email, Password) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssss", $Fullname, $Phone_Number, $Gender, $Email, $Password);
            if (mysqli_stmt_execute($stmt)) {
                // Store session and redirect to Booking.php
                $_SESSION['user_email'] = $Email;
                echo "<script>alert('Sign Up Successful!'); window.location.href='Payment.php';</script>";
            } else {
                echo "<script>alert('Failed to sign up. Please try again.');</script>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Database error.');</script>";
        }
    }
    mysqli_stmt_close($checkStmt);
    mysqli_close($conn); // Close the database connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Basin Volta Hotel</title>
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
        .form-group { margin-bottom: 15px; text-align: left; position: relative; }
        label { display: block; font-weight: bold; }
        input, select, button {
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
        <h3 style="font-style:oblique; font-family: fantasy;">Hotels&#8482;</h3>  
    </div>

    <div class="container">
        <h2>Sign Up</h2>
        <form method="POST" id="signupForm">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="Fullname" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="Phone_Number" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="Gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="Password" required>
                <span class="eye-icon" onclick="togglePassword('password', this)">👁️</span>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <span class="eye-icon" onclick="togglePassword('confirmPassword', this)">👁️</span>
            </div>
            <p id="message"></p>
            <button type="submit" name="save">Sign Up</button>
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

        document.getElementById("signupForm").addEventListener("submit", function(event) {
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                event.preventDefault();
                document.getElementById("message").textContent = "Passwords do not match!";
            }
        });
    </script>
</body>
</html>


