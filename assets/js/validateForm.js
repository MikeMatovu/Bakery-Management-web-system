function notNull(text, error) {
  var result = document.getElementById(error);
  result.style.display = "block";
  if (text < 0) {
    result.innerHTML = "Invalid!";
    return false;
  } else if (text.trim() == "") {
    result.innerHTML = "Must be filled out!";
    return false;
  }
  result.style.display = "none";
  return true;
}
function addProduct() {
  document.getElementById("product_acknowledgement").innerHTML = "";
  var name = document.getElementById("product_name");
  var description = document.getElementById("descriptionn");
  var quantity = document.getElementById("quantity");
  var category = document.getElementById("category");
  var expiryDate = document.getElementById("expiry_date");
  var price = document.getElementById("price");

  if (!notNull(name.value, "product_name_error")) name.focus();
  else if (!notNull(description.value, "description_error"))
    description.focus();
  else if (!notNull(quantity.value, "quantity_error")) quantity.focus();
  //   else if (!notNull(expiryDate.value, "expiry_date_error")) expiryDate.focus();
  else {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if ((xhttp.readyState = 4 && xhttp.status == 200))
        document.getElementById("product_acknowledgement").innerHTML =
          xhttp.responseText;
    };
    xhttp.open(
      "GET",
      `scripts/addProduct.php?name=${name.value}&price=${price.value}&quantity=${quantity.value}&category=${category.value}&description=${description.value}&expiry_date=${expiryDate.value}`,
      true
    );
    xhttp.send();
  }
}
