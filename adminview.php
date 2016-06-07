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
            <h3>Admin View</h3> 
            <h5>Question-answer view, Add/Delete/Edit Question-Answer</h5>
            <!-- <label for="pass">Personal Assessment questions:</label> -->
            <a href="addPAquestions.php" class="btn btn-success" role="button">Add PA questions</a>
            
           <!-- <label for="pass">Subject Related questions:</label> -->
            <a href="addSRquestions.php" class="btn btn-success" role="button">Add SR questions</a>
            
            <br><br>

            <?php

                $keepCount = 1;
                $questionNumber = 1;

                //view subject related questions from level 1 and 2
                while ( $keepCount <= 6) {
                    $answerNumber = 1;
                    $query1 = mysqli_query($con, "SELECT `question`, `Qid` FROM `question bank` WHERE `Did` = $keepCount");
                    $query2 = mysqli_query($con, "SELECT `Dname` FROM `department` WHERE `Did` = $keepCount");
                    $result2 = mysqli_fetch_assoc($query2);  
                    $keepDname = $result2['Dname'];
                    echo "<br>" . $keepDname . "-" . "<br>" . "<br>";
                    while($result1 = mysqli_fetch_array($query1)){ 
                        $keepQid = $result1['Qid'];
                        echo $questionNumber . ") " .$result1['question'] . "<br>" . "<br>";
                        $query3 = mysqli_query($con, "SELECT `ans`, `Aid`, `point` FROM `answer bank` WHERE `Qid` = $keepQid"); 
                        while($result3 = mysqli_fetch_array($query3)){ 
                            echo "&nbsp&nbsp&nbsp&nbsp"  . $answerNumber . ". " .$result3['ans'] . " = " . $result3['point'] . "<br>";
                            $answerNumber++;    
                        
                        }
                        $answerNumber = 1;
                        $questionNumber++;
                        ?>  <br>
                            <a href="deletequestion.php?id=<?php echo $result1['Qid'];?>" class="btn btn-danger" role="button">Delete</a> 
                            <a href="#" class="btn btn-primary" role="button">Edit</a> 
                            <br><br>
                        <?php
                        echo "<br>";
                        
                        
                    }

                    $keepCount++;
                }

                //view personal assessment questions from level 0   
                $query4 = mysqli_query($con, "SELECT `question`, `Qid` FROM `question bank` WHERE `Did` = 0");
                $query5 = mysqli_query($con, "SELECT `Dname` FROM `department` WHERE `Did` = 0");
                $result5 = mysqli_fetch_assoc($query5);  
                $keepDname = $result5['Dname'];
                echo "<br>" . $keepDname . "-" . "<br>" . "<br>";
                while($result4 = mysqli_fetch_array($query4)){ 
                    $keepQid = $result4['Qid'];
                    echo $questionNumber . ") " .$result4['question'] . "<br>" . "<br>";
                    $query6 = mysqli_query($con, "SELECT `ans`, `Aid_p`, `point` FROM `personal answer bank` WHERE `Qid` = $keepQid"); 
                    while($result6 = mysqli_fetch_array($query6)){ 
                        echo "&nbsp&nbsp&nbsp&nbsp"  . $answerNumber . ". " .$result6['ans'] . " = " . $result6['point'] . "<br>";
                        $answerNumber++;    
                    
                    }
                    $answerNumber = 1;
                    $questionNumber++;
                    ?>  <br>
                        <a href="deletequestion.php?id=<?php echo $result1['Qid'];?>" class="btn btn-danger" role="button">Delete</a> 
                        <a href="#" class="btn btn-primary" role="button">Edit</a> 
                        <br><br>
                    <?php
                    echo "<br>";
                    
                    
                }

            ?>   
                    
    
        </div>
    </body> 
    
<!--Footer-->
<?php
    include_once('footer.php');
?>

</html> 

                             
                              

                            
 