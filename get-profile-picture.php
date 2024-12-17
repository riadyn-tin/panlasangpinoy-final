<?php
header('Content-Type: application/json');

$email = $_GET['email'] ?? '';

if (empty($email)) {
    echo json_encode(['success' => false, 'message' => 'No email provided']);
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'panlasangnoypi');

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

$stmt = $conn->prepare("SELECT profile_picture FROM user_profiles WHERE email = ?");
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode([
        'success' => true,
        'profile_picture' => $row['profile_picture']
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No profile picture found'
    ]);
}

$stmt->close();
$conn->close();
?>