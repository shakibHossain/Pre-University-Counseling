<!DOCTYPE html>
<html lang="en">
<!--Header-->
<?php
    include_once('header.php');
?>
<html>
    <head>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">

        <meta charset="UTF-8">
        <title>CSE470 Project</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <?php
                        
                        session_start();
                    


                    
                    $name = $pass = $pass_hash = $email = $optradio = ""; 
                    $nameErr = $passErr = $emailErr = $optradioErr =  "";




                    if (isset($_POST["submit"])){
                        
                        if (empty($_POST['name'])) {
                            $nameErr = "*Name is required";
                        } 
                        else {
                            $name = test_input($_POST['name']);
                            // check if name only contains letters and whitespace
                            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                                $nameErr = "Only letters and white space allowed";
                            }
                        }


                        if (empty($_POST['pass'])) {
                            $passErr = "*Password is required";
                        } 
                        else {
                            //$pass = test_input($_POST["pass"]);
                            $pass = $_POST['pass'];
                            $pass_hash = md5($pass);
                        }

                        if (empty($_POST['email'])) {
                            $emailErr = "*Email is required";
                        } else {
                            $email = test_input($_POST['email']);
                            // check if name only contains letters and whitespace
                            //    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                            //      $nameErr = "Only letters and white space allowed";
                            //  }
                        }


                        if(empty($_POST['optradio'])){
                            $optradioErr = "*One of the options must be selected"; 
                        }
                        else{
                            $optradio = $_POST['optradio'];
                        }




                        require 'connect.php';

                        if ($name == '' or $pass == '' or $email == '' or $optradio == '') {
                            echo "Please fill in all the details.";
                        } 
                        else {
                            echo "Here";
                            echo $optradio;
                            $query = mysqli_query($con, "INSERT INTO `user information` (`user level`, `username`, `password`, `email`) VALUES ($optradio, '$name', '$pass_hash', '$email')");

                            if ($query) {
                                echo "Registration Completed.";
                                header('Location: login.php');
                                

                            } 
                            else {
                                echo "Cannot register at the moment.";
                            }
                        }





                        mysqli_close($con);
                    }

                    function test_input($data) {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }
                    ?>






                    <h2>User Registration :</h2>    
                    <form role="form" action ="register.php" method="post">
                        <div class="form-group">
                            <label for="name">Username :</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <span class = "error"> <?php echo $nameErr; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <span class = "error"> <?php echo $emailErr; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="pass">Password :</label>
                            <input type="password" class="form-control" id="pass" name="pass">
                            <span class = "error"> <?php echo $passErr; ?></span>
                        </div>
                        <p>Register as :</p>
                        <div class="radio">
                            <label><input type="radio" name="optradio" value="1">Student</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio" value="2">Faculty</label>
                        </div>
                        <span class = "error"> <?php echo $optradioErr; ?></span>
                        <br><br>
                        <button id="submit" name="submit" type="submit" class="btn btn-primary">Register</button>





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