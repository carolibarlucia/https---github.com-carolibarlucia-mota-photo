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
  var btnContact2 = document.querySelectorAll(".idcontact2");
  var contactLink = document.querySelector(".idcontact a p");
  let lightboxes = document.querySelectorAll(".wp-block-image");
  // let btnFullscreen = document.querySelectorAll(".wp-block-image");
  // let btnCloseFullscreen = document.querySelectorAll(".close-button");
  let openLightBoxBtn = document.querySelectorAll(".ct-lightbox");
  let closeLightBoxBtn = document.querySelector(".lightbox__close");
  var lightboximg = document.getElementById("lightboxes");
  let currentLightboxIndex = 0;
  // let lightboximage = document.getElementById("lightboximage");
  let next = document.querySelector(".lightbox__next");
  let previous = document.querySelector(".lightbox__prev");
  // let info = document.getElementById("info");
  let photoinfo = document.querySelectorAll(".photo-info");
  let prevImage = document.getElementById("prev-thumbnail");
  let nextImage = document.getElementById("next-thumbnail");

  // let refPhoto = document.getElementById("ref-photo");
  // let single_prev = document.getElementById("single_prev");
  // let single_next = document.getElementById("single_next");
  // let referenceid = document.getElementById("referenceid");

  if (prevImage) {
    prevImage.style.display = "none";
  }
  document.querySelector(".arrow-left").addEventListener("mouseover", function (e) {
      prevImage.style.display = "block";
    });

  document.querySelector(".arrow-left").addEventListener("mouseleave", function (e) {
      prevImage.style.display = "none";
    });

  if (nextImage) {
    nextImage.style.display = "none";
  }
  document.querySelector(".arrow-right").addEventListener("mouseover", function (e) {
      nextImage.style.display = "block";
    });

  document.querySelector(".arrow-right").addEventListener("mouseleave", function (e) {
      nextImage.style.display = "none";
    });

  // Apparition / fermeture modale contact
  btnContact.forEach(function (e) {
    e.addEventListener("click", function (e) {
      displayForm();
      e.stopPropagation();
    });
  });

  btnContact2.forEach(function (e) {
    e.addEventListener("click", function (e) {
      displayForm();
      showRef();
      e.stopPropagation();
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

  function showRef() {
    // Trouver l'élément qui contient la référence de la photo
    const referenceElement = document.getElementById("referenceid");

    // Récupérer la référence à partir de cet élément
    const reference = referenceElement.innerHTML;

    // Mettre à jour le champ dans le formulaire de contact
    document.getElementById("reference-field").innerHTML = reference;
  }

  // LIGHTBOX

  // Fonction pour initialiser les gestionnaires d'événements de la lightbox
  jq(document).ready(function () {
    // Fonction pour initialiser les gestionnaires d'événements de la lightbox
    function initializeLightbox() {}
    // Appeler la fonction pour initialiser les gestionnaires d'événements de la lightbox au chargement de la page
    initializeLightbox();
  });

  function open(i) {
    console.log(lightboxes);
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
    console.log(i);
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
    document.getElementById("photo").innerHTML = imageData.innerHTML;
    document.getElementById("lightboxes").classList.remove("lightboxHidden");
    document.getElementById("lightboxes").classList.remove("cptcontent");
    document.getElementById("lightboxes").classList.add("lightbox");
    const reference =
      photoinfo[currentLightboxIndex].querySelector(".reference");
    document.getElementById("reference").innerHTML = reference.innerHTML;
    const categorie =
      photoinfo[currentLightboxIndex].querySelector(".categorie");
    document.getElementById("category").innerHTML = categorie.innerHTML;
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
        lightboxes = document.querySelectorAll(".wp-block-image");
        openLightBoxBtn = document.querySelectorAll(".ct-lightbox");
        closeLightBoxBtn = document.querySelector(".lightbox__close");
        photoinfo = document.querySelectorAll(".photo-info");
        console.log(lightboxes.length);
        openLightBoxBtn.forEach((e, i) => {
          console.log(i);
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
