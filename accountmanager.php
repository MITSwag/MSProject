<?php
function connect_SQL()
{
    $host = "localhost";
    $username = "root";
    $password = "root";
    $DB = "MSProject-master";
    $port = "3306";
    $con = mysqli_connect($host, $username, $password, $DB, $port);
    if (!$con) {
        die("Connection failed: " . $con->connect_error);
    }
    return $con;
}

function disconnect_SQL($con)
{
    mysqli_close($con);
}

function login($username, $password)
{
    $con = connect_SQL();
    $sql = "SELECT Username, Password FROM Users";
    if ($result = mysqli_query($con, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row["Username"] == $username && $row["Password"] == $password) {
                return true;
            }
        }
    }
    return false;
}

function register($fName,$lName,$username,$email,$password) {
    $con = connect_SQL();
    $sql = "SELECT Username FROM Users";
    $result = mysqli_query($con, $sql);
    disconnect_SQL($con);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            if($row["Username"] == $username){return false;}
        }
    }
    $name = $fName . " " . $lName;
    $con = connect_SQL();
    $sql = "INSERT INTO Users (Name, Username, Email, Password) VALUES (\"".$name."\", \"".$username."\", \"".$email."\", \"".$password."\")";
    mysqli_query($con, $sql);
    return true;
}

function Validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST["login-submit"])) {
    $loguser=Validate($_POST["username"]);
    $logpassword=Validate($_POST["password"]);
    if((login($loguser,$logpassword))==true){
            header('Location: /MSProject-master/dashboard.php');
    }
}

if(isset($_POST["register-submit"])) {
    if($_POST["password"] == $_POST["confirm-password"]) {
        $logfname=Validate($_POST["fName"]);
        $loglname=Validate($_POST{"lName"});
        $loguser=Validate($_POST["username"]);
        $logemail=Validate($_POST["email"]);
        $logpassword=Validate($_POST["password"]);
        if((register($logfname,$loglname,$loguser, $logemail, $logpassword))==true){
            header('Location: /MSProject-master/login.php');
        }
    }
}
?>