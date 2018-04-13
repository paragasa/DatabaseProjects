<?php
     $servername = "xxx.email";
    $username = "xxxx";
    $password = "xxxx";
    $dbname = "DBxxxx";
    
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    /*Session Start*/
    session_start();
    
    ?>
  
<html>
    <head>
    <title>New Application</title>
    </head>

    <body style="background-color:orange" >

    <form action="personal-information.php" method="POST">
    <p>
    Which type of Student are you?<br>
<?php
   
    //echo $_SESSION["MAXAPP"];
    
	$sql= "SELECT * FROM STUDENT_TYPE";
	$result= mysqli_query($conn, $sql);   
    if (mysqli_num_rows($result) > 0) {
        echo "<select name= 'type'>\n";
        while($row = mysqli_fetch_row($result)) {
            echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>\n";
        }
        echo "</select>\n";
    } else {
        echo "0 results";
    }
    
    ?>
     <p>
    Which College are you applying to?<br>
    <?php
	$sql= "SELECT * FROM COLLEGE";
	$result= mysqli_query($conn, $sql);   
    if (mysqli_num_rows($result) > 0) {
        echo "<select name= 'college'>\n";
        while($row = mysqli_fetch_row($result)) {
            echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>\n";
        }
        echo "</select>\n";
    } else {
        echo "0 results";
    }
    ?>
     <p>
    What type of degree are you applying for?<br>
<?php
$sql= "SELECT * FROM DEGREE";
$result= mysqli_query($conn, $sql);   
if (mysqli_num_rows($result) > 0) {
echo "<select name= 'degree'>\n";
while($row = mysqli_fetch_row($result)) {
echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>\n";
}
echo "</select>\n";
} else {
echo "0 results";
}
?>   
<p>Please select the Major you are applying to?<br>
<?php
$sql= "SELECT * FROM MAJOR_TYPE";
$result= mysqli_query($conn, $sql);   
if (mysqli_num_rows($result) > 0) {
echo "<select name= 'major'>\n";
while($row = mysqli_fetch_row($result)) {
echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>\n";
}
echo "</select>\n";
} else {
echo "0 results";
}
?>
<p> Term:<br>
<?php
$sql= "SELECT * FROM TERM";
$result= mysqli_query($conn, $sql);   
if (mysqli_num_rows($result) > 0) {
echo "<select name= 'term'>\n";
while($row = mysqli_fetch_row($result)) {
echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>\n";
}
echo "</select>\n";
} else {
echo "0 results";
}
?>
<p>	
<input type=reset value="Clear">
<input type=submit value="Enter">
</form>
</body>
</html>
    
    


