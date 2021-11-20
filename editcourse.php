<!DOCTYPE html>
<html>
    
<head>
	<title>CS3319 Asn3</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
    
<body>
    
    <nav class="navbar navbar-expand-lg">
        
        <a class="navbar-brand" href="index.php">CS3319 Assignment 3</a>

        <a class="nav-item nav-link" href="index.php#courselist">Course List</a>
        <a class="nav-item nav-link" href="index.php#addcourse">Add Course</a>
        <a class="nav-item nav-link" href="index.php#unidetails">University Details</a>
        <a class="nav-item nav-link" href="index.php#unibyprov">Universities By Province</a>
        <a class="nav-item nav-link" href="index.php#coursedetails">Course Details</a>
        <a class="nav-item nav-link" href="index.php#equivbydate">Equivalencies By Date</a>
        <a class="nav-item nav-link" href="index.php#createequiv">Add Equivalency</a>
        <a class="nav-item nav-link" href="index.php#moreuni">More Universities</a>

        
    </nav>
    <div class="space"></div>
    
    
    <div class="container">
    
        <div class="section">
        
            <?php
    
                include "connecttodb.php";

                $num = $_POST[num];

                echo "

                    <h1>Edit Course: ".$num."</h1><br>


                    <form action='editcourse.php' method='POST'>

                        <label>Course Name:</label>
                        <br>
                        <input name='changename'><br><br>

                        <label>Weight:</label>
                        <br>
                        <input name='changeweight'><br><br>

                        <label>Suffix:</label>
                        <br>
                        <input name='changesuffix'><br><br>
                        <input type='hidden' name='number' value='".$num."'><br><br>

                        <input type='submit' value='Save Changes' class='btn'>

                    </form>

                ";


                /*  On Form Submission  */

                $updatename = "UPDATE westerncourse SET coursename= '$_POST[changename]' WHERE coursenum='$_POST[number]'";
                $updateweight = "UPDATE westerncourse SET weight= '$_POST[changeweight]' WHERE coursenum='$_POST[number]'";
                $updatesuffix = "UPDATE westerncourse SET suffix= '$_POST[changesuffix]' WHERE coursenum='$_POST[number]'";
            
                echo"<br>";

                /*  Checking if no input    */
                if($_POST[changename]){
                    mysqli_query($connection, $updatename);
                    echo"Name Update Successful! <br>";
                }else{
                    echo "No Name update. <br>";
                }

                if($_POST[changeweight]){
                    mysqli_query($connection, $updateweight);
                    echo"Weight Update Successful! <br>";
                }else{
                    echo "No Weight update. <br>";
                }

                if($_POST[changesuffix]){
                    mysqli_query($connection, $updatesuffix);
                    echo"Suffix Update Successful! <br>";
                }else{
                    echo "No Suffix update. <br>";
                }

                $connection -> close();
            ?>
            
            <br>
            <a href='index.php'><button class="btn">Back to home</button></a>
            
        </div>
    
    </div>
    
    
    
    


    
    
    
</body>
</html>