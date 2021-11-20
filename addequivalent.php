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

                $westerncourse = $_POST[westerncourse];
                $outsidecourse = $_POST[outsidecourse];

                $query = "SELECT * FROM equivalent WHERE westerncourse='".$westerncourse."' && othercourse='".$outsidecourse."'";

                $result = mysqli_query($connection, $query);
                $check = mysqli_query($connection, $query);

                if (!$result) {
                    die("Query failed.");
                }

                /*  Setting timezone and getting current date   */
                date_default_timezone_set('EST');
                $today = date('Y-m-d');

                /*  If Equivalence Already Exists   */
                if(mysqli_fetch_assoc($check)){

                    echo "<h3>Courses already equivalent!</h3><br>";
                    $row = mysqli_fetch_assoc($result);

                    echo"
                    <table>
                    <tr><td>Previous Equal Date</td> <td>".$row['equaldate']."</td></tr>
                    <tr><td>New Equal Date</td> <td>".$today."</td></tr>            
                    </table>    
                    ";

                    $update = "UPDATE equivalent SET equaldate='".$today."' WHERE westerncourse='".$westerncourse."' && othercourse='".$outsidecourse."'";

                    $updateresult = mysqli_query($connection, $update);

                }

                /*  If creating new equivalence */
                else{

                    $query2 = "SELECT * FROM outsidecourse WHERE coursecode='".$outsidecourse."'";

                    $result2 = mysqli_query($connection, $query2);
                    $row = mysqli_fetch_assoc($result2);

                    $insert = "INSERT INTO equivalent VALUES('".$westerncourse."', '".$outsidecourse."', '".$row['universityid']."', '".$today."')";

                    $insertresult = mysqli_query($connection, $insert);


                    echo"<h3>Equivaleny Created!</h3>";


                }


                $connection -> close();

            ?>

            
            <br>
            <a href='index.php'><button class="btn">Back to home</button></a>

            
        </div>
    </div>
    
    
    
    
</body>
</html>