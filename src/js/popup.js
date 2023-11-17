document.addEventListener("DOMContentLoaded", function () {
  print('%');
});

function openPopup(countryId, token) {
  // Make an HTTP request to a PHP script passing the countryId
  fetch("src/pages/getCountryInfo.php?id=" + countryId + "&token=" + token)
    .then((response) => response.text())
    .then((data) => {
      document.getElementById("popupContent").innerHTML = data;
      document.getElementById("popup").classList.remove("hidden");
    })
    .catch((error) => console.error("Error:", error));
}

function closePopup() {
  document.getElementById("popup").classList.add("hidden");
}

window.onclick = function (event) {
  var popup = document.getElementById("popup");
  if (event.target == popup) {
    popup.classList.add("hidden");
  }
};

function print(pattern) {
  fetch("getContent.php?pattern=" + pattern)
    .then((response) => response.text())
    .then((data) => {
      document.getElementById("gridContent").innerHTML = data;
    })
    .catch((error) => console.error("Error:", error));
}
