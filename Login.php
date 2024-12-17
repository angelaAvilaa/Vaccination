<?php
session_start(); // Start the session
require('./Database.php');

$errorMessage = ""; // Initialize an error message variable

if (isset($_POST['select'])) {
    $UserName = $_POST['email'];
    $Password = $_POST['password'];

    // Prepare and execute the statement to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM registration WHERE UserName = ? AND Password = ?");
    $stmt->bind_param("ss", $UserName, $Password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user was found
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id']; // Store user ID in session
        $_SESSION['user_name'] = $user['Name']; // Store user's name in session
        echo '<script>window.location.href = "/VACCINATION/Page.php";</script>';
        exit; // Ensure no further code is executed
    } else {
        $errorMessage = "Please enter correct username and password."; // Set the error message
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="tl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #E0F7FA;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background: #C8E6C9; 
        padding: 20px;
        border-radius: 10px; 
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        width: 320px;
        text-align: center;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #388E3C; 
        font-size: 24px;
    }

    label {
        display: block;
        margin: 10px 0 5px;
        color: #555; 
        font-size: 14px;
    }

    input, button {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #B0BEC5; 
        border-radius: 8px; 
        font-size: 16px;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #FFEB3B;
        border: none;
        color: #333; 
        font-weight: bold;
        border-radius: 8px;
        cursor: pointer;
    }

    button:hover {
        background-color: #FBC02D; 
    }

    p {
        text-align: center;
        margin-top: 15px;
        color: #333;
    }

    a {
        color: #0000FF; 
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }

    .error {
        color: red;
        text-align: center;
        margin: 10px 0;
    }
</style>

</head>
<body>
    <div class="container">
        <h1>LOG IN</h1>
        <form method="POST" action="">
            
            <input type="email" id="email" name="email" placeholder="Username" required>

            <input type="password" id="password" name="password" placeholder="Password" required>

            <button type="submit" name="select">Log in</button>

            <?php if ($errorMessage): ?>
                <div class="error"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
        </form>
        <p style="color: black;">Don't have an Account? <a href="index.php">Registration</a></p>
    </div>
</body>
</html>