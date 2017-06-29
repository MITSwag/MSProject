<?php
include "accountManager.php";
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
function send($chat, $user, $message)
{
$con = connect_SQL();
$sql = "INSERT INTO " . $chat . " (Index, User, Message, Time) VALUES (\"".getLastIndex($chat)+1."\", \"".$user."\", \"".$message."\", \"".time()"\")";
mysqli_query($con, $sql);
return true;
}
function getLastIndex($chat) {
$con = connect_SQL();
$sql = "SELECT Index FROM " . $chat;
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
return mysqli_fetch_assoc($result);
}
else {return 0}
}
function update($chat) {
  $result = getMessages($chat);
  $stream = array();
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($results)) {
      while (getLastMessageIndex(getCurrentUser()) < $row[index]) {
        array_unshift($stream, array($row[User], $row[Message], $row[Time]));
      }
    }
  }
  return $stream;
}
function getMessages($chat) {
$con = connect_SQL();
$sql = "SELECT * FROM " . $chat;
$result = mysqli_query($con, $sql);
return $result;
}
function enterChat($chat) {
$result = getMessages($chat);
$stream = ";";
$count = 0;
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result) && $count < 50) {
array_unshift($stream, array($row[User], $row[Message], $row[Time]));
$count = $count + 1;
}
}
return $stream;
}
function show($stream) {
  while(sizeOf($stream) != 0) {
    echo "test";
    array_splice($stream, sizeOf($stream)-1);
  }
}
function newChat($chatName)
{
  $con = connect_SQL();
  $sql = "".$chatName." (Index int, User varchar(20), Message varchar(1000), Time int)";
}
function deleteChat($chatName)
{
}
function Validate($data)
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
?>
