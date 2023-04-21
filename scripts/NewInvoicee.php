<?php

if (isset($_GET['action']) && $_GET['action'] == "add_row")
    createProductInfoRow();

// if (isset($_GET['action']) && $_GET['action'] == "is_customer")
//     isCustomer(strtoupper($_GET['name']), $_GET['contact_number']);

// if (isset($_GET['action']) && $_GET['action'] == "is_invoice")
//     isInvoiceExist($_GET['invoice_number']);

// if (isset($_GET['action']) && $_GET['action'] == "is_medicine")
//     isMedicine(strtoupper($_GET['name']));

if (isset($_GET['action']) && $_GET['action'] == "current_invoice_number")
    getInvoiceNumber();

if (isset($_GET['action']) && $_GET['action'] == "product_list")
    showProductList(strtoupper($_GET['text']));

if (isset($_GET['action']) && $_GET['action'] == "fill")
    fill(strtoupper($_GET['name']), $_GET['column']);

if (isset($_GET['action']) && $_GET['action'] == "check_quantity")
    checkAvailableQuantity(strtoupper($_GET['product_name']));

// if (isset($_GET['action']) && $_GET['action'] == "update_stock")
//     updateStock(strtoupper($_GET['name']), $_GET['batch_id'], intval($_GET['quantity']));

// if (isset($_GET['action']) && $_GET['action'] == "add_sale")
//     addSale();

if (isset($_GET['action']) && $_GET['action'] == "add_new_invoice")
    addNewInvoice();

function isCustomer($name, $contact_number)
{
    require "db_connection.php";
    if ($con) {
        $query = "SELECT * FROM customers WHERE UPPER(NAME) = '$name' AND CONTACT_NUMBER = '$contact_number'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        echo ($row) ? "true" : "false";
    }
}

function isInvoiceExist($invoice_number)
{
    require "db_connection.php";
    if ($con) {
        $query = "SELECT * FROM sales WHERE INVOICE_NUMBER = $invoice_number";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        echo ($row) ? "true" : "false";
    }
}

function isMedicine($name)
{
    require "db_connection.php";
    if ($con) {
        $query = "SELECT * FROM medicines_stock WHERE UPPER(NAME) = '$name'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        echo ($row) ? "true" : "false";
    }
}

function createProductInfoRow()
{
    $row_id = $_GET['row_id'];
    $row_number = $_GET['row_number'];
?>
    <div class="row col col-md-12">
        <div class="col-md-2">
            <input id="product_name_<?php echo $row_number; ?>" name="product_name" class="form-control" list="product_list_<?php echo $row_number; ?>" placeholder="Select Product" onkeydown="productOptions(this.value, 'product_list_<?php echo $row_number; ?>');" onfocus="productOptions(this.value, 'product_list_<?php echo $row_number; ?>');" onchange="fillFields(this.value, '<?php echo $row_number; ?>');">
            <code class="text-danger small font-weight-bold float-right" id="product_name_error_<?php echo $row_number; ?>" style="display: none;"></code>
            <datalist id="product_list_<?php echo $row_number; ?>" style="display: none; max-height: 200px; overflow: auto;">
                <?php showProductList("") ?>
            </datalist>

        </div>
        <div class="col col-md-1"><input type="text" class="form-control" id="category_id_<?php echo $row_number; ?>" disabled></div>
        <div class="col col-md-1"><input type="number" class="form-control" id="available_quantity_<?php echo $row_number; ?>" disabled></div>
        <div class="col col-md-2"><input type="text" class="form-control" id="expiry_date_<?php echo $row_number; ?>" disabled></div>
        <div class="col col-md-1">
            <input type="number" class="form-control" id="quantity_<?php echo $row_number; ?>" value="0" onkeyup="getTotal('<?php echo $row_number; ?>');" onblur="checkAvailableQuantity(this.value, '<?php echo $row_number; ?>');">
            <code class="text-danger small font-weight-bold float-right" id="quantity_error_<?php echo $row_number; ?>" style="display: none;"></code>
        </div>
        <div class="col col-md-1"><input type="number" class="form-control" id="mrp_<?php echo $row_number; ?>" onchange="getTotal('<?php echo $row_number; ?>');" disabled></div>
        <div class="col col-md-1">
            <input type="number" class="form-control" id="discount_<?php echo $row_number; ?>" value="0" onkeyup="getTotal('<?php echo $row_number; ?>');">
            <code class="text-danger small font-weight-bold float-right" id="discount_error_<?php echo $row_number; ?>" style="display: none;"></code>
        </div>
        <div class="col col-md-1"><input type="number" class="form-control" id="total_<?php echo $row_number; ?>" disabled></div>
        <div class="col col-md-2">
            <button class="btn btn-primary" onclick="addRow();">
                <i class="fa fa-plus"></i>
            </button>
            <button class="btn btn-danger" onclick="removeRow('<?php echo $row_id ?>');">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    </div>
    <div class="col col-md-12">
        <hr class="col-md-12" style="padding: 0px;">
    </div>
<?php
}

