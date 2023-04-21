var rows = 0;

function addRow() {
  if (typeof addRow.counter == "undefined") addRow.counter = 1;
  var previous = document.getElementById("invoice_product_list_div").innerHTML;
  var node = document.createElement("div");
  var cls = document.createAttribute("id");
  cls.value = "product_row_" + addRow.counter;
  node.setAttributeNode(cls);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if ((xhttp.readyState = 4 && xhttp.status == 200)) {
      node.innerHTML = xhttp.responseText;
      document.getElementById("invoice_product_list_div").appendChild(node);
    }
  };
  xhttp.open(
    "GET",
    "./scripts/newInvoicee.php?action=add_row&row_id=" +
      cls.value +
      "&row_number=" +
      addRow.counter,
    true
  );
  xhttp.send();
  //alert(addRow.counter);
  addRow.counter++;
  rows++;
}

function removeRow(row_id) {
  if (rows == 1) alert("Can't delete only one row is there!");
  else {
    document.getElementById(row_id).remove();
    rows--;
  }
}

function getInvoiceNumber() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if ((xhttp.readyState = 4 && xhttp.status == 200))
      document.getElementById("invoice_number").value = xhttp.responseText;
  };
  xhttp.open(
    "GET",
    "./scripts/newInvoicee.php?action=current_invoice_number",
    true
  );
  xhttp.send();
}

function productOptions(text, id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if ((xhttp.readyState = 4 && xhttp.status == 200))
      document.getElementById(id).innerHTML = xhttp.responseText;
  };
  xhttp.open(
    "GET",
    "./scripts/newInvoicee.php?action=product_list&text=" + text.trim(),
    true
  );
  xhttp.send();
}

function fillFields(product_name, id) {
  fill(product_name, "category_id_" + id, "category_id");
  fill(product_name, "available_quantity_" + id, "stock_quantity");
  fill(product_name, "expiry_date_" + id, "expiry_date");
  fill(product_name, "mrp_" + id, "price");
  getTotal(id);
  var expiry_date = document.getElementById("expiry_date_" + id).value;
  //alert(expiry_date);
  if (checkExpiry(expiry_date, "product_name_error_" + id) != -1)
    document.getElementById("product_name_error_" + id).style.display = "none";
  else return;
  var available_quantity = document.getElementById(
    "available_quantity_" + id
  ).value;
  if (!checkAvailableQuantity(available_quantity, id)) return;
  document.getElementById("product_name_" + id).blur();
}

function fill(name, field_name, column) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if ((xhttp.readyState = 4 && xhttp.status == 200))
      document.getElementById(field_name).value = xhttp.responseText;
  };
  xhttp.open(
    "GET",
    "./scripts/newInvoicee.php?action=fill&name=" + name + "&column=" + column,
    false
  );
  xhttp.send();
}

function getTotal(id) {
  var mrp = document.getElementById("mrp_" + id).value;
  var qty = document.getElementById("quantity_" + id).value;
  if (!checkQuantity(qty, "quantity_error_" + id)) return;
  var discount = document.getElementById("discount_" + id).value;
  if (!checkValue(discount, "discount_error_" + id)) return;
  var total = document.getElementById("total_" + id);
  total.value = mrp * qty - (discount * mrp * qty) / 100;

  // net total , discount and total Amount
  var parent = document.getElementById("invoice_product_list_div");
  var row_count = parent.childElementCount;
  var product_info = parent.children;
  var total_amount = 0;
  var total_discount = 0;
  var net_total = 0;
  for (var i = 1; i < row_count; i++) {
    qty = Number.parseInt(
      product_info[i].children[0].children[4].children[0].value
    );
    mrp = Number.parseFloat(
      product_info[i].children[0].children[5].children[0].value
    );
    discount =
      (qty *
        mrp *
        Number.parseFloat(
          product_info[i].children[0].children[6].children[0].value
        )) /
      100;

    total_amount += qty * mrp;
    total_discount += discount;
  }
  net_total = total_amount - total_discount;
  document.getElementById("total_amount").value = total_amount;
  document.getElementById("total_discount").value = total_discount;
  document.getElementById("net_total").value = net_total;
}

function checkAvailableQuantity(value, id) {
  var product_name = document.getElementById("product_name_" + id).value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if ((xhttp.readyState = 4 && xhttp.status == 200)) xhttp.responseText;
  };
  xhttp.open(
    "GET",
    "./scripts/newInvoicee.php??action=check_quantity&product_name=" +
      product_name,
    false
  );
  xhttp.send();
  if (Number.parseInt(xhttp.responseText) == 0) {
    document.getElementById("product_name_error_" + id).style.display = "block";
    document.getElementById("product_name_error_" + id).innerHTML =
      "Out of Stock!";
    //alert("medicine_name_error_" + id);
    return -1;
  } else if (value > Number.parseInt(xhttp.responseText)) {
    document.getElementById("quantity_error_" + id).style.display = "block";
    document.getElementById("quantity_error_" + id).innerHTML =
      "only " + xhttp.responseText + " in stock!";
    return -2;
  }
  return 999;
}

function getChange(paid_amt) {
  var net_total = document.getElementById("net_total").value;
  document.getElementById("change_amt").value = paid_amt - net_total;
}

function addInvoice() {
  console.log(43673287);
  // save invoice
  var customers_name = document.getElementById("customer");
  var customers_contact_number = document.getElementById(
    "customers_contact_number"
  );
  var invoice_number = document.getElementById("invoice_number");
  var payment_type = document.getElementById("payment_type");
  var invoice_date = document.getElementById("invoice_date");
  var total_amount = document.getElementById("total_amount");
  var total_discount = document.getElementById("total_discount");
  var net_total = document.getElementById("net_total");
  var product_name = document.getElementById("product_name_1");
  var quantity = document.getElementById("quantity_1");

  addNewInvoice(
    customers_name.value,
    customers_contact_number.value,
    invoice_date.value,
    total_amount.value,
    total_discount.value,
    net_total.value,
    product_name.value,
    quantity.value
  );
}

function addNewInvoice(
  customers_name,
  customers_contact_number,
  invoice_date,
  total_amount,
  total_discount,
  net_total,
  product_name,
  quantity
) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if ((xhttp.readyState = 4 && xhttp.status == 200))
      document.getElementById("invoice_acknowledgement").innerHTML =
        xhttp.responseText;
  };
  xhttp.open(
    "GET",
    `./scripts/newInvoicee.php?action=add_new_invoice&customers_name=${customers_name}&customers_contact_number=${customers_contact_number}&invoice_date=${invoice_date}&total_amount=${total_amount}&total_discount=${total_discount}&net_total=${net_total}&product_name=${product_name}&quantity=${quantity}`,
    true
  );
  xhttp.send();
}
