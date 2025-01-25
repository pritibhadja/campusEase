<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusEase - Role Selection</title>
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

        .role-container {
            background-color: #333;
            padding: 20px 30px;
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .role-container h1 {
            color: #00bfff;
        }

        .role-container p {
            color: rgba(255, 255, 255, 0.7);
        }

        .role-container a {
            display: inline-block;
            width: 100%;
            padding: 12px;
            background-color: #00bfff;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            text-decoration: none;
            cursor: pointer;
            margin: 10px 0;
        }

        .role-container a:hover {
            background-color: #00bfff96;
        }
    </style>
</head>
<body>
    <div class="role-container">
        <h1>CampusEase</h1>
        <p>Choose your role to continue:</p>
        <a href="login.php?role=student">Student</a>
        <a href="login.php?role=admin">Admin</a>
    </div>
</body>
</html>