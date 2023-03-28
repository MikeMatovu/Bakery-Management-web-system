<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/css/sidenav.css" />
  <script defer src="../assets/js/navbar.js"></script>
</head>

<body>
  <div class="sidenav">
    <div class="card">
      <div class="card-body">
        <div class="logo">
          <img src="./assets/images/prof.jpg" class="profile" />
          <h1 class="logo-caption"><span class="tweak">A</span>dmin</h1>
        </div>
        <!-- logo class -->

        <!-- dashboard start -->
        <div class="main-menu-item">
          <a href="index.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
        </div>
        <!-- dashboard end -->

        <!-- invoice strat -->
        <div id="first" class="main-menu-item" onclick="showhide(this.id);">
          <a href="#">
            <i class="fa fa-balance-scale"></i><span>Invoice</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none">
            <li class="treeview">
              <a href="../new_invoice.php">New Invoice</a>
            </li>
            <li class="treeview">
              <a href="../manage_invoice.php">Manage Invoice </a>
            </li>
          </ul>
        </div>
        <!-- invoice end -->

        <!-- customer end -->
        <div id="second" class="main-menu-item" onclick="showhide(this.id);">
          <a href="#">
            <i class="fa fa-handshake"></i><span>Customer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none">
            <li class="treeview">
              <a href="../add_customer.php">Add Customer</a>
            </li>
            <li class="treeview">
              <a href="../manage_customer.php">Manage Customer</a>
            </li>
          </ul>
        </div>
        <!-- customer end -->

        <!-- medicine strat -->
        <div id="third" class="main-menu-item" onclick="showhide(this.id);">
          <a href="#">
            <i class="fa fa-shopping-bag"></i><span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none">
            <li class="treeview">
              <a href="../add_product.php">Add Product</a>
            </li>
            <li class="treeview">
              <a href="manage_products.php">Manage Products</a>
            </li>
            <li class="treeview">
              <a href="manage_medicine_stock.php">Manage Products Stock</a>
            </li>
          </ul>
        </div>
        <!-- medicine end -->

        <!-- manufacturer start -->
        <div id="fourth" class="main-menu-item" onclick="showhide(this.id);">
          <a href="#">
            <i class="fa fa-group"></i><span>Supplier</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none">
            <li class="treeview">
              <a href="../add_supplier.php">Add Supplier</a>
            </li>
            <li class="treeview">
              <a href="manage_supplier.php">Manage Supplier</a>
            </li>
          </ul>
        </div>
        <!-- manufacturer end -->

        <!-- purchase start -->
        <div id="fifth" class="main-menu-item" onclick="showhide(this.id);">
          <a href="#">
            <i class="fa fa-bar-chart"></i><span>Purchase</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none">
            <li class="treeview">
              <a href="../add_purchase.php">Add Purchase</a>
            </li>
            <li class="treeview">
              <a href="manage_purchases.php">Manage Purchase</a>
            </li>
          </ul>
        </div>
        <!-- purchase end -->

        <!-- report start -->
        <?php
        if (isset($_SESSION['user_id']) && $_SESSION['is_admin'] == 1) {
          echo ' <div id="sixth" class="main-menu-item" onclick="showhide(this.id);">
          <a href="#">
            <i class="fa fa-book"></i><span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none">
            <li class="treeview">
              <a href="../updated_products.php">Updated Products Report</a>
            </li>
            <li class="treeview">
              <a href="purchase_report.php">Purchase Report</a>
            </li>
          </ul>
        </div>';
        }
        ?>

        <!-- report end -->

        <!-- search start -->
        <div id="seventh" class="main-menu-item" onclick="showhide(this.id);">
          <a href="#">
            <i class="fa fa-search"></i><span>Search</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none">
            <li class="treeview"><a href="manage_invoice.php">Invoice</a></li>
            <li class="treeview">
              <a href="manage_customer.php">Customer</a>
            </li>
            <li class="treeview">
              <a href="manage_medicine.php">Products</a>
            </li>
            <li class="treeview">
              <a href="manage_supplier.php">Supplier</a>
            </li>
            <li class="treeview">
              <a href="manage_purchase.php">Purchase</a>
            </li>
          </ul>
        </div>
        <!-- search end -->
      </div>
      <!-- card-body class -->
    </div>
    <!-- card  -->
  </div>
</body>

</html>