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
        <h3>Faculty Profile</h3>
        <h3>Harem Ali</h3>
                  
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <?php
                        require 'connect.php';
                    ?>
                    <br> 
                    <p>   
                      <a href=""
                         onclick="window.open('chatServer.php','chat_popup','toolbar=0,menubar=0,scrollbars=1,width=800,height=650'); return false;">
                      start a Consultation
                      </a>
                    </p> 
                     

                    <br>
                    <h4>Current Workplace:</h4>

                    <p> Assistant Professor<br>
                        Department of Electricial and Electronics Engineering<br>
                        IUT, Bangladesh.
                    </p><br>

                    <h4>Bio:</h4>

                    <p> Mr. Harem Ali received his Bachelor degree in Electrical and Electronics Engineering from Khulna University of Engineering and Technology (KUET)  in 2007. In 2009 he received his Masters degree from Bangladesh University of Engineering and Technology (BUET). He has participated in the "eLINK"-project at Corvinus University of Budapest, Hungary, from September 2009 until July 2010 (funded by European Union).  His specialization lies in the fields of  Wireless Sensor Networks, Networked Embedded Systems and Pervasive Computing. He started his PhD studies under the Erasmus Mundus Grant from European Commission working at Klagefurt University, Austria from January 2011 – July 2012, spent a year at University of Genova, Italy and returned to Klagenfurt in July 2013 to continue his work and his dissertation. He obtained his joint doctorate degree in September, 2014. 
                    </p><br>
                    
                    <h4><a name = "Favorite quote"></a>Favorite quote:</h4>

                    <p><em>"First they ignore you. Then they laugh at you.</br> Then they fight you. Then you win."</em></br> - Mahatma Gandhi</p>
                    <br> 
                    <h4><a name = "Useful Links"></a>Useful Links:</h4>

                    <a href= "#">LinkedIn</a> </br>
                    <a href= "#">Twitter</a> </br>
                    <a href= "#">Google Plus</a> </br>
                    <br><br><br>

                    


                </div>
               
            </div>
                        
            
        </div>
    </body>
    
<!--Footer-->
<?php
    include_once('footer.php');
?>

</html> 

                             
                              

                            
 