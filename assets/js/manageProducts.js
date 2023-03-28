function deleteProduct(id) {
  var confirmation = confirm("Are you sure?");
  if (confirmation) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if ((xhttp.readyState = 4 && xhttp.status == 200))
        document.getElementById("products_div").innerHTML = xhttp.responseText;
    };
    xhttp.open(
      "GET",
      "scripts/manageProducts.php?action=delete&id=" + id,
      true
    );
    xhttp.send();
  }
}

function editProduct(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if ((xhttp.readyState = 4 && xhttp.status == 200))
      document.getElementById("products_div").innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "scripts/manageProducts.php?action=edit&id=" + id, true);
  xhttp.send();
}

function updateProducts(id) {
  var name = document.getElementById("product_name");
  var description = document.getElementById("description");
  var quantity = document.getElementById("quantity");
  var category = document.getElementById("categoryId");
  var expiryDate = document.getElementById("expiryDate");
  var price = document.getElementById("price");

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if ((xhttp.readyState = 4 && xhttp.status == 200))
      document.getElementById("products_div").innerHTML = xhttp.responseText;
  };
  xhttp.open(
    "GET",
    `scripts/manageProducts.php?action=update&id=${id}&name=${name.value}&price=${price.value}&quantity=${quantity.value}&categoryId=${category.value}&description=${description.value}&expiryDate=${expiryDate.value}`,
    true
  );
  xhttp.send();
}

function cancel() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if ((xhttp.readyState = 4 && xhttp.status == 200))
      document.getElementById("products_div").innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "scripts/manageProducts.php?action=cancel", true);
  xhttp.send();
}

function searchUpdatedProducts(text) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if ((xhttp.readyState = 4 && xhttp.status == 200))
      document.getElementById("products_div").innerHTML = xhttp.responseText;
  };
  xhttp.open(
    "GET",
    "scripts/manageProducts.php?action=searchUpdate&text=" + text,
    true
  );
  xhttp.send();
}

function searchProducts(text) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if ((xhttp.readyState = 4 && xhttp.status == 200))
      document.getElementById("products_div").innerHTML = xhttp.responseText;
  };
  xhttp.open(
    "GET",
    "scripts/manageProducts.php?action=search&text=" + text,
    true
  );
  xhttp.send();
}
