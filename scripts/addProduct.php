<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';
if ($conn) {
    $name = ucwords($_GET["name"]);
    $quantity = $_GET["quantity"];
    $price = $_GET["price"];
    $description = strtoupper($_GET["description"]);
    $expiryDate = ucwords($_GET["expiry_date"]);
    $category = $_GET["category"];

    $query1 = "SELECT category_id FROM categories WHERE UPPER(category_name) = '" . strtoupper($category) . "'";
    $result = mysqli_query($conn, $query1);
    $row = mysqli_fetch_array($result);

    $category_id = $row['category_id'];

    // $query = "INSERT INTO products (product_name, description, price, stock_quantity,expiry_date, category_id) VALUES('$name', '$description', '$price', '$quantity', '$expiryDate', '$category_id')";
    // $result = mysqli_query($conn, $query);
    // if (!empty($result))
    //     echo "$name added...";
    // else
    //     echo "Failed to add $name!";


    $stmt = $conn->prepare("CALL add_product(?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sidsss", $name, $quantity, $price, $description, $expiryDate, $category_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0)
        echo "$name added...";
    else
        echo "Failed to add $name! Error: " . $stmt->error;
}
