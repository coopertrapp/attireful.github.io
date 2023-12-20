<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);

    if ($stmt->execute()) {
        header("Location: login.html");
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
