<?php
function connect_SQL()
{
$host = "localhost";
$username = "root";
$password = "root";
$DB = "Messages";
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
function newChat($chatName)
{
  $con = connect_SQL();
  $sql = "CREATE TABLE ".$chatName." (Index int, User varchar(20), Message varchar(1000), Time int)";
    mysqli_query($con, $sql);
    return true;
}
function deleteChat($chatName)
{
    $con = connect_SQL();
    $sql = "DROP TABLE ".$chatName;
    mysqli_query($con, $sql);
    return true;
}
?>