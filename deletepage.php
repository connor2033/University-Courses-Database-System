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
        
            
            <h1>Delete Course<br></h1>
    

            <?php

                include "connecttodb.php";

                $query = "SELECT westerncourse FROM equivalent WHERE westerncourse= '$_POST[course]'";

                $result = mysqli_query($connection, $query);

                if (!$result) {
                    die("Query failed.");
                }




                $row = mysqli_fetch_assoc($result);

                /*  Not in equivalent - Delete  */
                if (!$row){

                    $del = "DELETE FROM westerncourse WHERE coursenum = '$_POST[course]'";
                    $delresult = mysqli_query($connection, $del);

                    if (!$delresult) {
                        die("Delete failed.");
                    }else{
                        echo "<br><h2>$_POST[course] has been deleted! <h2><br>";
                    }


                }

                /*  In equivalent - Warn and delete button  */
                else{
                    echo"
                    <br><h2> [Warning: $_POST[course] has equivalent courses]<h2><br>
                    <h3>Are you sure your want to delete this course?<h3>
                    <form action='deletecourse.php' method='POST'>
                        <input type='hidden' value='".$_POST[course]."' name='course'>
                        <br>
                        <input type='submit' value='Delete' class='btn'> 
                    </form>
                    ";


                }



                $connection -> close();

            ?>
            
            <br>
            <a href='index.php'><button class="btn">Back to home</button></a>    
        
        </div>
    </div>
    
    
    
    
    
    
</body>
</html>