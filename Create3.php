<?php
require('./Database.php');  // Ensure this file contains the correct database connection

if (isset($_POST['create'])) {
    // Retrieve POST data
    $ChildName = mysqli_real_escape_string($connection, $_POST['ChildName']);
    $ChildAge = mysqli_real_escape_string($connection, $_POST['ChildAge']);
    $Vaccine = mysqli_real_escape_string($connection, $_POST['Vaccine']);

    // Prepare the SQL query using prepared statements
    $queryCreate = "INSERT INTO san_juan (ChildName, ChildAge, Vaccine) 
                    VALUES (?, ?,?)";

    // Initialize prepared statement
    if ($stmt = mysqli_prepare($connection, $queryCreate)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, 'sss', $ChildName, $ChildAge, $Vaccine);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            // If successful, redirect the user to the Admin Page
            echo '<script>window.location.href = "/VACCINATION/San Juan.php"</script>';
        } else {
            // Handle query execution error
            echo '<script>alert("Error: ' . mysqli_error($connection) . '")</script>';
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle error with preparing the query
        echo '<script>alert("Error preparing the query: ' . mysqli_error($connection) . '")</script>';
    }
}
?>
