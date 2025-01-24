<?php
include 'database.php';

$search_results = [];  

// Search functionality
if (isset($_GET['search_query'])) {
    $search_query = $_GET['search_query'];

    // Search projects by team name
    $stmt = $conn->prepare("
        SELECT p.project_name, t.team_name
        FROM projects p
        LEFT JOIN teams t ON p.team_id = t.id
        WHERE t.team_name LIKE ?
    ");
    $search_term = "%" . $search_query . "%";  
    $stmt->bind_param('s', $search_term);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $search_results[] = $row;
        }
    }

    $stmt->close();

    echo json_encode($search_results);
    exit();
}

// Project creation logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_type = $_POST['project_type'];

    if ($project_type == 'team') {
        $team_name = $_POST['team_name'];
        $project_name = $_POST['project_name'];

        // Validate the team name from the database
        $stmt = $conn->prepare("SELECT * FROM teams WHERE team_name = ?");
        $stmt->bind_param('s', $team_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $team = $result->fetch_assoc();
            $team_id = $team['id'];

            $stmt = $conn->prepare("INSERT INTO projects (project_name, team_id) VALUES (?, ?)");
            $stmt->bind_param('si', $project_name, $team_id);
            if ($stmt->execute()) {
                echo "Project created successfully!";
            } else {
                echo "Error creating project.";
            }
        } else {
            echo "Team not found!";
        }
    }
}

$conn->close();
?>
