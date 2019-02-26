export function setModal() {
    let btn_ajout = document.getElementById("bouton_ajout");
    let btn_close = document.getElementById("close-button")
    let modal = document.getElementById("modal");
    let black_div = document.getElementById("black-div");

    
    btn_ajout.addEventListener("click", () => {
        modal.classList.remove("d-none");
        black_div.classList.remove("d-none");
    })

    btn_close.addEventListener("click", () => {
        modal.classList.add("d-none");
        black_div.classList.add("d-none");
    })
}