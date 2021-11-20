<!DOCTYPE html>
<html>
    
<head>
	<title>Western Courses</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
    
<body>
    <h1>List of Courses:</h1>
    
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
            
            <h2>Course List</h2>
            
            <?php
                include "connecttodb.php";

                /*  How to use $_POST   */
                $sort = $_POST[sortby];
                $order = $_POST[order];


                $query = "SELECT * FROM westerncourse ORDER BY $sort $order";

                $result = mysqli_query($connection, $query);

                if (!$result) {
                    die("Query on westerncourse failed.");
                }
                
                /*  Creating Table with forms   */
                echo "<table style='width:100%'>";

                echo "<tr> <th>coursenum</th><th>coursename</th><th>weight</th><th>suffix</th><th>Edit</th><th>Delete Course</th> </tr>";
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr> 
                    <td>".$row['coursenum']."</td> <td>".$row['coursename']."</td> <td>".$row['weight']."</td> <td>".$row['suffix']."</td>
                    <td style=text-align:center>

                    <form action='editcourse.php' method='POST'>
                        <input type='hidden' value='".$row['coursenum']."' name='num'>
                        <input type='submit' value='Edit Details' class='btn'> 
                    </form>
                    </td>

                    <td style=text-align:center>
                    <form action='deletepage.php' method='POST'>
                        <input type='hidden' value='".$row['coursenum']."' name='course'>
                        <input type='submit' value='Delete' class='btn'> 
                    </form>
                    </td>

                    </tr>";
                }

                echo "</table>";



                mysqli_free_result($result);


                $connection -> close();
            ?>
            
        
            <br>
            <a href='index.php'><button class="btn">Back to home</button></a>
            
        </div>
                
    </div>
    
    
    
    
</body>
    
</html>
    

