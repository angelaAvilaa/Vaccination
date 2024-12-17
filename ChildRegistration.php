<?php 
require('./Database.php');

$errorMessage = '';
$successMessage = '';

if (isset($_POST['create'])) {
    $ParentName = $_POST['ParentName'];
    $ChildName = $_POST['ChildName'];
    $PhoneNumber = $_POST['Phone'];
    $ChildAge = $_POST['ChildAge'];
    $Barangay = isset($_POST['Barangay']) ? $_POST['Barangay'] : '';

    if (preg_match('/[0-9]/', $ParentName)) {
        $errorMessage = "Error: Name must not contain numbers.";
    } 
    elseif (!preg_match('/^\d{11}$/', $PhoneNumber)) {
        $errorMessage = "Error: Phone number must be exactly 11 digits.";
    }
    elseif (!preg_match('/^\d+\s*(years|months)$/i', $ChildAge)) {
        $errorMessage = "Error: Child's age must be specified as a number followed by 'years' or 'months'.";
    }
    elseif (empty($Barangay)) {
        $errorMessage = "Error: You must select a Barangay.";
    } 
    else {
        $validBarangays = [
            "Becuran", "Dila Dila", "San Agustin", "San Basilio",
            "San Isidro", "San Jose", "San Juan", "San Matias",
            "Santa Monica", "San Vicente"
        ];

        if (in_array($Barangay, $validBarangays)) {
            $tableName = str_replace(' ', '_', $Barangay);

            $queryCreate = "INSERT INTO `$tableName` (ParentName, ChildName, PhoneNumber, ChildAge, Barangay) 
                            VALUES ('$ParentName', '$ChildName', '$PhoneNumber', '$ChildAge', '$Barangay')";

            $sqlCreate = mysqli_query($connection, $queryCreate);

            if ($sqlCreate) {
                $successMessage = "Registration successfully created for Barangay $Barangay!"; 
                echo '<script>setTimeout(function() { window.location.href = "/VACCINATION/Page.php"; }, 3000);</script>';
            } else {
                $errorMessage = "Error: " . mysqli_error($connection);
            }
        } else {
            $errorMessage = "Error: Invalid Barangay selected.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Child Registration</title>
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

.nav.flex-column {
    margin-top: 30px;
    background-color: #FFFFFF; 
    padding: 15px;
    border-radius: 8px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.nav-link {
    color: #00796B;
    font-weight: bold;
    text-decoration: none;
    padding: 8px 10px;
    display: block;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

.nav-link:hover {
    background-color: #B2DFDB; 
    color: #004D40; 
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

p {
    margin-top: 15px;
    font-size: 14px;
    color: #333; 
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

strong {
    color: #00796B; 
}
</style>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand">Vaccination</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="Page.php">Home</a></li>
            <li><a href="index.php">Registration</a></li>
            <li><a href="About.php">About Us</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="Logout.php" onclick="return confirm('Are you sure you want to log out?');">Log out</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1>Child Registration Form</h1>
    <form method="POST" action="">
        <input type="text" name="ParentName" placeholder="Parent Name" required pattern="[A-Za-z\s]+" title="Name must not contain numbers.">
        <input type="text" name="ChildName" placeholder="Child Name" required>
        <input type="text" name="Phone" placeholder="Phone Number" required pattern="^\d{11}$" title="Phone number must be exactly 11 digits.">
        <input type="text" name="ChildAge" placeholder="e.g., years or  months" required>
        <div class="form-group">
            <strong>Select Barangay</strong>
            <select name="Barangay" required> 
                <option value="">Select Here</option>
                <option value="Becuran">Becuran</option>
                <option value="Dila Dila">Dila Dila</option>
                <option value="San Agustin">San Agustin</option>
                <option value="San Basilio">San Basilio</option>
                <option value="San Isidro">San Isidro</option>
                <option value="San Jose">San Jose</option>
                <option value="San Juan">San Juan</option>
                <option value="San Matias">San Matias</option>
                <option value="Santa Monica">Santa Monica</option>
                <option value="San Vicente">San Vicente</option>
            </select>
        </div>

        <button type="submit" name="create">Submit</button>
        
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
