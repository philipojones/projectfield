<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "safari_chap";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $message = "<div class='alert alert-success'>Login successful!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Invalid username or password.</div>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Safari Chap</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #1e3c72, #2a5298);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        header {
            width: 100%;
            padding: 20px 0;
            background: linear-gradient(to right, #001f3f, #00509e);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            color: #ffd700;
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
            transition: color 0.3s;
        }

        header h1:hover {
            color: #33ccff;
        }

        nav {
            display: flex;
            gap: 15px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
        }

        nav a:hover {
            background: #ffd700;
            color: #001f3f;
        }

        .login-container {
            background: rgba(30, 60, 114, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
            text-align: center;
            margin-top: 50px;
        }

        .login-container h2 {
            font-size: 2rem;
            color: #ffd700;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #ffd700;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.8);
            color: #333;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            width: 100%;
            padding: 15px;
            background-color: #001f3f;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #ffd700;
            color: #001f3f;
        }

        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        footer {
            background: #001f3f;
            padding: 10px;
            text-align: center;
            width: 100%;
            color: #fff;
            font-size: 0.9rem;
            margin-top: auto;
        }

        footer a {
            color: #ffd700;
            text-decoration: none;
            transition: color 0.3s;
        }

        footer a:hover {
            color: #33ccff;
        }
    </style>
</head>
<body>
    <header>
        <h1>Safari Chap</h1>
        <nav>
            <a href="index.html"><i class="fas fa-home"></i> Home</a>
            <a href="schedule.html"><i class="fas fa-calendar-alt"></i> Bus Schedule</a>
            <a href="payment.php"><i class="fas fa-credit-card"></i> Payment</a>
        </nav>
    </header>

    <div class="login-container">
        <h2>Login</h2>
        <?php echo $message; ?>
        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>

    <footer>
        <p>&copy; 2024 Safari Chap. All rights reserved. | <a href="privacy-policy.html">Privacy Policy</a></p>
    </footer>
</body>
</html>
