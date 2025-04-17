<?php include 'header.php'; ?>
<h2>All Records</h2>
<link rel="stylesheet" type="text/css" href="style.css">

<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'final');

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch and display all records from string_info
$result = $conn->query("SELECT * FROM string_info");

if ($result->num_rows > 0) {
    // Display each record
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['string_id'] . " - Message: " . $row['message'] . "<br>";
    }
} else {
    echo "No records found.";
}
?>

<h3>Delete Record</h3>
<!-- Form for deleting a record -->
<form method="POST" action="">
    <input type="number" name="delete_id" placeholder="Enter string_id to delete" required>
    <button type="submit" name="delete">Delete</button>
</form>

<?php
// Handle deletion when form is submitted
if (isset($_POST['delete'])) {
    // Get the ID to delete and sanitize it
    $id = intval($_POST['delete_id']);
    
    // Run the delete query
    if ($conn->query("DELETE FROM string_info WHERE string_id = $id")) {
        echo "Record deleted!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

</body>
</html>
