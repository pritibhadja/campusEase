<?php
session_start();

// Database connection
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "campusease";

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get role from URL
$role = isset($_GET['role']) ? $_GET['role'] : 'student';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($role === 'student') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Fetch student from the database
        $sql = "SELECT * FROM students WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Redirect to success page
                $_SESSION['user'] = $user;
                $_SESSION['role'] = 'student';
                header("Location: success.php");
                exit();
            } else {
                echo "<div class='error-message'>Invalid password.</div>";
            }
        } else {
            echo "<div class='error-message'>Student not found.</div>";
        }
    } elseif ($role === 'admin') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Fetch admin from the database
        $sql = "SELECT * FROM admins WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Redirect to success page
                $_SESSION['user'] = $user;
                $_SESSION['role'] = 'admin';
                header("Location: success.php");
                exit();
            } else {
                echo "<div class='error-message'>Invalid password.</div>";
            }
        } else {
            echo "<div class='error-message'>Admin not found.</div>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusEase - Login</title>
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

        .form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 350px;
            padding: 20px;
            border-radius: 20px;
            background-color: #333;
            border: 1px solid #444;
        }

        .title {
            font-size: 28px;
            font-weight: 600;
            letter-spacing: -1px;
            color: #00bfff;
            text-align: center;
        }

        .message {
            font-size: 14.5px;
            color: rgba(255, 255, 255, 0.7);
            text-align: center;
        }

        .form label {
            position: relative;
        }

        .form label .input {
            background-color: #444;
            color: #fff;
            width: 100%;
            padding: 20px 5px 5px 10px;
            outline: 0;
            border: 1px solid rgba(105, 105, 105, 0.397);
            border-radius: 10px;
        }

        .form label .input + span {
            color: rgba(255, 255, 255, 0.5);
            position: absolute;
            left: 10px;
            top: 0px;
            font-size: 0.9em;
            cursor: text;
            transition: 0.3s ease;
        }

        .form label .input:placeholder-shown + span {
            top: 12.5px;
            font-size: 0.9em;
        }

        .form label .input:focus + span,
        .form label .input:valid + span {
            color: #00bfff;
            top: 0px;
            font-size: 0.7em;
            font-weight: 600;
        }

        .submit {
            border: none;
            outline: none;
            padding: 10px;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            background-color: #00bfff;
            cursor: pointer;
        }

        .submit:hover {
            background-color: #00bfff96;
        }

        .signin {
            font-size: 14.5px;
            color: rgba(255, 255, 255, 0.7);
            text-align: center;
        }

        .signin a {
            color: #00bfff;
            text-decoration: none;
        }

        .signin a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #dc3545;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <form class="form" method="POST" action="login.php?role=<?php echo $role; ?>">
        <p class="title">Login as <?php echo ucfirst($role); ?></p>
        <p class="message">Welcome back! Login to access your account.</p>
        <?php if ($role === 'student') : ?>
            <label>
                <input class="input" type="email" name="email" required>
                <span>Email</span>
            </label>
        <?php elseif ($role === 'admin') : ?>
            <label>
                <input class="input" type="text" name="username" required>
                <span>Username</span>
            </label>
        <?php endif; ?>
        <label>
            <input class="input" type="password" name="password" required>
            <span>Password</span>
        </label>
        <button class="submit" type="submit">Login</button>
        <?php if ($role === 'student') : ?>
            <p class="signin">Don't have an account? <a href="register.php">Sign up</a></p>
        <?php endif; ?>
    </form>
</body>
</html>