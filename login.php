<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT id, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $email, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION["user_id"] = $id;
            $_SESSION["email"] = $email;
            header("Location: membership.php");
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Email not found.";
    }

    $stmt->close();
    $conn->close();
}
?>