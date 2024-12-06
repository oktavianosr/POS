<?php
session_start();
session_destroy();
echo json_encode(["message" => "Logged out successfully"]);
header("location:../index.php");
exit;
?>
