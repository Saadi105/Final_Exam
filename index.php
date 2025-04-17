<?php include 'header.php'; ?>

<h2>Submit a Message</h2>

<form method="POST" action="">
    <input type="text" name="message" placeholder="Enter message" required>
    <button type="submit" name="submit">Submit</button>
</form>

<br>
<a href="showAll.php">Show all records</a>

<link rel="stylesheet" type="text/css" href="style.css">

<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'final');
    
    // Check if the connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize user input to prevent SQL injection
    $msg = $conn->real_escape_string($_POST['message']);

    // Insert message into the database
    if ($conn->query("INSERT INTO string_info (message) VALUES ('$msg')")) {
        echo "Message saved!";
    } else {
        echo "Error saving message: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

</body>
</html>
