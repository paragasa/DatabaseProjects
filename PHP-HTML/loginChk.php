

    

<html>
	<head>
	<title>Log In</title>
	</head>
    <form action="new-application.php" method="POST">

	<body style = "background-color:lightblue">
    <font size='8'>MyApplications</font>
<?php
    $servername = "cssql.seattleu.edu";
    $username = "pengt1";
    $password = "Frufu2@u";
    $dbname = "pengt1";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Check connection
    if (!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    
    /*Session Start*/
    session_start();
    
    $username = mysqli_real_escape_string($conn, $_POST["Usr_Nm"]);
    $pwd = $_POST["Usr_Pwd"];
    $sql = "SELECT * FROM USR_ACCT WHERE USR_NM = '$username' and USR_PWD = MD5('$pwd')";
    $result = mysqli_query($conn,$sql);
    
    
    
    $_SESSION["user"]= $username ;
    ?>

	<p>

<?php
    $sql2= "SELECT GRAD_APP_ID FROM APPLICATION WHERE GRAD_APP_ID =(SELECT MAX(GRAD_APP_ID) FROM APPLICATION)";
    $result2= mysqli_query($conn, $sql2);
    $row = mysqli_fetch_row($result2);
    $max=  $row[0];
    
    //sets MAXAPP to most recent APP ID and adds one
    $_SESSION["MAXAPP"] = $max + 1;
    
    
    if (mysqli_num_rows($result)==1){
        echo "Welcome " . $username;
        echo"<br>";

    //display table
    $sql = "SELECT GRAD_APP_ID, STUDENT_TYPE, COLLEGE, DEGREE, MAJOR, TERM FROM APPLICATION a  JOIN STUDENT_TYPE t ON a.TYPE_ID= t.TYPE_ID  JOIN COLLEGE c ON a.COLLEGE_ID = c.COLLEGE_ID  JOIN DEGREE d ON a.DEGREE_ID= d.DEGREE_ID  JOIN MAJOR_TYPE m ON a.MAJOR_ID= m.MAJOR_ID  JOIN TERM ter ON a.TERM_ID= ter.TERM_ID WHERE a.USR_NM= '$username'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<table border = '1'>\n";
        // output data of each row
        echo "<tr>\n";
        echo "<th>APP ID</th>\n<th>Student Type</th>\n<th>College</th>\n<th>Degree</th>\n<th>Major</th>\n<th>Term</th>\n";
        echo "</tr>\n";
        while($row = mysqli_fetch_row($result)) {
            echo "<tr>\n";
            $pass=$row[0];
            echo "<td><a href='confirmation.php?id=$pass'> $pass</a></td>\n" . "<td>". $row[1] . "</td>\n" . "<td>". $row[2] . "</td>\n". "<td>". $row[3] . "</td>\n". "<td>". $row[4] . "</td>\n". "<td>". $row[5] . "</td>\n";             echo "</tr>\n";
        }
        echo "</table>\n";
    } else {
        echo "No Applications Started<br>";
    }
    }else{
        echo "log in fail!";
    }

    
    ?>


    <input type=submit value="Create New Application">


	</form>

	</body>
</html>




	

