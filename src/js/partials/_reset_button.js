export function setReset() {
    let btn_reset = document.getElementById("btn-reset"); //Le bouton de reset de la selection
    let check = document.querySelectorAll(".dropdown-menu input"); //Tous les inputs des dropdowns de tri
    
    
    btn_reset.addEventListener("click", () => {
        event.preventDefault(); //Eviter le rechargement de la page quand on clique sur Reset
    
        //Enelève le check de tous les inputs
        check.forEach( function(elem) {
            elem.removeAttribute("checked");
        })
    })
}