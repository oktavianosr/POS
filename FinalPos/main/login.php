<?php
session_start();

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'point_of_sales');

// Cek apakah form login telah diisi
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa apakah username dan password benar
    $sql = "SELECT * FROM member WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    // Cek apakah data member ditemukan
    if ($result->num_rows > 0) {
        // Simpan data member ke dalam session
        $_SESSION['member_id'] = $result->fetch_assoc()['id'];
        $_SESSION['member_name'] = $result->fetch_assoc()['name'];

        // Redirect ke halaman utama
        header('Location:index.php');
        exit;
    } else {
        // Tampilkan pesan error jika username atau password salah
        echo 'Username atau password salah';
    }
}

// Tampilkan form login
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
        /* Body Styling */
        body {
            background-color: #f0f8ff; /* Light Blue */
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Container Styling */
        .container-fluid {
            width: 100%;
            max-width: 400px;
            background-color: #ffffff; /* White Background */
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow Effect */
        }

        /* Content Class for Form */
        .content form label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        .content form input[type="text"], 
        .content form input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #d0d0d0;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .content form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff; /* Blue */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .content form input[type="submit"]:hover {
            background-color: #0056b3; /* Darker Blue */
        }

        /* Responsive Styling */
        @media (max-width: 768px) { /* Tablet and smaller devices */
            .container-fluid {
                padding: 20px 15px;
                max-width: 90%;
            }

            .content form input[type="text"], 
            .content form input[type="password"], 
            .content form input[type="submit"] {
                font-size: 14px; /* Adjust font size for smaller screens */
                padding: 10px; /* Reduce padding for compact display */
            }
        }

        @media (max-width: 480px) { /* Smartphone devices */
            body {
                padding: 20px;
                height: auto; /* Allow scroll for small devices */
            }

            .container-fluid {
                max-width: 100%; /* Full-width for small screens */
                padding: 15px; /* Reduce padding */
            }

            .content form label {
                font-size: 14px; /* Smaller labels */
            }

            .content form input[type="text"], 
            .content form input[type="password"], 
            .content form input[type="submit"] {
                font-size: 12px; /* Compact input size */
                padding: 8px; /* Reduce padding further */
            }
        }
    </style>
<body>
    <div class="container-fluid">
        <div class="content">
            <form action="" method="post" class="login-form">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username"><br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password"><br><br>
                <input type="submit" value="Login">
            </form>
        </div>
        
    </div>
    
</body>
</html>