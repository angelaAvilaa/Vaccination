<?php 
require('./Database.php');

$errorMessage = '';
$successMessage = '';

if (isset($_POST['create'])) {
    $Name = $_POST['Name'];
    $UserName = $_POST['UserName'];
    $Password = $_POST['Password'];
    $Barangay = isset($_POST['Barangay']) ? $_POST['Barangay'] : '';

    if (empty($Name)) {
        $errorMessage = "Error: Name is required.";
    } elseif (preg_match('/[0-9]/', $Name)) {
        $errorMessage = "Error: Name must not contain numbers.";
    } elseif (empty($UserName)) {
        $errorMessage = "Error: Username is required.";
    } elseif (!filter_var($UserName, FILTER_VALIDATE_EMAIL) || strpos($UserName, '@gmail.com') === false) {
        $errorMessage = "Error: Username must be a valid Gmail address.";
    } elseif (empty($Password)) {
        $errorMessage = "Error: Password is required.";
    } elseif (empty($Barangay)) {
        $errorMessage = "Error: Please select a Barangay.";
    } else {
        $queryCreate = "INSERT INTO admin (Name, UserName, Password, Barangay) VALUES ('$Name', '$UserName', '$Password', '$Barangay')";
        $sqlCreate = mysqli_query($connection, $queryCreate);

        if ($sqlCreate) {
            $successMessage = "Registration successful! Redirecting to login page...";
            echo '<script>setTimeout(function() { window.location.href = "/VACCINATION/AdminLog.php"; }, 3000);</script>';
        } else {
            $errorMessage = "Error: " . mysqli_error($connection);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #E3F2FD;
    margin: 0;
    padding: 0;
}

.container {
    background: #C8E6C9; 
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); 
    width: 320px;
    margin: 50px auto;
    text-align: center;
}

h1 {
    margin-bottom: 20px;
    font-size: 28px;
    color: #388E3C;
}

input, button, select {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #B0BEC5; 
    border-radius: 8px; 
    font-size: 16px;
    box-sizing: border-box;
}

input:focus, button:focus, select:focus {
    border-color: #00796B; 
    outline: none;
}

button {
    background-color: #FFEB3B; 
    border: none;
    color: #333; 
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

button:hover {
    background-color: #FBC02D;
    transform: scale(1.05); 
}

.error {
    color: #D32F2F;
    margin-top: 10px;
    font-size: 14px;
}

.success {
    color: #388E3C; 
    margin-top: 10px;
    font-size: 14px;
}
</style>
</head>
<body>

<div class="container">
    <h1> Admin Registration </h1>
    <form method="POST" action="">
        <input type="text" name="Name" placeholder="Name" required pattern="[A-Za-z\s]+" title="Name must not contain numbers.">
        <input type="email" name="UserName" placeholder="Username (Gmail only)" required>
        <input type="password" name="Password" placeholder="Password" required>
        <div class="form-group">
            <strong>Select Barangay</strong>
            <select name="Barangay" required>
                <option value="">Select Here</option>
                <option value="Becuran">Becuran</option>
                <option value="San Jose">San Jose</option>
                <option value="San Juan">San Juan</option>
            </select>
        </div>
        <button type="submit" name="create">Register</button>
        <p style="color: black;">Already have an account? <a href="AdminLog.php">Log in</a></p>

        <?php if ($errorMessage): ?>
            <p class="error"><?php echo htmlspecialchars($errorMessage); ?></p>
        <?php endif; ?>

        <?php if ($successMessage): ?>
            <p class="success"><?php echo htmlspecialchars($successMessage); ?></p>
        <?php endif; ?>
    </form>
</div>
</body>
</html>
