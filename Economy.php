<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Hotels | Basin Volta Hotel | Login | Economy</title>
    <style>
        body {
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
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
        .header {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px 15px;
            border-radius: 5px;
            text-align: left;
        }
        .economy-text {
            font-family: fantasy;
            font-weight: bold;
            font-size: 40px;
            margin: 80px 0 15px;
        }
        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 10px;
            width: 90%;
            max-width: 800px;
            padding: 20px;
        }
        .room {
            width: 100px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.8);
            border: 2px solid #000;
            cursor: pointer;
            font-weight: bold;
            text-align: center;
            transition: background 0.3s;
        }
        .room:hover {
            background-color: rgba(255, 255, 255, 1);
        }
        .booked {
            background-color: rgb(151, 56, 56);
            color: white;
        }
        .manager-controls {
            margin-top: 20px;
        }
        .manager-controls button {
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            background: rgb(0, 123, 255);
            color: white;
            font-size: 14px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .manager-controls button:hover {
            background: rgb(0, 86, 179);
        }
    </style>
</head>
<body>

    <video autoplay loop muted>
        <source src="ERoom.mov" type="video/mp4">
    </video>

    <div class="header">
        <h2 style = "font-family: fantasy">Basin Volta</h2> 
        <h3 style = "font-style:oblique; font-family: fantasy;">Hotels&#8482;</h3>  
    </div>

    <div class="economy-text">ECONOMY</div>

    <div class="container" id="roomContainer"></div>

    <div class="manager-controls">
        <button onclick="proceedToPayment()">Proceed</button>
    </div>

    <script>
        const container = document.getElementById("roomContainer");

        // Load bookings from local storage
        let bookedRooms = JSON.parse(localStorage.getItem("bookedRooms")) || {};

        for (let i = 1; i <= 50; i++) {
            const room = document.createElement("div");
            room.classList.add("room");
            room.textContent = `Room ${i}`;

            // Check if the room is already booked
            if (bookedRooms[i]) {
                room.classList.add("booked");
                room.dataset.booked = "true";
                room.textContent += " (Booked)";
            } else {
                room.dataset.booked = "false";
            }

            room.addEventListener("click", () => toggleBooking(room, i));
            container.appendChild(room);
        }

        function toggleBooking(room, roomNumber) {
            if (room.dataset.booked === "false") {
                room.classList.add("booked");
                room.dataset.booked = "true";
                room.textContent = `Room ${roomNumber} (Booked)`;
                bookedRooms[roomNumber] = true;
            } else {
                room.classList.remove("booked");
                room.dataset.booked = "false";
                room.textContent = `Room ${roomNumber}`;
                delete bookedRooms[roomNumber];
            }
            localStorage.setItem("bookedRooms", JSON.stringify(bookedRooms));
        }

        function proceedToPayment() {
            window.location.href = "Room.php";
        }
    </script>

</body>
</html>



