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

            $coursenum = $_POST[code];
            echo "<div class='section'><h1>Course Details: ".$coursenum."</h1>";


            $query1 = "SELECT * FROM westerncourse WHERE coursenum='$coursenum'";

            $result1 = mysqli_query($connection, $query1);

            if (!$result1) {
                die("Query on westerncourse failed.");
            }

            $row = mysqli_fetch_assoc($result1);
        
            /*  Table of course details */
            echo"<table>        
            <tr><td>Course Name</td> <td>".$row['coursename']."</td></tr>        
            <tr><td>Course Number</td> <td>".$row['coursenum']."</td></tr>        
            <tr><td>Weight</td> <td>".$row['weight']."</td></tr>       
            </table></div><br>
            ";








            $query2 = "
            SELECT *, westerncourse.weight AS wweight, outsidecourse.weight AS oweight
                FROM equivalent
                INNER JOIN outsidecourse ON othercourse=coursecode AND university=universityid
                INNER JOIN university ON universityid=idnum
                INNER JOIN westerncourse ON westerncourse=coursenum
                WHERE coursenum='$coursenum'
            ";

            $result2 = mysqli_query($connection, $query2);
            $check = mysqli_query($connection, $query2);

            if (!$result2) {
                die("Query with joins failed.");
            }

            /*  If has equivalent courses   */
            if(mysqli_fetch_assoc($check)){

                echo "<div class='section'><h3>Equivalent Courses:</h3>";

                /*  Table of equal courses  */
                echo"<table>";
                echo"<tr><th>University</th> <th>Course Name</th> <th>Course Number</th> <th>Weight</th> <th>Date of Equivalency</th></tr>";
                while($row = mysqli_fetch_assoc($result2)){

                    echo"

                    <tr><td>".$row[offname]."</td> <td>".$row[name]."</td> <td>".$row[coursecode]."</td> <td>".$row[oweight]."</td> <td>".$row[equaldate]."</td></tr>


                    ";

                }
                echo"</table></div>";


            }else{
                echo"No equivalent courses. <br>";
            }


            $connection -> close();
        
        ?>
        

        
        
    </div>
    
    
    

    
    
    
</body>
</html>