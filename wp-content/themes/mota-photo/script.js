window.addEventListener("DOMContentLoaded", () => {
  var contactModal = document.getElementById("contactModal");
  var btnContact = document.getElementById("contact");
  btnContact.onclick = function () {
    contactModal.style.display = "block";
  };

  window.onclick = function (event) {
    if (event.target == contactModal) {
      contactModal.style.display = "none";
    }
  };
});
