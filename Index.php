<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('https://images.unsplash.com/photo-1506748686214e9df14a7c8bdfd?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MXwyMDgxNzN8MHwxfGFsbHwxfHx8fHx8fDE2NjMwNzI3OD&ixlib=rb-1.2.1&q=80&w=1920') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 100vh;
            color: #fff;
            overflow: hidden;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            text-align: center;
            max-width: 600px;
            width: 100%;
            background: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 1.5s ease-out;
        }

        .container h1 {
            font-size: 48px;
            margin: 0;
            font-weight: 700;
            line-height: 1.2;
        }

        .container p {
            font-size: 18px;
            margin: 20px 0;
            font-weight: 300;
        }

        .container a {
            display: inline-block;
            padding: 12px 24px;
            font-size: 18px;
            font-weight: 500;
            color: #fff;
            background: #007bff;
            border-radius: 25px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .container a:hover {
            background: #0056b3;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="overlay">
        <div class="container">
            <h1>We’re Launching Soon!</h1>
            <p>Thank you for your patience. We're working hard to get everything ready for you. Stay tuned!</p>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
