<?php

$host = 'localhost';
$db = 'pharma';
$user = 'root';
$pass = ''; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchQuery = $_POST['searchQuery'];

 
    $stmt = $conn->prepare("SELECT researcher_name, research_name, researcher_id FROM researchers WHERE researcher_name LIKE ?");
    $stmt->bind_param("s", $searchQuery);
    $stmt->execute();
    $result = $stmt->get_result();

   
    $searchResults = array();
    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }

    echo json_encode($searchResults);

    $stmt->close();
}

$conn->close();
?>