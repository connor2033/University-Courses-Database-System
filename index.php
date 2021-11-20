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
    
    
    <a name="courselist"></a>
    <div class="space"></div>

    
    
    
    
    
    <div class="container">
 
    
    
        <!--    Get Course List Section -->
        
        <div class="section">
            <h2>Get list of courses</h2>

            <form action="courselist.php" method="POST">
                
                <legend>Order Courses By:</legend>


                <input type="radio" name="sortby" value="coursenum">
                <label>Course Num</label><br>


                <input type="radio" name="sortby" value="coursename">
                <label>Course Name</label><br><br>


                <input type="radio" name="order" value="ASC">
                <label>Ascending</label><br>


                <input type="radio" name="order" value="DESC">
                <label>Descending</label><br><br>

                <input type="submit" value="See Courses" class="btn">  

                
            </form>


        </div>


        <!--    Add Course Section -->
        <a name="addcourse"></a>
        <div class="section">

            <h2>Add Course</h2>

            <form action="addcourse.php" method="POST">
                      
                <legend>Input Course Details:</legend>
                
                <label>Course Number:</label><br>
                <input type="text" name="coursenum" required="required">
                <br><br>

                <label>Course Name:</label><br>
                <input type="text" name="coursename" required="required">
                <br><br>

                <label>Weight:</label><br>
                <input type="text" name="weight" required="required">
                <br><br>

                <label>Suffix:</label><br>
                <input type="text" name="suffix" required="required">
                <br><br>

                <input type="submit" value="Add Course" class="btn">  

                
            </form>



        </div>


        <!--    Get Uni Details Section -->
        <a name="unidetails"></a>
        <div class="section">


            <h2>Get University Details</h2>

            <form action="unidetails.php" method="POST">
                

                <legend>Select a University:</legend>



                <?php
                    include "connecttodb.php";

                    $query = "SELECT * FROM university ORDER BY province";

                    $result = mysqli_query($connection, $query);

                    if (!$result) {
                        die("Query on westerncourse failed.");
                    }



                    while($row = mysqli_fetch_assoc($result)){

                        echo "<input type='radio' name='uni' value='".$row['idnum']."'>";
                        echo "<label>".$row['offname']."</label><br>";
                    }

                    
                    $connection -> close();
                ?>


                <input type="submit" value="See Details" class="btn">  

            </form>



        </div>


        <!--    Get Uni By Province Section -->
        <a name="unibyprov"></a>
        <div class="section">

            <h2>Get Universities by Province</h2>

            <form action="provincepage.php" method="POST" id="provinceform">
                

                <legend>Select a Province:</legend>


                <select name="province" form="provinceform">        

                    <?php
                        include "connecttodb.php";

                        $query = "SELECT DISTINCT province FROM university";

                        $result = mysqli_query($connection, $query);

                        if (!$result) {
                            die("Query on westerncourse failed.");
                        }

                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option value='".$row['province']."'>".$row['province']."</option>";
                        }
                    
                        $connection -> close();
                    ?>



                </select>


                <br><br>
                <input type="submit" value="See Details" class="btn"> 

                
            </form>

        </div>

        
        <!--    Get Course Details Section  -->
        <a name="coursedetails"></a>
        <div class="section">
            

            <h2>Get Course Details</h2>

            <form action="coursepage.php" method="POST" id="courseform">
                

                <legend>Select a Western Course:</legend>
                <br>

                <select name="code" form="courseform">        

                    <?php
                        include "connecttodb.php";

                        $query = "SELECT * FROM westerncourse";

                        $result = mysqli_query($connection, $query);

                        if (!$result) {
                            die("Query failed.");
                        }

                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option value='".$row['coursenum']."'>".$row['coursenum']." - ".$row['coursename']."</option>";
                        }

                        $connection -> close();
                    ?>



                </select>


                <br><br>
                <input type="submit" value="See Details" class="btn"> 

               
            </form>


        </div>  


        <!--    Get Equivalencies Section   -->
        <a name="equivbydate"></a>
        <div class="section">

            <h2>Get Equivalencies By Date</h2>

            <form action="priorequivalencies.php" method="POST">
               

                <legend>Selected a Date:</legend>
                <br>

                <input type="date" name="date" required="required">

                <br><br>
                <input type="submit" value="See Equivalencies" class="btn"> 


            </form>


        </div>


        <!--    Create Equivalencies Section    -->
        <a name="createequiv"></a>
        <div class="section">

            <h2>Create New Equivalency</h2>

            <form action="addequivalent.php" method="POST" id="equivform">
                
                <legend>Choose Equivalent Courses:</legend>
                <br>


                <select name="westerncourse" form="equivform">        

                    <?php
                        include "connecttodb.php";

                        $query = "SELECT * FROM westerncourse";

                        $result = mysqli_query($connection, $query);

                        if (!$result) {
                            die("Query failed.");
                        }

                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option value='".$row['coursenum']."'>".$row['coursenum']." - Western</option>";
                        }
                    
                        $connection -> close();
                    ?>

                </select>

                <label>Is Equivalent To</label>
                <select name="outsidecourse" form="equivform">        

                    <?php
                        include "connecttodb.php";

                        $query = "
                        SELECT *
                            FROM outsidecourse
                            INNER JOIN university ON universityid=idnum ORDER BY coursecode
                        ";

                        $result = mysqli_query($connection, $query);

                        if (!$result) {
                            die("Query failed.");
                        }

                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option value='".$row['coursecode']."'>".$row['coursecode']." - ".$row['nickname']."</option>";
                        }

                        $connection -> close();
                    ?>

                </select>




                <br><br>
                <input type="submit" value="Create Equivalency" class="btn"> 



            </form>

        </div>


        <!--    List Universities without Associated Courses Section    -->
        <a name="moreuni"></a>
        <div class="section">

            <h2>Universities without Associated Courses:</h2>
            <br>

            <?php
                include "connecttodb.php";
                
                $query = "SELECT * FROM university WHERE idnum NOT IN (SELECT universityid FROM outsidecourse)";

                $result = mysqli_query($connection, $query);

                if (!$result) {
                    die("Query failed.");
                }

                echo "<table>
                <tr><th>Official Name</th> <th>Nickname</th></tr>
                ";
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr><td>".$row['offname']."</td> <td>".$row['nickname']."</td></tr>";
                }
                echo "</table>";
                
                $connection -> close();
            ?>


        </div>
        
        
        <div class="space"></div>        
        <h5 style="text-align: center; color: mediumpurple;">
            Site created by <b><a href="https://connorhaines.net/" target="_blank" style="text-decoration: none; color: mediumpurple;">Connor Haines</a></b> for CS3319 (2020)
        </h5>
        <div class="space"></div>
    
    </div>

    
</body>
    
</html>