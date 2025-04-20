<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Hotels | Basin Volta Hotel | Login | Luxury</title>
    <style>
        body {
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            overflow: hidden;
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
            top: 10px;
            left: 10px;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px 15px;
            border-radius: 5px;
        }
        .luxury-text {
            font-family: fantasy;
            font-size: 40px;
            font-weight: bold;
            margin: 20px 0;
        }
        .container {
            position: relative;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: 15px;
            max-width: 400px;
        }
        .room {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            color: white;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            border: 2px solid #000;
            cursor: pointer;
            transition: transform 0.3s ease, filter 0.3s;
        }
        .room:hover, .room:focus {
            transform: scale(1.2);
        }
        .booked {
            filter: grayscale(100%);
            background-color: rgba(151, 56, 56, 0.8);
        }
        .manager-controls {
            margin-top: 20px;
        }
        .manager-controls button {
            padding: 10px 15px;
            border: none;
            background: rgb(0, 128, 0);
            color: white;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .manager-controls button:hover {
            background: rgb(0, 100, 0);
        }
        @media (max-width: 600px) {
            .container {
                grid-template-columns: repeat(auto-fit, minmax(60px, 1fr));
            }
        }
    </style>
</head>
<body>
    <video autoplay loop muted playsinline>
        <source src="LRoom.mov" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="header">
        <h2 style = "font-family: fantasy">Basin Volta</h2> 
        <h3 style = "font-style:oblique; font-family: fantasy;">Hotels&#8482;</h3>  
    </div>

    <div class="luxury-text">LUXURY</div>

    <div class="container" id="roomContainer"></div>

    <div class="manager-controls">
        <button onclick="window.location.href='Room.php'">Proceed</button>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const container = document.getElementById("roomContainer");
            const numRooms = 8;
            let bookedRooms = JSON.parse(localStorage.getItem("bookedRooms")) || {};

            for (let i = 0; i < numRooms; i++) {
                const room = document.createElement("div");
                room.classList.add("room");
                room.style.backgroundImage = `url(luxuryboxes.jpeg)`;
                room.setAttribute("tabindex", "0");
                room.dataset.roomId = i + 1;
                
                if (bookedRooms[i + 1]) {
                    room.classList.add("booked");
                    room.textContent = "Booked";
                } else {
                    room.textContent = `Room ${i + 1}`;
                }
                
                room.addEventListener("click", () => toggleBooking(room));
                room.addEventListener("keydown", (e) => {
                    if (e.key === "Enter" || e.key === " ") toggleBooking(room);
                });
                
                container.appendChild(room);
            }
        });

        function toggleBooking(room) {
            let bookedRooms = JSON.parse(localStorage.getItem("bookedRooms")) || {};
            const roomId = room.dataset.roomId;

            if (bookedRooms[roomId]) {
                delete bookedRooms[roomId];
                room.classList.remove("booked");
                room.textContent = `Room ${roomId}`;
            } else {
                bookedRooms[roomId] = true;
                room.classList.add("booked");
                room.textContent = "Booked";
            }

            localStorage.setItem("bookedRooms", JSON.stringify(bookedRooms));
        }
    </script>
</body>
</html>



