<?php
    $servername = "cssql.seattleu.edu";
    $username = "pengt1";
    $password = "Frufu2@u";
    $dbname = "pengt1";
    
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    /*ADDING TO DATABASE*/
    //for grad app
    
     /*Session Start*/
       session_start();
    
    
    ?>

<html>
<head>
<title>Personal Information</title>
</head>

<body style = "background-color:yellow">

<form action="application-information.php" method="POST">
<?php
    //ADDS ALL INFO FROM NEW APPLICATION
    
    $username= $_SESSION["user"];
    $stmt= mysqli_prepare($conn,"INSERT INTO APPLICATION VALUES (?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt,'isiiiii',$one, $two, $three, $four, $five, $six, $seven);
    $one=   $_SESSION["MAXAPP"] ;
    $two= $username;
    $three= $_POST['type'];
    $four= $_POST['college'];
    $five= $_POST['degree'];
    $six= $_POST['major'];
    $seven= $_POST['term'];
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    
  
        $sql= "SELECT Person_ID FROM PERSONAL_INFO WHERE PERSON_ID =(SELECT MAX(PERSON_ID) FROM PERSONAL_INFO)";
        $result= mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);
        $maxp=  $row[0];
        
        //SET SESSION TO HAVE max person id plus one
        $_SESSION["MAXPID"] = $maxp + 1;
    


    ?>

<p>

Last Name:<br>
<input type="text" name="LName" ><br>


First Name:<br>
<input type="text" name="Name" ><br>

Preferred Name:<br>
<input type="text" name="pre_Name"><br>

Date of Birth (YYYY-MM-DD):<br>
<input type="text" name="DOB" ><br>


Mailing Address:<br>
Address:
<input type="text" name="address" >
City:
<input type="text" name="city" >
State:
<?php
    $sql= "SELECT * FROM STATE";
    $result= mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<select name= 'state'>\n";
        while($row = mysqli_fetch_row($result)) {
            echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>\n";
        }
        echo "</select>\n";
    } else {
        echo "0 results";
    }
    ?>
Zipcode:
<input type="text" name="zip" ><br>
<p>
Phone Number:<br>
<input type="text" name="pref_phone"><br>


Are you a US Citizen:<br>
<input type="radio" name="US" value="Y" id="US1">
<label for="US1">Yes</label>
<input type="radio" name="US" value="N" id="US2">
<label for="US2">No</label>
<p>

Is English your native language?:<br>
<input type="radio" name="English" value="Y" id="E1">
<label for="E1">Yes</label>
<input type="radio" name="English" value="N" id="E2”>
<label for="E2">No</label>
<p>

Please tell us your veteran status<br>
<?php
    
	$sql= "SELECT * FROM VET_STAT";
	$result= mysqli_query($conn, $sql);   
    if (mysqli_num_rows($result) > 0) {
        echo "<select name= 'vet'>\n";
        while($row = mysqli_fetch_row($result)) {
            echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>\n";
        }
        echo "</select>\n";
    } else {
        echo "0 results";
    }
    ?>
     <p>
Military Branch<br>
<?php
	$sql= "SELECT * FROM MILITARY_BRANCH";
	$result= mysqli_query($conn, $sql);   
    if (mysqli_num_rows($result) > 0) {
        echo "<select name= 'mil'>\n";
        while($row = mysqli_fetch_row($result)) {
            echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>\n";
        }
        echo "</select>\n";
    } else {
        echo "0 results";
    }
    ?>
     <p>
Gender?:<br>
<input type="radio" name="GENDER" value="M" id="G1">
<label for="G1">Male</label>
<input type="radio" name="GENDER" value="F" id="G2">
<label for="G2">Female</label>
<p>


Are you Hispanic/Latino origin?<br>
<input type="radio" name="Hispanic" value="Y" id="H1">
<label for="H1">Yes</label>
<input type="radio" name="Hispanic" value="N" id="H2">
<label for="H2">No</label>
<p>

Please Mark all that apply:<br>
<?php
	$sql= "SELECT * FROM ETHNICITY";
	$result= mysqli_query($conn, $sql);   
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_row($result)) {
            echo "<input type='checkbox' name='eth[]' value='" . $row[0] . "'>" . $row[1] . "</option>\n";
	
	
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
