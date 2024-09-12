<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
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

        .signup-container {
            background-color: rgba(20, 20, 20, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
            max-width: 400px;
            width: 100%;
            z-index: 1;
        }

        .signup-container h3 {
            margin-bottom: 25px;
            text-align: center;
            font-size: 14px;
            font-weight: 400;
            color: #aaa;
            display: block;
        }

        .signup-container h1 {
            margin-bottom: 10px;
            text-align: center;
            font-size: 24px;
            font-weight: 500;
            color: #fff;
        }

        .signup-container form {
            display: flex;
            flex-direction: column;
        }

        .signup-container form input[type="text"],
        .signup-container form input[type="email"],
        .signup-container form input[type="password"],
        .signup-container form input[type="tel"] {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #333;
            background-color: #222;
            color: #fff;
            font-size: 16px;
            outline: none;
        }

        .signup-container form input[type="text"]::placeholder,
        .signup-container form input[type="email"]::placeholder,
        .signup-container form input[type="password"]::placeholder,
        .signup-container form input[type="tel"]::placeholder {
            color: #999;
        }

        .signup-container form button {
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

        .signup-container form button:hover {
            background-color: #0056b3;
        }

        .social-login {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .social-login button {
            padding: 10px;
            border: none;
            border-radius: 8px;
            width: 48%;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #444;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .social-login button img {
            margin-right: 8px;
            width: 20px;
            height: 20px;
        }

        .social-login .google:hover {
            background-color: #db4437;
        }

        .social-login .facebook:hover {
            background-color: #3b5998;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
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

        .message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 25px;
            border-radius: 5px;
            font-size: 16px;
            color: #fff;
            opacity: 0;
            animation: fadeInOut 3s ease-in-out;
            z-index: 1000;
        }

        .message.success {
            background-color: #28a745;
        }

        .message.error {
            background-color: #dc3545;
        }

        .message.info {
            background-color: #007bff;
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0;
                transform: translateX(-50%) translateY(-20px);
            }
            10% {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
            90% {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
            100% {
                opacity: 0;
                transform: translateX(-50%) translateY(-20px);
            }
        }

        .password-strength {
            font-size: 14px;
            margin-top: -15px;
            margin-bottom: 15px;
            color: #fff;
        }

        .password-strength.weak {
            color: #dc3545;
        }

        .password-strength.medium {
            color: #ffc107;
        }

        .password-strength.strong {
            color: #28a745;
        }
    </style>
</head>
<body>

<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($fullname) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
        echo "<div class='message error'>All fields are required!</div>";
    } elseif ($password !== $confirm_password) {
        echo "<div class='message error'>Passwords do not match!</div>";
    } else {
        $result = mysqli_query($conn, "SELECT * FROM signup WHERE email = '$email'");
        if (mysqli_num_rows($result) > 0) {
            echo "<div class='message info'>This account already exists, please login!</div>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO signup (fullname, phone, email, password) VALUES ('$fullname', '$phone', '$email', '$hashed_password')";
            if (mysqli_query($conn, $sql)) {
                echo "<div class='message success'>Account created successfully!</div>";
            } else {
                echo "<div class='message error'>Error: " . mysqli_error($conn) . "</div>";
            }
        }
    }
}

mysqli_close($conn);
?>

<div class="signup-container">
    <h1>Create Account</h1>
    <h3>Welcome Back : Get Started With Free Account</h3>
    
    <div class="social-login">
        <button class="google"><img src="https://img.icons8.com/color/48/000000/google-logo.png"/>Login with Gmail</button>
        <button class="facebook"><img src="https://img.icons8.com/fluency/48/000000/facebook-new.png"/>Login with Facebook</button>
    </div>
    <form action="" method="POST">
        <input type="text" name="fullname" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="tel" name="phone" placeholder="Phone Number" required>
        <input type="password" name="password" placeholder="Create Password" id="password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <div class="password-strength" id="password-strength"></div>
        <button type="submit" name="submit">Create Account</button>
    </form>
    <div class="login-link">
        <p>Have an account? <a href="login.php">Login</a></p>
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

    const passwordInput = document.getElementById('password');
    const passwordStrengthText = document.getElementById('password-strength');

    function checkPasswordStrength(password) {
        let strength = 'Weak';
        const regex = {
            lowercase: /[a-z]/,
            uppercase: /[A-Z]/,
            number: /[0-9]/,
            special: /[!@#$%^&*(),.?":{}|<>]/
        };

        if (password.length > 8) {
            let score = 0;
            if (regex.lowercase.test(password)) score++;
            if (regex.uppercase.test(password)) score++;
            if (regex.number.test(password)) score++;
            if (regex.special.test(password)) score++;
            
            if (score === 4) strength = 'Strong';
            else if (score === 3) strength = 'Medium';
            else strength = 'Weak';
        } else {
            strength = 'Weak';
        }
        
        return strength;
    }

    passwordInput.addEventListener('input', function() {
        const strength = checkPasswordStrength(passwordInput.value);
        passwordStrengthText.textContent = strength === 'Weak' ? 'Weak password' : strength === 'Medium' ? 'Medium strength password' : 'Strong password';
        passwordStrengthText.className = 'password-strength ' + strength.toLowerCase();
    });

    const message = document.querySelector('.message');
    if (message) {
        setTimeout(() => {
            message.style.opacity = '0';
        }, 2000);

        setTimeout(() => {
            message.remove();
        }, 3000);
    }
</script>
</body>
</html>
