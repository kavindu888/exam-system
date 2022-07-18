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

if (isset($_SESSION['createExamForm'])) {
    unset($_SESSION['createExamForm']);
}
if (isset($_SESSION['examName'])) {
    unset($_SESSION['examName']);
}
if (isset($_SESSION['examDate'])) {
    unset($_SESSION['examDate']);
}
if (isset($_SESSION['createQuestionForm'])) {
    unset($_SESSION['createQuestionForm']);
}
if (isset($_SESSION['examDuration'])) {
    unset($_SESSION['examDuration']);
}
?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Exams</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">


    </head>
    <body>
        <br>
        <br>
        <nav class="navbar">
            <div class="container-fluid">

                <form class="d-flex" role="search" method="POST" action="teacher_open_view.php">
                    <input class="form-control me-2" type="search" placeholder="Search Exam" aria-label="Search" name="search">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
                <a style="text-decoration: none;" href="create_exam.php"> <button class="btn btn-success" type="submit"  >New Exam</button></a>
            </div>
        </nav>
<?php
if (!empty($_REQUEST['msg'])) {
    $color = "#ff0000";
    ?>
                <p style="color: #ff0000;"><?php echo sprintf($_REQUEST['msg']); ?></p>

<?php } ?>  





        <br>
        <br>
        <section>
            <div class="container">
                <table class="table table-striped table-bordered "  >
                    <thead style="background-color: #b3ffff;text-align: center;">

                        <tr >

                            <th scope="col">Exam</th>
                            <th scope="col">Last Updated</th>
                            <th scope="col">Status</th>
                        </tr>


                    </thead>
                    <tbody style="text-align: center;">
                        <?php
                        $que;
                        $form = true;
                        if (isset($_SESSION['from'])) {
                            
                        }




                        $que = "SELECT * FROM exam_management_system.`exam` INNER JOIN exam_management_system.`publish` ON exam_management_system.`exam`.`publish_id`=exam_management_system.`publish`.`publish_id` WHERE `user_id`='" . $userId . "' AND name  LIKE '%$examSearchName%'";

                        $resultExam = $connection->query($que);
                        if (mysqli_num_rows($resultExam) > 0) {
                            while ($examData = mysqli_fetch_assoc($resultExam)) {

                                $examName = $examData['name'];
                                $examlastUpdate = $examData['last_updated'];
                                $examstatus = $examData['status'];
                                $examId = $examData['examId'];
                               
                           
                                ?> 
                        
                                             
                   
                        <tr data-id=$id_from_db onclick="submit_id(this)"">
                       
                            <td  > <a style="text-decoration: none;color: #000000;" href="moniter_exam.php?examId=<?php echo $examId;?>"><?php echo $examName; ?></a></td>
                            <td><a style="text-decoration: none;color: #000000;" href="moniter_exam.php?examId=<?php echo $examId;?>"> <?php echo $examlastUpdate; ?></a></td>
                          <td><a style="text-decoration: none;color: #000000;" href="moniter_exam.php?examId=<?php echo $examId;?>"><?php echo $examstatus; ?></a></td>
                            <input type="hidden" <?php echo$examId; ?>/>
                    
                          
                                        </tr>
                </a>
                    
                    
                            <?php
                        }
                    } else {
                        
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </section>
     
<script>
  function submit_id(tableRow) {
        //get ID
        var myID = tableRow.dataset.id;

        //set ID
        var setID       = document.getElementById('order_id');
            setID.value = myID;

        //submit
        var form = document.getElementById('myform');
        form.submit();
    };
  
    
    
    
    
    
 function myFunction(x) {
  
  

    
    var $text = x.rowIndex.find(".nr").text(); // Find the text
    
    // Let's test it out
    alert($text);

}


   function getColumnValue(e){
            //i know here is the object type but would not sure on how to change it
            var colValue = this.dataItem($(e.currentTarget).closest("tr"));
            //for verification purposes
            alert(colValue);
   }
   
    




</script>

    </body>
</html>
