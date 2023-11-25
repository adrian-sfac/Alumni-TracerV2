<!DOCTYPE html>
<html lang="en">

<?php
require '../../includes/conn.php';
include '../../includes/head.php';
include '../../includes/session.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News</title>
    <style>
        .container {
            padding: 20px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 30px;
        }

        h3 {
            font-family: 'Sans-serif';
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            color: #555;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 20px;
            display: inline-block;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<?php if ($_SESSION['role'] == "Super Administrator" || $_SESSION['role'] == "Admin") {?>

<body class="g-sidenav-show  bg-gray-200">

<?php include "../../includes/sidebar.php";?>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

<?php include "../../includes/navbar.php"?>
<div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-9 mt-3">
                <div class="card">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4" style="font-family: sans-serif;">Add News</h3>
                        <form method="post" action="submit-news.php" enctype="multipart/form-data" onsubmit="return confirmSubmit();">
                        <div class="mb-3">
                            <label for="title">News Title:</label>
                            <input type="text" style="border: 1px solid black; border-radius: 3px; color: black;" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="content">News Content:</label>
                            <textarea name="content" style="resize: none; border: 1px solid black; border-radius: 5px; color: black;" id="content" rows="8" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image">Image:</label>
                            <input type="file" name="image" style="width: auto;"accept=".gif, .jpeg, .jpg, .png">
                            <small class="form-text text-muted">Accepted file types: .gif, .jpeg, .jpg, .png</small>
                        </div>

                        <div class="text-center">
                            <button type="submit">Submit News</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

<?php include "../../includes/footer.php"?>

<?php } ?>

<script>
    function confirmSubmit() {
        return confirm("Are you sure you want to submit this news article?");
    }
</script>

</main>

<?php include "../../includes/script.php"; ?>

</body>
</html>