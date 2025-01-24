<?php
include('../Model/db_connect.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $input = json_decode(file_get_contents('php://input'), true);

    $table = $input['table'] ?? null; 
    $id = $input['id'] ?? null;

    if (!empty($table) && !empty($id)) {
        $table = mysqli_real_escape_string($conn, $table);
        $id = intval($id);

        $primaryKey = ''; 

        $primaryKeys = [
            'admin_users' => 'admin_id',
            'employee_users' => 'employee_id',
            'researcher_users' => 'researcher_id',
            'accountant_users' => 'accountant_id',
        ];

        if (array_key_exists($table, $primaryKeys)) {
            $primaryKey = $primaryKeys[$table];

            $sql = "DELETE FROM $table WHERE $primaryKey = $id";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(['success' => true, 'message' => 'User removed by oliver successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to remove Olive']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid table name']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
