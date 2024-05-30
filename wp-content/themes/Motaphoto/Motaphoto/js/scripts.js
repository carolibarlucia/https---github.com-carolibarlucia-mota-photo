let popupContact = document.getElementsByClassName('menu-item-9');
let modale = document.getElementById('modale');
let overlay = document.getElementById('overlay');
let placement = document.getElementById('placement');

popupContact[0].addEventListener('click', () => {
    overlay.classList.add('active');
    overlay.classList.remove('inactive');
    modale.classList.remove('inactive');
    modale.classList.add('active');
    placement.classList.remove('inactive');
    placement.classList.add('active');
});

popupContact[1].addEventListener('click', () => {
    overlay.classList.add('active');
    overlay.classList.remove('inactive');
    modale.classList.remove('inactive');
    modale.classList.add('active');
    placement.classList.remove('inactive');
    placement.classList.add('active');
});

overlay.addEventListener('click', () => {
    overlay.classList.remove('active');
    overlay.classList.add('inactive');
    modale.classList.remove('active');
    modale.classList.add('inactive');
    placement.classList.remove('active');
    placement.classList.add('inactive');
});


// --- Bouton contact dans la fiche des photos---

let popupContactFiche = document.getElementsByClassName('bouton-contact');

popupContactFiche[0].addEventListener('click', () => {
  overlay.classList.add('active');
  overlay.classList.remove('inactive');
  modale.classList.remove('inactive');
  modale.classList.add('active');
  placement.classList.remove('inactive');
  placement.classList.add('active');
});


//remplissage du formulaire avec la référence

  var champSaisie = document.getElementsByClassName('nf-ref');

  function passerRef(arg){
    champSaisie[0].value = arg;
  }