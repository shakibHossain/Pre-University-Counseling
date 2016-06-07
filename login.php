<!DOCTYPE html>

<?php
    session_start();
?>

<html>
    <head>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">

        <meta charset="UTF-8">
        <title>CSE470 Project</title>
        <!--Header-->
        <?php
            include_once('header.php');
        ?>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">

                    <?php
                        
                        $_SESSION["login_status"] = false;
                        if (isset($_POST['name']) && isset($_POST['pass'])) {
                            require 'connect.php';
                           $_SESSION["login_status"] = false;
                            $name = $_POST['name'];
                            $_SESSION["name"] = $name;
                             
                            
                            $pass = $_POST['pass'];
                            $pass_hash = md5($pass);

                            if (!empty($name) && !empty($pass)) {
                                $sql = "SELECT `userid`, `user level` FROM `user information` WHERE `username` = '$name' AND `password` = '$pass_hash'";
                                $query = mysqli_query($con, $sql);
                                $result = mysqli_fetch_assoc($query);
                                $_SESSION["userid"] = $result['userid']; //user id from database
                                $keepUserLevel = $result['user level'];    
                                if ($query){


                                    $query_num_rows = mysqli_num_rows($query);

                                    if ($query_num_rows == 0) {
                                        echo "Invalid username/password combination";
                                        session_unset();
                                    } 
                                    else if ($query_num_rows > 0) {
                                       // echo 'Logged in </br> <a href="taketest.php.php">Start Test.</a>';
                                        $_SESSION["login_status"] = true;
                                      // echo $_SESSION["name"];
                                      // echo $user_id = mysqli_store_result($con);
                                        if($keepUserLevel == 0){
                                            header("location: adminview.php"); //admin view     
                                        }
                                        else if($keepUserLevel == 1){
                                            header("location: taketest.php"); //student view     
                                        }
                                        else if($keepUserLevel == 2){
                                            header("location: facultyview.php"); //faculty view     
                                        }
                                        
                                    }
                                }
                            }
                         
                            else {
                                echo 'You must enter a username and a password';
                            }

                            mysqli_close($con);
                        }

                        elseif ($_SESSION["login_status"]) {
                           // echo 'already logged in. Go to <a href="check.p.php">Search</a>';
                           // include_once('taketest.php'); // From here goes to taketest.php page when test related information is shown.
                        }
 
                    

                    ?>

                    <!--Login form. Input data from here is processed in the above code block-->              
                    <h2>Login :</h2>    
                    <form role="form" action ="login.php" method="post">
                        <div class="form-group">
                            <label for="name">Username:</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="pass">Password:</label>
                            <input type="password" class="form-control" id="pass" name="pass">
                        </div>

                        <button type="submit" class="btn btn-danger">Log in</button>
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