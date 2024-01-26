<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Dashboard</title>
    <style>


        .welcome-message {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .encouragement {
            font-style: italic;
            color: #555;
            margin-bottom: 20px;
        }

        .vision-mission {
            font-size: 16px;
            color: #777;
            max-width: 600px;
            margin-bottom: 30px;
        }

        .seatscape-tagline {
            font-size: 18px;
            font-weight: bold;
            color: #3498db;
            margin-bottom: 10px;
        }

        .thank-you {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>

<?php
if (isset($_SESSION['username'])) {
    $welcomeMessage = "Welcome to Dashboard, Admin {$_SESSION['username']} at Seatscape!";
    $encouragement = "You're doing great! Keep up the good work!";
    $visionMission = "Our vision at Seatscape is to create a seamless and enjoyable experience for all users. We strive to provide innovative solutions and excellent service to make a positive impact on the seating industry.";
    ?>
    
    <p class="welcome-message"><?= $welcomeMessage ?></p>
    <p class="encouragement"><?= $encouragement ?></p>
    <p class="vision-mission"><?= $visionMission ?></p>
    <p class="seatscape-tagline">Seatscape - Redefining Comfort and Convenience</p>
    <p class="thank-you">Thank you for being part of our journey!</p>
    
<?php } ?>

</body>
</html>
