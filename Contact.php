<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>To be continue</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   
    <style>
        body {
            background-color: #E3F2FD; 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        
        .welcome-message {
            font-size: 24px;
            font-weight: bold;
            color: #333; 
            margin-bottom: 20px;
        }
        
        .custom-file-upload {
            display: inline-block;
            padding: 10px 20px;
            cursor: pointer;
            border: 1px solid #00796B; 
            border-radius: 5px;
            background-color: #00796B; 
            color: white;
            font-weight: bold;
            transition: background-color 0.3s, border-color 0.3s;
        }
        
        .custom-file-upload:hover {
            background-color: #005A4A;
            border-color: #005A4A;
        }
        
        input[type="file"] {
            display: none;
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
        <div class="welcome-message">
            <?php
           
            echo "Not finished yet, to be continued...";
            ?>
        </div>
    
    </div>
</body>
</html>
