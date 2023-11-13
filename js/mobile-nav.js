function toggleMenu() {
  var navList = document.getElementById("navList");
  if (navList.className === "responsive") {
    navList.className = ""; // Remove the responsive class
  } else {
    navList.className = "responsive"; // Add the responsive class
  }
}
