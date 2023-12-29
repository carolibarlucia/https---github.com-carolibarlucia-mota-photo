window.addEventListener("DOMContentLoaded", () => {
  var contactModal = document.getElementById("contactModal");
  var btnContact = document.querySelector(".idcontact");
  var contactLink = document.querySelector(".idcontact a");

  btnContact.onclick = function (e) {
   displayForm()
    e.stopPropagation;
  };

  document.onclick = function (event) {
    console.log(event);
    if (!contactModal.contains(event.target) && contactModal.classList.contains("show") && event.target != contactLink) {

     hideForm()
    }
  };
});
 function displayForm() {
if (contactModal.classList.contains("hidden")) {
  contactModal.classList.remove("hidden")
  contactModal.classList.add("show")
}
 }

 function hideForm(){
  if (contactModal.classList.contains("show")) {
    contactModal.classList.remove("show")
    contactModal.classList.add("hidden")
  }
 }