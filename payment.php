<?php
require 'vendor/autoload.php'; // Include Stripe's PHP library

\Stripe\Stripe::setApiKey('YOUR_STRIPE_SECRET_KEY');

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment'])) {
    $token = $_POST['stripeToken'];
    $amount = htmlspecialchars($_POST['amount']);

    try {
        $charge = \Stripe\Charge::create([
            'amount' => $amount * 100, // Amount in cents
            'currency' => 'usd',
            'source' => $token,
            'description' => 'Payment for Safari Chap'
        ]);

        $message = "<div class='alert alert-success'>Payment successful!</div>";
    } catch (\Stripe\Exception\CardException $e) {
        $message = "<div class='alert alert-danger'>Payment failed: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Safari Chap</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: url('upload/download(1).jpeg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        header {
            width: 100%;
            padding: 20px;
            background: #001f3f; /* Dark blue header */
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
        }

        header h1 {
            margin: 0;
            font-size: 2.5rem;
            color: #ffd700; /* Gold accent */
        }

        nav {
            display: flex;
            gap: 15px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
        }

        nav a:hover {
            background: #ffd700; /* Gold hover effect */
            color: #001f3f; /* Dark blue text on hover */
        }

        .container {
            width: 90%;
            max-width: 600px;
            background: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
            margin-top: 100px;
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

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.8);
            color: #333;
        }

        .form-group input:focus {
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
            <a href="feedback.php"><i class="fas fa-comments"></i> Feedback</a>
        </nav>
    </header>

    <div class="container">
        <div class="header">
            <h3>Make Your Payment</h3>
        </div>
        <?php echo $message; ?>
        <form action="payment.php" method="POST">
            <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="YOUR_STRIPE_PUBLISHABLE_KEY"
                data-amount="5000" // Amount in cents
                data-name="Safari Chap"
                data-description="Payment for Safari Chap"
                data-currency="usd"
                data-locale="auto">
            </script>
            <input type="hidden" name="stripeToken" id="stripeToken">
            <input type="hidden" name="amount" value="50"> <!-- Amount in dollars -->
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Safari Chap. All rights reserved. | <a href="privacy-policy.html">Privacy Policy</a></p>
    </footer>
</body>
</html>
