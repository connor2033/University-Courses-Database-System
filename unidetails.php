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
        
        
            
            <?php
                include "connecttodb.php";



                $query = "SELECT * FROM university WHERE idnum=$_POST[uni]";

                $result = mysqli_query($connection, $query);

                if (!$result) {
                    die("Query failed.");
                }

                $row = mysqli_fetch_assoc($result);

                echo"<div class='section'><h1>".$row['offname']."</h1>";

                echo "<h3>Details:</h3>";
        
                /*  Table of uni details    */
                echo"<table>        
                <tr><td>University ID:</td> <td>".$row['idnum']."</td></tr>        
                <tr><td>Official Name:</td> <td>".$row['offname']."</td></tr>        
                <tr><td>City:</td> <td>".$row['city']."</td></tr>        
                <tr><td>Province:</td> <td>".$row['province']."</td></tr>        
                <tr><td>Nickname:</td> <td>".$row['nickname']."</td></tr>        
                </table>
                ";



                echo"</div><br>";

                $coursequery = "SELECT * FROM outsidecourse WHERE universityid=$_POST[uni]";

                $result2 = mysqli_query($connection, $coursequery);
                $checkresult = mysqli_query($connection, $coursequery);

                if (!$result2) {
                    die("Query failed.");
                }

                

                if(mysqli_fetch_assoc($checkresult)){
                    
                    echo "<div class='section'><h3>Courses at ".$row['nickname'].":</h3>";

                    /*  Table of uni courses */
                    echo"<table>";
                    echo"<tr><th>Course Code</th> <th>Name</th> <th>Year</th> <th>Weight</th></tr>";

                    while($course = mysqli_fetch_assoc($result2)){
                        echo"
                        <tr><td>".$course['coursecode']."</td> <td>".$course['name']."</td> <td>".$course['year']."</td> <td>".$course['weight']."</td></tr>
                        ";
                    }
                    echo"</table></div>";

                }
                else{
                    echo "No courses in database.";
                }


                $connection -> close();

            ?>
            
        
    </div>
    

    
</body>
</html>