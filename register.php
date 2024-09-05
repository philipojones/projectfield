<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Safari Chap</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #f4f4f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            height: 100vh;
            overflow: hidden;
            padding-top: 100px; /* Space for header */
            padding-bottom: 50px; /* Space for footer */
        }

        header {
            width: 100%;
            padding: 15px 30px;
            background: linear-gradient(to right, #001f3f, #00509e);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
        }

        header h1 {
            color: #ffd700;
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

        .register-container {
            background: rgba(30, 60, 114, 0.9);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            max-width: 800px;
            width: 80%;
            height: calc(100vh - 200px); /* Adjust height to fit between header and footer */
            overflow-y: auto; /* Enable vertical scrolling */
            text-align: center;
            margin: 0 auto;
            transition: transform 0.3s ease-in-out;
        }

        .register-container:hover {
            transform: translateY(-10px);
        }

        h2 {
            font-size: 2rem;
            color: #ffd700;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            font-weight: bold;
            color: #ffd700;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            outline: none;
            transition: border 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            color: #333;
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="email"]:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(50, 150, 250, 0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #27ae60;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-top: 10px;
        }

        button:hover {
            background-color: #2ecc71;
            transform: translateY(-3px);
        }

        button:active {
            transform: translateY(1px);
        }

        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
            text-align: left;
            transition: opacity 0.3s ease;
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
            position: fixed;
            bottom: 0;
            left: 0;
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
            <a href="schedule.php"><i class="fas fa-bus"></i> Bus Schedule</a>
            <a href="feedback.php"><i class="fas fa-comment-dots"></i> Feedback</a>
        </nav>
    </header>

    <div class="register-container">
        <h2>Register for Safari Chap</h2>
        <?php if (isset($message)) echo $message; ?>
        <form action="register.php" method="POST">
            <div class="input-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div class="input-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="current_location">Current Location</label>
                <input type="text" id="current_location" name="current_location" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="register">Register</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Safari Chap. All rights reserved. | <a href="privacy-policy.html">Privacy Policy</a></p>
    </footer>
</body>

</html>
