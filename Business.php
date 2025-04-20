<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Hotels | Basin Volta Hotel | Login | Business </title>
    <style>
        body {
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: auto;
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            position: relative;
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
        .business-text {
            font-family: fantasy;
            font-weight: bold;
            font-size: 40px;
            margin: 80px 0 15px;
        }
        .container {
            position: relative;
            width: 400px;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .room {
            position: absolute;
            width: 80px;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            cursor: pointer;
            font-weight: bold;
            text-align: center;
            transition: transform 0.3s ease, background 0.3s, filter 0.3s;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            border: 2px solid #000;
            font-size: 14px;
        }
        .room:hover {
            transform: scale(1.2) translateY(-5px);
        }
        .booked {
            filter: blur(3px);
            background-color: rgba(151, 56, 56, 0.8);
        }
        .room span {
            position: absolute;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 5px 8px;
            border-radius: 5px;
        }
        .booked span {
            background: rgba(255, 0, 0, 0.7);
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

    <video autoplay loop muted playsinline>
        <source src="BRoom.mov" type="video/mp4">
    </video>

    <div class="header">
        <h2 style = "font-family: fantasy">Basin Volta</h2> 
        <h3 style = "font-style:oblique; font-family: fantasy;">Hotels&#8482;</h3>  
    </div>

    <div class="business-text">BUSINESS</div>

    <div class="container" id="roomContainer"></div>

    <div class="manager-controls">
        <button onclick="window.location.href='Room.php'">Proceed</button>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const container = document.getElementById("roomContainer");
            const numRooms = 10;
            const radius = 150;
            let bookedRooms = JSON.parse(localStorage.getItem("bookedRooms")) || {};

            const imageUrls = Array(10).fill('businessboxes.jpeg');

            for (let i = 0; i < numRooms; i++) {
                const angle = ((i + 1) / numRooms) * (2 * Math.PI) - Math.PI / 2;
                const x = radius * Math.cos(angle);
                const y = radius * Math.sin(angle);

                const room = document.createElement("div");
                room.classList.add("room");
                room.style.backgroundImage = `url(${imageUrls[i]})`;
                room.style.left = `calc(50% + ${x}px - 40px)`; 
                room.style.top = `calc(50% + ${y}px - 40px)`;

                const roomLabel = document.createElement("span");
                roomLabel.textContent = bookedRooms[i + 1] ? "Booked" : `Room ${i + 1}`;
                room.appendChild(roomLabel);

                if (bookedRooms[i + 1]) {
                    room.classList.add("booked");
                }

                room.addEventListener("click", () => toggleBooking(room, roomLabel, i + 1));
                container.appendChild(room);
            }
        });

        function toggleBooking(room, roomLabel, roomNumber) {
            let bookedRooms = JSON.parse(localStorage.getItem("bookedRooms")) || {};

            if (bookedRooms[roomNumber]) {
                delete bookedRooms[roomNumber];
                room.classList.remove("booked");
                roomLabel.textContent = `Room ${roomNumber}`;
            } else {
                bookedRooms[roomNumber] = true;
                room.classList.add("booked");
                roomLabel.textContent = "Booked";
            }

            localStorage.setItem("bookedRooms", JSON.stringify(bookedRooms));
        }
    </script>

</body>
</html>