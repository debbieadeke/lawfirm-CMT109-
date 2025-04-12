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
    $caseid = $_POST['caseid'];
    $hearingdate = $_POST['hearingdate'];
    $judgename = $_POST['judgename'];
    $courtlocation = $_POST['courtlocation'];
    $outcome = $_POST['outcome'];


    // Prepare the SQL statement
    $sql = "INSERT INTO hearings ( caseid, hearingdate, judgename,courtlocation, outcome) VALUES (?, ?, ?, ?, ?)";
    
    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $caseid, $hearingdate, $judgename, $courtlocation, $outcome);
    
    // Execute and check if successful
    if ($stmt->execute()) {
        echo "<script>alert('Hearing added successfully!'); window.location.href='cases_hearings.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
