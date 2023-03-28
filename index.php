<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1a953be97e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/index.css">
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
    ?>
    <?php
    include("./includes/navbar.php");
    ?>
    <div class="container-fluid">
        <div class="container">
            <!-- header section -->
            <?php
            require "./includes/header.php";
            createHeader('home', 'Dashboard', 'Home');
            ?>
            <!-- header section end -->

            <!-- form content -->
            <div class="row">
                <div class="row col col-xs-8 col-sm-8 col-md-8 col-lg-8">

                    <?php
                    function createSection1($location, $title, $table)
                    {
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';

                        $query = "SELECT * FROM $table";
                        if ($title == "Out of Stock")
                            $query = "SELECT * FROM $table WHERE QUANTITY = 0";

                        $result = mysqli_query($conn, $query);
                        $count = mysqli_num_rows($result);


                        if ($title == "Expired") {
                            // logic
                            $count = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                $expiry_date = $row['expiry_date'];
                                if (substr($expiry_date, 3) < date('y'))
                                    $count++;
                                else if (substr($expiry_date, 3) == date('y')) {
                                    if (substr($expiry_date, 0, 2) < date('m'))
                                        $count++;
                                }
                            }
                        }

                        echo '
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="padding: 10px">
                    <div class="dashboard-stats" onclick="location.href=\'' . $location . '\'">
                      <a class="text-dark text-decoration-none" href="' . $location . '">
                        <span class="h4">' . $count . '</span>
                        <span class="h6"><i class="fa fa-play fa-rotate-270 text-warning"></i></span>
                        <div class="small font-weight-bold">' . $title . '</div>
                      </a>
                    </div>
                  </div>
                ';
                    }
                    createSection1('manage_products.php', 'Total Products', 'products');
                    createSection1('manage_categories.php', 'Total Categories', 'categories');
                    createSection1('manage_orders.php', 'Total Orders', 'orders');
                    //  createSection1('manage_medicine_stock.php?out_of_stock', 'Out of Stock', 'medicines_stock');
                    // createSection1('manage_medicine_stock.php?expired', 'Expired', 'medicines_stock');
                    createSection1('manage_invoice.php', 'Total Invoices', 'invoices');
                    ?>

                </div>

                <div class="col col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding: 7px 0; margin-left: 15px;">
                    <div class="todays-report">
                        <div class="h5">Todays Report</div>
                        <table class="table table-bordered table-striped table-hover">
                            <tbody>
                                <?php
                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';
                                if ($conn) {
                                    $date = date('Y-m-d');
                                ?>
                                    <tr>
                                        <?php
                                        $total = 0;
                                        $query = "SELECT total_amount FROM invoices WHERE payment_date = '$date'";
                                        $result = mysqli_query($conn, $query);

                                        while ($row = mysqli_fetch_array($result))
                                            $total = $total + $row['total_amount'];
                                        ?>
                                        <th>Total Sales</th>
                                        <th class="text-success">Shs. <?php echo $total; ?></th>
                                    </tr>
                                    <tr>
                                    <?php
                                    //echo $date;
                                    $total = 0;
                                    $query = "SELECT total_amount FROM invoices WHERE payment_date = '$date'";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($result))
                                        $total = $total + $row['total_amount'];
                                }
                                    ?>
                                    <th>Total Purchase</th>
                                    <th class="text-danger">Shs. <?php echo $total; ?></th>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <hr style="border-top: 2px solid #ff5252;">

            <div class="row">

                <?php
                function createSection2($icon, $location, $title)
                {
                    echo '
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="padding: 10px;">
              		<div class="dashboard-stats" style="padding: 30px 15px;" onclick="location.href=\'' . $location . '\'">
              			<div class="text-center">
                      <span class="h1"><i class="fa fa-' . $icon . ' p-2"></i></span>
              				<div class="h5">' . $title . '</div>
              			</div>
              		</div>
                </div>
              ';
                }
                createSection2('address-card', 'new_invoice.php', 'Create New Invoice');
                createSection2('handshake', 'add_customer.php', 'Add New Customer');
                createSection2('shopping-bag', 'add_product.php', 'Add New Product');
                createSection2('group', 'add_supplier.php', 'Add New Supplier');
                createSection2('bar-chart', 'add_purchase.php', 'Add New Purchase');
                createSection2('book', 'sales_report.php', 'Sales Report');
                createSection2('book', 'purchase_report.php', 'Purchase Report');
                createSection2('book', 'purchase_report.php', 'Purchase Report');
                ?>

            </div>
            <!-- form content end -->

            <hr style="border-top: 2px solid #ff5252;">

        </div>
    </div>
</body>

</html>