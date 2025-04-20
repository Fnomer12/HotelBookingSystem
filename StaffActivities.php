<?php
require_once 'staffconnection.php';
session_start();

if (!isset($_SESSION['user_email'])) {
    header('Location: StaffActivities.php');
    exit();
}

$user_email = $_SESSION['user_email'];
$query = "SELECT Fullname, Department FROM SignUp WHERE Email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$stmt->bind_result($fullname, $department);
$stmt->fetch();
$stmt->close();

// Handle attendance submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['attendance'] ?? 'absent';
    $amount = ($status === 'present') ? 120 : 0;
    $today = date('Y-m-d');

    // Avoid duplicate entries for the same day
    $checkQuery = "SELECT * FROM Attendance WHERE user_email = ? AND date = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ss", $user_email, $today);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Insert attendance record
        $insertQuery = "INSERT INTO Attendance (user_email, date, status, amount) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sssi", $user_email, $today, $status, $amount);
        $stmt->execute();
    }
}

// Get attendance data for the current week (Sunday to Saturday)
$week_dates = [];
$week_amounts = [];
$today = date('Y-m-d');
$start_of_week = date('Y-m-d', strtotime('last sunday', strtotime($today))); // Sunday of the current week
$end_of_week = date('Y-m-d', strtotime('next saturday', strtotime($today))); // Saturday of the current week

// Query attendance data for this week (Sunday to Saturday)
$query = "SELECT date, amount FROM Attendance WHERE user_email = ? AND date BETWEEN ? AND ? ORDER BY date";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $user_email, $start_of_week, $end_of_week);
$stmt->execute();
$result = $stmt->get_result();

// Prepare data for the chart (Sunday to Saturday)
for ($i = 0; $i < 7; $i++) {
    $date = date('Y-m-d', strtotime("$start_of_week +$i days"));
    $week_dates[] = date('l', strtotime($date)); // Get the day of the week (e.g., Sunday, Monday, etc.)
    $week_amounts[] = 0; // Default value is 0 for each day
}

