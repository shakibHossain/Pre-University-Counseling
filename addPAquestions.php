<!DOCTYPE html>
<html lang="en">
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
  <h3>Add PA questions to database: </h3>
  <h5>(where PA = Personal Assesment)</h5>
  <h5>Enter question, answers and corresponding points.</h5>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">

      <?php
        require 'connect.php';
        $department = $questionlevel = $question = '';
        $option1 = $option2 = $option3 = $option4 = $option5 = $option6 = '';
        $point1 = $point2 = $point3 = $point4 = $point5 = $point6 = '';

        if (isset($_POST['submit'])) {
          //echo "Success";
          $department = 0;
          $questionlevel = 0;
          $question = $_POST['question'];
          $option1 = $_POST['option1'];
          $option2 = $_POST['option2'];
          $option3 = $_POST['option3'];
          $option4 = $_POST['option4'];
          $option5 = $_POST['option5'];
          $option6 = $_POST['option6'];
          $point1 = $_POST['point1'];
          $point2 = $_POST['point2'];
          $point3 = $_POST['point3'];
          $point4 = $_POST['point4'];
          $point5 = $_POST['point5'];
          $point6 = $_POST['point6'];

          /*
          echo "Here1 . <br>";
          echo " $department.<br>";
          echo " $questionlevel.<br>";
          echo " $question.<br>";
          echo " $option1.<br>";
          echo " $point1.<br>";
          echo " $option2.<br>";
          echo " $point2.<br>";

          echo " $option3.<br>";
          echo " $point3.<br>";

          echo " $option4.<br>";
          echo " $point4.<br>";
          */


          if(!empty($department) && !empty($questionlevel) && !empty($question) 
              && !empty($option1) && !empty($point1) && !empty($option2) && !empty($point2) 
              && !empty($option3) && !empty($point3) && !empty($option4) && !empty($point4)
              && !empty($option5) && !empty($point5) && !empty($option6) && !empty($point6)){
              //echo "Here2";
              //insert question into question table  
              $query1 = mysqli_query($con, "INSERT INTO `question bank` (`Did`, `question level`, `question`) 
                                            VALUES ($department, $questionlevel, '$question')") or die(mysqli_error($con));
              
              //select that question's id
              $query2 = mysqli_query($con,"SELECT `Qid` FROM `question bank` ORDER BY `Qid` DESC LIMIT 1") or die(mysqli_error($con));
              $result2 = mysqli_fetch_assoc($query2);
              $keepQid = $result2['Qid'];
              //echo "Here4";

              //insert corresponding answers and points into the answer bank
              $query3 = mysqli_query($con, "INSERT INTO `answer bank` (`Qid`, `ans`, `point`) 
                                            VALUES  ($keepQid, '$option1', $point1),
                                                    ($keepQid, '$option2', $point2),
                                                    ($keepQid, '$option3', $point3),
                                                    ($keepQid, '$option4', $point4)
                                                    ($keepQid, '$option5', $point5)
                                                    ($keepQid, '$option6', $point6)")or die(mysqli_error($con));
              if($query3){
                echo "Question was added successfully";
              }
              else{
                echo "Question was not added successfully. Please try again.";
              }




          }
          else{
            echo "You must fill in all the details";
          }
    
    

        }
      ?>


      <form role="form" action ="addPAquestions.php" method="post">
    <div class="form-group">
      <p>
        <label for="comment">Question:</label>
        <textarea class="form-control" rows="3" id="question" name="question"></textarea>
      </p>
      <p>
        <label for="comment">Option-1:</label>
        <textarea class="form-control" rows="1" id="option1" name="option1"></textarea>
        <label for="comment">Point:</label>
        <textarea class="form-control" rows="1" id="point1" name="point1"></textarea>
     
      </p>
      <p>
        <label for="comment">Option-2:</label>
        <textarea class="form-control" rows="1" id="option2" name="option2"></textarea>
        <label for="comment">Point:</label>
        <textarea class="form-control" rows="1" id="point2" name="point2"></textarea>
     
      </p>
      <p>
        <label for="comment">Option-3:</label>
        <textarea class="form-control" rows="1" id="option3" name="option3"></textarea>
        <label for="comment">Point:</label>
        <textarea class="form-control" rows="1" id="point3" name="point3"></textarea>
     
      </p>
      <p>
        <label for="comment">Option-4:</label>
        <textarea class="form-control" rows="1" id="option3" name="option4"></textarea>
        <label for="comment">Point:</label>
        <textarea class="form-control col" rows="1" id="point3" name="point4"></textarea>
     
      </p>
      <p>
        <label for="comment">Option-5:</label>
        <textarea class="form-control" rows="1" id="option5" name="option5"></textarea>
        <label for="comment">Point:</label>
        <textarea class="form-control col" rows="1" id="point5" name="point5"></textarea>
     
      </p>
        <p>
        <label for="comment">Option-6:</label>
        <textarea class="form-control" rows="1" id="option6" name="option6"></textarea>
        <label for="comment">Point:</label>
        <textarea class="form-control col" rows="1" id="point6" name="point6"></textarea>
     
      </p>


    <button id="submit" name="submit" type="submit" class="btn btn-success">Add</button>
    <br><br><br><br>
  

    </div>
    

  </form>

    </div>
  </div>
  
</div>

</body>
<!--Footer-->
<?php
    include_once('footer.php');
?>

</html>
