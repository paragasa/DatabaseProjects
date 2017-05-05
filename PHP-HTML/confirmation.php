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
    
    
    /*Session Start*/
    session_start();
    
    
?>

    

<html>
    <head>
    <title>Confirmation</title>
    </head>

    <body style="background-color:lightgreen">

    <form>
<?php
  
    if($_SERVER['HTTP_REFERER']=='http://localhost/test/FINAL/loginChk.php'){
    echo"<font size='5'>View Application</font><br><br>";
    
        echo "<u>New Application</u>:<br>";
        $gradapp=$_GET["id"];
        
      $sql = "SELECT GRAD_APP_ID, STUDENT_TYPE, COLLEGE, DEGREE, MAJOR, TERM FROM APPLICATION a  JOIN STUDENT_TYPE t ON a.TYPE_ID= t.TYPE_ID  JOIN COLLEGE c ON a.COLLEGE_ID = c.COLLEGE_ID  JOIN DEGREE d ON a.DEGREE_ID= d.DEGREE_ID  JOIN MAJOR_TYPE m ON a.MAJOR_ID= m.MAJOR_ID  JOIN TERM ter ON a.TERM_ID= ter.TERM_ID WHERE a.GRAD_APP_ID= $gradapp";
        
        $result= mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_row($result)) {
            echo " Which type of Student are you?              <br> ". $row[1] ."<br><br>";
            echo " Which College are you applying to?          <br> ". $row[2] ."<br><br>";
            echo " What type of degree are you applying for?   <br> ". $row[3] ."<br><br>";
            echo " Please select the Major you are applying to?<br> ". $row[4] ."<br><br>";
            echo " Term?                                       <br> ". $row[5] ."<br><br>";
            }
            
        } else {
            echo "0 results";
        }
        
        
        echo "<u>Personal Information</u>:<br>";
        $sql = "SELECT GRAD_APP_ID, FNAME, LNAME, PERFER_NM, DOB, ADDR,CITY, STATE_ID,ZIP,PHONE_NUM, US_CITIZEN, ENG_LANG_PRIMARY, VET_STATUS, MIL_BRANCH, GENDER_OPTION, HISPANIC FROM PERSONAL_INFO p  JOIN VET_STAT v ON p.VET_STAT_ID= v.VET_STAT_ID JOIN MILITARY_BRANCH m ON p.MIL_ID = m.MIL_ID WHERE p.GRAD_APP_ID= $gradapp";
        
        $result= mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_row($result)) {
                echo " First Name:            <br> ". $row[1] ."<br><br>";
                echo " Last Name:          <br> ". $row[2] ."<br><br>";
                echo " Preferred Name:   <br> ". $row[3] ."<br><br>";
                echo " Date of Birth: <br> ". $row[4] ."<br><br>";
                echo " Address:<br> ". $row[5] ."<br><br>";
                echo "City:<br> ". $row[6] ."<br><br>";
                echo " State:<br>". $row[7] ."<br><br>";
                echo " ZIP:<br>". $row[8] ."<br><br>";
                echo " Phone Number:<br>". $row[9] ."<br><br>";
                echo " Are you a US Citizen?<br>". $row[10] ."<br><br>";
                echo " Is English your native language?<br>". $row[11] ."<br><br>";
                echo " Please tell us your veteran status?<br>". $row[12] ."<br><br>";
                echo " Military Branch<br>". $row[13] ."<br><br>";
                echo "Gender:<br> ". $row[14] ."<br><br>";
                echo " Are you Hispanic<br>". $row[15] ."<br><br>";
            }
            
        } else {
            echo "0 results";
        }
        
        echo " Choose your ethncities:<br> ";
        $sql = "SELECT  ETH_CHOICE FROM ETHNICITY e JOIN ETH_LINKING el ON e.ETH_ID = el.ETH_ID JOIN PERSONAL_INFO a ON el.PERSON_ID= a.PERSON_ID WHERE a.GRAD_APP_ID= $gradapp";
        
        $result= mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_row($result)) {
                echo  $row[0] ."<br>";
                
            }
            echo "<br><br><p>";
        } else {
            echo "0 results";
        }
        
        //APPLICATION INFORMATION
        echo "<u>Application Information</u>:<br>";
        
        
        $sql = "SELECT  FINANCIAL_AID, TUITION_ASSIST, OTHER_PROG, CONVICTED, EDU_PROBATION FROM BK_GROUND  WHERE GRAD_APP_ID= $gradapp";
        
        $result= mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_row($result)) {
                echo " Will you be applying for financial aid?<br> ". $row[0] ."<br><br>";
                echo " Do you have employer tuition assistance?<br>". $row[1] ."<br><br>";
                echo " Are you also applying to other programs?<br>". $row[2] ."<br><br>";
                echo " Have you ever been convicted of a felony or a gross misdemeanor?<br>". $row[3] ."<br><br>";
                
                echo " A conviction will not necessarily bar admission but will require additional documentation prior to a decision. You will be contacted shortly via email with instructions on reporting the nature of your conviction.<br>Have you ever been placed on probation, suspended from, dismissed from or otherwise sanctioned by for any period of time any higher education institution?<br>". $row[4] ."<br>";
            }
            
        } else {
            echo "0 results";
        }
        
        
    }
    else{
        /*INSERT INTO BACKGROUND APPLICATION IF MAKING AN APPLICATION*/
        $stmt= mysqli_prepare($conn,"INSERT INTO BK_GROUND VALUES (?,?,?,?,?,?)");
        mysqli_stmt_bind_param($stmt,'sssssi',$one, $two, $three, $four, $five, $six);
        $one= $_POST["FINACIAL"];;
        $two=$_POST["TUITION"];
        $three= $_POST["PROGRAMS"];
        $four= $_POST["FELONY"];
        $five=  $_POST["DISMISSED"];
        $six= $_SESSION["MAXAPP"];
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo "<font size='8'>APPLICATION CREATION CONFIRMED!</font>";
    }
    
?>

</form>

    </body>
</html>
    
