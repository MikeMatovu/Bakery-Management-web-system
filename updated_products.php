<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Purchases</title>
    <link rel="stylesheet" href="./assets/css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1a953be97e.js" crossorigin="anonymous"></script>
    <script src="assets/js/manageProducts.js"></script>
</head>

<body>
    <?php
    include "./includes/navbar.php"
    ?>
    <div class="container-fluid">
        <div class="container">
            <?php
            include "./includes/header.php";
            createHeader('bar-chart', 'Updated Products', 'View Updated Products');
            ?>

            <!-- form content -->
            <div class="row">

                <div class="col-md-4 form-group form-inline">
                    <label class="font-weight-bold" for="">Search :&emsp;</label>
                    <input type="text" class="form-control" id="by_name" placeholder="By Product Name" onkeyup="searchUpdatedProducts(this.value);">
                </div>

                <div class="col col-md-12">
                    <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
                </div>

                <div class="col col-md-12 table-responsive">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>User</th>
                                    <th>Old Product Name</th>
                                    <th>New Product Name</th>
                                    <th>Old Description</th>
                                    <th>New Description</th>
                                    <th>Old Price</th>
                                    <th>New Price</th>
                                    <th>Old Stock</th>
                                    <th>New Stock</th>
                                    <th>Old Expiry Date</th>
                                    <th>New Expiry Date</th>
                                    <th>Old Category</th>
                                    <th>New Category</th>
                                </tr>
                            </thead>
                            <tbody id="products_div">
                                <?php
                                require 'scripts/manageProducts.php';
                                showEditedProducts(0);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- form content end -->
            <hr style="border-top: 2px solid #ff5252;">
        </div>
    </div>
</body>

</html>