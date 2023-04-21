<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';

if ($conn) {
    if (isset($_GET['action']) && $_GET['action'] == "category")

        showSuggestions($conn, "categories", "category");

    if (isset($_GET['action']) && $_GET['action'] == "customer")
        showSuggestions($conn, "customers", "customer");

    // if(isset($_GET['action']) && $_GET['action'] == "medicine")
    //   showSuggestions($conn, "medicines", "medicine");

    if(isset($_GET['action']) && $_GET['action'] == "customers_address")
      getValue($conn, $_GET['action'], "address");

    if(isset($_GET['action']) && $_GET['action'] == "customers_contact_number")
      getValue($conn, $_GET['action'], "phone_number");
}

function showSuggestions($conn, $table, $action)
{
    $column_name = $action . '_name';
    $text = strtoupper($_GET["text"]);
    $query = "SELECT * FROM $table WHERE UPPER(" . $action . "_name) LIKE '%$text%'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    if (mysqli_num_rows($result) == 0)
        echo '<div class="list-group-item list-group-item-action font-italic" style="padding: 5px;" disabled>No suggestions...</div>';
    while ($row = mysqli_fetch_array($result))

        echo '<input type="button" class="list-group-item list-group-item-action" value="' . $row[$column_name] . '" style="padding: 5px; outline: none;" onclick="suggestionClick(this.value, \'' . $action . '\');">';
}

function getValue($conn, $action, $column)
{
    $name = $_GET['name'];
    $query = "SELECT * FROM customers WHERE customer_name = '$name'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result))
        echo $row[$column];
}
