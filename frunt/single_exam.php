<?php
session_start();
include './DB_Conn.php';
$examName;
$examId;
$examEndTime;
$questionNo;
$answerNo1="false";
$answerNo2="false";
$answerNo3="false";
$answerNo4="false";


if (isset($_SESSION["examName"])) {
    $examName = $_SESSION["examName"];
}
if (isset($_SESSION["examId"])) {
    $examId = $_SESSION["examId"];
}if (isset($_SESSION["examEndTime"])) {
    $examEndTime = $_SESSION["examEndTime"];
      $getDate=getdate(date("U"));

}

if (isset($_SESSION["questionNo"])) {


        if (isset($_POST["nextquestionNo"])) {
            $_SESSION["questionNo"] = $_POST["nextquestionNo"];
        }

        if (isset($_POST['prequestionNo'])) {

            $_SESSION["questionNo"] = $_POST['prequestionNo'];
        }
        $questionNo = $_SESSION["questionNo"];
    
        
} else {
    $_SESSION["questionNo"] = 1;
    $questionNo = 1;
}

if (isset($_POST['answer'])) {

  //  echo 'answer is  ' . $_POST['answer'];
}

if (isset($_POST['saveAnswer'])) {


    if (isset($_SESSION['answerArray'])) {

        $key = array_search(filter_input(INPUT_POST, 'qustionId'), array_column($_SESSION['answerArray'], 'questionId'));
      

        if ($key === false) {



            $count = count($_SESSION['answerArray']);
            $_SESSION['answerArray'][$count] = array(
                'questionId' => filter_input(INPUT_POST, 'qustionId'),
                'answerId' => filter_input(INPUT_POST, 'answer'),
            );
       
            
           // echo 'save';
        } else {
            $arryQid = $_SESSION['answerArray'][$key]['questionId'];
            $arrayAid = $_SESSION['answerArray'][$key]['answerId'];
           // echo 'aid : ' . $arrayAid;
           // echo 'qid : ' . $arryQid;
            if ($arrayAid === filter_input(INPUT_POST, 'answer')){

              //  echo 'same value';
            } else {

                foreach ($_SESSION['answerArray']as &$value) {
                    if ($value['questionId'] === filter_input(INPUT_POST, 'qustionId')) {
                        $value['answerId'] = filter_input(INPUT_POST, 'answer');
                        break;
                    }
                }
              //  echo 'update';
            }
        }

     //   print_r($_SESSION['answerArray']);
    } else {


        $_SESSION['answerArray'][0] = array(
            'questionId' => filter_input(INPUT_POST, 'qustionId'),
            'answerId' => filter_input(INPUT_POST, 'answer'),
        );
        
       // print_r($_SESSION['answerArray']);
      
    }
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Single Exam</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=League+Gothic&display=swap" rel="stylesheet">

    </head>
    <body>
        <br>
        <a href="teacher_open_view.php" style="color: #000000;text-decoration: none;" >   <span ><image src="icon/back.png"/><?php echo $examName; ?> </span></a>

        <br>
        <div class="row">
            <span class="text-center"><p id="demo" style="font-weight: 700;">0h 0m 00s</p></span>
        </div>
        <br>
        <br>
        <div class="container">

            <div class="row  justify-content-center">
                <div class="col-12 col-sm-12 col-md-8 col-lg-6 ">

<?php
$questionId;

$que = "SELECT * FROM exam_management_system.`quection` WHERE exam_id='" . $examId . "' AND quection_no='" . $questionNo . "' ";

$resultExam = $connection->query($que);

if (mysqli_num_rows($resultExam) > 0) {
    $questioncount = mysqli_num_rows($resultExam);
    while ($examData = mysqli_fetch_assoc($resultExam)) {

        $question = $examData['quection'];

        $questionId = $examData['quction_id'];
        $answer1 = "";
        $answer2 = "";
        $answer3 = "";
        $answer4 = "";
        $answer1Id = "";
        $answer2Id = "";
        $answer3Id = "";
        $answer4Id = "";
        $answerQue = "SELECT * FROM exam_management_system.`answer` WHERE quection_id='" . $questionId . "' ";

        $resultAnswer = $connection->query($answerQue);
        if (mysqli_num_rows($resultAnswer) > 0) {
            while ($answerData = mysqli_fetch_assoc($resultAnswer)) {

                $answerNo = $answerData['answer_No'];
                $answer = $answerData['answer'];

                switch ($answerNo) {
                    case 1:
                        $answer1 = $answerData['answer'];
                        $answer1Id = $answerData['answerId'];
                        break;
                    case 2:
                        $answer2 = $answerData['answer'];
                        $answer2Id = $answerData['answerId'];
                        break;
                    case 3:
                        $answer3 = $answerData['answer'];
                        $answer3Id = $answerData['answerId'];
                        break;

                    case 4:
                        $answer4 = $answerData['answer'];
                        $answer4Id = $answerData['answerId'];
                        break;
                }
            }
        }
        ?>

                            <div class = "  justify-content-center" >
                                <span style="color: #000000;font-weight: 700;"><?php echo $questionNo;
        ?>)<?php echo $question; ?></span>
                                <br><!-- comment -->


                                <div style="border-style: solid;border-color: #99ccff;padding: 25px 25px 25px 25px;border-width: 2px;">
                                    <span>Select Correct Answer :</span>
                                    <div class="text-center">
                                        <?php

    if (isset($_SESSION['answerArray'])) {

        $key = array_search($questionId, array_column($_SESSION['answerArray'], 'questionId'));
      //  echo "key is  : " . $key . "  ";
         $arrayAid = $_SESSION['answerArray'][$key]['answerId'];
         
         if ($arrayAid===$answer1Id) {
            $answerNo1="true";
         }else if($arrayAid===$answer2Id){
               $answerNo2="true";
             
         }else if($arrayAid===$answer3Id){
             
                $answerNo3="true";
         }else if($arrayAid===$answer4Id){
             
              $answerNo4="true";
         }
    }         
                              ?>          
                                        
                                        
                                        <span style="color: #000000;font-weight: 700;">  <input type="radio" name="answer" value="<?php echo $answer1Id; ?>" checked="checked" id="answer1" form="save" /> <?php echo" " . $answer1; ?></span>
                                        <br>
                                        <span style="color: #000000;font-weight: 700;">  <input type="radio" name="answer" value="<?php echo $answer2Id; ?>" checked="checked" id="answer2"  form="save" /> <?php echo" " . $answer2; ?></span>
                                        <br>
                                        <span style="color: #000000;font-weight: 700;">  <input type="radio" name="answer" value="<?php echo $answer3Id; ?>" checked="checked" id="answer3"  form="save" /> <?php echo " " . $answer3; ?></span>
                                        <br>
                                        <span style="color: #000000;font-weight: 700;">  <input type="radio" name="answer" value="<?php echo $answer4Id; ?>" checked="checked" id="answer4"  form="save" /><?php echo " " . $answer4; ?></span>
                                        <br>

                                    </div>

                                </div>
                                <br>

                                <div class="container">

                                    <div class="row  ">

                                        <div class="col-auto me-auto">

        <?php
        if ($questionNo > 1) {
            ?>
                                                <form method="POST" action="single_exam.php">

                                                    <input type="submit" value="prev" class="btn btn-secondary btn-sm"/>
                                                    <input type="hidden" value="<?php echo $questionNo - 1; ?>" name="prequestionNo" class="btn btn-secondary btn-sm"/>
                                                    <input type="hidden" value="<?php echo $questionNo; ?>" name="questionNo" />
                                                </form>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                        <div class=" col-auto me-auto">
                                            <span class="justify-content-center ">Question <?php echo $questionNo; ?></span>


                                        </div>
                                        <div class=" col-auto  ">
        <?php
        $quecount = "SELECT * FROM exam_management_system.`quection` WHERE exam_id='" . $examId . "'";

        $resultcount = $connection->query($quecount);
        $questioncount = mysqli_num_rows($resultcount);

        if ($questionNo < $questioncount) {
            ?>

                                                <form method="POST" action="single_exam.php" >
                                                    <input type="submit" value="Next" name="next" class="btn btn-secondary btn-sm float-end" />

                                                    <input type="hidden" value="<?php echo $questionNo + 1; ?>" name="nextquestionNo"  />
                                                    <input type="hidden" value="<?php echo $questionNo; ?>" name="questionNo" />
                                                    <input type="hidden" value="<?php echo $questioncount; ?>" name="questionCount" />
                                                </form>
            <?php
        }
        ?>



                                        </div>

                                    </div>

        <?php
    }
}
?>  
                        </div>


                    </div>


                </div>
            </div>
            <br>
            <br>
            <div class="row ">
                <div class=" text-end">
                    <form method="POST" id="save">
                        <input type="submit" name="saveAnswer" value="Save"class="btn btn-success btn-sm"/>
                        <input type="hidden" name="qustionId" value="<?php echo $questionId; ?>"/>

                    </form>
                    <form method="POST" action="actions/publish_paper_action.php">
                    <input type="submit" name="complete" value="Complete" class="btn btn-primary btn-sm"/>
                    </form>
                </div>
            </div>



        </div>  

    </div>
<?php
$radio = true;
?>
    <script>
        const a1btn = document.getElementById('answer1');
        const a2btn = document.getElementById('answer2');
        const a3btn = document.getElementById('answer3');
        const a4btn = document.getElementById('answer4');
        a1btn.checked = <?php echo $answerNo1;?>;
        a2btn.checked = <?php echo $answerNo2;?>;
        a3btn.checked = <?php echo $answerNo3;?>;
        a4btn.checked = <?php echo $answerNo4;?>;

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
