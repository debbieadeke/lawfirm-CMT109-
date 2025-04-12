<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Default for XAMPP
$password = ""; // Default for XAMPP (no password)
$database = "lawfirm"; // Change this to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clientid = $_POST['clientid'];
    $lawyerid = $_POST['lawyerid'];
    $appointmentdate = $_POST['appointmentdate'];
    $purpose = $_POST['purpose'];
    $status= $_POST['status'];


    // Prepare the SQL statement
    $sql = "INSERT INTO appointments ( clientid, lawyerid, appointmentdate,purpose, status) VALUES (?, ?, ?, ?, ?)";
    
    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $clientid, $lawyerid, $appointmentdate, $purpose, $status);
    
    // Execute and check if successful
    if ($stmt->execute()) {
        echo "<script>alert('Appointment added successfully!'); window.location.href='appointments.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
