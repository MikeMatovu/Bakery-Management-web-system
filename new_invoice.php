<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Invoice</title>
    <link rel="stylesheet" href="./assets/css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1a953be97e.js" crossorigin="anonymous"></script>
    <script src="assets/js/suggestionss.js"></script>
    <script src="assets/js/validateFormm.js"></script>
    <script src="assets/js/addNewInvoicee.js"></script>
</head>

<body>
    <?php
    include "./includes/navbar.php"
    ?>
    <div class="container-fluid">
        <div class="container">
            <?php
            include "./includes/header.php";
            createHeader('clipboard', 'New Invoice', 'Create New Invoice');
            ?>

            <!-- form content -->
            <div class="row">
                <!-- customer details content -->
                <div class="row col col-md-12">
                    <div class="col col-md-3 form-group">
                        <label class="font-weight-bold" for="customers_name">Customer Name :</label>
                        <input id="customer" type="text" class="form-control" placeholder="Customer Name" name="customers_name" onkeyup="showSuggestions(this.value, 'customer');">
                        <code class="text-danger small font-weight-bold float-right" id="customer_name_error" style="display: none;"></code>
                        <div id="customer_suggestions" class="list-group position-fixed" style="z-index: 1; width: 18.30%; overflow: auto; max-height: 200px;"></div>
                    </div>
                    <div class="col col-md-3 form-group">
                        <label class="font-weight-bold" for="customers_address">Address :</label>
                        <input id="customers_address" type="text" class="form-control" name="customers_address" placeholder="Address" disabled>
                    </div>
                    <div class="col col-md-2 form-group">
                        <label class="font-weight-bold" for="invoice_number">Invoice Number :</label>
                        <input id="invoice_number" type="text" class="form-control" name="invoice_number" placeholder="Invoice Number" disabled>
                    </div>
                    <div class="col col-md-2 form-group">
                        <label class="font-weight-bold" for="">Payment Type :</label>
                        <select id="payment_type" class="form-control">
                            <option value="1">Cash Payment</option>
                            <option value="2">Card Payment</option>
                            <option value="3">Internet Banking</option>
                        </select>
                    </div>
                    <div class="col col-md-2 form-group">
                        <label class="font-weight-bold" for="">Date :</label>
                        <input type="date" class="datepicker form-control hasDatepicker" id="invoice_date" value='<?php echo date('Y-m-d'); ?>' onblur="checkDate(this.value, 'date_error');">
                        <code class="text-danger small font-weight-bold float-right" id="date_error" style="display: none;"></code>
                    </div>
                </div>
                <!-- customer details content end -->

                <!-- new user button -->
                <div class="row col col-md-12">
                    <div class="col col-md-2 form-group">
                        <button class="btn btn-primary form-control" onclick="document.getElementById('add_new_customer_model').style.display = 'block';">New Customer</button>
                    </div>
                    <div class="col col-md-1 form-group"></div>
                    <div class="col col-md-2 form-group">
                        <label class="font-weight-bold" for="customers_contact_number">Contact Number :</label>
                        <input id="customers_contact_number" type="number" class="form-control" name="customers_contact_number" placeholder="Contact Number" disabled>
                    </div>
                </div>
                <!-- closing new user button -->

                <div class="col col-md-12">
                    <hr class="col-md-12" style="padding: 0px; border-top: 3px solid  #02b6ff;">
                </div>

                <!-- add medicines -->
                <div class="row col col-md-12">
                    <div class="row col col-md-12 font-weight-bold">
                        <div class="col col-md-2">Product Name</div>
                        <div class="col col-md-1">Category ID</div>
                        <div class="col col-md-1">Ava.Qty.</div>
                        <div class="col col-md-2">Expiry</div>
                        <div class="col col-md-1">Quantity</div>
                        <div class="col col-md-1">MRP</div>
                        <div class="col col-md-1">Discount(%)</div>
                        <div class="col col-md-1">Total</div>
                        <div class="col col-md-2">Action</div>
                    </div>
                </div>
                <div class="col col-md-12">
                    <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
                </div>

                <div class="row col col-md-12 " id="invoice_product_list_div">
                    <script>
                        addRow();
                        getInvoiceNumber();
                    </script>
                </div>

                <div class="row col col-md-12">
                    <div class="col col-md-6 form-group"></div>
                    <div class="col col-md-2 form-group float-right">
                        <label class="font-weight-bold" for="">Total Amount:</label>
                        <input type="text" class="form-control" value="0" id="total_amount" disabled>
                    </div>
                    <div class="col col-md-2 form-group float-right">
                        <label class="font-weight-bold" for="">Total Discount :</label>
                        <input type="text" class="form-control" value="0" id="total_discount" disabled>
                    </div>
                    <div class="col col-md-2 form-group float-right">
                        <label class="font-weight-bold" for="">Net Total :</label>
                        <input type="text" class="form-control" value="0" id="net_total" disabled>
                    </div>
                </div>

                <div class="col col-md-12">
                    <hr class="col-md-12" style="padding: 0px;">
                </div>

                <div class="row col col-md-12">
                    <div id="save_button" class="col col-md-2 form-group float-right">
                        <label class="font-weight-bold" for=""></label>
                        <button class="btn btn-success form-control font-weight-bold" onclick="addInvoice();">Save</button>
                    </div>
                    <div id="new_invoice_button" class="col col-md-2 form-group float-right" style="display: none;">
                        <label class="font-weight-bold" for=""></label>
                        <button class="btn btn-primary form-control font-weight-bold" onclick="location.reload();;">New Invoice</button>
                    </div>
                    <div id="print_button" class="col col-md-2 form-group float-right" style="display: none;">
                        <label class="font-weight-bold" for=""></label>
                        <button class="btn btn-warning form-control font-weight-bold" onclick="printInvoice(document.getElementById('invoice_number').value);">Print</button>
                    </div>
                    <div class="col col-md-4 form-group"></div>
                    <div class="col col-md-2 form-group float-right">
                        <label class="font-weight-bold" for="">Paid Amount :</label>
                        <input type="text" class="form-control" name="total_discount" onkeyup="getChange(this.value);">
                    </div>
                    <div class="col col-md-2 form-group float-right">
                        <label class="font-weight-bold" for="">Change :</label>
                        <input type="text" class="form-control" id="change_amt" disabled>
                    </div>
                </div>

                <div id="invoice_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;">
                </div>
            </div>

            <!-- form content end -->
            <hr style="border-top: 2px solid #ff5252;">

        </div>
    </div>
</body>

</html>