​
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
function send($chat, $user, $message)
{
$con = connect_SQL();
$sql = "INSERT INTO " . $chat . " (User, Message) VALUES (\"".$user."\", \"".$message."\"")";//Can you add insert a timestamp
mysqli_query($con, $sql);
return true;
}
function enterChat($chat) {
$con = connect_SQL();
$sql = "SELECT User, Message FROM " . $chat;//Add a get timestamp
$result = mysqli_query($con, $sql);
disconnect_SQL($con);
$stream = ";";
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
$stream = ";" . $row[User] . "," . $row[Message] . $stream;
show($stream);
}
function updateChat($chat) {
//We'll haven't worked out this method yet
}
function show($stream) {
$count = 0;
while($stream != ";" && $count < 50) {
$user = substr($stream,strpos($stream,";")+1,strpos($stream,",")-strpos($stream,";")-1);//Check my logic to see if it seperates right. I'm pretty sure I used to right algorithm
$message = substr($stream,strpos($stream,",")+1,strpos($stream,";",strpos($stream,";")+1)-strpos($stream,",")-1);//Check my logic to see if it seperates right. I'm pretty sure I used to right algorithm
echo $user . $message//We need to do this echo later with correct css
$stream = substr($stream,strpos($stream,";")+1,strripos($stream,";")-strpos($stream,";"));
//We'll have to add something later to allow viewing of more messages if the user chooses more messages. I set the limit to 50 to increase speed.
}
function Validate($data)
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
?>
