<?php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $action = $data['action'];
    $table = $data['table'];
    $id = $data['id'];

    // Validate inputs
    if (!in_array($table, ['admin_users', 'employee_users', 'researcher_users', 'accountant_users'])) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid table']);
        exit;
    }

    if (!in_array($action, ['remove', 'ban'])) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
        exit;
    }

    $primaryKey = '';
    switch ($table) {
        case 'admin_users':
            $primaryKey = 'admin_id';
            break;
        case 'employee_users':
            $primaryKey = 'employee_id';
            break;
        case 'researcher_users':
            $primaryKey = 'researcher_id';
            break;
        case 'accountant_users':
            $primaryKey = 'accountant_id';
            break;
    }

    if ($action === 'remove') {
        $sql = "DELETE FROM $table WHERE $primaryKey = ?";
    } elseif ($action === 'ban') {
        $sql = "UPDATE $table SET status = 'Banned' WHERE $primaryKey = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => ucfirst($action) . ' successful']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to execute action']);
    }

    $stmt->close();
    $conn->close();
}
