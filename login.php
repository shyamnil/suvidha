<?php
session_start();

// Simple Hardcoded Credentials (You can change these)
$valid_username = "shyam";
$valid_password = "lucifer";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if ($user === $valid_username && $pass === $valid_password) {
        $_SESSION['loggedin'] = true;
        header("Location: index.php"); // Redirect to your main form
        exit;
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Suvidha Portal</title>
    <style>
        :root {
            --primary-color: #1a73e8;
            --bg-color: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 { color: var(--primary-color); margin-bottom: 10px; }
        p { color: #5f6368; margin-bottom: 25px; font-size: 14px; }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1.5px solid #dadce0;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.1);
        }

        button {
            width: 100%;
            background-color: var(--primary-color);
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover { background-color: #1557b0; }

        .error-msg {
            color: #d93025;
            background: #fce8e6;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>Suvidha Portal Access</h2>
    <p>Please enter your credentials to continue</p>

    <?php if ($error): ?>
        <div class="error-msg"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required autofocus>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    
    <div style="margin-top: 20px; font-size: 12px; color: #70757a;">
        Shyam Sundar Modak - Suvidha Portal
    </div>
</div>

</body>
</html>