<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #000;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            position: relative;
            color: #fff;
        }

        .login-container {
            background-color: rgba(20, 20, 20, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
            max-width: 400px;
            width: 100%;
            z-index: 1;
        }

        .login-container h1 {
            margin-bottom: 10px;
            text-align: center;
            font-size: 24px;
            font-weight: 500;
            color: #fff;
        }

        .login-container h7 {
            margin-bottom: 25px;
            text-align: center;
            font-size: 14px;
            font-weight: 400;
            color: #aaa;
            display: block;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
        }

        .login-container form input[type="email"],
        .login-container form input[type="password"] {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #333;
            background-color: #222;
            color: #fff;
            font-size: 16px;
            outline: none;
        }

        .login-container form input[type="email"]::placeholder,
        .login-container form input[type="password"]::placeholder {
            color: #999;
        }

        .login-container form button {
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #007bff;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        .login-container form button:hover {
            background-color: #0056b3;
        }

        .signup-link {
            text-align: center;
            margin-top: 15px;
        }

        .signup-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .message {
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
            color: #ff0000;
        }

        .snowflake {
            position: absolute;
            top: -10px;
            z-index: 0;
            width: 10px;
            height: 10px;
            background-color: #fff;
            border-radius: 50%;
            opacity: 0.8;
            pointer-events: none;
            animation: fall linear infinite;
        }

        @keyframes fall {
            to {
                transform: translateY(100vh);
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <h7>Welcome back! Please login to your account.</h7>
        
        <?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "registration";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, fullname, password FROM signup WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            header("Location: index.php");
            exit();
        } else {
            $message = 'Invalid email or password.';
        }
    } else {
        $message = 'Invalid email or password.';
    }

    $stmt->close();
    $conn->close();
}
?>

        <form action="" method="post">
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div class="signup-link">
            <p>Don't have an account? <a href="signup.php">Create one</a></p>
        </div>
    </div>

    <script>
        function createSnowflake() {
            const snowflake = document.createElement('div');
            snowflake.classList.add('snowflake');

            snowflake.style.left = Math.random() * 100 + 'vw';
            snowflake.style.animationDuration = Math.random() * 3 + 2 + 's';
            snowflake.style.opacity = Math.random();
            snowflake.style.transform = `scale(${Math.random()})`;

            document.body.appendChild(snowflake);

            setTimeout(() => {
                snowflake.remove();
            }, 5000);
        }

        setInterval(createSnowflake, 50);
    </script>
</body>
</html>
