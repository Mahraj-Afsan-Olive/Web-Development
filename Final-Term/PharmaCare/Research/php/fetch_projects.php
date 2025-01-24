<?php
include 'database.php';

// Fetch 
$query = "
    SELECT p.project_name, t.team_name
    FROM projects p
    LEFT JOIN teams t ON p.team_id = t.id
";

$result = $conn->query($query);

$projects = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;  
    }
} else {
    $projects = [];  
}


echo json_encode($projects);

$conn->close();
?>
