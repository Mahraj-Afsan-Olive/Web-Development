<?php
include 'database.php';

$action = isset($_POST['action']) ? $_POST['action'] : '';

// Add a new team
if ($action == 'add' && isset($_POST['team_name']) && isset($_POST['members'])) {
    $team_name = $_POST['team_name'];
    $members = $_POST['members']; 

    // Insert the team into the database
    $stmt = $conn->prepare("INSERT INTO teams (team_name, members) VALUES (?, ?)");
    $stmt->bind_param('ss', $team_name, $members);

    if ($stmt->execute()) {
        echo '<p>Team added successfully!</p>';
    } else {
        echo '<p>Error adding team. Please try again.</p>';
    }
    $stmt->close();
}

if ($action == 'search' && isset($_POST['search_query'])) {
    $search_query = $_POST['search_query'];


    $stmt = $conn->prepare("SELECT * FROM teams WHERE team_name LIKE ? OR members LIKE ?");
    $search_term = "%" . $search_query . "%";  
    $stmt->bind_param('ss', $search_term, $search_term);
    $stmt->execute();

    $result = $stmt->get_result();
    $teams = [];

    while ($row = $result->fetch_assoc()) {
        $teams[] = $row;
    }

    if (count($teams) > 0) {
        echo '<h3>Search Results:</h3>';
        foreach ($teams as $team) {
            echo '<div class="team-item">';
            echo '<strong>' . htmlspecialchars($team['team_name']) . '</strong><br>';
            echo 'Members: ' . htmlspecialchars($team['members']);
            echo '</div>';
        }
    } else {
        echo '<p>No teams found matching your search.</p>';
    }
    $stmt->close();
}

if ($action == 'delete' && isset($_POST['team_name'])) {
    $team_name = $_POST['team_name'];

 
    $stmt = $conn->prepare("DELETE FROM teams WHERE team_name = ?");
    $stmt->bind_param('s', $team_name);

    if ($stmt->execute()) {
        echo '<p>Team deleted successfully!</p>';
    } else {
        echo '<p>Error deleting team. Please try again.</p>';
    }
    $stmt->close();
}

echo '<a href="../views/teams.html">Go Back</a>';

$conn->close();
?>
