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

                $coursenum = $_POST[coursenum];

                /*  check if starts with cs... then query to check if exists */

                /* Check coursenum format with regex and strlen()    */
                $pattern = "/cs\d{4}/";
                if(preg_match($pattern, $coursenum) && strlen($coursenum)==6){


                    $check = "SELECT * FROM westerncourse WHERE coursenum='$coursenum'";

                    $result = mysqli_query($connection, $check);

                    if (!$result) {
                        die("Query check failed.");
                    }


                    $row = mysqli_fetch_assoc($result);

                    /*  Not in westerncourse - Add  */
                    if (!$row){


                        $addcourse = "INSERT INTO westerncourse VALUES('$coursenum', '$_POST[coursename]', '$_POST[weight]', '$_POST[suffix]')";

                        $insertresult = mysqli_query($connection, $addcourse);

                        echo "$_POST[coursenum] has been added!";


                    }

                    /*  Already exists - Don't Add  */
                    else{
                        echo "This course number already exists";
                    }






                }
                /*  If coursenum wrong format */
                else{
                    echo "Course number '$coursenum' uses incorrect format.";
                    
                }

                echo "<br><br><a href='index.php'><button class='btn'>Back to home</button></a>";
            
                $connection -> close();

            ?>
        
        </div>
    </div>
    
    
    
    
    

    
    
    
    
</body>
</html>