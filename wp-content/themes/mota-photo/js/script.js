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
  let openLightBoxBtn = document.querySelectorAll(".ct-lightbox");
  let closeLightBoxBtn = document.querySelector(".lightbox__close");
  var lightboximg = document.getElementById("lightboxes");
  let currentLightboxIndex = 0;
  let next = document.querySelector(".lightbox__next");
  let previous = document.querySelector(".lightbox__prev");
  let photoinfo = document.querySelectorAll(".photo-info");
  let prevImage = document.getElementById("prev-thumbnail");
  let nextImage = document.getElementById("next-thumbnail");
  let cross = document.getElementById("cross");
  let burger = document.getElementById("burger");
  let Menu = document.getElementById("header-");

  // SLIDER PAGE SINGLE
  if (prevImage) {
    prevImage.style.display = "none";
  }
  const arrowLeft = document.querySelector(".arrow-left");
  if (arrowLeft) {
    arrowLeft.addEventListener("mouseover", function (e) {
      prevImage.style.display = "block";
    });

    arrowLeft.addEventListener("mouseleave", function (e) {
      prevImage.style.display = "none";
    });
  }

  if (nextImage) {
    nextImage.style.display = "none";
  }
  const arrowRight = document.querySelector(".arrow-right");
  if (arrowRight) {
    arrowRight.addEventListener("mouseover", function (e) {
      nextImage.style.display = "block";
    });

    arrowRight.addEventListener("mouseleave", function (e) {
      nextImage.style.display = "none";
    });
  }

  // Apparition / fermeture modale contact
  btnContact.forEach(function (e) {
    e.addEventListener("click", function (event) {
      clearReferenceField();
      displayForm();
      event.stopPropagation();
    });
  });

  btnContact2.forEach(function (e) {
    e.addEventListener("click", function (event) {
      displayForm();
      showRef();
      event.stopPropagation();
    });
  });

  document.addEventListener("click", function (event) {
    if (
      !contactModal.contains(event.target) &&
      contactModal.classList.contains("show") &&
      !Array.from(btnContact).includes(event.target) &&
      !Array.from(btnContact2).includes(event.target)
    ) {
      hideForm();
    }
  });

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
    const referenceElement = document.getElementById("referenceid");
    const reference = referenceElement.innerHTML;
    document.getElementById("reference-field").innerHTML = reference;
  }

  function clearReferenceField() {
    document.querySelector("#reference-field input").style.display = "none";
  }

  // LIGHTBOX
  function open(i) {
    currentLightboxIndex = i;
    setLightboxInfo();
    lightboximg.classList.remove("lightboxHidden");
    lightboximg.classList.add("lightbox");
  }

  function close() {
    lightboximg.classList.remove("lightbox");
    lightboximg.classList.add("lightboxHidden");
  }

  openLightBoxBtn.forEach((e, i) => {
    e.addEventListener("click", function (event) {
      open(i);
      event.stopPropagation();
    });
  });

  if (closeLightBoxBtn) {
    closeLightBoxBtn.addEventListener("click", function (event) {
      close();
      event.stopPropagation();
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

  next.addEventListener("click", function (event) {
    slideNext();
    event.stopPropagation();
  });

  previous.addEventListener("click", function (event) {
    slidePrevious();
    event.stopPropagation();
  });

  const targetNode = document.querySelector(".main-container");
  const config = { attributes: true, childList: true, subtree: true };
  const callback = (mutationList, observer) => {
    for (const mutation of mutationList) {
      if (mutation.type === "childList") {
        lightboxes = document.querySelectorAll(".wp-block-image");
        openLightBoxBtn = document.querySelectorAll(".ct-lightbox");
        closeLightBoxBtn = document.querySelector(".lightbox__close");
        photoinfo = document.querySelectorAll(".photo-info");
        openLightBoxBtn.forEach((e, i) => {
          e.addEventListener("click", function (event) {
            open(i);
            event.stopPropagation();
          });
        });
      }
    }
  };

  // RESPONSIVE
  burger.addEventListener("click", function () {
    showMenu();
    showCross();
  });

  cross.addEventListener("click", function () {
    hideMenu();
    showBurger()
  });
  function showMenu() {
    Menu.classList.remove("header-")
  }

  function hideMenu() {
    Menu.classList.add("header-")
  }

  function showCross () {
    cross.classList.remove("cross")
    cross.classList.add("cross-show")
    burger.classList.remove("burger")
    burger.classList.add("burger-hide")
  }

  function showBurger() {
    cross.classList.add("cross")
    cross.classList.remove("cross-show")
    burger.classList.add("burger")
    burger.classList.remove("burger-hide")
  }

  const observer = new MutationObserver(callback);
  observer.observe(targetNode, config);
});
