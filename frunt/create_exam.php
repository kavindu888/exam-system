<?php
session_start();
include './DB_Conn.php';

if (isset($_POST['question'])) {
    if ($_POST['question'] === "") {
        header("Location:create_exam.php?msg=No Quction Added.Can't create Question !!!");
        die();
    }
}

if (isset($_POST['answer1'])) {
    if ($_POST['answer1'] === "") {
        header("Location:create_exam.php?msg=No Answer 1 Added.Can't create Question !!!");
        die();
    }
}

if (isset($_POST['answer2'])) {
    if ($_POST['answer2'] === "") {
        header("Location:create_exam.php?msg=No Answer 2 Added.Can't create Question !!!");
        die();
    }
}

if (isset($_POST['answer3'])) {
    if ($_POST['answer3'] === "") {
        header("Location:create_exam.php?msg=No Answer 3 Added.Can't create Question !!!");
        die();
    }
}

if (isset($_POST['answer4'])) {
    if ($_POST['answer4'] === "") {
        header("Location:create_exam.php?msg=No Answer 4 Added.Can't create Question !!!");
        die();
    }
}
$examNameForInput = "";
if (isset($_POST['examName'])) {


    if (isset($_SESSION['examName'])) {



        if ($_POST['examName'] === $_SESSION['examName']) {


            $examNameForInput = $_SESSION['examName'];
        } else {

            if ($_POST['examName'] === "") {
                
            } else {
                $_SESSION['examName'] = $_POST['examName'];
                $examNameForInput = $_SESSION['examName'];
            }
        }
        $examNameForInput = $_SESSION['examName'];
    } else {

        $_SESSION['examName'] = $_POST['examName'];
        $examNameForInput = $_SESSION['examName'];
    }
}
$date = "";
if (isset($_POST['date'])) {
    if (isset($_SESSION['date'])) {
        $date = $_SESSION['date'];
    
    } else {

        $_SESSION['date'] = $_POST['date'];
        $date = $_SESSION['date'];
       
    }
}
$duration = "00:00:00";
if (isset($_POST['duration'])) {
    if (isset($_SESSION['duration'])) {
        $duration = $_SESSION['duration'];
    } else {

        $_SESSION['duration'] = $_POST['duration'];
        $duration = $_SESSION['duration'];
    }
}




if (filter_input(INPUT_POST, 'save_qu')) {


    if (isset($_SESSION['quctionArray'])) {
        $quctionNo = $_SESSION['quctionNo'] + 1;
        $count = count($_SESSION['quctionArray']);

        $_SESSION['quctionArray'][$count] = array(
            'question' => filter_input(INPUT_POST, 'question'),
            'answer1' => filter_input(INPUT_POST, 'answer1'),
            'answer2' => filter_input(INPUT_POST, 'answer2'),
            'answer3' => filter_input(INPUT_POST, 'answer3'),
            'answer4' => filter_input(INPUT_POST, 'answer4'),
            'answer' => filter_input(INPUT_POST, 'answer'),
            'quctionNo' => $quctionNo
        );

        $_SESSION['quctionNo'] = $quctionNo;
        //  print_r($_SESSION['quctionArray']);
    } else {
        $_SESSION['quctionNo'] = 1;

        $_SESSION['quctionArray'][0] = array(
            'question' => filter_input(INPUT_POST, 'question'),
            'answer1' => filter_input(INPUT_POST, 'answer1'),
            'answer2' => filter_input(INPUT_POST, 'answer2'),
            'answer3' => filter_input(INPUT_POST, 'answer3'),
            'answer4' => filter_input(INPUT_POST, 'answer4'),
            'answer' => filter_input(INPUT_POST, 'answer'),
            'quctionNo' => $_SESSION['quctionNo']
        );

        if ((isset($_SESSION['quctionArray']))) {
            //  echo $_SESSION['quctionArray'] ;
            // print_r($_SESSION['quctionArray']);
        }
    }
}
?>



