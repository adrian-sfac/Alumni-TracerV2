<?php
include '../../../includes/session.php';
include '../../../includes/conn.php';

if (isset($_POST['submit'])) {
    $selectedBatchID = $_POST['batch'];

    $studentsQuery = mysqli_query($db, "SELECT * FROM tbl_student WHERE batch_id = $selectedBatchID");

    while ($student = mysqli_fetch_assoc($studentsQuery)) {
        // Insert data into tbl_alumni
        mysqli_query($db, "INSERT INTO tbl_alumni (stud_no, firstname, middlename, lastname, username, password, batch_id)
                           VALUES ('{$student['stud_no']}', '{$student['firstname']}', '{$student['middlename']}', '{$student['lastname']}', '{$student['username']}', '{$student['password']}', '{$student['batch_id']}')");

        // Retrieve alumni_id
        $alumniIdQuery = mysqli_query($db, "SELECT LAST_INSERT_ID() as alumni_id");
        $alumniId = mysqli_fetch_assoc($alumniIdQuery)['alumni_id'];

        // Insert data into tbl_form using the retrieved alumni_id
        mysqli_query($db, "INSERT INTO tbl_form (alumni_id, firstname, middlename, lastname, email, contact, batch_id)
                           VALUES ('$alumniId', '{$student['firstname']}', '{$student['middlename']}', '{$student['lastname']}','{$student['email']}', '{$student['contact']}', '{$student['batch_id']}')");

        // Delete data from tbl_student
        mysqli_query($db, "DELETE FROM tbl_student WHERE stud_no = '{$student['stud_no']}'");
    }

    $_SESSION['transitionBatch'] = true;
    header("location: ../batch-transition.php");
    exit();
}
?>
