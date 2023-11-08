<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="./images/favicon.png" type="image/png" sizes="16x16">
<title>Discussion Forum</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
                                $sql = "INSERT INTO tbl_forum (id, user, message, date) VALUES ('', '$user_name', '$message', '$date')";
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
                        <tbody>
                            <?php 
                            
                            $display = mysqli_query($db, "SELECT * FROM tbl_forum ORDER BY id DESC");
                            
                            if (mysqli_num_rows($display) != 0) {
                                while ($row = mysqli_fetch_assoc($display)) {
                                    if ($row['parent_id'] == 0) {
                                        // This is a top-level comment
                                        echo "<tr><td>".$row['id']."</td>";
                                        echo "<td>".$row['user']."</td>";
                                        echo "<td>".$row['message']."</td>";
                                        echo "<td>".$row['date']."</td>";
                                        echo '<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#replyModal" onclick="setReplyId('.$row['id'].')">Reply</button></td>';
                                        echo "</tr>";
                                    } else {
                                        // This is a reply
                                        // Display it under the corresponding top-level comment
                                        echo "<tr><td style='margin-left: 20px;'>".$row['id']."</td>";
                                        echo "<td>".$row['user']."</td>";
                                        echo "<td>".$row['message']."</td>";
                                        echo "<td>".$row['date']."</td>";
                                        echo "</tr>";
                                    }
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

<!-- Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reply Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="frm1" method="post">
                    <div class="form-group">
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
                            <label class="text-bold ms-1 ps-1"><?php echo $user_name ?></label>
                        </a>
                    </div>
                    <div class="form-group">
                        <label for="replyMessage">Write your reply:</label>
                        <textarea class="form-control" style="resize:none; border: 1px solid black; border-radius: 10px; padding: 10px;" rows="5" name="replyMessage" id="replyMessage" required></textarea>
                    </div>
                    <input type="hidden" id="replyCommentId" name="replyCommentId" value="0">

                    <button type="submit" name="btnreply" class="btn btn-info">Reply</button>

                    <?php
                    if (isset($_POST['btnreply'])) {
                        $message = isset($_POST['replyMessage']) ? $_POST['replyMessage'] : '';
                        $date = date("Y-m-d h:i:s A");
                        $reply_id = isset($_POST['replyCommentId']) ? $_POST['replyCommentId'] : 0;

                        if (strlen($message) >= 1 && strlen($message) <= 200) {
                            // Insert the reply into the database
                            $sql = "INSERT INTO tbl_forum (user, message, date, parent_id) VALUES ('$user_name', '$message', '$date', $reply_id)";
                            if ($savepost = mysqli_query($db, $sql)) {
                                echo "<script language=javascript>alert('Reply posted successfully!')</script>";
                                echo "<script>document.location='forum-form.php'</script>";
                            } else {
                                echo "<center>Reply unsuccessful.</center>";
                            }
                        } else {
                            echo "Reply message must be between 1 and 200 characters.";
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>


    <script>
    function setReplyId(commentId) {
        // Set the replyCommentId to the selected comment's comment_id
        document.getElementById('replyCommentId').value = commentId;
    }
    </script>
    
    <?php } ?>
</main>

<?php include "../../includes/footer.php"?>
</body>
</html>
<!--   Core JS Files   -->
<?php include "../../includes/script.php"?>