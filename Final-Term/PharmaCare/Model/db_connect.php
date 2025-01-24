<?php
function getDbConnection() {
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "PharmaCare"; 

    
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}


$conn = getDbConnection();
?>