function getInvoiceNumber()
{
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';
    if ($conn) {
        $query = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'bakery_management' AND TABLE_NAME = 'invoices';";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        echo $row['AUTO_INCREMENT'];
    }
}

function showProductList($text)
{
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';
    if ($conn) {
        if ($text == "")
            $query = "SELECT DISTINCT product_name FROM products";
        else
            $query = "SELECT DISTINCT product_name FROM products WHERE UPPER(product_name) LIKE '%$text%'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result))
            echo '<option value="' . $row['product_name'] . '">' . $row['product_name'] . '</option>';
    }
}

function fill($name, $column)
{
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';
    if ($conn) {
        $query = "SELECT * FROM products WHERE UPPER(product_name) = '$name' ORDER BY expiry_date ASC 
        LIMIT 1";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) != 0) {
            $row = mysqli_fetch_array($result);
            echo $row[$column];
        }
    }
}

function checkAvailableQuantity($name)
{
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';
    if ($conn) {
        $query = "SELECT quantity FROM products WHERE UPPER(product_name) = '$name'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        echo ($row) ? $row['quantity'] : "false";
    }
}

function updateStock($name, $batch_id, $quantity)
{
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';
    if ($conn) {
        $query = "UPDATE medicines_stock SET QUANTITY = QUANTITY - $quantity WHERE UPPER(NAME) = '$name' AND BATCH_ID = '$batch_id'";
        $result = mysqli_query($conn, $query);
        echo ($result) ? "stock updated" : "failed to update stock";
    }
}

function getCustomerId($name, $contact_number)
{
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';
    if ($conn) {
        $query = "SELECT customer_id FROM customers WHERE UPPER(customer_name) = '$name' AND phone_number = '$contact_number'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        return ($row) ? $row['customer_id'] : 0;
    }
}

function addSale()
{
    $customer_id = getCustomerId(strtoupper($_GET['customers_name']), $_GET['customers_contact_number']);
    $invoice_number = $_GET['invoice_number'];
    $medicine_name = $_GET['medicine_name'];
    $batch_id = $_GET['batch_id'];
    $expiry_date = $_GET['expiry_date'];
    $quantity = $_GET['quantity'];
    $mrp = $_GET['mrp'];
    $discount = $_GET['discount'];
    $total = $_GET['total'];

    require "db_connection.php";
    if ($con) {
        $query = "INSERT INTO sales (CUSTOMER_ID, INVOICE_NUMBER, MEDICINE_NAME, BATCH_ID, EXPIRY_DATE, QUANTITY, MRP, DISCOUNT, TOTAL) VALUES($customer_id, $invoice_number, '$medicine_name', '$batch_id', '$expiry_date', $quantity, $mrp, $discount, $total)";
        $result = mysqli_query($con, $query);
        echo ($result) ? "inserted sale" : "falied to add sale...";
    }
}

function addNewInvoice()
{
    $customer_id = getCustomerId(strtoupper($_GET['customers_name']), $_GET['customers_contact_number']);
    $invoice_date = $_GET['invoice_date'];
    //$payment_status = ($_GET['payment_type'] == "");
    $total_amount = $_GET['total_amount'];
    $total_discount = $_GET['total_discount'];
    $net_total = $_GET['net_total'];
    $payment_status = 'paid';
    $payment_date = $_GET['invoice_date'];
    $product_name = $_GET['product_name'];
    $quantity = $_GET['quantity'];

    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';
    if ($conn) {
        $query = "INSERT INTO invoices (customer_id, invoice_date, total_amount, total_discount, net_total, payment_status, payment_date) VALUES($customer_id, '$invoice_date', $total_amount, $total_discount, $net_total, '$payment_status', '$payment_date')";
        $result = mysqli_query($conn, $query);
        // echo ($result) ? "Invoice saved..." : "falied to add invoice...";
        // echo $query;


        $query2 = "SELECT product_id FROM products WHERE UPPER(product_name) = '$product_name' ORDER BY expiry_date ASC 
        LIMIT 1";
        $result2 = mysqli_query($conn, $query2);
        if (mysqli_num_rows($result2) == 1) {

            $row = mysqli_fetch_assoc($result2);
            $product_id = $row['product_id'];
        }
        $stmt = $conn->prepare("CALL update_product_quantity(?, ?)");
        $stmt->bind_param("ii", $product_id, $quantity);
        $stmt->execute();

        if ($stmt->affected_rows > 0)
            echo "Invoice saved...";
        else
            echo "Failed to add ! Error: " . $stmt->error;
    }
}
?>