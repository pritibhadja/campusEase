<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusEase - Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #1a1a1a;
            color: #fff;
        }

        .success-container {
            background-color: #333;
            padding: 20px 30px;
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .success-container h1 {
            color: #00bfff;
        }

        .success-container p {
            color: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h1>Login Successful!</h1>
        <p>Welcome, <?php echo $user['firstname'] . " " . $user['lastname']; ?>!</p>
        <p>Role: <?php echo ucfirst($role); ?></p>
        <p>Email: <?php echo $user['email']; ?></p>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>