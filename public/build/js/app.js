function mostrarSidebar(){let e,c;switch(window.location.pathname){case"/uptask":e=document.querySelector("#uptask"),c=1;break;case"/crear-proyecto":e=document.querySelector("#crear-proyecto"),c=2;break;case"/perfil":e=document.querySelector("#perfil"),c=3}cambiarSeleccionado(c),e.classList.add("seleccionado")}function cambiarSeleccionado(e){const c=document.querySelector("#uptask"),o=document.querySelector("#crear-proyecto"),a=document.querySelector("#perfil");switch(e){case 1:o.classList.remove("seleccionado"),a.classList.remove("seleccionado");break;case 2:c.classList.remove("seleccionado"),a.classList.remove("seleccionado");break;case 3:c.classList.remove("seleccionado"),o.classList.remove("seleccionado")}}mostrarSidebar();
//# sourceMappingURL=app.js.map
