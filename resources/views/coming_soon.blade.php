<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Binnenkort Beschikbaar</title>
    <style>
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Container for the Coming Soon Screen */
        .coming-soon-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: radial-gradient(circle at top left, #a0e2c4, #1b8354);
            position: relative;
            overflow: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #ffffff;
        }

        /* Overlay for additional visual depth */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(27, 131, 84, 0.3);
            z-index: 1;
            pointer-events: none;
        }

        /* Logo Styling */
        .logo-container {
            z-index: 2;
            margin-bottom: 30px;
            animation: fade-in 2s ease-in-out;
        }

        .logo {
            width: 250px;
            height: auto;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        /* Main Text Styling */
        .text-container {
            text-align: center;
            z-index: 2;
            margin-bottom: 20px;
            animation: text-pop 1.5s ease-in-out;
        }

        .main-text {
            font-size: 3rem;
            font-weight: bold;
            margin: 10px 0;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.2);
        }

        /* Subtext Styling */
        .subtext-container {
            text-align: center;
            z-index: 2;
            color: #d1f2c4;
            animation: text-pop 1.8s ease-in-out;
        }

        .sub-text {
            font-size: 1.5rem;
            font-weight: 500;
            margin: 10px 0;
        }

        /* Highlighted Facebook Link */
        .sub-text a {
            color: #3b5998;
            /* Facebook blue */
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .sub-text a:hover {
            color: #1b8354;
            text-decoration: underline;
        }

        /* Circle Background Animations */
        .background-animations .circle {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(27, 131, 84, 0.2);
            animation: move 6s ease-in-out infinite;
            z-index: 1;
        }

        .circle-one {
            width: 350px;
            height: 350px;
            top: -150px;
            left: -100px;
            animation-delay: 0s;
        }

        .circle-two {
            width: 250px;
            height: 250px;
            bottom: -100px;
            right: -100px;
            animation-delay: 2s;
        }

        .circle-three {
            width: 300px;
            height: 300px;
            top: 40%;
            left: 60%;
            animation-delay: 4s;
        }

        /* Additional Animated Elements */
        .background-animations .star {
            position: absolute;
            width: 15px;
            height: 15px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            animation: twinkle 4s infinite;
            z-index: 1;
        }

        .star-one {
            top: 20%;
            left: 25%;
            animation-delay: 1s;
        }

        .star-two {
            top: 70%;
            left: 80%;
            animation-delay: 3s;
        }

        .star-three {
            top: 50%;
            left: 40%;
            animation-delay: 2s;
        }

        /* Animations */
        @keyframes fade-in {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes text-pop {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes move {
            0% {
                transform: scale(1) translate(0, 0);
            }

            50% {
                transform: scale(1.2) translate(20px, 20px);
            }

            100% {
                transform: scale(1) translate(0, 0);
            }
        }

        @keyframes twinkle {

            0%,
            100% {
                opacity: 0.8;
            }

            50% {
                opacity: 0.3;
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .main-text {
                font-size: 2.2rem;
            }

            .sub-text {
                font-size: 1.2rem;
            }

            .logo {
                width: 120px;
            }

            .background-animations .circle-one,
            .background-animations .circle-two,
            .background-animations .circle-three,
            .background-animations .star-one,
            .background-animations .star-two,
            .background-animations .star-three {
                display: none;
                /* Hide circles and stars on smaller screens for better performance */
            }
        }
    </style>
    <!-- Favicon (Optional) -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- SEO Meta Tag -->
    <meta name="robots" content="noindex, nofollow">
</head>

<body>
    <div class="coming-soon-container">
        <!-- Overlay for visual depth -->
        <div class="overlay"></div>

        <!-- Animated Background Elements -->
        <div class="background-animations">
            <div class="circle circle-one"></div>
            <div class="circle circle-two"></div>
            <div class="circle circle-three"></div>

            <!-- Additional Stars for Creativity -->
            <div class="star star-one"></div>
            <div class="star star-two"></div>
            <div class="star star-three"></div>
        </div>

        <!-- Centered Logo -->
        <div class="logo-container">
            <img src="{{ asset('assets/images/logo2.png') }}" alt="Logo" class="logo" />
        </div>

        <!-- Main Text -->
        <div class="text-container">
            <h1 class="main-text">Binnenkort Beschikbaar</h1>
            <h1 class="main-text">Coming Soon</h1>
        </div>

        <!-- Subtext -->
        <div class="subtext-container">
            <h2 class="sub-text">
                Blijf op de hoogte! We werken hard om iets geweldigs te brengen.

            </h2>
            <h2 class="sub-text">
                Stay tuned! We’re working hard to bring you something amazing.

            </h2>

            <h2 class="sub-text">
                Follow Us:
                <a href="https://www.facebook.com/profile.php?id=61560892673549" target="_blank"
                    rel="noopener noreferrer">Facebook</a>
            </h2>
        </div>
    </div>
</body>

</html>
