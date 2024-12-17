<?php
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password
$dbname = "panlasangnoypi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['full-name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (full_name, email, password) VALUES ('$fullName', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        session_start();
        $_SESSION['user_email'] = $email;
        $_SESSION['profile_picture'] = 'images/profile-pic.png'; // Default profile picture
        echo "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                    background-color: #ffffff;
                }
                .success-message {
                    position: relative;
                    border: 2px solid #000000;
                    background-color: transparent;
                    color: black;
                    padding: 20px;
                    padding-top: 60px;
                    border-radius: 5px;
                    text-align: center;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
                }
                .success-message::before {
                    content: '';
                    position: absolute;
                    top: -20px;
                    left: 50%;
                    transform: translateX(-50%);
                    width: 240px;
                    height: 120px;
                    background-image: url('images/panlasangnoypi.png');
                    background-size: contain;
                    background-repeat: no-repeat;
                    background-position: center;
                }
                .loading {
                    margin-top: 10px;
                    font-size: 14px;
                }
            </style>
        </head>
        <body>
            <div class='success-message'>
                <h2>Registration Successful!</h2>
                <p>Welcome, $fullName!</p>
                <p class='loading'>Redirecting...</p>
            </div>
            <script>
                localStorage.setItem('isLoggedIn', 'true');
                localStorage.setItem('userName', '$fullName');
                localStorage.setItem('userEmail', '$email');
                localStorage.setItem('profilePicture', 'images/profile-pic.png');
                setTimeout(function() {
                    window.location.href = 'index.html?message=' + encodeURIComponent('Welcome, $fullName!');
                }, 5000);
            </script>
        </body>
        </html>
        ";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>