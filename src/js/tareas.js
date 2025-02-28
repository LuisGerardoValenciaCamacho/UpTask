(function() {
    const path = window.location.href;
    const url = path.split("=")[1]; 
    const boton = document.querySelector("#agregar-tarea")
    boton.addEventListener("click", mostrarFormulario);

    function mostrarFormulario() { 
        const modal = document.createElement("DIV");
        modal.classList.add("modal");
        modal.innerHTML = `
            <section class="formulario-tarea">
                <form class="contenedor-sm formulario">
                    <div class="center" id="leyenda">
                        <legend class="nueva-tarea">Añade una nueva tarea</legend>
                    </div>
                    <div class="campo">
                        <label for="nombre">Tarea:</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Añadir Tarea a Tu Proyecto">
                    </div>
                    <div class="botones-modal">
                        <section>
                            <input type="hidden" value="${url}" name="url">
                            <button type="button" class="btn-indigo" id="btn-crear">Añadir Tarea</button>
                        </section>
                        <section>
                            <button type="button" class="btn-naranja" id="btn-cancelar">Cancelar</button>
                        </section>
                    </div>
                </form>
            </section>
        `;
        setTimeout(() => {
            const formulario = document.querySelector(".formulario-tarea")
            formulario.classList.add("animar");
            const botonCancelar = document.querySelector("#btn-cancelar");
            botonCancelar.addEventListener("click", () => {
                window.location.reload();
            });
            const botonCrear = document.querySelector("#btn-crear");
            botonCrear.addEventListener("click", nuevaTarea);
        }, 400);
        document.querySelector(".dashboard").appendChild(modal);
    }

    function nuevaTarea() {
        const tarea = document.querySelector("#nombre").value.trim();
        if(tarea == "") {
            mostrarAlerta("Nombre Vacio", "error", document.querySelector("#leyenda"));
            return;
        } else {
            agregarTarea(tarea);
        }
    }

    function mostrarAlerta(mensaje, tipo, referencia) {
        const alertaPrevia = document.querySelector(".alerta");
        if(alertaPrevia) {
            alertaPrevia.remove();
        }
        const alerta = document.createElement("DIV");
        alerta.classList.add("alerta", tipo);
        alerta.textContent = mensaje;
        referencia.appendChild(alerta);
        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }

    async function agregarTarea(tarea) {
        const datos = new FormData();
        datos.append("nombre", tarea);
        datos.append("url", window.location.href.split("=")[1]);
        //datos.append("url", "12345");
        try {
            const respuesta = await fetch("http://localhost:3000/api/tarea", {
                method: "POST",
                body: datos
            });
            const resultado = await respuesta.json();
            mostrarAlerta(resultado["mensaje"], resultado["tipo"], document.querySelector("#leyenda"));
            if(resultado["tipo"] == "correcto") {
                const modal = document.querySelector(".modal");
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            }
        } catch (error) {
            console.warn(error);
        }
    }
})();
