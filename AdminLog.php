<?php 
require('./Database.php');

$errorMessage = '';
$successMessage = '';

if (isset($_POST['login'])) {
    $UserName = $_POST['UserName'];
    $Password = $_POST['Password'];
    $Barangay = isset($_POST['Barangay']) ? $_POST['Barangay'] : '';

    if (empty($UserName)) {
        $errorMessage = "Error: Username is required.";
    } elseif (empty($Password)) {
        $errorMessage = "Error: Password is required.";
    } elseif (empty($Barangay)) {
        $errorMessage = "Error: Please select a Barangay.";
    } else {
        // Validate login credentials
        $query = "SELECT * FROM admin WHERE UserName = '$UserName' AND Password = '$Password' AND Barangay = '$Barangay'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) == 1) {
            // Successful login
            $successMessage = "Login successful! Redirecting to Barangay $Barangay page...";
            
            // Dynamically redirect to Barangay-specific page
            $redirectURL = "/VACCINATION/$Barangay.php";
            echo '<script>setTimeout(function() { window.location.href = "' . $redirectURL . '"; }, 3000);</script>';
        } else {
            $errorMessage = "Error: Invalid Username, Password, or Barangay.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
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
    <h1>Admin Login </h1>
    <form method="POST" action="">
        <input type="text" name="UserName" placeholder="Username" required>
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
        <button type="submit" name="login">Login</button>
        <p style="color: black;">Don't have an Account? <a href="AdminRe.php">Registration</a></p>
        
        <?php if ($errorMessage): ?>
            <p class="error"><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <?php if ($successMessage): ?>
            <p class="success"><?php echo $successMessage; ?></p>
        <?php endif; ?>
    </form>
</div>
</body>
</html>
