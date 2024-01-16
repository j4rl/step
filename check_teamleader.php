<?php
// Connect to the database (replace these with your database credentials)
$servername = "localhost";
$username = "mockelngymnasie";
$password = "PPeTExVh";
$dbname = "mockelngymnasie";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to check if a username already exists in the database
function isTeamleader($teamleader, $conn) {
    $query = "SELECT * FROM tblteam WHERE teamleader = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $teamleader);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// Check if the username is taken
if (isset($_POST['teamleader'])) {
    $teamleader = intval($_POST['teamleader']);

    if (isUsernameTaken($teamleader, $conn)) {
        echo "Användarnamnet finns redan.";
    } else {
        echo "Användarnamnet är ledigt";
    }
}

// Close the database connection
$conn->close();
?>
