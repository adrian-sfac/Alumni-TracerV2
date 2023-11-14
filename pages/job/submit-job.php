<?php
require '../../includes/conn.php';

$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$job_desc = $_POST['job_desc'];
$edu_background = $_POST['edu_background'];

$sql = "INSERT INTO tbl_job (name, email, contact, job_desc, edu_background) VALUES (?, ?, ?, ?, ?)";
$stmt = $db->prepare($sql);

$stmt->bind_param("sssss", $name, $email, $contact, $job_desc, $edu_background);

if ($stmt->execute()) {
    echo "<script> alert('Job Added Successfully!') </script>";
    echo "<script>document.location='../dashboard/dashboard.php'</script>";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$stmt->close();
?>
