<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "link_tracker";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = $_POST["link"];
    } else {
        $link = $_GET["link"];
    }

    // Prepare and execute SQL statement
    $clientIP = $_SERVER['REMOTE_ADDR'];

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("INSERT INTO links (link, ip) VALUES (?, ?)");
    $stmt->bind_param("ss", $link, $clientIP);
    
    if ($stmt->execute()) {
        echo "Link submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    

    $conn->close();