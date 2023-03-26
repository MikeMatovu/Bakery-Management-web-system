<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';

if ($conn) {
    if (isset($_GET['action']) && $_GET['action'] == "category")

        showSuggestions($conn, "categories", "category");

    // if(isset($_GET['action']) && $_GET['action'] == "customer")
    //   showSuggestions($conn, "customers", "customer");

    // if(isset($_GET['action']) && $_GET['action'] == "medicine")
    //   showSuggestions($conn, "medicines", "medicine");

    // if(isset($_GET['action']) && $_GET['action'] == "customers_address")
    //   getValue($conn, $_GET['action'], "ADDRESS");

    // if(isset($_GET['action']) && $_GET['action'] == "customers_contact_number")
    //   getValue($conn, $_GET['action'], "CONTACT_NUMBER");
}

function showSuggestions($conn, $table, $action)
{

    $text = strtoupper($_GET["text"]);
    $query = "SELECT * FROM $table WHERE UPPER(category_name) LIKE '%$text%'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    if (mysqli_num_rows($result) == 0)
        echo '<div class="list-group-item list-group-item-action font-italic" style="padding: 5px;" disabled>No suggestions...</div>';
    while ($row = mysqli_fetch_array($result))
        echo '<input type="button" class="list-group-item list-group-item-action" value="' . $row['category_name'] . '" style="padding: 5px; outline: none;" onclick="suggestionClick(this.value, \'' . $action . '\');">';
}

function getValue($con, $action, $column)
{
    $name = $_GET['name'];
    $query = "SELECT * FROM customers WHERE NAME = '$name'";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result))
        echo $row[$column];
}
