<?php
session_start();
require('./Read.php'); // Ensure Read.php initializes $connection

// Handle search functionality
$searchTerm = '';
if (isset($_POST['search'])) {
    $searchTerm = mysqli_real_escape_string($connection, $_POST['searchTerm']);
}

// Update the query with the correct table name
$queryAccount = "SELECT * FROM san_jose WHERE Vaccine LIKE '%$searchTerm%' OR ChildAge LIKE '%$searchTerm%'";
$sqlAccount = mysqli_query($connection, $queryAccount);

// Check if the query was successful
if (!$sqlAccount) {
    die("Error in query: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        @media print {
            #printButton {
                display: none;
            }
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
            <li><a href="SMS.php">SMS Notification</a></li>
            
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="Logout.php" onclick="return confirm('Are you sure you want to log out?');">Log out</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <br>
    <div class="row">
        <div class="col-md-8">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
        </div>
        <div class="col-md-4 text-right">
            <!-- Search Form -->
            <form action="" method="post" class="form-inline" style="margin-top: 20px;">
                <input type="text" name="searchTerm" placeholder="Search by  ChildAge" class="form-control" value="<?php echo htmlspecialchars($searchTerm); ?>" />
                <input type="submit" name="search" value="SEARCH" class="btn btn-info" />
            </form>
        </div>
    </div>

    <br>

    <form action="Create2.php" method="post">
        <h3>Create User Info</h3>
        <input type="text" name="ChildName" placeholder="Enter Child Name" required />
        <input type="text" name="ChildAge" placeholder="Enter Child Age" required />
        <input type="text" name="Vaccine" placeholder="Enter Specific Vaccine" required />
        <input type="submit" name="create" value="CREATE" class="btn btn-success" />
    </form>

    <br>
    <table class="table">
        <tr class="info">
            <th>ID</th>
            <th>ChildName</th>
            <th>ChildAge</th>
            <th>PhoneNumber</th>
            <th>Barangay</th>
            <th>Vaccine</th>
            <th>Actions</th>
        </tr>
        <?php 
        // Check if there are results before looping through them
        if (mysqli_num_rows($sqlAccount) > 0) {
            while ($results = mysqli_fetch_array($sqlAccount)) { ?>
                <tr>
                    <td><?php echo $results['ID']; ?></td>
                    <td><?php echo htmlspecialchars($results['ChildName']); ?></td>
                    <td><?php echo htmlspecialchars($results['ChildAge']); ?></td>
                    <td><?php echo htmlspecialchars($results['PhoneNumber']); ?></td>
                    <td><?php echo htmlspecialchars($results['Barangay']); ?></td>
                    <td><?php echo htmlspecialchars($results['Vaccine']); ?></td>
                    <td>
                        <form action="Edit2.php" method="post" style="display:inline;">
                            <input type="hidden" name="editID" value="<?php echo $results['ID']; ?>">
                            <input type="hidden" name="editCN" value="<?php echo htmlspecialchars($results['ChildName']); ?>">
                            <input type="hidden" name="editCA" value="<?php echo htmlspecialchars($results['ChildAge']); ?>">
                            <input type="hidden" name="editB" value="<?php echo htmlspecialchars($results['Barangay']); ?>">
                            <input type="hidden" name="editV" value="<?php echo htmlspecialchars($results['Vaccine']); ?>">
                            <input type="submit" name="edit" value="EDIT" class="btn btn-primary">
                        </form>
                        <form action="Delete2.php" method="post" style="display:inline;">
                            <input type="hidden" name="deleteID" value="<?php echo $results['ID']; ?>">
                            <input type="submit" name="delete" value="DELETE" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            <?php }
        } else {
            echo "<tr><td colspan='7'>No records found.</td></tr>";
        }
        ?>
    </table>
</div>
<button id="printButton" onclick="window.print()">Print</button>
</body>
</html>
