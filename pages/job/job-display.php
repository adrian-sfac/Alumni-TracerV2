<?php
require '../../includes/conn.php';
include '../../includes/session.php';
include '../../includes/head.php';
include '../../includes/script.php';

$totalEntriesQuery = $db->query("SELECT COUNT(*) as total FROM tbl_job");
$totalEntries = $totalEntriesQuery->fetch_assoc()['total'];
$entriesPerPage = 5;
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

    </style>
</head>
<body>

<?php if ($_SESSION['role'] == "Super Administrator") {?>

<?php include "../../includes/sidebar.php";?>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

<?php include "../../includes/navbar.php"?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="job-list">
                <h3 class="text-center mb-4" style="font-family: sans-serif;">Job Opportunities</h3>
                <?php

                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($currentPage - 1) * $entriesPerPage;

                $query = $db->query("SELECT * FROM tbl_job ORDER BY id DESC LIMIT $offset, $entriesPerPage");

                if ($query->num_rows > 0) {
                    while ($row = $query->fetch_assoc()) {
                        echo '<div class="feedback" style="color: black; border: 1px solid black; padding: 10px; border-radius: 10px; margin-bottom: 15px;">';
                        echo '<strong>Name:</strong> <span style="margin-right: 20px;">' . $row['name'] . '</span>';
                        echo '<strong>Email:</strong> <span style="margin-right: 20px;">' . $row['email'] . '</span>';
                        echo '<strong>Contact:</strong> <span style="margin-right: 20px;">' . $row['contact'] . '</span><br>';
                        echo '<strong>Job Description:</strong> ' . $row['job_desc'] . '<br>';
                        echo '<strong>Educational Requirement:</strong> ' . $row['edu_background'] . '<br>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="text-center">No job opportunities yet.</p>';
                }
                ?>
            </div>
            <ul class="pagination justify-content-center">
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

<?php include "../../includes/footer.php"?>

<?php }?>

</main>

</body>
</html>
