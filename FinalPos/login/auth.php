<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'point_of_sales');

// Handle GET request untuk memeriksa sesi login
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION['username'])) {
        echo json_encode([
            "username" => $_SESSION['username'],
            "role" => $_SESSION['role']
        ]);
    } else {
        http_response_code(401);
        echo json_encode(["message" => "Not logged in"]);
    }
    exit();
}

// // Handle POST request untuk login
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     // Query untuk memeriksa user
//     $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
//     $stmt->bind_param("ss", $username, $password);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if ($result->num_rows === 1) {
//         $user = $result->fetch_assoc();
//         $_SESSION['username'] = $user['username'];
//         $_SESSION['role'] = $user['role'];

//         // Redirect berdasarkan role
//         if ($user['role'] === 'admin') {
//             header("Location: ../dashboard/");
//         } elseif ($user['role'] === 'user') {
//             header("Location: ../public/index.php");
//         } else {
//             echo "Role tidak dikenali.";
//         }
//     } else {
//         echo "Username atau password salah!";
//     }
// }
?>
