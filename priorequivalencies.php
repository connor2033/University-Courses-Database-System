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
        <div class="section"?>
            
            
            <?php
                include "connecttodb.php";

                $date = $_POST[date];

                echo"<h2>Equivalencies made before ".$date.": </h2><br>";

                $query = "
                SELECT *, westerncourse.weight AS wweight, outsidecourse.weight AS oweight
                    FROM equivalent
                    INNER JOIN outsidecourse ON othercourse=coursecode AND university=universityid
                    INNER JOIN university ON universityid=idnum
                    INNER JOIN westerncourse ON westerncourse=coursenum
                    WHERE equaldate <= '$date'
                ";

                $result = mysqli_query($connection, $query);

                if (!$result) {
                    die("Query failed.");
                }


                /*  Building Table  */
                echo"<table>";
                echo"<tr><th>Western Course Name</th> <th>Western Course Number</th> <th>Western Course Weight</th> <th>University</th> <th>Equivalent Course Name</th> <th>Equivalent Course Number</th> <th>Equivalent Course Weight</th> <th>Date of Equivalency</th></tr>";
                while($row = mysqli_fetch_assoc($result)){

                    echo"

                    <tr><td>".$row[coursename]."</td> <td>".$row[westerncourse]."</td> <td>".$row[wweight]."</td> <td>".$row[offname]."</td> <td>".$row[name]."</td> <td>".$row[coursecode]."</td> <td>".$row[oweight]."</td> <td>".$row[equaldate]."</td></tr>


                    ";

                }
                echo"</table>";
                    
                $connection -> close();

            ?>
        
            <br>
            <a href='index.php'><button class="btn">Back to home</button></a>
            
        </div>
    </div>
    

    
    
    
    
</body>
</html>