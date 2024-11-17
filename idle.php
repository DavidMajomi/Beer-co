<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect Page</title>
    <style>
        /* Full-screen setup */
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            font-family: Arial, sans-serif;
        }

        /* Slider container */
        .slider {
            position: fixed;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .slider img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .slider img.active {
            opacity: 1;
        }

        /* Text overlay */
        .center-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            font-size: 2em;
        }

        /* Ensures redirection on click */
        .overlay {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 10;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Image slider -->
    <div class="slider">
        <img src="images/mainpage1.jpg" alt="Slide 1" class="active">
        <img src="images/mainpage2.jpg" alt="Slide 2">
        <img src="images/mainpage3.jpg" alt="Slide 3">
        <img src="images/mainpage4.jpg" alt="Slide 4">
    </div>

    <!-- Overlay text -->
    <div class="center-text">Tap anywhere to proceed!</div>

    <!-- Clickable overlay -->
    <div class="overlay" onclick="redirect()"></div>

    <script>
        // Background slider logic
        const images = document.querySelectorAll('.slider img');
        let currentIndex = 0;

        function changeSlide() {
            images[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % images.length;
            images[currentIndex].classList.add('active');
        }

        // Change slide every 3 seconds
        setInterval(changeSlide, 3000);

        // Redirection logic
        function redirect() {
            window.location.href = "AJAX_search.php"; // Update to your destination page
        }
    </script>
</body>
</html>