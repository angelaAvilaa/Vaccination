<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination Management System </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
   <style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 0;
        background-color: #E3F2FD; 
        color: #333;
    }

    header {
        background-color: #43A047; 
        color: white;
        padding: 1.5rem 0; 
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15); 
    }

    main {
        max-width: 800px;
        margin: 2rem auto;
        background: white;
        padding: 2rem;
        border-radius: 12px; 
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    h1 {
        color: white; 
        font-size: 2rem; 
        margin: 0;
    }

    h2 {
        color: #43A047; 
        margin-top: 1rem;
        margin-bottom: 0.5rem;
    }

    p {
        margin-bottom: 1.5rem; 
        line-height: 1.8;
    }

    footer {
        text-align: center;
        padding: 1rem 0;
        background-color: #E0F7FA; 
        margin-top: 2rem;
        font-size: 0.9rem;
        color: #00796B; 
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
    }

    .nav.flex-column {
        margin-top: 30px;
        background-color: #FFFFFF;
        padding: 15px;
        border-radius: 8px; 
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
    }

    .nav-link {
        color: #007BFF;
        font-weight: bold;
        text-decoration: none;
        padding: 8px 10px;
        display: block;
        border-radius: 5px; 
        transition: background-color 0.3s, color 0.3s;
    }

    .nav-link:hover {
        background-color: #B2EBF2;
        color: #004D40; 
    }
</style>

</head>
<body> 

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" >Vaccination</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="Page.php">Home</a></li>
            <li><a href="Index.php">Registration</a></li>
            <li><a href="About.php">About Us</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="Logout.php" onclick="return confirm('Are you sure you want to log out?');">Log out</a></li>
            <li><a href="AdminRe.php">Admin</a></li>
        </ul>
    </div>
</nav>

    <header>

        <h1>Web-Based Vaccination Management System</h1>
        <p>Empowering healthcare, one child at a time.</p>

    </header>
    <main>
        <h2>Welcome</h2>
        <p>Welcome to the Web-Based Vaccination Management System with SMS Notification, a groundbreaking initiative designed to revolutionize infant immunization in Sta. Rita, Pampanga. Our mission is to streamline vaccination processes, empower healthcare providers, and ensure timely immunization for infants in our community.</p>
        
        <h2>Who We Are</h2>
        <p>We are a dedicated team of innovators, healthcare advocates, and technology enthusiasts committed to improving public health through modern solutions. By integrating advanced web technologies and SMS notifications, we aim to bridge gaps in immunization schedules and promote a healthier future for every child in Sta. Rita, Pampanga.</p>
        
        <h2>Our Vision</h2>
        <p>To create a community where no child misses their vital vaccines, ensuring a healthier and more resilient future for all.</p>
        
        <h2>What We Do</h2>
        <ul>
            <li><strong>Digital Vaccine Management:</strong> Our platform simplifies record-keeping for both parents and healthcare providers, reducing errors and improving efficiency.</li>
            <li><strong>Automated SMS Notifications:</strong> Never miss a vaccination appointment! Parents receive timely reminders for upcoming schedules and follow-ups.</li>
            <li><strong>User-Friendly Access:</strong> The system is accessible to healthcare professionals, parents, and guardians, fostering transparency and collaboration in immunization programs.</li>
        </ul>
        
        <h2>Why It Matters</h2>
        <p>In a fast-paced world, keeping track of vaccination schedules can be challenging. Our system eliminates the hassle and ensures that infants receive their immunizations on time, reducing the risk of preventable diseases and safeguarding public health.</p>
        
        <p><strong>Together, let’s make immunization more accessible, efficient, and impactful for the children of Sta. Rita, Pampanga.</strong></p>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Web-Based Vaccination Management System. All rights reserved. | Group 12 </p>
    </footer>
</body>
</html>
