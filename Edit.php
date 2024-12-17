<?php
require('./Database.php');

$editID = $editCN = $editCA = $editB = $editV = ''; // Initialize variables

// Fetch the data for the edit form
if (isset($_POST['edit'])) {
    $editID = $_POST['editID'];
    $result = mysqli_query($connection, "SELECT * FROM childregistration WHERE ID = $editID");

    if ($result && mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        $editCN = $row['ChildName'];
        $editCA = $row['ChildAge'];
        $editB = $row['Barangay'];
        $editV = $row['Vaccine'];
    } else {
        echo '<script>alert("User not found!"); window.location.href="/VACCINATION/AdminPage.php";</script>';
        exit();
    }
}

// Handle the form submission to update the record
if (isset($_POST['update'])) {
    $updateID = $_POST['updateID'];
    $updateCN = mysqli_real_escape_string($connection, $_POST['updateCN']);
    $updateCA = mysqli_real_escape_string($connection, $_POST['updateCA']);
    $updateB = mysqli_real_escape_string($connection, $_POST['updateB']);
    $updateV = mysqli_real_escape_string($connection, $_POST['updateV']);

    // Update query to modify the database record
    $query = "UPDATE childregistration SET ChildName = ?, ChildAge = ?, Barangay = ?, Vaccine = ? WHERE ID = ?";
    $stmt = mysqli_prepare($connection, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssi', $updateCN, $updateCA, $updateB, $updateV, $updateID);
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Successfully Edited!"); window.location.href="/VACCINATION/AdminPage.php";</script>';
        } else {
            echo '<script>alert("Error: ' . mysqli_error($connection) . '");</script>';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo '<script>alert("Error preparing the update query.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
        <h1>Edit Data Information</h1>
        <form method="post">
            <div class="form-group">
                <input type="text" name="updateCN" placeholder="Enter Child Name" value="<?php echo htmlspecialchars($editCN); ?>" required class="form-control" />
            </div>
            <div class="form-group">
                <input type="text" name="updateCA" placeholder="Enter Child Age" value="<?php echo htmlspecialchars($editCA); ?>" required class="form-control" />
            </div>
            <div class="form-group">
                <input type="text" name="updateB" placeholder="Enter Barangay" value="<?php echo htmlspecialchars($editB); ?>" required class="form-control" />
            </div>
            <div class="form-group">
                <input type="text" name="updateV" placeholder="Enter Vaccine" value="<?php echo htmlspecialchars($editV); ?>" required class="form-control" />
            </div>
            <button type="submit" name="update" class="btn btn-primary">SAVE</button>
            <input type="hidden" name="updateID" value="<?php echo htmlspecialchars($editID); ?>"/>
        </form>
    </div>
</body>
</html>
