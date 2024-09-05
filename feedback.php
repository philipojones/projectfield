<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "safari_chap";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_feedback'])) {
    $rating = htmlspecialchars($_POST['rating']);
    $comment = htmlspecialchars($_POST['comment']);

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO feedback (rating, comment) VALUES (?, ?)");
    $stmt->bind_param("ss", $rating, $comment);

    if ($stmt->execute()) {
        $message = "<div class='alert alert-success'>Feedback submitted successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - Safari Chap</title>
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

        .container {
            width: 100%;
            max-width: 600px;
            background: rgba(30, 60, 114, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
            margin-top: 50px;
        }

        .header {
            margin-bottom: 20px;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            padding: 15px;
            border-radius: 10px;
            color: #fff;
        }

        .header h3 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #ffd700;
        }

        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.8);
            color: #333;
        }

        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background-color: #001f3f;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
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
           
            <a href="payment.html"><i class="fas fa-credit-card"></i> Payment</a>
        </nav>
    </header>

    <div class="container">
        <div class="header">
            <h3>We Value Your Feedback!</h3>
        </div>
        <?php echo $message; ?>
        <form action="feedback.php" method="POST">
            <div class="form-group">
                <label for="rating">Rating</label>
                <select id="rating" name="rating" required>
                    <option value="">Choose a rating</option>
                    <option value="1">1 - Very Poor</option>
                    <option value="2">2 - Poor</option>
                    <option value="3">3 - Average</option>
                    <option value="4">4 - Good</option>
                    <option value="5">5 - Excellent</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea id="comment" name="comment" rows="4" required></textarea>
            </div>
            <button type="submit" name="submit_feedback" class="btn-submit">Submit Feedback</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Safari Chap. All rights reserved. | <a href="privacy-policy.html">Privacy Policy</a></p>
    </footer>
</body>
</html>
