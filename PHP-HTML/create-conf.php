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
    
    ?>



<html>
<head>
<title>CREATE ACCOUNT CONFIRMED</title>
</head>

<body style = "background-color:#7DCEA0">
<form>

<?php
    
    if( $_POST["Usr_Pwd"] != $_POST["Usr_Pwd2"] | empty($_POST["Usr_Nm"])){
        echo" <font size='8'>ENTRY ERROR, CHECK USERNAME OR PASSWORD</font>";
        echo"<br>";
           }
    else{
        $stmt= mysqli_prepare($conn,"INSERT INTO USR_ACCT VALUES (?,MD5(?))");
        mysqli_stmt_bind_param($stmt,'ss',$UN, $UP);
        $UN= $_POST["Usr_Nm"];
        $UP= $_POST["Usr_Pwd"];
        
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo" <font size='8'>ACCOUNT CREATION CONFIRMED </font>";

        echo "<br>";
        
        echo"<a href='login.php'>LOGIN</a>";
    }
    ?>
</form>
</body>
</html>



