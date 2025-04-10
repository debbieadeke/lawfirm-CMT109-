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
    $case_number = $_POST['case_number'];
    $client_id = $_POST['client_id'];
    $lawyer_id = $_POST['lawyer_id'];
    $case_details = $_POST['case_details'];
    $status = $_POST['status'];
    $filing_date = $_POST['filing_date'];
    $closing_date = $_POST['closing_date'];


    // Prepare the SQL statement
    $sql = "INSERT INTO cases (case_number, client_id, lawyer_id, case_details,status, filing_date, closing_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siissss", $case_number, $client_id, $lawyer_id, $case_details, $status, $filing_date, $closing_date);
    
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
