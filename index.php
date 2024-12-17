<?php 
require('./Database.php');

$errorMessage = '';

if (isset($_POST['create'])) {
    $Name = $_POST['Name'];
    $UserName = $_POST['UserName'];
    $Password = $_POST['Password'];

    // Validate that the name does not contain numbers
    if (preg_match('/[0-9]/', $Name)) {
        $errorMessage = "Error: Name must not contain numbers.";
    }
    // Validate that the username is a Gmail address
    elseif (filter_var($UserName, FILTER_VALIDATE_EMAIL) && strpos($UserName, '@gmail.com') !== false) {
        $querryCreate = "INSERT INTO registration VALUES (null, '$Name', '$UserName', '$Password')";
        $sqlcreate = mysqli_query($connection, $querryCreate);

        if ($sqlcreate) {
            echo '<script>window.location.href = "/VACCINATION/Login.php"</script>';
        } else {
            $errorMessage = "Error: " . mysqli_error($connection);
        }
    } else {
        $errorMessage = "Error: Username must be a valid Gmail address.";
    }
}
?>

<!DOCTYPE html>
<html lang="tl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Registration</title>
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
    }

    label {
        display: block;
        margin: 10px 0 5px;
        color: #555; 
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
        color:#0000FF; 
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
    <h1>Registration Form</h1>
    <form method="POST" action="">
        <input type="text" name="Name" placeholder="Name" required pattern="[A-Za-z\s]+" title="Name must not contain numbers.">
        <input type="text" name="UserName" placeholder="Username " required>
        <input type="password" name="Password" placeholder="Password" required>
        <button type="submit" name="create">Register</button>
        <p style="color: black;">Already have an account? <a href="Login.php">Log in</a></p>
        <a href="AdminRe.php">Admin</a>
        
        <?php if ($errorMessage): ?>
            <div class="error"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        
    </form>
</div>
</body>
</html>