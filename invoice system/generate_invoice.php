<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST["item"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $total = $price * $quantity;

    // Connect to the database 
    $conn = new mysqli("localhost", "root", "", "invoice_system");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the 'invoices' table
    $sql = "INSERT INTO invoices (item, price, quantity, total) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdd", $item, $price, $quantity, $total);

    if ($stmt->execute()) {
        echo "Item added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
