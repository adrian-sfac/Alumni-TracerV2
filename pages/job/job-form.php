<!DOCTYPE html>
<html lang="en">

<?php
require '../../includes/conn.php';
include '../../includes/session.php';
include '../../includes/head.php';
include "../../includes/script.php";
?>

<?php if ($_SESSION['role'] == "Super Administrator" || $_SESSION['role'] == "Admin" || $_SESSION['role'] == "Registrar" || $_SESSION['role'] == "Student" || $_SESSION['role'] == "Alum Stud") ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Opportunity Form</title>
    <style>

        .container-fluid {
            padding: 4rem 0;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2.5rem;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border: 1px solid black;
            border-radius: 10px;
            padding: 10px;
        }

        .form-control:focus {
            outline: none; 
            border: 1px solid black;
        }

        .form-check-input {
            margin-top: 0.25rem;
        }

        .form-select option {
        margin-left: 20px;
        }

        .btn-dark {
            background-color: #343a40;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php include "../../includes/sidebar.php"; ?>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

<?php include "../../includes/navbar.php"?>

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-9 mt-3">
                <div class="card">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4" style="font-family: sans-serif;">Job Opportunity Form</h3>
                        <form method="post" action="submit-job.php" id="jobForm">
                            <div class="mb-3">
                                <label for="name" class="form-label" style="color: black;">Name:</label>
                                <input type="text" class="form-control" style="border: 1px solid black; border-radius: 10px; color: black;" name="name" placeholder="Your Name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label" style="color: black;">Email:</label>
                                <input type="email" class="form-control" name="email" placeholder="example@gmail.com" required>
                            </div>

                            <div class="mb-3">
                                <label for="contact" class="form-label" style="color: black;">Contact No:</label>
                                <input type="tel" class="form-control" name="contact" style="color: black;" placeholder="Your Contact Number" required>
                            </div>

                            <div class="mb-3">
                                <label for="job_desc" class="form-label" style="color: black;">Job Description:</label>
                                <textarea class="form-control" name="job_desc" rows="8" style="resize:none; color: black;" required placeholder="Enter job description here..."></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="edu_background" class="form-label" style="color: black;">Required Educational Background:</label>
                                <select class="form-select" name="edu_background" style="border: 1px solid black; border-radius: 10px; color: black; padding-left: 6px; width: 250px;" required>
                                    <option value="" selected disabled>Select Educational Background</option>
                                    <option value="None">None</option>
                                    <option value="Elementary Graduate">Elementary Graduate</option>
                                    <option value="Junior High School Graduate">Junior High School Graduate</option>
                                    <option value="Senior High School Graduate">Senior High School Graduate</option>
                                    <option value="College Graduate (Any Course)">College Graduate (Any Course)</option>
                                    <option value="CS Graduate">CS Graduate</option>
                                    <option value="EDUC Graduate">EDUC Graduate</option>
                                    <option value="BA Graduate">BA Graduate</option>
                                    <option value="HM/HRM Graduate">HM/HRM Graduate</option>
                                    <option value="LA Graduate">LA Graduate</option>
                                    <option value="ENG Graduate">ENG Graduate</option>
                                    <option value="NURS Graduate">NURS Graduate</option>
                                </select>
                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-dark mt-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include "../../includes/footer.php"?>

</main>
</body>
</html>
