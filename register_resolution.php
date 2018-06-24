<?php
$registered_name = $registered_password = $registered_email = $retyped_password = "";

// Get and test inputs

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registered_name = test_input($_POST["username"]);
    $registered_email = test_input($_POST["email"]);
    $registered_password = test_input($_POST["password"]);
    $retyped_password = test_input($_POST["retype_password"]);
  }

  
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

$passwordError =  "";

if($registered_password !== $retyped_password) {
    $passwordError = "The submitted passwords do not match.";
    echo $passwordError;
    return;
  }



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registered_users";

// Establish connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
  }

echo "Connection Established!\n";

$sql = "INSERT INTO user_information(`username`, `password`, `email_address`)
VALUES('$registered_name', '$registered_password', '$registered_email')";

if($connection->query($sql) === TRUE) {
  echo "New user has been registered";
}
else {
  echo "Error: " . $sql . "<br>" . $connection->error;
}

$connection->close();

?>