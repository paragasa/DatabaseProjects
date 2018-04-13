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
    
    $stmt= mysqli_prepare($conn,"INSERT INTO PERSONAL_INFO VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt,'isssssssisssiissi',$one,  $twotwo, $two, $three, $four, $five, $six, $seven ,$eight, $nine, $ten, $eleven, $twelve, $thirteen, $fourteen,$fifteen , $sixteen);
    $one= $_SESSION["MAXPID"];
    $twotwo=$_POST["LName"];
    $two=$_POST["Name"];
    $three= $_POST["pre_Name"];
    $four= $_POST["DOB"];
    $five=  $_POST["address"];
    $six=  $_POST["city"];
    $seven= $_POST['state'];
    $eight= $_POST["zip"];
    $nine= $_POST["pref_phone"];
    $ten= $_POST["US"];
    $eleven= $_POST["English"];
    $twelve= $_POST['vet'];
    $thirteen= $_POST['mil'];
    $fourteen= $_POST["GENDER"];
    $fifteen=  $_POST["Hispanic"];
    $sixteen= $_SESSION["MAXAPP"];
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    //insert into eth linking
    
    
    $check=$_POST['eth'];
    
    for($i=0;$i<sizeof($check);$i++){
    $stmt= mysqli_prepare($conn,"INSERT INTO ETH_LINKING VALUES (?,?)");
    mysqli_stmt_bind_param($stmt,'is',$user, $ethn);
    $user= $_SESSION["MAXPID"];
    $ethn=$check[$i];
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    }
    ?>
  
<html>
    <head>
    <title>Application Information</title>
    </head>

    <body style="background-color:lightblue">
    <form action="confirmation.php" method="POST">
    <p>

Will you be applying for financial aid?<br>

<input type="radio" name="FINACIAL" value="Y" id="H1">
<label for="H1">Yes</label>
<input type="radio" name="FINACIAL" value="N" id="H2">
<label for="H2">No</label>
<p>

Do you have employer tuition assistance?<br>
<input type="radio" name="TUITION" value="Y" id="H1">
<label for="H1">Yes</label>
<input type="radio" name="TUITION" value="N" id="H2">
<label for="H2">No</label>
<p>
Are you also applying to other programs?<br>
<input type="radio" name="PROGRAMS" value="Y" id="H1">
<label for="H1">Yes</label>
<input type="radio" name="PROGRAMS" value="N" id="H2">
<label for="H2">No</label>
<p>

Have you ever been convicted of a felony or a gross misdemeanor?<br>
<input type="radio" name="FELONY" value="Y" id="H1">
<label for="H1">Yes</label>
<input type="radio" name="FELONY" value="N" id="H2">
<label for="H2">No</label>
<p>
A conviction will not necessarily bar admission but will require additional documentation prior to a decision. You will be contacted shortly via email with instructions on reporting the nature of your conviction. 
<br>
 Have you ever been placed on probation, suspended from, dismissed from or otherwise sanctioned by for any period of time any higher education institution?<br>
<input type="radio" name="DISMISSED" value="Y" id="H1">
<label for="H1">Yes</label>
<input type="radio" name="DISMISSED" value="N" id="H2">
<label for="H2">No</label>
<p>



    <input type=reset value="Clear">
    <input type=submit value="Enter">

    </form>

    </body>
</html>
    
    


