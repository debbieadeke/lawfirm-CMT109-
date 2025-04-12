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
    $casedetails = $_POST['casedetails'];
    $status = $_POST['status'];
    $filingdate = $_POST['filingdate'];
    $closingdate = $_POST['closingdate'];


    // Prepare the SQL statement
    $sql = "INSERT INTO cases ( clientid, lawyerid, casedetails,status, filingdate, closingdate) VALUES (?, ?, ?, ?, ?, ?)";
    
    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissss", $clientid, $lawyerid, $casedetails, $status, $filingdate, $closingdate);
    
    // Execute and check if successful
    if ($stmt->execute()) {
        echo "<script>alert('Case added successfully!'); window.location.href='cases_hearings.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
