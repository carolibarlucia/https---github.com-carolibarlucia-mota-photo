var jq = jQuery.noConflict();
// Utilisez jq au lieu de $ à partir de ce point
jq(document).ready(function () {
  let apiUrl = "";
  let btnLoadMore = document.getElementById("load_more");
  if (btnLoadMore) {
    apiUrl = btnLoadMore.getAttribute("data-ajaxurl");
  }

  var contactModal = document.getElementById("contactModal");
  var btnContact = document.querySelectorAll(".idcontact");
  var contactLink = document.querySelector(".idcontact a");
  let lightboxes = document.querySelectorAll(".wp-lightbox-container");
  let btnFullscreen = document.querySelectorAll(".wp-block-image");
  let btnCloseFullscreen = document.querySelectorAll(".close-button");
  let openLightBoxBtn = document.querySelectorAll(".ct-lightbox");
  let closeLightBoxBtn = document.querySelector(".lightbox__close");
  var lightboximg = document.getElementById("lightboxes");
  let currentLightboxIndex = 0;
  let lightboximage = document.getElementById("lightboximage");
  let next = document.querySelector(".lightbox__next");
  let previous = document.querySelector(".lightbox__prev");

  let info = document.getElementById("info");
  let cptcontent = document.querySelectorAll("cptcontent-photo");
  let photoContact = document.querySelector(".btn-contact");
  let contactPhoto = document.getElementById("contactPhoto");
  let single_prev = document.getElementById("single_prev");
  let single_next = document.getElementById("single_next");

  // Apparition / fermeture modale contact
  btnContact.forEach(function (e) {
    e.addEventListener("click", function () {
      console.log("click");
      displayForm();
      e.stopPropagation;
    });
  });

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

  function hideForm() {
    if (contactModal.classList.contains("show")) {
      contactModal.classList.remove("show");
      contactModal.classList.add("hidden");
    }
  }

  // function showContact() {
  //   contactPhoto.classList.remove("hidden");
  //   contactPhoto.classList.add("show");
  // }

  //   photoContact.addEventListener("click", function () {
  //     console.log("click");
  //     showContact()
  //     console.log(showContact)
  //     e.stopPropagation;
  //   });

  // LIGHTBOX

  // Fonction pour initialiser les gestionnaires d'événements de la lightbox
  jq(document).ready(function () {
    // Fonction pour initialiser les gestionnaires d'événements de la lightbox
    function initializeLightbox() {
      // jq(document).on("click", ".lightbox-trigger", function () {
      //     open(jq(this).data("index"));
      // });
      // jq(document).on("click", ".lightbox__close", function () {
      //     close();
      // });
      // jq(document).on("click", ".lightbox__next", function () {
      //     slideNext();
      // });
      // jq(document).on("click", ".lightbox__prev", function () {
      //     slidePrevious();
      // });
      // Ajoutez ici d'autres gestionnaires d'événements pour les actions associées à la lightbox
    }

    // Appeler la fonction pour initialiser les gestionnaires d'événements de la lightbox au chargement de la page
    initializeLightbox();
  });

  function open(i) {
    console.log(lightboxes)
    currentLightboxIndex = i;
    setLightboxInfo();

    return;
    jq.ajax({
      type: "POST",
      url: apiUrl,
      data: {
        action: "lightboxShow",
        index: i,
      },

      success: function (resp) {
        // console.log(resp);
        // console.log(resp[currentLightboxIndex]);
        // lightboximage.setAttribute("src", resp[index].thumbnail);
        // info.innerHTML = resp[index].info;
        lightboxes = resp;
        currentLightboxIndex = i;
        setLightboxInfo();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Erreur AJAX: " + textStatus, errorThrown);
        // Gérer l'erreur en conséquence
      },
    });
    lightboximg.classList.remove("lightboxHidden");
    lightboximg.classList.add("lightbox");
  }

  function close() {
    lightboximg.classList.remove("lightbox");
    lightboximg.classList.add("lightboxHidden");
  }

  openLightBoxBtn.forEach((e, i) => {
    console.log(i)
    e.addEventListener("click", function () {
      open(i);
    });
  });

  if (closeLightBoxBtn) {
    closeLightBoxBtn.addEventListener("click", function () {
      close();
    });
  }

  function slideNext() {
    if (currentLightboxIndex == lightboxes.length - 1) {
      currentLightboxIndex = 0;
    } else {
      currentLightboxIndex++;
    }
    setLightboxInfo();
  }
  function slidePrevious() {
    if (currentLightboxIndex == 0) {
      currentLightboxIndex = lightboxes.length - 1;
    } else {
      currentLightboxIndex--;
    }
    setLightboxInfo();
  }

  function setLightboxInfo() {
    const imageData = lightboxes[currentLightboxIndex];
    console.log(imageData.innerHTML)
    // lightboximage.setAttribute("src", imageData.thumbnail);
    console.log(currentLightboxIndex);
    document.getElementById('photo').innerHTML=imageData.innerHTML
    document.getElementById('lightboxes').classList.remove("lightboxHidden")
  }

  next.addEventListener("click", function () {
    slideNext();
  });

  previous.addEventListener("click", function () {
    slidePrevious();
  });
  // Select the node that will be observed for mutations
  const targetNode = document.querySelector(".main-container");

  // Options for the observer (which mutations to observe)
  const config = { attributes: true, childList: true, subtree: true };

  // Callback function to execute when mutations are observed
  const callback = (mutationList, observer) => {
    for (const mutation of mutationList) {
      if (mutation.type === "childList") {
        lightboxes = document.querySelectorAll(".wp-lightbox-container");
        openLightBoxBtn = document.querySelectorAll(".ct-lightbox");
        closeLightBoxBtn = document.querySelector(".lightbox__close");
        console.log(lightboxes.length);
        openLightBoxBtn.forEach((e, i) => {
          console.log(i)
          e.addEventListener("click", function () {
            open(i);
          });
        });
      } else if (mutation.type === "attributes") {
        console.log(`The ${mutation.attributeName} attribute was modified.`);
      }
    }
  };

  // Create an observer instance linked to the callback function
  const observer = new MutationObserver(callback);

  // Start observing the target node for configured mutations
  observer.observe(targetNode, config);
});
