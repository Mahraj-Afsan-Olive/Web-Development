<?php
// Database connection
$host = 'localhost';
$db = 'pharma';
$user = 'root'; 
$pass = ''; 

$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $researcher_name = $_POST['researcher_name'];
    $research_name = $_POST['research_name'];
    $researcher_id = $_POST['researcher_id'];

    try {
        $stmt = $conn->prepare("INSERT INTO researchers (researcher_name, research_name, researcher_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $researcher_name, $research_name, $researcher_id);

        if ($stmt->execute()) {
            header('Location: ../views/my_profile.html?status=success');
        } else {
            throw new Exception('Failed to create researcher profile');
        }
    } catch (mysqli_sql_exception $e) {
        $errorMessage = $e->getMessage();
        header('Location: ../views/my_profile.html?error=' . urlencode($errorMessage));
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
        header('Location: ../views/my_profile.html?error=' . urlencode($errorMessage));
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
        exit;
    }
}
?>
