<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Hotels | Basin Volta Hotel | Select</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Palatino Linotype", "Palatino", serif;
            text-align: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            color: white;
        }

        /* Video Background */
        .video-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .video-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Fallback Background */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('fallback.jpg') center/cover no-repeat;
            z-index: -2;
        }

        /* Overlay for readability */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .content {
            position: relative;
            z-index: 1;
        }

        .header {
            margin-bottom: 20px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
        }

        h2, h3 {
            margin: 0;
        }

        .option-text {
            font-size: 20px;
            font-weight: bold;
            margin-top: 15px;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.6);
        }

        .buttons-container {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .button {
            background-color: #0044cc;
            color: white;
            padding: 12px 24px;
            font-size: 18px;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s, box-shadow 0.3s;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
            width: 200px;
            text-align: center;
        }

        .button:hover {
            background-color: #0033aa;
            transform: scale(1.05);
            box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.5);
        }

        /* Mobile Responsiveness */
        @media (min-width: 600px) {
            .buttons-container {
                flex-direction: row;
            }
        }

    </style>
</head>
<body>

    <div class="video-container">
        <video autoplay loop muted>
            <source src="maldives.mp4" type="video/mp4">
        </video>
    </div>
    
    <div class="overlay"></div>

    <div class="content">
        <div class="header">
            <h2 style="font-family: 'Georgia', serif;">Basin Volta</h2> 
            <h3 style="font-style: oblique; font-family: 'Georgia', serif;">Hotels&#8482;</h3>  
        </div>

        <div class="option-text">SELECT YOUR OPTION</div>

        <div class="buttons-container">
            <a href="SignUp.php" class="button"> Sign Up </a>
            <a href="LogIn.php" class="button"> Log In </a>
        </div>
    </div>

</body>
</html>

       




