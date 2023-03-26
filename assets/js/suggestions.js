function showSuggestions(text, action) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState == 4 && xhttp.status == 200)
      document.getElementById(action + "_suggestions").innerHTML =
        xhttp.responseText;
  };
  xhttp.open(
    "GET",
    "assets/php/suggestions.php?action=" + action + "&text=" + text,
    true
  );
  xhttp.send();
}

function clearSuggestions(id) {
  var div = document.getElementById(id + "_suggestions");
  if (div) div.innerHTML = "";
}

function suggestionClick(value, id) {
  document.getElementById(id).value = value;
  //   if (id == "category") {
  //     fillCustomerDetails(value);
  //   }
  clearSuggestions(id);
  notNull(value, id + "_name_error");
}

document.addEventListener("click", (evt) => {
  const dn1 = document.getElementById("category_suggestions");
  const dn2 = document.getElementById("suppliers_name");
  const dn3 = document.getElementById("customer_suggestions");
  const dn4 = document.getElementById("customers_name");
  let te = evt.target;
  do {
    if (te == dn1 || te == dn2 || te == dn3 || te == dn4) return;
    te = te.parentNode;
  } while (te);
  clearSuggestions("supplier");
  clearSuggestions("customer");
});
