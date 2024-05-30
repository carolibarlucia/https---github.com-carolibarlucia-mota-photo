document.addEventListener('DOMContentLoaded', function(e){
    let lightbox = document.getElementById("lightbox");
   let photo = document.getElementById("photo-lightbox");
let lightbox_overlay = document.getElementById("lightbox-overlay");
let lightbox_cross = document.getElementById("lightbox-cross");
let lightbox_infos = document.getElementById("lightbox-infos");


//Ouverture de la lightbox
photo.addEventListener("click", function() {
    lightbox.classList.add("active-flex");
    lightbox.classList.remove("inactive");
    lightbox_overlay.classList.add("active");
    lightbox_overlay.classList.remove("inactive");
    lightbox_cross.classList.add("active");
    lightbox_cross.classList.remove("inactive");
    lightbox_infos.classList.add("active-flex");
    lightbox_infos.classList.remove("inactive");
});

//Fermer la lightbox
lightbox_cross.addEventListener("click", function() {
    lightbox.classList.add("inactive");
    lightbox.classList.remove("active-flex");
    lightbox_overlay.classList.add("inactive");
    lightbox_overlay.classList.remove("active");
    lightbox_cross.classList.add("inactive");
    lightbox_cross.classList.remove("active");
    lightbox_infos.classList.add("inactive");
    lightbox_infos.classList.remove("active-flex");
});


//navigation lightbox
    let lightbox_cat = document.getElementById("lightbox-info-cat");
    let lightbox_ref = document.getElementById("lightbox-info-ref");
    let lightbox_img = document.getElementById("lightbox-info-img");

    //fonction clic gauche
    function leftLightbox() {
        //récupération de l'url de l'image en cours
        let url_value = lightbox_img.getAttribute('src');

        //parcours du tableau pour savoir où on se trouve
        for(let i = 0; i< dataPhotos.length; i++){
            if(url_value == dataPhotos[i]['thumbnail']){
                var currentImage = i;
            }
        }

        //affichage selon le cas de figure
        if(currentImage == 0){
            //si on se trouve en début de tableau, on retourne à la fin
            currentImage = dataPhotos.length-1;
            //affichage de la nouvelle image
            lightbox_img.src = dataPhotos[currentImage]['thumbnail'];
            lightbox_cat.innerHTML = dataPhotos[currentImage]['categorie'];
            lightbox_ref.innerHTML = dataPhotos[currentImage]['reference'];
        }else{
            //cas d'affichage normal
            currentImage--;
            //affichage de la nouvelle image
            lightbox_img.src = dataPhotos[currentImage]['thumbnail'];
            lightbox_cat.innerHTML = dataPhotos[currentImage]['categorie'];
            lightbox_ref.innerHTML = dataPhotos[currentImage]['reference'];
        }
    }

    //fonction clic droit
    function rightLightbox() {
        //récupération de l'url de l'image en cours
        let url_value = lightbox_img.getAttribute('src');

        //parcours du tableau pour savoir où on se trouve
        for(let i = 0; i< dataPhotos.length; i++){
            if(url_value == dataPhotos[i]['thumbnail']){
                var currentImage = i;
            }
        }

        //affichage selon le cas de figure
        if(currentImage == dataPhotos.length-1){
            //si on se trouve en bout de tableau, on retourne au début
            currentImage = 0;
            //affichage de la nouvelle image
            lightbox_img.src = dataPhotos[currentImage]['thumbnail'];
            lightbox_cat.innerHTML = dataPhotos[currentImage]['categorie'];
            lightbox_ref.innerHTML = dataPhotos[currentImage]['reference'];
        }else{
            //cas d'affichage normal
            currentImage++;
            //affichage de la nouvelle image
            lightbox_img.src = dataPhotos[currentImage]['thumbnail'];
            lightbox_cat.innerHTML = dataPhotos[currentImage]['categorie'];
            lightbox_ref.innerHTML = dataPhotos[currentImage]['reference'];
        }
    }
});
