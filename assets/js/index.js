var isUser = false;

function validate() {
  const email = document.getElementById("typeEmailX");
  const password = document.getElementById("typePasswordX");
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      isUser = xhttp.responseText;
    }
  };
  xhttp.open(
    "GEt",
    "scripts/validateCredentials.php?action=is_user&email=" +
      email.value +
      "&password=" +
      password.value,
    true
  );
  xhttp.send();
  console.log(isUser);
}

function validateCredentials() {
  if (isUser == "true") return true;
  alert("Username or password invalid!");
  return false;
}

function validateAndSetup() {
  var username = document.getElementById("username").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirmPassword").value;
  var adminStatus = 0;
  var isAdmin = document.getElementById("isAdmin");
  if (isAdmin.checked) {
    adminStatus = 1;
  }

  if (password !== confirmPassword) {
    alert("Passwords do not match!");
    return false;
  }
  let confirmed = confirm("Are you sure?");
  if (confirmed) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (xhttp.readyState == 4 && xhttp.status == 200)
        alert(xhttp.responseText);
      // document.getElementById("hello").innerHTML = xhttp.responseText;
    };
    xhttp.open(
      "GET",
      `scripts/validateCredentials.php?action=store_user_info&username=${username}&email=${email}&password=${password}&isAdmin=${adminStatus}`,
      true
    );
    xhttp.send();
    return true;
  }

  return false;
}

function displaySignUp() {
  document.getElementById("sign-up-form").style.display = "block";
  document.getElementById("login-form").style.display = "none";
}
