<?php
require '../../includes/conn.php';
include '../../includes/session.php';
include '../../includes/head.php';

$totalEntriesQuery = $db->query("SELECT COUNT(*) as total FROM tbl_job");
$totalEntries = $totalEntriesQuery->fetch_assoc()['total'];
$entriesPerPage = 7;
$totalPages = ceil($totalEntries / $entriesPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Opportunity List</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .job-list {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
        }

        .feedback {
            margin-bottom: 20px;
        }

        .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-link {
            color: #007bff;
            border: 1px solid #007bff;
            margin: 0 5px;
        }

        .pagination .page-item.active .page-link {
            color: white;
            background-color: #007bff;
            border-color: #007bff;
        }

        .pagination-hidden {
        display: none;
        }
        
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); 
            backdrop-filter: blur(3px);
            z-index: 1;
        }

        .modal {
            display: none;
            position: fixed;
            top: 70%;
            left: 55%;
            transform: translate(-50%, -50%);
            border: 1px transparent;
            background-color: transparent;
            padding: 20px;
            border-radius: 10px;
            z-index: 3; /* Higher z-index to appear above the overlay */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .modal-content {
            color: black;
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        .feedback a {
            font-weight: bold;
            color: #fc6060;
            text-decoration: none;
        }

        .feedback a:hover {
            font-weight: bold;
            color: blue;
            text-decoration: underline;
        }

    </style>
</head>
<body class="g-sidenav-show  bg-gray-200">

<?php if ($_SESSION['role'] == "Super Administrator" || $_SESSION['role'] == "Admin" || $_SESSION['role'] == "Registrar" || $_SESSION['role'] == "Student" || $_SESSION['role'] == "Alum Stud") {?>

<?php include "../../includes/sidebar.php";?>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

<?php include "../../includes/navbar.php"?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="job-list">
                <h3 class="text-center mb-4" style="font-family: sans-serif;">Current Job Opportunities</h3>
                <?php

                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($currentPage - 1) * $entriesPerPage;

                $query = $db->query("SELECT * FROM tbl_job ORDER BY id DESC LIMIT $offset, $entriesPerPage");

                if ($query->num_rows > 0) {
                    while ($row = $query->fetch_assoc()) {
                        echo '<div class="feedback" style="color: black; border: 1px solid black; padding: 10px; border-radius: 10px; margin-bottom: 15px;">';
                        echo '<strong><span style="margin-right: 50px; margin-left: 5px;">' . $row['job_name'] . '</span></strong>';
                        echo '<span style="margin-left: 50%; margin-right: 20px;">Offered by: <strong>' . $row['name'] . '</strong></span>';

                        // Limiting job description words
                        // $jobDescWords = explode(' ', $row['job_desc']);
                        // $limitedJobDesc = implode(' ', array_slice($jobDescWords, 0, 20)); // Adjust the number of words as needed
                        // echo '<strong>Job Description:</strong> ' . $limitedJobDesc . ' ...<br>';
                        echo '<a href="#" onclick="showJobInfo(' . $row['id'] . ')">See details</a>';
                        if ($row['user'] == $user_name) {
                            echo '<a style="margin-left: 10px;" href="#" onclick="deleteJob(' . $row['id'] . ')"><i class="fas fa-trash-alt"></i></a>';
                        } else if ($_SESSION['role'] == "Super Administrator" || $_SESSION['role'] == "Admin" || $_SESSION['role'] == "Registrar") {
                            echo '<a style="margin-left: 10px;" href="#" onclick="deleteJob(' . $row['id'] . ')"><i class="fas fa-trash-alt"></i></a>'; }
                        echo '</div>';
                        
                        echo '<div class="modal-overlay" id="modalOverlay"></div>
                                <div id="jobInfoModal' . $row['id'] . '" class="modal" style="display: none;">
                                    <div class="modal-content">
                                        <span class="close" style="margin-right: 10px;" onclick="closeJobInfo(' . $row['id'] . ')">&times;</span>
                                        <strong span style="font-size: 22px;">' . $row['job_name'] . '</span></strong>
                                        <a style="font-size: 18px;">(Posted on: ' . $row['date'] . ')</a><br>
                                        <span style="font-size: 18px; margin-left: 15px;"> <strong>Job Description:</strong> <br>' . $row['job_desc'] . '</span><br><br>
                                        <span style="font-size: 18px;">Offered by: <strong>' . $row['name'] . '</strong></span>
                                        <span style="font-size: 18px; margin-left: 40px; margin-top: 10px;">Email: '. $row['email'] .'</span>
                                        <span style="font-size: 18px; margin-left: 40px;">Contact: '. $row['contact'] .'<br></span>
                                    </div>
                                </div>';
                        }
                } else {
                    echo '<p class="text-center">No job opportunities yet.</p>';
                }
                ?>
            </div>
            <ul id="pagination" class="pagination justify-content-center">
                <?php
                if ($currentPage > 1) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage - 1) . '" aria-label="Previous"><span aria-hidden="true">&larr;</span></a></li>';
                }

                for ($i = 1; $i <= $totalPages; $i++) {
                    $activeClass = ($i == $currentPage) ? 'active' : '';
                    echo '<li class="page-item ' . $activeClass . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                }

                if ($currentPage < $totalPages) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage + 1) . '" aria-label="Next"><span aria-hidden="true">&rarr;</span></a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<script>
    function showJobInfo(jobId) {
    var modalOverlay = document.getElementById('modalOverlay');
    var modal = document.getElementById('jobInfoModal' + jobId);
    var pagination = document.getElementById('pagination');

    modalOverlay.style.display = 'block';
    modal.style.display = 'block';
    pagination.classList.add('pagination-hidden');
    }

    function closeJobInfo(jobId) {
        var modalOverlay = document.getElementById('modalOverlay');
        var modal = document.getElementById('jobInfoModal' + jobId);
        var pagination = document.getElementById('pagination');

        modalOverlay.style.display = 'none';
        modal.style.display = 'none';
        pagination.classList.remove('pagination-hidden');
    }

    // Close modal on outside click
    window.onclick = function(event) {
        var modalOverlay = document.getElementById('modalOverlay');
        var pagination = document.getElementById('pagination');

        if (event.target.className === 'modal-overlay') {
            modalOverlay.style.display = 'none';
            document.querySelector('.modal').style.display = 'none';
            pagination.classList.remove('pagination-hidden');
        }
    };

    function deleteJob(jobId) {
        // You can add an additional confirmation here if needed
        var confirmDelete = confirm('Are you sure you want to delete this job?');

        if (confirmDelete) {
            // Perform the delete operation, for example, redirect to a delete script
            window.location.href = 'delete-job.php?id=' + jobId;
        }
    }
</script>


<?php include "../../includes/footer.php"?>

<?php }?>

</main>

<?php include '../../includes/script.php'?>

</body>
</html>
