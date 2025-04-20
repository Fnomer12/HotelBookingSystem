<?php
session_start();
include_once "staffconnection.php"; // Connect to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and collect form inputs
    $Fullname = mysqli_real_escape_string($conn, $_POST["Fullname"]);
    $Phone_Number = mysqli_real_escape_string($conn, $_POST["Phone_Number"]);
    $Gender = mysqli_real_escape_string($conn, $_POST["Gender"]);
    $Department = mysqli_real_escape_string($conn, $_POST["Department"]);
    $Email = mysqli_real_escape_string($conn, $_POST["Email"]);
    $Password = password_hash($_POST["Password"], PASSWORD_DEFAULT);

    // Check for duplicate email
    $checkStmt = mysqli_prepare($conn, "SELECT * FROM SignUp WHERE Email = ?");
    mysqli_stmt_bind_param($checkStmt, "s", $Email);
    mysqli_stmt_execute($checkStmt);
    $result = mysqli_stmt_get_result($checkStmt);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already exists! Try another one.');</script>";
    } else {
        // Insert new staff data
        $stmt = mysqli_prepare($conn, "INSERT INTO SignUp (Fullname, Phone_Number, Gender, Department, Email, Password) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssss", $Fullname, $Phone_Number, $Gender, $Department, $Email, $Password);
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['user_email'] = $Email;
                // Redirect to StaffLogIn.php page after successful sign-up
                echo "<script>alert('Sign Up Successful!'); window.location.href='StaffLogIn.php';</script>";
                exit;
            } else {
                echo "<script>alert('Failed to sign up. Please try again.');</script>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Database error.');</script>";
        }
    }
    mysqli_stmt_close($checkStmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Basin Volta Hotel | Staff Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('stafftrack1.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background: rgba(0, 0, 0, 0.7);
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
            width: 320px;
            text-align: center;
        }
        h2 { margin-bottom: 15px; font-family: fantasy; }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
            position: relative;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input { background: #fff; color: #333; }
        button {
            background: #27ae60;
            color: white;
            font-weight: bold;
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
        }
        button:hover {
            background: #219150;
        }
        .eye-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
        #message {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Staff Sign Up</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="signupForm">
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
                </select>
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <select id="department" name="Department" required>
                    <option value="">Select Department</option>
                    <option value="Kitchen">Kitchen</option>
                    <option value="Housekeeping">Housekeeping</option>
                    <option value="Accounting">Accounting</option>
                    <option value="Front Office">Front Office</option>
                    <option value="Human Resources">Human Resources</option>
                    <option value="Maintenance Engineering">Maintenance Engineering</option>
                    <option value="Sales & Marketing">Sales & Marketing</option>
                    <option value="Security">Security</option>
                    <option value="Event Management">Event Management</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
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
            <button type="submit" name= "save">Sign Up</button>
        </form>
    </div>

    <script>
        function togglePassword(fieldId, icon) {
            const field = document.getElementById(fieldId);
            if (field.type === "password") {
                field.type = "text";
                icon.textContent = "🙈";
            } else {
                field.type = "password";
                icon.textContent = "👁️";
            }
        }

        document.getElementById("signupForm").addEventListener("submit", function(event) {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;
            if (password !== confirmPassword) {
                event.preventDefault();
                document.getElementById("message").textContent = "Passwords do not match!";
            }
        });
    </script>

</body>
</html>






