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
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $specialization = $_POST['specialization'];
    $experience = $_POST['experience'];

    // Prepare the SQL statement
    $sql = "INSERT INTO lawyers (name, contact,email, specialization, experience) VALUES (?, ?, ?, ?, ?)";
    
    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $contact,$email, $specialization, $experience);
    
    // Execute and check if successful
    if ($stmt->execute()) {
        echo "<script>alert('Lawyer added successfully!'); window.location.href='clients_lawyers.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
