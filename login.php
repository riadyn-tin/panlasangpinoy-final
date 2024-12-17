<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "panlasangnoypi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $isLoginSuccessful = true;
        } else {
            $isLoginSuccessful = false;
        }
    } else {
        $isLoginSuccessful = false;
    }

    if ($isLoginSuccessful) {
        $userName = $row['full_name'];
        $profilePicture = $row['profile_picture'] ?? 'images/profile-pic.png';
        session_start();
        $_SESSION['user_email'] = $email;
        $_SESSION['profile_picture'] = $profilePicture;
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
  position: relative;  /* Add relative positioning */
  border: 2px solid #000000;
  background-color: transparent;
  color: black;
  padding: 20px;
  padding-top: 60px;  /* Add extra padding on top for the image */
  border-radius: 5px;
  text-align: center;
  box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.success-message::before {
  content: '';
  position: absolute;
  top: -20px;  /* Position it above the border */
  left: 50%;
  transform: translateX(-50%);
  width: 240px;  /* Adjust width as needed */
  height: 120px;  /* Adjust height as needed */
  background-image: url('images/panlasangnoypi.png');  /* Update path to your image */
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
                <h2>Login Successful!</h2>
                <p>Welcome, $userName!</p>
                <p class='loading'>Redirecting...</p>
            </div>
            <script>
                localStorage.setItem('isLoggedIn', 'true');
                localStorage.setItem('userName', '$userName');
                localStorage.setItem('userEmail', '$email');
                localStorage.setItem('profilePicture', '$profilePicture');
                setTimeout(function() {
                    window.location.href = 'index.html?message=' + encodeURIComponent('Welcome, $userName!');
                }, 5000); // Redirects after 5 seconds
            </script>
        </body>
        </html>
        ";
        exit();
    } else {
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
                    background-color: rgba(0, 0, 0, 0.5);
                }
                .error-popup {
                    background-color: white;
                    border-radius: 10px;
                    padding: 20px;
                    text-align: center;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                    max-width: 350px;
                    width: 100%;
                }
                .error-popup h2 {
                    color: #d62300;
                    margin-bottom: 10px;
                }
                .error-popup p {
                    color: #333;
                    margin-bottom: 20px;
                }
                .error-popup button {
                    background-color: #d62300;
                    color: white;
                    border: none;
                    font-weight: bold;
                    padding: 10px 20px;
                    border-radius: 5px;
                    cursor: pointer;
                }
                .error-popup button:hover {
                    background-color: #a61b00;
                }
            </style>
        </head>
        <body>
            <div class='error-popup'>
                <h2>Uh-oh, the email or password is incorrect</h2>
                <p>You need to input the correct email address or password to proceed. Please try again or reset your password by selecting \"forgot password\" in the next screen.</p>
                <button onclick='window.history.back()'>Try Again</button>
            </div>
        </body>
        </html>
        ";
        exit();
    }
}

$conn->close();
?>