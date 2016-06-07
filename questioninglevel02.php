<!DOCTYPE html>
<html>
    <head>
        <title>CSE470 Project</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
<!--Header-->
<?php
    include_once('headerwhenloggedin.php');
?>
    </head>

    <body>
        <div class="container">
            <?php
            require 'connect.php';
            ?> 
            <h3>Know your interest in subject to be studied in university level with our question-answering session.</h3>
            <h3>Questioning Level - 2</h3> <?php 
            echo "<br>";
            //shows questions for level 2
            $questionNumber = 1;
            $sql = "SELECT `question`, `Qid` FROM `question bank` WHERE `question level` = 2";
            $query1 = mysqli_query($con, $sql);
            while ($result = mysqli_fetch_array($query1)) {
                $keepQid = $result['Qid'];
                echo $questionNumber . ". " . $result['question'] . "<br>";
                $query2 = mysqli_query($con, "SELECT `ans`, `Aid` FROM `answer bank` WHERE `Qid` = $keepQid");
                ?> 
                <form action="result.php" method="post"> <?php
                while ($result2 = mysqli_fetch_array($query2)) {
                    ?>
                    <input type="radio" name="question<?php echo $questionNumber ?>" value="<?php echo $result2['Aid']; ?>"> <?php
                    echo $result2['ans'];
                    echo'<br>';
                }
                echo "<br>";
                $questionNumber++;
            }
            ?> <input type="submit" name="submit3">
            <br><br><br><br>

            <?php

            //check answers for level 1
            if (isset($_POST['submit2'])) {

                $values1 = $_POST; 
                foreach ($values1 as $value) {
                    // echo $value;
                    $keepValue = $value;
                    //selecting corresponding question of the selected radio button
                    $query3 = mysqli_query($con, "SELECT `Qid` FROM `answer bank` WHERE Aid = $value")or die(mysqli_error($con));
                    $result3 = mysqli_fetch_assoc($query3);
                    // echo $result3;
                    $keepQid1 = (int) $result3['Qid'];
                    // echo $keepQid1;
                    $keepUserid = $_SESSION["userid"]; //user id from current session

                    //storing user answer in user answer storage
                    $query4 = mysqli_query($con, "INSERT INTO `user answer storage`(`Qid`, `Uid`, `Aid`) VALUES ($keepQid1, $keepUserid, $keepValue)")or die(mysqli_error($con));
                    
                    //selecting corresponding dept of the question
                    $query5 = mysqli_query($con, "SELECT `Did` FROM `question bank` WHERE Qid = $keepQid1")or die(mysqli_error($con));
                    $result5 = mysqli_fetch_assoc($query5);
                    $keepDid = (int) $result5['Did'];
                    // echo $keepDid;

                    //checking if the corresponding dept and userid exist or not
                    $query6 = mysqli_query($con, "SELECT * FROM `points table` WHERE Did = $keepDid AND `Uid` = $keepUserid")or die(mysqli_error($con));
                    $rowcount = mysqli_num_rows($query6);
                    //echo $rowcount;

                    //select submission id to insert into points table
                    $query7 = mysqli_query($con, "SELECT `Sid` FROM `user answer storage` ORDER BY Sid DESC LIMIT 1")or die(mysqli_error($con));
                    $result7 = mysqli_fetch_assoc($query7);
                    $keepSid = (int) $result7['Sid'];

                    //checking if row exits of that dept
                    if ($rowcount == 0) {
                        // echo 'Here';
                        //inserting new dept row as it does not exist for that particular user
                        $query8 = mysqli_query($con, "INSERT INTO `points table`(`Sid`, `Did`, `Uid`, `points`) VALUES ($keepSid, $keepDid, $keepUserid, 0)")or die(mysqli_error($con));
                    }
                    //select previous point
                    $query9 = mysqli_query($con, "SELECT `points` FROM `points table` WHERE `Did` = $keepDid AND `Uid` = $keepUserid");
                    $result9 = mysqli_fetch_assoc($query9);
                    $keepPreviousPoint = $result9['points'];
                    //echo $keepPreviousPoint;
                    
                     //selecting new point of the answer which was selected by the user from personal answer bank 
                    $query10 = mysqli_query($con, "SELECT `point` FROM `answer bank` WHERE `Aid` = $keepValue");
                    $result10 = mysqli_fetch_assoc($query10);
                    $keepNewPoint = $result10['point'];
                    //echo $keepNewPoint + "";
                    $sum = $keepPreviousPoint + $keepNewPoint;
                    //echo $sum;
                    
                    //final update of points table using the given answers
                    $query11 = mysqli_query($con, "UPDATE `points table` SET `Sid`= $keepSid,`Did`=$keepDid,`points`= $sum WHERE `Did` = $keepDid AND `Uid` = $keepUserid");
                }
            }
            ?>

                </form>
    


        </div>
    </body>

<!--Footer-->
<?php
    include_once('footer.php');
?>

</html> 





