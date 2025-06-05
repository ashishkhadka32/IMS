document.addEventListener("DOMContentLoaded", function () {
  const alertBox = document.getElementById("alert-box");
  if (alertBox) {
    setTimeout(function () {
      alertBox.style.opacity = "0";
      setTimeout(() => alertBox.remove(), 500);
    }, 3000);
  }
});