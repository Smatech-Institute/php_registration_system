<?php
$servername = "localhost";
$username = "root";
$password = "";
//create connection
$conn = new mysqli($servername, $username, $password);

//check connection
if($conn->connect_error){
    die("Connection Failled: " . $con->connect_error);
}else{
    echo "Successful Connection";
}
?>