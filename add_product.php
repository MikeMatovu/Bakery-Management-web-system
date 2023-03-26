<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="./assets/css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1a953be97e.js" crossorigin="anonymous"></script>
    <script src="assets/js/suggestions.js"></script>
    <script src="assets/js/validateForm.js"></script>
    <script src="assets/js/restrict.js"></script>

</head>

<body>
    <?php
    include "./includes/navbar.html"
    ?>
    <div class="container-fluid">
        <div class="container">
            <?php
            include "./includes/header.php";
            createHeader('handshake', 'Add Product', 'Add New Product');
            ?>


            <!-- form content -->
            <div class="row">
                <div class="row col col-md-6">
                    <?php
                    require "./pages/addProduct.html";
                    ?>
                </div>
            </div>

            <hr style="border-top: 2px solid #ff5252;">
            <!-- form content end -->
        </div>
    </div>
</body>

</html>