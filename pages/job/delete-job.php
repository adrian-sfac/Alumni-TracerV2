<?php
// Include your database connection or setup here
include "../../includes/conn.php";

// Check if the job ID is set and not empty
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $jobId = mysqli_real_escape_string($db, $_GET['id']);

    // Perform the delete operation
    $deleteQuery = "DELETE FROM tbl_job WHERE id = $jobId";

    if (mysqli_query($db, $deleteQuery)) {
        // Job deleted successfully
        header("Location: job-display.php");
        exit();
    } else {
        // Error in deletion
        echo "Error deleting job: " . mysqli_error($db);
    }
} else {
    // Redirect to the job listing page if no job ID is provided
    header("Location: job-display.php");
    exit();
}
?>
