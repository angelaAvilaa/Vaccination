
<?php 
session_start();
require('./Read.php');

// Error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message = ''; // Initialize message variable
$all_feedback = []; // Array to hold all feedback

// User information from session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest';
$profile_file = "user_profile_{$user_id}.txt"; // Unique file for each user

// Initialize profile picture
$profile_pic = 'default-profile.png'; // Default picture if not logged in
if ($user_id) {
    // Create the profile file if it doesn't exist
    if (!file_exists($profile_file)) {
        file_put_contents($profile_file, ""); // Create empty file
    }
    
    // Check if there's a profile picture in session or in the file
    $profile_pic = isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : (file_exists($profile_file) ? file_get_contents($profile_file) : 'default-profile.png');
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_pic'])) {
    $target_dir = "uploads/";

    // Check for file upload errors
    if ($_FILES['profile_pic']['error'] !== UPLOAD_ERR_OK) {
        $message = "File upload error: " . $_FILES['profile_pic']['error'];
    } else {
        // Create uploads directory if it doesn't exist
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $file_name = basename($_FILES["profile_pic"]["name"]);
        $file_name = preg_replace('/[^A-Za-z0-9\._-]/', '', $file_name);
        $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $new_file_name = uniqid($user_id . '_', true) . '.' . $imageFileType; // Unique file name tied to user
        $target_file = $target_dir . $new_file_name;

        // Validate the uploaded file
        $uploadOk = 1;
        $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
        if ($check === false) {
            $message = "File is not an image.";
            $uploadOk = 0;
        } elseif ($_FILES["profile_pic"]["size"] > 500000) {
            $message = "File is too large.";
            $uploadOk = 0;
        } elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            $message = "Only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Process the upload if validations pass
        if ($uploadOk === 1) {
            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                file_put_contents($profile_file, $target_file); // Save the path to the file
                $_SESSION['profile_pic'] = $target_file; // Store in session
                $profile_pic = $target_file; // Update local variable for display
            } else {
                $message = "Sorry, there was an error uploading your file.";
            }
        }
    }
}

// Handle feedback submission
if (isset($_POST['feedback'])) {
    $feedback = htmlspecialchars(trim($_POST['feedback']));
    if (!empty($feedback)) {
        // Save feedback with user name to a shared file
        $feedback_entry = "$user_name: $feedback\n"; // Include the user's name
        file_put_contents('feedback.txt', $feedback_entry, FILE_APPEND);
    } else {
        $message = "Feedback cannot be empty.";
    }
}

// Read all feedback from the shared file
if (file_exists('feedback.txt')) {
    $all_feedback = file('feedback.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
    
    .profile-container {
        display: flex;
        align-items: center;
        margin-top: 20px;
    }
    
    .profile-picture {
        margin-right: 20px;
    }
    
    .profile-picture img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 2px solid #00796B;
    }
    
    .welcome-message {
        font-size: 20px;
        font-weight: bold;
        color: #333; 
    }
    
    .custom-file-upload {
        display: inline-block;
        padding: 6px 12px;
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
    
    .upload-button {
        margin-left: 5px;
        padding: 6px 12px;
        border-radius: 5px;
        background-color: #FFEB3B; 
        color: #333; 
        border: none;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s;
    }
    
    .upload-button:hover {
        background-color: #FBC02D;
    }
    
    .nav.flex-column {
        margin-top: 30px;
        background-color: #FFFFFF;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15); 
    }
    
    .nav-link {
        color: #00796B; 
        font-weight: bold;
        text-decoration: none;
        margin-bottom: 10px;
    }
    
    .nav-link:hover {
        text-decoration: underline;
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
            <li><a href="index.php">Registration</a></li>
            <li><a href="About.php">About Us</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="Logout.php" onclick="return confirm('Are you sure you want to log out?');">Log out</a></li>
            
        </ul>
    </div>
</nav>

<div class="container">
<div class="jumbotron" style="background-color: #28a745; color: white;">
        <h1>Your Child's Health, Our Priority!</h1>      
        <p>At the Web-Based Vaccination Management System, we make immunization scheduling seamless and stress-free. Ensure your child's timely vaccinations with our online platform and SMS reminders, fostering a healthier future for every family in Sta. Rita, Pampanga.</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="profile-container">
                <div class="profile-picture">
                    <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Picture">
                </div>
                <div class="welcome-message">
                    Welcome, <span class="user-name"><?php echo htmlspecialchars($user_name); ?></span>!
                </div>
            </div>

            <div class="upload-form">
                <form action="" method="post" enctype="multipart/form-data">
                    <label class="custom-file-upload">
                        <input type="file" name="profile_pic" accept="image/*" required>
                        Choose File
                    </label>
                    <button type="submit" class="upload-button">Upload</button>
                </form>
            </div>

            <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="ChildRegistration.php"> Register Your Child Here </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Contact.php">Contact Information</a>
                </li>
            </ul>
        </div>

        <div class="col-md-4">
            <div class="feedback-form">
                <h3 style="color: #007bff;">We Value Your Feedback!</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <textarea name="feedback" class="form-control" rows="4" placeholder="Share your thoughts with us..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Send Feedback</button>
                </form>

                <h4 style="margin-top: 20px;">All Feedback:</h4>
                <ul class="list-group">
                    <?php foreach ($all_feedback as $feedback): ?>
                        <li class="list-group-item"><?php echo htmlspecialchars($feedback); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<footer>
    <center>
        <p>&copy; <?php echo date("Y"); ?> Web-Based Vaccination Management System. All rights reserved. | Group 12</p>
    </center>
    </footer>
</body>
</html>
