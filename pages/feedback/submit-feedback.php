<?php
include '../../includes/conn.php';
include '../../includes/session.php';
 
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $user_name = $db->real_escape_string($_POST['user']);
        $email = $db->real_escape_string($_POST['email']);
        $feedback = $db->real_escape_string($_POST['feedback']);
        $rating = (int)$_POST['rating'];
        $anonymous = isset($_POST['anonymous']) ? 1 : 0;

        $insertQuery = "INSERT INTO tbl_feedback (user, email, feedback, rating, anonymous) VALUES ('$user_name', '$email', '$feedback', $rating, $anonymous)";
        $result = $db->query($insertQuery);

        if ($result) {
            // Successful insertion
            $_SESSION['feedback_added'] = 'Feedback Submitted Successfully!';
            header("location: feedback-form.php");
        } else {
            // Error in insertion
            echo "<script> alert('Error! Feedback unsuccessful.') </script>" . $db->error;
            echo "<script>document.location='feedback-form.php'</script>";
        }
    }
?>