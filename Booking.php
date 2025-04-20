<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Luxury Hotels | Basin Volta Hotel | Login | Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('Rooms.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            text-align: center;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content {
            max-width: 600px;
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            padding: 40px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        h1, p {
            margin: 10px 0;
        }

        .image-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px; /* Space between images */
            width: 100%;
            margin-top: 20px; /* Space between text and images */
        }

        .image-container a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
            width: 100%;
            text-align: center;
        }

        .image-container img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s ease;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .image-container img:hover {
            transform: scale(1.05);
        }

        .image-container a:hover {
            text-decoration: solid;
        }

    </style>
</head>
<body>
    <div class="content">
        <h1>Welcome to Basin Volta Hotel</h1>
        <p style="font-style: italic; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">
            SELECT YOUR ROOM
        </p>

        <!-- Images displayed in a clean vertical list -->
        <div class="image-container">
            <a href="Luxury.php">
                <img src="Luxury.jpg" alt="Luxury">
                <br>LUXURY
            </a>
            <a href="Business.php">
                <img src="Business.jpg" alt="Business">
                <br>BUSINESS
            </a>
            <a href="Economy.php">
                <img src="Economy.jpg" alt="Economy">
                <br>ECONOMY
            </a>
        </div>
    </div>
</body>
</html>












