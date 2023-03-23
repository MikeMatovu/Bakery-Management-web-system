var pid = "none";
function showhide(id) {
  var elements = document.getElementById(id).childNodes;
  var menu = elements[3];
  var arrow = elements[1].childNodes[4].childNodes[1];
  if (menu.style.display == "block") {
    menu.style.display = "none";
    arrow.style.transform = "rotate(0deg)";
    elements[1].style.color = "#eeeeee";
  } else {
    menu.style.display = "block";
    arrow.style.transform = "rotate(270deg)";
    elements[1].style.color = "#ff5252";
  }
  if (pid == id) pid = "none";
  if (pid != "none") {
    elements = document.getElementById(pid).childNodes;
    menu = document.getElementById(pid).childNodes[3];
    arrow = elements[1].childNodes[4].childNodes[1];
    if (menu.style.display == "block") {
      menu.style.display = "none";
      arrow.style.transform = "rotate(0deg)";
      elements[1].style.color = "#eeeeee";
    }
  }
  pid = id;
}

function showOptions() {
  var flag = document.getElementById("options");
  if (flag.style.display == "block") {
    flag.style.display = "none";
    document.getElementById("mark").style.display = "none";
  } else {
    flag.style.display = "block";
    document.getElementById("mark").style.display = "block";
  }
}
