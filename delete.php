<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "myshop";

    // Create connection
    $connection = mysqli_connect($servername, $username, $password, $database);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $connection->prepare("DELETE FROM clients WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        $connection->close();
        header("location: /myshop/index.php");
        exit;
    } else {
        echo "Error deleting record: " . $connection->error;
    }

    $stmt->close();
    $connection->close();
} else {
    header("location: /myshop/index.php");
    exit;
}
?>
