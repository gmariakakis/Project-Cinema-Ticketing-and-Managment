<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
   
    <style>
        .thank-you-container {
            text-align: center;
            padding-top: 50px;
        }

        .fun-message {
            font-size: 24px;
            color: #4CAF50; /* Or any color you prefer */
            margin-bottom: 20px;
        }

        @keyframes pop-in {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .emoji {
            font-size: 48px;
            animation: pop-in 0.5s ease;
        }
    </style>
</head>
<body>
    <!-- Container for the thank you message -->
    <div class="thank-you-container">
        <div class="fun-message">Message sent successfully!</div>
        <div class="emoji">🎉</div>
        <p>We've received your message and will get back to you soon.</p>
    </div>

    <script>
         <!-- Script to redirect the user to the home page after a delay -->
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 5000); // Redirect after 5000 milliseconds (5 seconds)
    </script>
</body>
</html>
