<?php 

session_start();
include './DB_Conn.php';
$examId="";
if (isset($_GET["examId"])) {
  $examId=  $_GET["examId"];

 
}
$userId;
if (isset($_COOKIE["userId"])) {
    $userId = $_COOKIE["userId"];
  
}

  
       $getResultque="SELECT * FROM exam_management_system.`result` WHERE `exam_id`='".$examId."' ";

$resultget = $connection->query($getResultque);
$users=mysqli_num_rows($resultget);

                         $allUserQue = "SELECT * FROM exam_management_system.`user` INNER JOIN exam_management_system.`role` ON exam_management_system.`user`.`role_id`=exam_management_system.`role`.`roleId` WHERE `role`='student'";

$alluser = $connection->query($allUserQue);
$allusers=mysqli_num_rows($alluser);
  
    $examDataQue="SELECT * FROM exam_management_system.`exam` WHERE `examId`='".$examId."'";
    $examDataresult = $connection->query($examDataQue);
if (mysqli_num_rows($examDataresult) > 0) {
     while ($examData = mysqli_fetch_assoc($examDataresult)) {
   $examDate=$examData['date_time'];
   $duration=$examData['duration'];
   
   $dateTime = new DateTime($examDate);
            $date = $dateTime->format("Y-m-d");
            $time = $dateTime->format('H:i:s');
            
            date_default_timezone_set("Asia/Colombo");
              $secs = strtotime($time) - strtotime("00:00:00");
               $currentDate = date("Y-m-d");
                $examEndTime = date("H:i:s", strtotime($duration) + $secs);

              
     }
}
?>



<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Moniter Started Exam</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=League+Gothic&display=swap" rel="stylesheet">

    </head>
    <body>
        <br>
        <a href="teacher_open_view.php" style="color: #000000;" >   <span ><image src="icon/back.png"/>exam name </span></a>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 ">

                    <div style="border-color: #ccccff;border-style: solid;border-width: 2px;">
                        <span class="fw-bold" style="padding-left:  5px;">Exam Completed :</span>  
                        <div class="text-center">
                            <span class=" fw-bold" style="font-family: 'League Gothic', sans-serif;font-size: 5rem;"><?php echo $users."/".$allusers;?></span> 
                            <br>
                            <?php 
                          
                              if ($currentDate === $date) {
                                  ?>
                            <span class="text-center fs-4"id="demo">time</span>
                            <?php
                                  
                              }else if($currentDate > $date){
                                  ?>
                            <span class="text-center fs-4"><?php echo $date;?></span
                                   <?php
                              }
                            
                            
                            
                            ?>
                           
                            <br>
                        </div>

                    </div>
                    <br> 
                    <div style="border-color: #ccccff;border-style: solid;border-width: 2px; padding-bottom:  20px;">
                        <br>
                        <div style="padding-left:  20px;">
                            <span>Exam Started Time :<?php echo $time ;?></span> 
                            <br>
                            <span>Exam Ending Time : <?php echo $examEndTime;?></span> 
                        </div>
                    </div>


                </div>
                <div class="col-12 cpl-sm-12 col-md-6 col-lg-6">
                    <div style="border-color: #ccccff;border-style: solid;border-width: 2px;min-height: 100px;margin-top: 20px; ">
                        <span class="fs-6 fw-bold" style="padding-left: 10px;">Attending Student Details :</span>
<?php 

 $studentque = "SELECT * FROM exam_management_system.`user` INNER JOIN exam_management_system.`result` ON exam_management_system.`user`.`userID`=exam_management_system.`result`.`user_id` WHERE `exam_id`='".$examId."'";

   
    $studentResult = $connection->query($studentque);
if (mysqli_num_rows($studentResult) > 0) {
     while ($studentData = mysqli_fetch_assoc($studentResult)) {
   $name=$studentData['name'];
   $marks=$studentData['marks'];
  
  
?>
                        
                        
                        
                        <div style="padding: 10px 10px 10px 10px;">
                            <div class="col-12" style="border-style: solid;border-color: #99ccff;border-width: 1px;border-radius: 5px;padding: 5px 5px 5px 5px;">
                                <span "><?php echo $name;?></span><span style="color: #00cc33;float: right;font-weight: 700;"><?php echo $marks;?></span>

                            </div>
                        </div>
                        <?php 
     }
}
                        ?>

                       
                    </div>

                </div>

                <div class="container" >
                    <br>
                    <div class="row">
                        <div class="text-end">
                            <a href="teacher_open_view.php" style="color: #ffffff;text-decoration: none;"> <button class="btn btn-danger btn-sm" style="">End Exam</button></a>
                        </div> 
                    </div> 

                </div>
                </div>
                </div>
        <script>
        <?php
$getDate=getdate(date("U"));

?>

// Set the date we're counting down to
var countDownDate = new Date("<?php echo $getDate["month"]." ".$getDate["mday"];?>, <?php echo $getDate["year"]." ". $examEndTime;?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML =  hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
        
        </script>
                </body>
                </html>
