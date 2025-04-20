<?php
session_start();
include_once "connection.php"; // Ensure this file correctly connects to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize input data
    $Name = mysqli_real_escape_string($conn, $_POST["Name"]);
    $Email = mysqli_real_escape_string($conn, $_POST["Email"]);
    $Room_type = mysqli_real_escape_string($conn, $_POST["Room_type"]);
    $Room_number = mysqli_real_escape_string($conn, $_POST["Room_number"]);
    $Check_in = mysqli_real_escape_string($conn, $_POST["Check_in"]);
    $Check_out = mysqli_real_escape_string($conn, $_POST["Check_out"]);
    $Amount = mysqli_real_escape_string($conn, $_POST["Amount"]);
    $Payment_method = mysqli_real_escape_string($conn, $_POST["Payment_method"]);

    // Check if email already exists
    $checkStmt = mysqli_prepare($conn, "SELECT Email FROM Room_Details WHERE Email = ?");
    mysqli_stmt_bind_param($checkStmt, "s", $Email);
    mysqli_stmt_execute($checkStmt);
    $result = mysqli_stmt_get_result($checkStmt);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already exists! Try another one.'); window.history.back();</script>";
    } else {
        // Insert user data into the database using a prepared statement
        $stmt = mysqli_prepare($conn, "INSERT INTO Room_Details (Name, Email, Room_type, Room_number, Check_in, Check_out, Amount, Payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssssss", $Name, $Email, $Room_type, $Room_number, $Check_in, $Check_out, $Amount, $Payment_method);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['user_email'] = $Email;
                echo "<script>alert('Booking Successful!'); window.location.href='Payment.php';</script>";
            } else {
                echo "<script>alert('Failed to save booking. Please try again.');</script>";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Hotels | Basin Volta Hotel | Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('Payment.jpeg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        .header {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px 15px;
            border-radius: 5px;
        }

        .payment-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        input, select, button {
            width: 100%;
            padding: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            height: 55px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    
    <div class="header">
        <h2 style="font-family: fantasy">Basin Volta</h2> 
        <h3 style="font-style:oblique; font-family: fantasy;">Hotels&#8482;</h3>  
    </div>

    <div class="payment-container">
        <h2 style="font-family: fantasy">Room Details</h2>
        <form id="payment-form" method="POST">
            <input type="text" name="Name" placeholder="Full Name" required>
            <input type="email" name="Email" placeholder="Email" required>

            <select id="room-type" name="Room_type" required onchange="updateRoomDetails()">
                <option value="">Select Room Type</option>
                <option value="luxury">Luxury ($550/night)</option>
                <option value="business">Business ($400/night)</option>
                <option value="economy">Economy ($300/night)</option>
            </select>

            <select id="room-number" name="Room_number" required>
                <option value="">Select Room Number</option>
            </select>

            <p>Check-in Date: <span id="checkInDisplay"></span></p>
            <input type="hidden" id="checkInInput" name="Check_in">
            
            <p>Check-out Date: <span id="checkOutDisplay"></span></p>
            <input type="hidden" id="checkOutInput" name="Check_out">
            
            <p>Total Days: <span id="totalDaysDisplay"></span></p>
            
            <p><strong>Total Amount: $<span id="totalAmount">0</span></strong></p>
            <input type="hidden" id="totalAmountInput" name="Amount">

            <select name="Payment_method" required>
                <option value="">Select Payment Method</option>
                <option value="Visa">Visa Card</option>
                <option value="Paypal">PayPal</option>
                <option value="Cash">Cash</option>
                <option value="American Card">American Card</option>
            </select>

            <button type="submit">Proceed to Payment</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let checkInDate = localStorage.getItem("checkInDate") || "";
            let checkOutDate = localStorage.getItem("checkOutDate") || "";
            let totalDays = parseInt(localStorage.getItem("totalDays")) || 1;

            document.getElementById("checkInDisplay").textContent = checkInDate;
            document.getElementById("checkOutDisplay").textContent = checkOutDate;
            document.getElementById("totalDaysDisplay").textContent = totalDays;

            document.getElementById("checkInInput").value = checkInDate;
            document.getElementById("checkOutInput").value = checkOutDate;
        });

        function updateRoomDetails() {
            let roomType = document.getElementById("room-type").value;
            let roomSelect = document.getElementById("room-number");
            let totalDays = parseInt(document.getElementById("totalDaysDisplay").textContent) || 1;
            let pricePerNight = 0;
            let roomCount = 0;

            roomSelect.innerHTML = "";

            if (roomType === "luxury") {
                roomCount = 8;
                pricePerNight = 550;
            } else if (roomType === "business") {
                roomCount = 10;
                pricePerNight = 400;
            } else if (roomType === "economy") {
                roomCount = 50;
                pricePerNight = 300;
            }

            for (let i = 1; i <= roomCount; i++) {
                let option = document.createElement("option");
                option.value = i;
                option.textContent = "Room " + i;
                roomSelect.appendChild(option);
            }

            let totalAmount = (totalDays * pricePerNight).toFixed(2);
            document.getElementById("totalAmount").textContent = totalAmount;
            document.getElementById("totalAmountInput").value = totalAmount;
        }
    </script>
</body>
</html>