while ($row = $result->fetch_assoc()) {
    $attendance_date = $row['date'];
    $amount = $row['amount'];
    $day_of_week = date('l', strtotime($attendance_date)); // Get the day of the week

    // Update the amount for that day (e.g., Sunday, Monday, etc.)
    $day_index = array_search($day_of_week, $week_dates);
    if ($day_index !== false) {
        $week_amounts[$day_index] = $amount; // Add the attendance amount for that day
    }
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('stafftrack4.jpg') no-repeat center center fixed;
            margin: 0;
            padding: 0;
        }

        .top-bar {
               display: flex;
               justify-content: center;
                align-items: center;
              background-color: rgba(255, 255, 255, 0.5); /* Semi-transparent background */
                 padding: 20px 0;
                box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                 backdrop-filter: blur(10px); /* Apply blur to the background */
                  -webkit-backdrop-filter: blur(10px); /* For Safari support */
}


        canvas#analogClock {
            background: rgb(20, 20, 20); /* Semi-transparent white */
            backdrop-filter: blur(10px); /* Apply blur to the background */
            -webkit-backdrop-filter: blur(10px); /* For Safari support */
            border-radius: 50%;
            width: 150px;
            height: 150px;
            box-shadow: 0 0 15px rgb(90, 141, 171), inset 0 0 10px #999;
}


        .container {
    max-width: 900px;
    margin: 30px auto;
    padding: 20px;
    background: rgb(255, 255, 255); /* Semi-transparent white */
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.94);
    backdrop-filter: blur(10px); /* Apply blur to the background */
    -webkit-backdrop-filter: blur(10px); /* For Safari support */
}


        .attendance-form {
            margin: 30px 0;
            text-align: center;
        }

        .attendance-form label {
            font-size: 18px;
            margin-right: 20px;
        }

        .attendance-form button {
            padding: 10px 20px;
            font-size: 16px;
        }

        .present-table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        .present-table th, .present-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .chart-container {
            width: 100%;
            margin-top: 40px;
        }

        .date-display {
            font-size: 18px;
            margin-bottom: 15px;
            text-align: center;
            color: #444;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <canvas id="analogClock" width="150" height="150"></canvas>
</div>

<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($fullname); ?></h2>
    <p><strong>Department:</strong> <?php echo htmlspecialchars($department); ?></p>
    <div class="date-display" id="currentDate"></div>

    <form method="POST" class="attendance-form">
        <label><input type="radio" name="attendance" value="present" required> Present</label>
        <label><input type="radio" name="attendance" value="absent"> Absent</label>
        <br><br>
        <button type="submit">Save Attendance</button>
    </form>

    <!-- Display days marked as Present -->
    <h3>Days Present:</h3>
    <table class="present-table">
        <thead>
            <tr>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($week_dates as $index => $day): ?>
                <?php if ($week_amounts[$index] === 120): ?>
                    <?php 
                        // Get the full date for this day (e.g., "April 8, 2025")
                        $formatted_date = date('F j, Y', strtotime("$start_of_week +$index days"));
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($formatted_date); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="chart-container">
        <canvas id="chart"></canvas>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Show today's date
    document.getElementById("currentDate").textContent = new Date().toLocaleDateString('en-US', {
        weekday: "long", year: "numeric", month: "long", day: "numeric"
    });

    // Weekly Attendance Chart (Sunday to Saturday)
    const attendanceChart = new Chart(document.getElementById('chart'), {
        type: 'line',
        data: {
            labels: <?php echo json_encode($week_dates); ?>, // Days of the week
            datasets: [{
                label: 'Daily Earnings ($)',
                data: <?php echo json_encode($week_amounts); ?>, // Earnings for each day
                borderColor: '#007BFF',
                backgroundColor: 'rgba(0,123,255,0.1)',
                tension: 0.3,
                pointRadius: 5,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Weekly Attendance Earnings',
                    font: { size: 20 }
                },
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Amount ($)' }
                },
                x: {
                    title: { display: true, text: 'Day of Week' }
                }
            }
        }
    });

    // Analog Clock
    const canvas = document.getElementById("analogClock");
    const ctx = canvas.getContext("2d");
    const radius = canvas.height / 2;
    ctx.translate(radius, radius);
    setInterval(drawClock, 1000);

    function drawClock() {
        drawFace(ctx, radius);
        drawNumbers(ctx, radius);
        drawTime(ctx, radius);
    }

    function drawFace(ctx, radius) {
        let grad = ctx.createRadialGradient(0, 0, radius * 0.9, 0, 0, radius * 1.05);
        grad.addColorStop(0, '#fff');
        grad.addColorStop(0.5, '#ccc');
        grad.addColorStop(1, '#333');

        ctx.beginPath();
        ctx.arc(0, 0, radius, 0, 2 * Math.PI);
        ctx.fillStyle = grad;
        ctx.fill();

        ctx.strokeStyle = "#333";
        ctx.lineWidth = 6;
        ctx.stroke();

        ctx.beginPath();
        ctx.arc(0, 0, 5, 0, 2 * Math.PI);
        ctx.fillStyle = "#333";
        ctx.fill();
    }

    function drawNumbers(ctx, radius) {
        ctx.font = radius * 0.15 + "px Arial";
        ctx.textBaseline = "middle";
        ctx.textAlign = "center";
        for (let num = 1; num <= 12; num++) {
            let ang = num * Math.PI / 6;
            ctx.rotate(ang);
            ctx.translate(0, -radius * 0.85);
            ctx.rotate(-ang);
            ctx.fillText(num.toString(), 0, 0);
            ctx.rotate(ang);
            ctx.translate(0, radius * 0.85);
            ctx.rotate(-ang);
        }
    }

    function drawTime(ctx, radius) {
        const now = new Date();
        let hour = now.getHours();
        let minute = now.getMinutes();
        let second = now.getSeconds();

        hour = hour % 12;
        hour = (hour * Math.PI / 6) + (minute * Math.PI / (6 * 60)) + (second * Math.PI / (360 * 60));
        drawHand(ctx, hour, radius * 0.5, radius * 0.07);

        minute = (minute * Math.PI / 30) + (second * Math.PI / (30 * 60));
        drawHand(ctx, minute, radius * 0.8, radius * 0.07);

        second = (second * Math.PI / 30);
        drawHand(ctx, second, radius * 0.9, radius * 0.02);
    }

    function drawHand(ctx, pos, length, width) {
        ctx.strokeStyle = "#333";
        ctx.lineWidth = width;
        ctx.lineCap = "round";
        ctx.beginPath();
        ctx.moveTo(0, 0);
        ctx.rotate(pos);
        ctx.lineTo(0, -length);
        ctx.stroke();
        ctx.rotate(-pos);
    }
</script>
</body>
</html>




















