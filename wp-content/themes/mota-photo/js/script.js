(function ($) {
  $(document).ready(function () {
    var contactModal = document.getElementById("contactModal");
    var btnContact = document.querySelector(".idcontact");
    var contactLink = document.querySelector(".idcontact a");
    let lightboxes = document.querySelectorAll(".wp-lightbox-container");
    let btnFullscreen = document.querySelectorAll(".wp-block-image");
    let btnCloseFullscreen = document.querySelectorAll(".close-button");
    let openLightBoxBtn = document.querySelectorAll(".lightbox-trigger");
    let closeLightBoxBtn = document.querySelector(".lightbox__close");
    var lightboximg = document.getElementById("lightboxes");
    let currentLightboxIndex = 0;
    let btnLoadMore = document.getElementById("load_more");
    let apiUrl = btnLoadMore.getAttribute("data-ajaxurl");
    let lightboximage = document.getElementById("lightboximage");
    let next = document.querySelector(".lightbox__next");
    let previous = document.querySelector(".lightbox__prev");
    let index = 0;
    let eyes = document.getElementById("eye");
    let eye_btn = document.querySelectorAll(".eye-btn");
    let info = document.getElementById("info");
    let cptcontent = document.querySelectorAll("cptcontent-photo");

    // Apparition / fermeture modale contact
    btnContact.onclick = function (e) {
      displayForm();
      e.stopPropagation;
    };

    document.onclick = function (event) {
      if (
        !contactModal.contains(event.target) &&
        contactModal.classList.contains("show") &&
        event.target != contactLink
      ) {
        hideForm();
      }
    };

    function displayForm() {
      if (contactModal.classList.contains("hidden")) {
        contactModal.classList.remove("hidden");
        contactModal.classList.add("show");
      }
    }

    // LIGHTBOX

    function open(i) {
      $.ajax({
        type: "POST",
        url: apiUrl,
        data: {
          action: "lightboxShow",
          index: i,
        },

        success: function (resp) {
          console.log(resp[index]);
          lightboxes = resp;
          index = i;
          setLightboxInfo();
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error("Erreur AJAX: " + textStatus, errorThrown);
          // Gérer l'erreur en conséquence
        },
      });
      lightboximg.classList.remove("lightboxHidden");
      lightboximg.classList.add("lightbox");
      console.log(index);
    }

    function close() {
      lightboximg.classList.remove("lightbox");
      lightboximg.classList.add("lightboxHidden");
    }

    openLightBoxBtn.forEach((e, i) => {
      e.addEventListener("click", function () {
        open(i);
      });
    });

    closeLightBoxBtn.addEventListener("click", function () {
      close();
    });
    function slideNext() {
      if (index == lightboxes.length - 1) {
        index = 0;
      } else {
        index++;
      }
      setLightboxInfo();
    }
    function slidePrevious() {
      if (index == 0) {
        index = lightboxes.length - 1;
      } else {
        index--;
      }
      setLightboxInfo();
    }

    function setLightboxInfo() {
      const imageData = lightboxes[index];
      lightboximage.setAttribute("src", imageData.thumbnail);
      console.log(index);
    }

    next.addEventListener("click", function () {
      slideNext();
    });

    previous.addEventListener("click", function () {
      slidePrevious();
    });

    // apparition eye icone

// function eyeShow () {
//   eyes.classList.toggle("eye-btn-1")
//   eyes.classList.add("eye-btn-2")
// } 

// function eyeHide () {
//   eyes.classList.remove("eye-btn-2")
//   eyes.classList.add("eye-btn-1")
// }

//     cptcontent.forEach(function(element) {
//       element.addEventListener("mouseover", function () {
//         console.log("enter")
//         eyeShow();
//       });

//       element.addEventListener("mouseleave", function () {
//         console.log("leave")
//         eyeHide();
//       });
//     });

    
  });
})(jQuery);
