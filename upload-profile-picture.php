<?php
// Prevent PHP errors from corrupting JSON output
error_reporting(0);
ini_set('display_errors', 0);

header('Content-Type: application/json');

if (!isset($_POST['email']) || empty($_POST['email'])) {
    echo json_encode(['success' => false, 'message' => 'No email provided']);
    exit;
}

$userEmail = $_POST['email'];

if (!isset($_FILES['profile_picture'])) {
    echo json_encode(['success' => false, 'message' => 'No file uploaded']);
    exit;
}

$file = $_FILES['profile_picture'];
$fileName = $file['name'];
$fileTmpName = $file['tmp_name'];
$fileError = $file['error'];

// Validate file type
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
$fileType = mime_content_type($fileTmpName);
if (!in_array($fileType, $allowedTypes)) {
    echo json_encode(['success' => false, 'message' => 'Invalid file type. Only JPG, PNG and GIF allowed']);
    exit;
}

// Generate unique filename using user email and timestamp
$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
$newFileName = md5($userEmail . time()) . '.' . $fileExtension;
$uploadPath = 'uploads/' . $newFileName;

// Create uploads directory if it doesn't exist
if (!file_exists('uploads')) {
    mkdir('uploads', 0777, true);
}

if ($fileError === 0) {
    try {
        if (move_uploaded_file($fileTmpName, $uploadPath)) {
            $conn = new mysqli('localhost', 'root', '', 'panlasangnoypi');
            
            if ($conn->connect_error) {
                throw new Exception('Database connection failed');
            }

            // Update or insert profile picture path for specific user
            $sql = "INSERT INTO user_profiles (email, profile_picture) 
                    VALUES (?, ?) 
                    ON DUPLICATE KEY UPDATE profile_picture = ?";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sss', $userEmail, $uploadPath, $uploadPath);
            
            if ($stmt->execute()) {
                echo json_encode([
                    'success' => true,
                    'image_path' => $uploadPath,
                    'message' => 'Profile picture updated successfully'
                ]);
            } else {
                throw new Exception('Failed to update database');
            }

            $stmt->close();
            $conn->close();
        } else {
            throw new Exception('Failed to move uploaded file');
        }
    } catch (Exception $e) {
        echo json_encode([
            'success' => false, 
            'message' => $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error uploading file'
    ]);
}
?>