<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Exams</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css"/>

    </head>
    <body>
        <br>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6" >
                    <a href="teacher_open_view.php" style="color: #000000;text-decoration: none;" >   <span  ><image src="icon/back.png"/>Exam View </span></a>
                    <br>
                    <br><!-- comment -->





                    <input class="form-control me-2" type="search" placeholder="Enter Exam Name"  name="examName" value="<?php echo $examNameForInput; ?>"  form="save"/>

                    <br>



                    <br>
                    <br>
                    <fieldset >
                        <div class="container-fluid d-inline"  >

                            <span>Question List</span>

                            <Button class="btn btn-danger float-end "  id="quction" onclick="enable()">New Quction</button>            

                        </div>
                        <br>

                        <br>

                        <div class="row" >

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered  ">
                                    <thead style="background-color: #b3ffff;text-align: center;">
                                        <tr>

                                            <th scope="col">Question</th>
                                            <th scope="col">Answers</th>

                                        </tr>
                                    </thead>
                                    <tbody >
                                        <?php
                                        if (!empty($_SESSION['quctionArray'])) {



                                            foreach ($_SESSION['quctionArray'] as $key => $qunction) {
                                                ?>

                                                <tr>

                                                    <td style="text-align: center;"><?php echo $qunction['quctionNo'] . ")" . $qunction['question']; ?></td>
                                                    <td style=""><?php echo "1." . "" . $qunction['answer1']; ?>
                                                        <br>
                                                        <?php echo"2." . "" . $qunction['answer2']; ?>
                                                        <br>
                                                        <?php echo"3." . "" . $qunction['answer3']; ?>
                                                        <br>
                                                        <?php echo"4." . "" . $qunction['answer4']; ?> 
                                                        <br>




                                                    </td>

                                                    <?php
                                                }
                                            }
                                            ?>




                                        </tr>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row align-items-start"
                         <div class=" col-sm-12 col-md-8 col-lg-6 " >

                        <div class="  justify-content-center text-center  " >
                            <div class="row" >
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6" style="padding: 5px 5px 5px 5px;">
                                    <input type="datetime-local"  name="date" value="<?php echo $date; ?>" form="save" placeholder="Exam Date Time" style="width: 200px;border-width: 1px;border-radius: 5px;border-color: #0a53be; " /></div>
                                <div class="col-sm-6 col-md-6 col-lg-6" style="padding : 5px 5px 5px 5px;">       
                                    <input type="text" name="duration" value="<?php echo $duration;?>" class="html-duration-picker"     style="width: 200px;border-width: 1px;border-radius: 5px;border-color: #0a53be;" form="save"/></div>




                            </div>


                        </div>

                    </div>
                    <br>

                    <div class="row align-items-start"
                         <div class=" col-sm-12 col-md-8 col-lg-6 " >

                        <div class="  justify-content-center text-center  " >



                            <div class=" justify-content-center text-center ">
                                <div style="padding: 5px 5px 10px 5px;">
                                    <form method="GET" action="actions/publish_action.php">
                                        <input type="submit" name="paper" value="Publish Paper" class="btn btn-primary btn-sm " />
                                    </form>


                                </div>
                            </div>

                        </div>
                    </div>

                </div>



                <div class=" col-sm-12 col-md-12 col-lg-6 " >
                    <fieldset disabled id="enable">
                        <?php
                        if (!empty($_REQUEST['msg'])) {
                            $color = "#ff0000";
                            ?>
                            <p style="color: #ff0000;"><?php echo sprintf($_REQUEST['msg']); ?></p>

                        <?php } ?>
                        <form method="POST" action="create_exam.php?action=add" id="save"  >
                            <div style="border-style: solid;border-color: #ccccff;" >

                                <div style="padding: 10px 10px 10px 10px;">
                                    <br>
                                    <span>Question :</span>

                                    <br>
                                    <input type="text" name="question" placeholder="Question " class="form-control"  />
                                    <br><br>
                                    <span>Answers :</span>
                                    <input type="text" name="answer1" placeholder="Answer 01" class="form-control"/>
                                    <br>
                                    <input type="text" name="answer2" placeholder="Answer 02" class="form-control"/>
                                    <br>
                                    <input type="text" name="answer3" placeholder="Answer 03" class="form-control"/>
                                    <br>
                                    <input type="text" name="answer4" placeholder="Answer 04" class="form-control"/>
                                    <br>


                                    <span>Select Correct Answer :</span>
                                    <div class="text-center">
                                        <span>  <input type="radio" name="answer" value="01" checked="checked" /> Answer 01</span>
                                        <br>
                                        <span>  <input type="radio" name="answer" value="02" checked="checked" /> Answer 02</span>
                                        <br>
                                        <span>  <input type="radio" name="answer" value="03" checked="checked" /> Answer 03</span>
                                        <br>
                                        <span>  <input type="radio" name="answer" value="04" checked="checked" /> Answer 04</span>
                                        <br>
                                    </div>
                                </div>
                                <div class="text-end" style="padding-right:   20px;padding-bottom: 20px;">
                                    <input type="submit" name="save_qu" value="Save" class="btn btn-success btn-sm" style="width: 100px;  "/>

                                </div>

                            </div>
                        </form>

                    </fieldset>
                </div>


            </div>
        </div>








        <script src="https://cdn.jsdelivr.net/npm/html-duration-picker@latest/dist/html-duration-picker.min.js"></script>
        <script>


                                function enable() {
                                    document.getElementById("enable").disabled = false;
                                }
        </script>
    </body>
</html>
