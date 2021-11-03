document.addEventListener("DOMContentLoaded", init);

function init(){
    document.getElementById("szerkesztes").addEventListener("click", szerkesztes)
}

function szerkesztes(e){
    if (
        document.getElementById("nev").value.trim() == "" ||
        document.getElementById("gyarto").value.trim() == "" ||
        document.getElementById("kepfrissites").value.trim() == "" ||
        document.getElementById("ar").value.trim() == "" 
    )
    e.preventDefault();
}