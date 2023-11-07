<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="./images/favicon.png" type="image/png" sizes="16x16">
<title>Discussion Forum</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php
include '../../includes/session.php';
// End Session
include '../../includes/head.php';
?>

<body class="g-sidenav-show  bg-gray-200">
  
<?php include "../../includes/sidebar.php"?>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <?php if ($_SESSION['role'] == "Super Administrator") { 
    $admin_id = $_SESSION['userid'];
    
    $query_admin = $db->query("SELECT admin_id,img,firstname FROM tbl_super_ad WHERE admin_id = '$admin_id'");
    $row_admin = $query_admin->fetch_array();
    $user_image = $row_admin['img'];
    $user_name = $row_admin['firstname'];
    ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h3 class="mb-0 text-white">Discussion Forum</h3>
            </div>
            
            <div class="card-body">
                <form name="frm" method="post">
                    <input type="hidden" id="commentid" name="Pcommentid" value="0">
                    <div class="nav-item mb-2 mt-0">
                        <a href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav" role="button" aria-expanded="false">
                            <?php 
                            $getImg = mysqli_query($db, "SELECT img FROM tbl_super_ad WHERE admin_id = '$admin_id'");
                            while ($row = mysqli_fetch_array($getImg)) {
                                if (empty($row['img'])) {
                                    echo '<img class="avatar" style="height:45px; width:45px; margin-bottom: 7px;" src="../../assets/img/image.png"/>';
                                } else {
                                    echo ' <img class="avatar" style="height:45px; width:45px; margin-bottom: 7px;" src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" "/>';
                                }
                            }
                            ?>

                            <label class="text-bold ms-1 ps-1"><?php echo $user_name ?></span>
                        </a>
                        <div class="form-group mb-3 text-black">
                            <label for="message">Your Question:</label>
                            <textarea class="form-control" style="resize:none; border: 1px solid black; border-radius: 10px; padding: 10px;" rows="5" name="message" id="message" required></textarea>
                        </div>

                        <button type="submit-responsive" id="submit" name="submit" class="btn btn-dark">Post</button>
                        
                        <?php
                        date_default_timezone_set('Asia/Manila');

                        $message = isset($_POST['message']) ? $_POST['message'] : '';
                        $date = date("Y-m-d h:i:s A");

                        if (isset($_POST['submit'])) {
                            if (strlen($message) >= 1 && strlen($message) <= 500) {
                                $sql = "INSERT INTO tbl_forum (comment_id, user, message, date) VALUES ('', '$user_name', '$message', '$date')";
                                if ($savepost = mysqli_query($db, $sql)) {
                                  echo "<script languge=javascript>alert('Post success!')</script>";
                                  echo "<script> document.location='forum-form.php' </script>";
                                } else {
                                    echo "<center> Post unsuccessful. </center>";
                                }
                            } else {
                                echo "Message must be between 1 and 500 characters.";
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body" style="background-color: #fff; border:0px; border-radius:10px">
                    <h4>Recent Questions</h4>           
                    <table class="table" id="MyTable" style="background-color: #fff; border:0px; border-radius:10px">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Message</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            
                            $display = mysqli_query($db, "SELECT * FROM tbl_forum ORDER BY comment_id DESC");
                            
                            if (mysqli_num_rows($display) != 0) {
                                while ($row = mysqli_fetch_assoc($display)) {
                                    echo "<tr><td>".$row['comment_id']."</td>";
                                    echo "<td>".$row['user']."</td>";
                                    echo "<td>".$row['message']."</td>";
                                    echo "<td>".$row['date']."</td></tr>";
                                }
                            }
                            ?>
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</main>

<?php include "../../includes/footer.php"?>
</body>
</html>
<!--   Core JS Files   -->
<?php include "../../includes/script.php"?>