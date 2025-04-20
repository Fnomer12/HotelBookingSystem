<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Luxury Hotels | Basin Volta Hotel</title>
    <style>
        body {
            margin: 0;
            padding: 20px;
            font-family: "Palatino Linotype", "Palatino", serif;
            text-align: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #e0e0e0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            width: calc(100% - 20px);
        }

        .top-left {
            text-align: center;
        }

        h2, h4 {
            margin: 0;
        }

        .nav-links {
            display: flex;
            gap: 15px;
        }

        .nav-links a {
            text-decoration: none;
            background-color: #81be31cf;
            color: #000;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 16px;
            transition: background-color 0.3s ease-in-out;
        }

        .nav-links a:hover {
            background-color: #30b09f;
        }

        .background-box {
            width: 105%;
            max-width: 3000000px;
            height: 90vh;
            background: url("Basin.jpg") center/ cover no-repeat;
            border-radius: 50px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 50px; /* Adjusted position */
        }

        .booking-box {
            background: rgba(255, 255, 255, 0.85);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .booking-box input,
        .booking-box button {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .booking-box button {
            background-color: #81be31cf;
            cursor: pointer;
            border: none;
            font-weight: bold;
        }

        .booking-box button:hover {
            background-color: #30b09f;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: rgb(0, 0, 0);
            background-color: #81be31cf;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
          }
          
          .button:hover {
            background-color: #30b09f;
          }

        .arrow {
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 30px solid #30b09f;
            margin-top: 10px;
        }

        .luxury-text {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-top: 10px;
        }

        .never-settle {
            font-size: 3rem;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            background: linear-gradient(45deg, #2b798a, #498972, #40b96a);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            letter-spacing: 3px;
            text-shadow: 2px 2px 8px rgba(255, 255, 255, 0.3);
            animation: glow 2s infinite alternate;
        }

        @keyframes glow {
            0% {
                text-shadow: 2px 2px 8px rgba(255, 255, 255, 0.3);
            }
            100% {
                text-shadow: 2px 2px 15px rgba(255, 255, 255, 0.6);
            }
        }
         
        .arrow {
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 30px solid #30b09f;
            margin-top: 10px;
        }
        .video-container {
            margin-top: 50px;
        }
        
        video {
            width: 1450px; /* Wider width */
            height: 600px; /* Shorter height */
            object-fit: cover; /* Ensures the video fills the defined dimensions */
            border-radius: 30px; /* Soft rounded corners */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        .arrow {
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 30px solid #30b09f;
            margin-top: 10px;
        }

        .bottom-section {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            margin-top: 30px;
            padding: 20px;
        }
        .location-box {
            background: #f8f8f8;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .hotel-location {
            font-size: 18px;
            font-weight: bold;
            color: #2b798a;
        }
        .hotel-location h3 {
            color: #30b09f;
            font-size: 22px;
            margin-bottom: 10px;
        }
        .hotel-location p {
            margin: 5px 0;
            color: #555;
        }
        .social-icons {
            margin-top: 10px;
        }
        .social-icons a {
            font-size: 30px;
            color: #30b09f;
            transition: transform 0.3s ease-in-out, color 0.3s;
            margin: 0 10px;
        }
        .social-icons a:hover {
            transform: scale(1.2);
            color: #2b798a;
        }
        .image-subscribe-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .image-container {
            display: flex;
            gap: 20px;
            justify-content: center;
        }
        .image-container img {
            width: 200px;
            height: 200px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, filter 0.3s ease-in-out;
        }
        .image-container img:hover {
            transform: scale(1.1);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.5);
            filter: brightness(1.2);
        }
        .container {
            margin-top: 20px;
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        .subscribe-box {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
        }
        .input-container {
            display: flex;
            align-items: center;
            background: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .input-container i {
            color: #007bff;
            margin-right: 10px;
        }
        .input-container input {
            border: none;
            outline: none;
            font-size: 16px;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>  
    <div class="header">
        <div class="top-left">
            <h2 style="font-family: fantasy">Basin Volta</h2> 
            <h3 style="font-style: oblique; font-family: fantasy;">Hotels&#8482;</h3>
        </div>
        <div class="nav-links">
            <a href = "StaffTrack.php" >Staff Track</a>
            <a href = "basinvolta/offers.php" >Offers</a>
            <a href = "basinvolta/meetings-events.php" >Meetings & Events</a>
        </div>
    </div>
    <br>
    <br>
    <hr>
    <div class="background-box">
        <div class="booking-box">
            <label for="check-in">Check-in Date:</label>
            <input type="date" id="check-in" required>
            <br>
            <label for="check-out">Check-out Date:</label>
            <input type="date" id="check-out" required>
            <br>
            
            <button onclick="saveBookingDates()">Select</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let checkIn = document.getElementById("check-in");
            let checkOut = document.getElementById("check-out");
    
            // Set today's date as the minimum for check-in
            let today = new Date().toISOString().split("T")[0];
            checkIn.min = today;
    
            // When the check-in date changes, update the check-out date
            checkIn.addEventListener("change", function () {
                checkOut.min = checkIn.value; // Prevent selecting earlier check-out dates
                if (checkOut.value < checkIn.value) {
                    checkOut.value = checkIn.value; // Auto-correct check-out if necessary
                }
            });
        });
    </script>
    
    <div class="arrow"></div>
    <div class="luxury-text">LUXURY HOTELS</div>
    <h3 class="never-settle">NEVER SETTLE</h3>
    <p>We put you at the heart of it all with exceptionally designed luxury hotels in iconic destinations and the most stunning views.
       Our personal mission is to deliver unparalleled service and experiences, so that you never have to settle for anything less than extraordinary.
    </p>
    <p>Come see how we NEVER SETTLE.</p>
    <div class="arrow"></div>
    <div class="video-container">
        <video controls autoplay loop muted>
            <source src="introduction.mov" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <div class="arrow"></div>
    <br>

           <div class="bottom-section">
            <div class="hotel-location">
                <h3>Our Location</h3>
                <p>Basin Volta Hotel</p>
                <p>Honolulu County, Hawaii</p>
                <p>Phone: +1-(403)-456-7890</p>

                <!-- Social Media Icons Inside Location Box -->
                <div class="social-icons">
                    <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <div class="image-subscribe-container">
                <div class="image-container">
                    <img src="front.jpeg" alt="Restaurant">
                    <img src="Maldives.jpg" alt="Maldives">
                </div>
                
                <div class="container">
                    <h2>Get Exclusive News Updates from Basin Volta Hotel</h2>
                    <div class="subscribe-box">
                        <div class="input-container">
                            <i class="fas fa-envelope"></i>
                            <input type="email" placeholder="Enter your email address" required>
                        </div>
                        <button type="submit">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let checkIn = document.getElementById("check-in");
                let checkOut = document.getElementById("check-out");
        
                // Set the minimum check-in date to today
                let today = new Date().toISOString().split("T")[0];
                checkIn.min = today;
        
                // Ensure check-out date cannot be before check-in date
                checkIn.addEventListener("change", function () {
                    checkOut.min = checkIn.value;
                    if (checkOut.value < checkIn.value) {
                        checkOut.value = checkIn.value;
                    }
                });
            });
        
            function saveBookingDates() {
                let checkIn = document.getElementById("check-in").value;
                let checkOut = document.getElementById("check-out").value;
        
                if (!checkIn || !checkOut) {
                    alert("Please select both check-in and check-out dates.");
                    return;
                }
        
                // Store values in localStorage
                localStorage.setItem("checkInDate", checkIn);
                localStorage.setItem("checkOutDate", checkOut);
        
                // Calculate total days
                let inDate = new Date(checkIn);
                let outDate = new Date(checkOut);
                let totalDays = (outDate - inDate) / (1000 * 60 * 60 * 24);
        
                localStorage.setItem("totalDays", totalDays);
        
                // Redirect to Room.html
                window.location.href = "Room.php";
                window.location.href = "Select.php";
               
                window
            }
        </script>
</body>
</html>




























