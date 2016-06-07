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
            //show questions for level 1
            require 'connect.php';
            ?> 
            <h3>Know your interest in subject to be studied in university level with our question-answering session.</h3>
            <h3>Questioning Level - 1</h3> <?php
            echo "<br>";
            $questionNumber = 1;
            $sql = "SELECT `question`, `Qid` FROM `question bank` WHERE `question level` = 1";
            $query1 = mysqli_query($con, $sql);
            while ($result = mysqli_fetch_array($query1)) {
                $keepQid = $result['Qid'];?>
                <?php
                echo $questionNumber . ". " . $result['question'] . "<br>";
                $query2 = mysqli_query($con, "SELECT `ans`, `Aid` FROM `answer bank` WHERE `Qid` = $keepQid");
                ?> 
                <form action="questioninglevel02.php" method="post"> <?php
                while ($result2 = mysqli_fetch_array($query2)) {
                    ?>
                    <input type="radio" name="question<?php echo $questionNumber ?>" value="<?php echo $result2['Aid']; ?>"> <?php echo $result2['ans']; echo'<br>';
                    }
                echo "<br>";        
                $questionNumber++;
            }
            ?>
             
            <input type="submit" name="submit2">
            <br><br><br><br>
                </form>
    
            <!--check answers for level 0 -->
            <?php
            if (isset($_POST['submit1'])) {
                $values1 = $_POST; //the value of the radio button, i don't know what to put here
                foreach ($values1 as $value) {
                   // echo $value;
                    $keepValue = $value;

                    //Corresponding question and department of the selected answer of radio button
                    $query3 = mysqli_query($con, "SELECT `Qid`, `Did` FROM `personal answer bank` WHERE Aid_p = $value")or die(mysqli_error($con));
                    $result3 = mysqli_fetch_assoc($query3);
                    // echo $result3;
                    $keepQid1 = (int) $result3['Qid'];
                    $keepDid = (int) $result3['Did'];
                    // echo $keepQid1;
                    $keepUserid = $_SESSION["userid"]; //user id from current session

                    //Storing user answer in personal user answer storage table
                    $query4 = mysqli_query($con, "INSERT INTO `personal user answer storage`(`Qid`, `Uid`, `Aid_p`) VALUES ($keepQid1, $keepUserid, $keepValue)")or die(mysqli_error($con));


                    //checking if the corresponding dept and userid exist or not
                    $query6 = mysqli_query($con, "SELECT * FROM `points table` WHERE `Did` = $keepDid AND `Uid` = $keepUserid")or die(mysqli_error($con));
                    $rowcount = mysqli_num_rows($query6);
                    //   echo $rowcount;
                    //submission id from user answer storage
                    $query7 = mysqli_query($con, "SELECT `Sid_p` FROM `personal user answer storage` ORDER BY Sid_p DESC LIMIT 1")or die(mysqli_error($con));
                    $result7 = mysqli_fetch_assoc($query7);
                    $keepSid = (int) $result7['Sid_p'];


                    if ($rowcount == 0) {
                        // echo 'Here';
                        //inserting new dept row as it does not exist
                        $query8 = mysqli_query($con, "INSERT INTO `points table`(`Sid`, `Did`, `Uid`, `points`) VALUES ($keepSid, $keepDid, $keepUserid, 0)")or die(mysqli_error($con));
                    }

                    //selecting previous points from points table
                    $query9 = mysqli_query($con, "SELECT `points` FROM `points table` WHERE `Did` = $keepDid AND `Uid` = $keepUserid");
                    $result9 = mysqli_fetch_assoc($query9);
                    $keepPreviousPoint = $result9['points'];
                    //echo $keepPreviousPoint;

                    //selecting new point of the answer which was selected by the user from personal answer bank 
                    $query10 = mysqli_query($con, "SELECT `point` FROM `personal answer bank` WHERE `Aid_p` = $keepValue");
                    $result10 = mysqli_fetch_assoc($query10);
                    $keepNewPoint = $result10['point'];
                    //echo $keepNewPoint + "";
                    $sum = $keepPreviousPoint + $keepNewPoint;
                    //echo $sum;

                    //final update of points table using the given answers
                    $query11 = mysqli_query($con, "UPDATE `points table` SET `Sid`= $keepSid, `Did`=$keepDid, `points`= $sum WHERE `Did` = $keepDid AND `Uid` = $keepUserid");
                }
            }

            ?>

        </div>
    </body>
<!--Footer-->
<?php
    include_once('footer.php');
?>

</html> 





