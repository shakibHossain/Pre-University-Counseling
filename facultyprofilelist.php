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

            <h3>Faculty Profile List:</h3><br><br>
            <h4>For EEE, CSE and Science:</h4>
            <a href= "f.haremali.php">Harem Ali</a> </br>
            <h4>For Pharmacy:</h4>
            <a href= "f.zulfikarali.php">Zulfikar Ali</a> </br>
            <h4>For Architecture & BBS:</h4>
            <a href= "f.zahidulhaque.php">Zahidul Haque</a> </br>
                        
            
        </div>
    </body>
    
<!--Footer-->
<?php
    include_once('footer.php');
?>

</html> 

                             
                              

                            
 