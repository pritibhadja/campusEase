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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Insert student into the database
    $sql = "INSERT INTO students (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='success-message'>Registration successful! <a href='login.php?role=student'>Login here</a></div>";
    } else {
        echo "<div class='error-message'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusEase - Student Registration</title>
    <style>
        /* Same CSS as login.php */
    </style>
</head>
<body>
    <form class="form" method="POST" action="register.php">
        <p class="title">Student Registration</p>
        <p class="message">Signup now and get full access to CampusEase.</p>
        <div class="flex">
            <label>
                <input class="input" type="text" name="firstname" required>
                <span>Firstname</span>
            </label>
            <label>
                <input class="input" type="text" name="lastname" required>
                <span>Lastname</span>
            </label>
        </div>
        <label>
            <input class="input" type="email" name="email" required>
            <span>Email</span>
        </label>
        <label>
            <input class="input" type="password" name="password" required>
            <span>Password</span>
        </label>
        <label>
            <input class="input" type="password" name="confirm_password" required>
            <span>Confirm password</span>
        </label>
        <button class="submit" type="submit">Submit</button>
        <p class="signin">Already have an account? <a href="login.php?role=student">Sign in</a></p>
    </form>
</body>
</html>