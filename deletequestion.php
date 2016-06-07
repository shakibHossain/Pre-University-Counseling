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
            <h4>Delete Question</h4>
           
            <?php

                $id = $_GET['id'];
                $query1 = mysqli_query($con, "DELETE from `question bank` WHERE `Qid` = $id") or die(mysqli_error($con));
                if ($query1) {
                       echo "The record was successfully deleted";
                       header("location: adminview.php");
                }
                else{
                    echo "An error occured. Try again later.";
                }    
            ?>   
                    
    
        </div>
    </body> 
    
<!--Footer-->
<?php
    include_once('footer.php');
?>

</html> 

                             
                              

                            
 