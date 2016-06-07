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
            <h3>Faculty View</h3> <br>
            

            <form action="facultyview.php" method="post">
                Enter Username of student:<br><br>
                <input type="text" name="username"><br><br>
                <button id="submit" name="submit" type="submit" class="btn btn-warning">Search</button><br><br>
                <p>   
                      <a href=""
                         onclick="window.open('chatServer.php','chat_popup','toolbar=0,menubar=0,scrollbars=1,width=800,height=650'); return false;">
                      start a Consultation
                      </a>
                    </p> 
                <h4>Student Answer View</h4>
            </form> 
            <br>
            <?php
                //search username     
                if (isset($_POST['submit'])) {
                    $keepUsername = $_POST['username'];
                    echo "Student - " . $keepUsername . "<br>" . "<br>";
                    if(!empty($keepUsername)){
                        
                        $questionNumber = 1;
                        $query1 = mysqli_query($con, "SELECT `userid` FROM `user information` WHERE `username` = '$keepUsername'");
                        $result1 = mysqli_fetch_assoc($query1);
                        $keepUserid = (int)$result1['userid'];
                        //$keepUserid = 13;

                        //fetch level 1 and level 2 answers of the userid from user answer storage
                        $query2 = mysqli_query($con, "SELECT * FROM `user answer storage` WHERE `Uid` = $keepUserid");
                        while($result2 = mysqli_fetch_array($query2)){ 
                            $keepQid = $result2['Qid'];
                            $keepAid = $result2['Aid'];
                            
                            $query3 = mysqli_query($con, "SELECT `question` FROM `question bank` WHERE `Qid` = $keepQid");
                            $result3 = mysqli_fetch_assoc($query3);  
                            $keepQuestion = $result3['question'];
                            echo $questionNumber. ")" . $keepQuestion . "<br>" . "<br>";
                            $query4 = mysqli_query($con, "SELECT * FROM `answer bank` WHERE `Qid` = $keepQid");
                            while ($result4 = mysqli_fetch_array($query4)) {
                                echo "&nbsp&nbsp&nbsp&nbsp&nbsp" . "-" . $result4['ans'] . " = " .$result4['point']. "<br>";
                            
                            }
                            $query5 = mysqli_query($con, "SELECT `ans` FROM `answer bank` WHERE `Aid` = $keepAid");
                            $result5 = mysqli_fetch_assoc($query5);
                            echo "<br>" . "User answered - " . "&nbsp" . $result5['ans'] . "<br>";
                            $questionNumber++;
                            echo "<br>" . "<br>" . "<br>";
                        
                
                        }
                        //fetch level 0 answers from personal user answer storage    
                        $query6 = mysqli_query($con, "SELECT * FROM `personal user answer storage` WHERE `Uid` = '$keepUserid'");
                        while($result6 = mysqli_fetch_array($query6)){ 
                            $keepQid = (int)$result6['Qid'];
                            $keepAid = (int)$result6['Aid_p'];
                            
                            $query7 = mysqli_query($con, "SELECT `question` FROM `question bank` WHERE `Qid` = $keepQid");
                            $result7 = mysqli_fetch_assoc($query7);  
                            $keepQuestion = $result7['question'];
                            echo $questionNumber. ")" . $keepQuestion . "<br>" . "<br>";
                            //fetch answers from personal answer bank    
                            $query8 = mysqli_query($con, "SELECT * FROM `personal answer bank` WHERE `Qid` = $keepQid");
                            while ($result8 = mysqli_fetch_array($query8)) {
                                echo "&nbsp&nbsp&nbsp&nbsp&nbsp" . "-" . $result8['ans'] . " = " .$result8['point']. "<br>";
                            
                            }
                            $query9 = mysqli_query($con, "SELECT `ans` FROM `personal answer bank` WHERE `Aid_p` = $keepAid");
                            $result9 = mysqli_fetch_assoc($query9);
                            echo "<br>" . "User answered - " . "&nbsp" . $result9['ans'] . "<br>";
                            $questionNumber++;
                            echo "<br>" . "<br>" . "<br>";
                        
                
                        }
                        

             
                        


                    }   
                }
                else{
                    echo "*Enter username";
                }

                  
            ?>

            
            
    
        </div>
    </body> 
    
<!--Footer-->
<?php
   include_once('footer.php');
?>

</html> 

                             
                              

                            
 