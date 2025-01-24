<?php
$conn = new mysqli('localhost', 'root', '', 'library');

if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

if (isset($_GET['query'])) {
    $query = $conn->real_escape_string($_GET['query']);
    $sql = "SELECT name FROM books WHERE name = '$query'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['found' => true, 'book_name' => $row['name']]);
    } else {
        echo json_encode(['found' => false]);
    }
} else {
    echo json_encode(['found' => false]);
}

$conn->close();
?>
