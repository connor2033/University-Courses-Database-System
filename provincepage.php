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


                $provcode = $_POST[province];
                $provname = $_POST[province];    
            
                /*  Getting Province Name   */
                if($provcode == 'ON'){
                    $provname = 'Ontario';
                }else if($provcode == 'NB'){
                    $provname = 'New Brunswick';
                }else if($provcode == 'QB'){
                    $provname = 'Quebec';
                }else if($provcode == 'BC'){
                    $provname = 'British Columbia';
                }

                echo "<h2>Universities in ".$provname."</h2><br>";


                $query = "SELECT * FROM university WHERE province='$provcode'";

                $result = mysqli_query($connection, $query);

                if (!$result) {
                    die("Query on westerncourse failed.");
                }

                /*  Table of universities   */
                echo"<table>";
                echo"<tr><th>Official Name</th> <th>Nickname</th></tr>";
                while($row = mysqli_fetch_assoc($result)){
                    echo"<tr><td>".$row['offname']."</td> <td>".$row['nickname']."</td></tr>";
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