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
            <?php
            	$keepUserid=$_SESSION["userid"];
 		$query0=mysqli_query($con, "Select * FROM `points table` WHERE `Uid`=$keepUserid");
 		$rowcount = mysqli_num_rows($query0);
 		//Check if the User has already submitted another response
		if( $rowcount==0 ){
		 
		   //if not then continue
		 
		} else {
			//Redirect to result.php page as the user has a past response
		 	Header("Location: result.php");
		   //Header("Location: <!-- m --><span class="postlink">http://www.google.com</span><!-- m -->");
		 
		}
 
	    ?> 
            <h3>Know your interest in subject to be studied in university level with our question-answering session.</h3> 
            <h3>Questioning Level - 0</h3> <br><br>
            <!-- Shows level o questions-->
            <?php
                $questionNumber = 1;
                $sql="SELECT `question`, `Qid` FROM `question bank` WHERE `question level` = 0"; 
                $query1 = mysqli_query($con, $sql);
                while($result = mysqli_fetch_array($query1)){ 
                    $keepQid = $result['Qid']; ?> 
                    <?php echo $questionNumber . ". " .$result['question'] . "<br>";
                    $query2 = mysqli_query($con, "SELECT `ans`, `Aid_p` FROM `personal answer bank` WHERE `Qid` = $keepQid"); 
                    ?> 
                    <form action="questioninglevel01.php" method="post"> <?php
                    while($result2 = mysqli_fetch_array($query2)){ 
                                  
                        ?>
                        <input type="radio" name="question<?php echo $questionNumber ?>" value="<?php echo $result2['Aid_p']; ?>"> <?php echo $result2['ans']; echo'<br>';
                    
                    }
                    echo "<br>";           
                    $questionNumber++;
                }
            
                    ?> <br>  
                    <input type="submit" name="submit1"> 
                    <br><br><br><br>
                    </form>
    
        </div>
    </body>
    
<!--Footer-->
<?php
    include_once('footer.php');
?>

</html> 

                             
                              

                            
 