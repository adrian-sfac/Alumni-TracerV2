<!DOCTYPE html>
<html lang="en"><!DOCTYPE html>
<html lang="en">

<?php
require '../../includes/conn.php';
include '../../includes/session.php';
include '../../includes/head.php';
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback Form</title>
</head>
<body>
<?php
include "../../includes/sidebar.php";
?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

<?php include "../../includes/navbar.php"?>

<?php if ($_SESSION['role'] == "Alum Stud") { ?>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-9 mt-3">
                <div class="card">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4" style="font-family: sans-serif;">Feedback Form</h3>
                        <form method="post" action="" id="feedbackForm">
                            <a href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav" role="button" aria-expanded="false">
                                <?php 
                                $getImg = mysqli_query($db, "SELECT img FROM tbl_alumni WHERE alumni_id = '$alumni_id'");
                                while ($row = mysqli_fetch_array($getImg)) {
                                    $imgSrc = empty($row['img']) ? '../../assets/img/image.png' : 'data:image/jpeg;base64,' . base64_encode($row['img']);
                                    echo '<img class="avatar" style="height:45px; width:45px; margin-bottom: 15px;" src="' . $imgSrc . '" />';
                                }
                                ?>

                                <label class="text-bold ms-1 ps-1"><?= $user_name ?></label>
                                <input type="hidden" name="user" value="<?= $user_name ?>">
                            </a>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" style="border: 1px solid black; border-radius: 10px; padding: 10px;" name="email" placeholder="example@gmail.com" required>
                            </div>

                            <label for="rating">Rating: </label>
                            <div class="rating-buttons ms-3">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    echo '<input type="radio" name="rating" value="' . $i . '" style="margin-left: 20px; margin-right: 5px;">' . $i;
                                }
                                ?>
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="feedback" class="form-label">Feedback:</label>
                                <textarea class="form-control" name="feedback" style="resize:none; border: 1px solid black; border-radius: 10px; padding: 10px;" rows="8" required placeholder="Enter your feedback here..."></textarea>
                            </div>

                            <div class="mb-3 mt-3 form-check">
                                <input type="checkbox" class="form-check-input" id="anonymousCheckbox" name="anonymous">
                                <label class="form-check-label" for="anonymousCheckbox">Submit Anonymously</label>
                            </div>

                            <div class="mt-3 text-center">
                                <button type="submit" class="btn btn-dark mt-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
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
            echo "<script> alert('Feedback submitted successfully!') </script>";
            echo "<script>document.location='feedback-form.php'</script>";
        } else {
            // Error in insertion
            echo "<script> alert('Error! Feedback unsuccessful.') </script>" . $db->error;
            echo "<script>document.location='feedback-form.php'</script>";
        }
    }
    ?>    

    <?php include "../../includes/footer.php"?>
<?php } ?>
</main>
</body>
</html>



<?php include "../../includes/script.php"?>