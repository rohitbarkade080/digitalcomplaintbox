<?php
$servername = "localhost:3307";
$username = "root";
$password = ""; // रिकामं ठेवा जर root ला पासवर्ड नसेल
$database = "system_box";

$conn = new mysqli($servername, $username, $password, $database);

// ✅ Error Handle
if ($conn->connect_error) {
    die("<h3 style='color:red;'>Database Connection Failed: " . $conn->connect_error . "</h3>");
} else {
    // Optional: Connection success message check करण्यासाठी (development साठी)
    // echo "<p style='color:lime;'>Database Connected Successfully</p>";
}
?>

