<?php
session_start();
include './DB_Conn.php';
$userId;
if (isset($_COOKIE["userId"])) {
    $userId = $_COOKIE["userId"];
} else {
    header("Location:login.php?msg=plese Login First !!!");
    die();
}

$examSearchName = "";
if (isset($_POST['search'])) {
    $examSearchName = $_POST['search'];
}
if (isset($_SESSION['myId'])) {
  
}
?>




<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Exams</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    </head>
    <body>
        <br>
        <br>
        <nav class="navbar">
            <div class="container-fluid">
<?php
if (!empty($_REQUEST['msg'])) {
    $color = "#ff0000";
    ?>
                    <p style="color: #ff0000;"><?php echo sprintf($_REQUEST['msg']); ?></p>

                <?php } ?> 

                <form class="d-flex" role="search" method="POST" action="student_open_view.php">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search Exam" aria-label="Search">
                    <input class="btn btn-primary" type="submit" value="Search"/>
                </form>

            </div>
        </nav>
        <br>
        <br>
        <section>
            <div class="container">
                <table class="table table-striped table-bordered ">
                    <thead style="background-color: #6699ff;text-align: center;">
                        <tr>

                            <th scope="col">Exam</th>
                            <th scope="col">Starting Time</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;">
<?php
$que = "SELECT * FROM exam_management_system.`exam` WHERE name LIKE '%$examSearchName%'";

$resultExam = $connection->query($que);
if (mysqli_num_rows($resultExam) > 0) {
    while ($examData = mysqli_fetch_assoc($resultExam)) {

        $examName = $examData['name'];
        $examlastUpdate = $examData['last_updated'];

        $examId = $examData['examId'];
        $examDate = $examData['date_time'];
        $duration = $examData['duration'];
        $status = "";
        $checkStatusQue = "SELECT * FROM exam_management_system.`result` WHERE user_id='" . $userId . "' and exam_id='" . $examId . "'";
        $resultStatus = $connection->query($checkStatusQue);
        if (mysqli_num_rows($resultStatus) > 0) {

            $status = "Done";
        } else {
            $status = "Pending";
            date("Y-m-d");
        }

     
        ?>   

                                <tr data-id="<?php echo $examId; ?>" data-name="<?php echo $examName; ?>" style="cursor: pointer;">

                                    <td><a style="text-decoration: none;color: #000;"href="actions/student_exam_action.php?id=<?php echo $examId; ?>"><?php echo $examName; ?></a></td>
                                    <td><a style="text-decoration: none;color: #000;" href="actions/student_exam_action.php?id=<?php echo $examId; ?>"><?php
                        $dd = strtotime($examDate);
                        echo date("Y-m-d h:i:sa", $dd);
                        ?></a></td>
                                    <td><a style="text-decoration: none;color: #000;" href="actions/student_exam_action.php?id=<?php echo $examId; ?>"><?php echo $duration; ?></a></td>
                                    <td><a  style="text-decoration: none;color: #000;" href="actions/student_exam_action.php?id=<?php echo $examId; ?>"><?php echo $status; ?></a></td>

                                </tr>
        <?php
    }
}
?>

                    </tbody>
                </table>
            </div>
        </section>


    </body>
</html>
