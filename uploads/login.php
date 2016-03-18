<html>
<head><title>Login page </title>
</head>
<body bgcolor="cyan">
<form method="post" >
<table>
<tr>
<td>Username : 
<td><input type="text" name="user_name";>
</tr>
<tr>
<td>Password :
<td><input type="password" name="user_pass";>
</tr>
<tr>
<td><input type="submit" name="Submit" value="Submit">
</table>
</form>
<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "logininfo";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "CREATE TABLE logininfo
user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
user_name VARCHAR (30) NOT NULL
user_pass VARCHAR (30) NOT NULL


)";

if (mysqli_query($conn, $sql)) {
    echo "Table login created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

$sql = "INSERT INTO login (user_id, user_name, user_pass)
VALUES ('5', 'tanvi', 'jatana')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>



</body>
</html><html>
<head><title>Login page </title>
</head>
<body bgcolor="cyan">
<form method="post" >
<table>
<tr>
<td>Username : 
<td><input type="text" name="user_name";>
</tr>
<tr>
<td>Password :
<td><input type="password" name="user_pass";>
</tr>
<tr>
<td><input type="submit" name="Submit" value="Submit">
</table>
</form>
<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "logininfo";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "CREATE TABLE logininfo
user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
user_name VARCHAR (30) NOT NULL
user_pass VARCHAR (30) NOT NULL


)";

if (mysqli_query($conn, $sql)) {
    echo "Table login created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

$sql = "INSERT INTO login (user_id, user_name, user_pass)
VALUES ('5', 'tanvi', 'jatana')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>



</body>
</html>