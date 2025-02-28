(function() {
    mostrarSidebar();
})();

function mostrarSidebar() {
    const path = window.location.pathname;
    let selecccionado;
    let query;
    switch(path) {
        case "/uptask":
            selecccionado = document.querySelector("#uptask");
            query = 1;
            break;
        case "/crear-proyecto":
            selecccionado = document.querySelector("#crear-proyecto");
            query = 2;
            break;
        case "/perfil":
            selecccionado = document.querySelector("#perfil");
            query = 3;
            break;
        default:
            break;
    }
    cambiarSeleccionado(query);
    selecccionado.classList.add("seleccionado");
}

function cambiarSeleccionado(query) {
    const uptask = document.querySelector("#uptask");
    const crear = document.querySelector("#crear-proyecto");
    const perfil = document.querySelector("#perfil");
    switch(query) {
        case 1:
            crear.classList.remove("seleccionado");
            perfil.classList.remove("seleccionado");
            break;
        case 2:
            uptask.classList.remove("seleccionado");
            perfil.classList.remove("seleccionado");
            break;
        case 3:
            uptask.classList.remove("seleccionado");
            crear.classList.remove("seleccionado");
            break;
    }
}