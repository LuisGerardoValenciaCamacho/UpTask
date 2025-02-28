(function() {
    let tareasObj = [];
    const boton = document.querySelector("#agregar-tarea")
    boton.addEventListener("click", mostrarFormulario);
    mostrarFiltros();
    obtenerTareas();
    
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
                        <input type="text" id="nombre" name="nombre" placeholder="Tarea de Tu Proyecto">
                    </div>
                    <div class="botones-modal">
                        <section>
                            <input type="hidden" value="${window.location.href.split("=")[1]}" name="url">
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
        if(document.querySelector("#btn-crear").textContent == "Actualizar") {
            datos.append("id", document.querySelector("#tareaEditar").value);
        }
        //datos.append("url", "12345");
        try {
            const respuesta = await fetch("http://localhost:3000/api/tarea", {
                method: "POST",
                body: datos
            });
            const resultado = await respuesta.json();
            mostrarAlerta(resultado["mensaje"], resultado["tipo"], document.querySelector("#leyenda"));
            if(resultado["tipo"] == "correcto") {
                if(document.querySelector("#btn-crear").textContent == "Actualizar") {
                    tareasObj.forEach(element => {
                        if(element.id == resultado["id"]) {
                            element.nombre = tarea;
                        }
                    })
                } else {
                    const newTarea = {
                        id: String(resultado.id),
                        nombre: tarea,
                        estado: "0",
                        id_proyecto: resultado.id_proyecto
                    };
                    tareasObj = [...tareasObj, newTarea];
                }
                mostrarTareas();
                setTimeout(() => {
                    document.querySelector(".modal").remove();
                }, 3000);
            }
        } catch (error) {
            console.error(error);
        }
    }
    
    function mostrarFiltros() {
        const todas = document.querySelector("#todas");
        const completadas = document.querySelector("#completadas");
        const pendientes = document.querySelector("#pendientes");
        todas.addEventListener("click", () => {
            obtenerTareas();
        });
        completadas.addEventListener("click", () => {
            obtenerTareas();
        });
        pendientes.addEventListener("click", () => {
            obtenerTareas();
        });
    }

    async function obtenerTareas() {
        try {
            const datos = new FormData();
        datos.append("url", window.location.href.split("=")[1])
        const resultado = await fetch("http://localhost:3000/api/todas", {
            "method": "POST",
            "body": datos
        });
        const tareas = await resultado.json();
        tareasObj = tareas.tareas;
        mostrarTareas();
        } catch (error) {
            console.error(error);
        }
    }
    
    function mostrarTareas() {
        const padre = document.querySelector("#padre");
        if(padre.lastElementChild.classList.contains("mostrar")) {
            document.querySelector(".mostrar").remove();
        }
        const div = document.createElement("DIV");
        div.classList.add("mostrar");
        div.classList.add("contenedor-sm");
        padre.appendChild(div);
        noTareas(tareasObj, div);
        tareasObj.forEach(element => {
            if(document.querySelector("#completadas").checked) {
                if(element.estado == 1) {
                    crearTarea(element, div);
                }
            } else if(document.querySelector("#pendientes").checked) {
                if(element.estado == 0) {
                    crearTarea(element, div);
                }
            } else {
                crearTarea(element, div);
            }
        });
    }
    
    function crearTarea(element, div) {
        const estilo = element.estado == 0 ? "naranja" : "verde";
        const texto = element.estado == 0 ? "Pendiente" : "Completada";
        const divSeparador = document.createElement("DIV");
        divSeparador.classList.add("mostrar-campo");

        const p = document.createElement("P");
        p.textContent = element.nombre;
        p.value = element.id;
        p.id = `p-${element.id}`;
        p.addEventListener("dblclick", editarTarea);
        divSeparador.appendChild(p);

        const divBotones = document.createElement("DIV");
        divBotones.classList.add("mostrar-campo-botones");

        const section = document.createElement("SECTION");

        const btnEstado = document.createElement("BUTTON");
        btnEstado.textContent = texto;
        btnEstado.classList.add(`btn-${estilo}`);
        btnEstado.value = element.id;
        btnEstado.id = `btn-estado-${element.id}`;
        section.appendChild(btnEstado);
        btnEstado.addEventListener("dblclick", cambiarEstado);
        
        divBotones.appendChild(section);

        const sectionEliminar = document.createElement("SECTION");

        const btnEliminar = document.createElement("BUTTON");
        btnEliminar.textContent = "Eliminar";
        btnEliminar.classList.add(`btn-rojo`);
        btnEliminar.id = `btn-eliminar-${element.id}`;
        btnEliminar.value = element.id;
        
        sectionEliminar.appendChild(btnEliminar);
        btnEliminar.addEventListener("click", mostrarEliminar);

        divBotones.appendChild(sectionEliminar);

        divSeparador.appendChild(divBotones);

        div.appendChild(divSeparador);
    }

    function mostrarEliminar(e) {
        Swal.fire({
            title: 'Estas seguro de eliminar la tarea?',
            showDenyButton: true,
            confirmButtonText: 'Si',
            denyButtonText: `No`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              Swal.fire('Tarea eliminada!', '', 'success')
              eliminarTarea(e);
            } else if (result.isDenied) {
              
            }
          })
    }

    async function eliminarTarea(e) {
        const btn = document.querySelector(`#${e.srcElement.id}`);
        const datos = new FormData();
        datos.append("id", btn.value);
        const respuesta = await fetch("http://localhost:3000/api/eliminar", {
            "method": "POST",
            "body": datos
        });
        const resultado = respuesta.json();
        let contador = 0;
        let posicion = 0;
        tareasObj.forEach(element => {
            contador++;
            if(element.id == resultado.id) {
                posicion = contador;
            }
        })
        tareasObj.splice(posicion, 1);
        obtenerTareas()
    }
    
    function editarTarea(e) {
        const p = document.querySelector(`#p-${e.toElement.value}`);
        mostrarFormulario();
        const legend = document.querySelector(".nueva-tarea");
        legend.textContent = "Actualizar Tarea";
        const btn = document.querySelector("#btn-crear");
        btn.textContent = "Actualizar"
        const input = document.querySelector("#nombre");
        input.value = p.textContent;
        const div = document.querySelector(".botones-modal");
        const inputId = document.createElement("INPUT");
        inputId.setAttribute("type", "hidden");
        inputId.setAttribute("value", e.toElement.value);
        inputId.setAttribute("name", "id");
        inputId.setAttribute("id", "tareaEditar");
        div.appendChild(inputId);
    }
    
    function cambiarEstado(e) {
        const botonEstado = document.querySelector(`#btn-estado-${e.toElement.value}`);
        if(botonEstado.classList.contains("btn-naranja")) {
            botonEstado.classList.remove("btn-naranja");
            botonEstado.classList.add("btn-verde");
            botonEstado.textContent = "Completada"
            setEstado(0, e.toElement.value);
        } else {
            botonEstado.classList.add("btn-naranja");
            botonEstado.classList.remove("btn-verde");
            botonEstado.textContent = "Pendiente"
            setEstado(1, e.toElement.value);
        }
    }
    
    async function setEstado(estado, id) {
        const datos = new FormData();
        datos.append("id", id)
        datos.append("estado", estado)
        const resultado = await fetch("http://localhost:3000/api/estados", {
            "method": "POST",
            "body": datos
        });
        const respuesta = await resultado.json();
        Swal.fire(
            'Exito!!',
            respuesta.mensaje,
            respuesta.tipo
          )
        obtenerTareas();
    }
    
    function noTareas(tareas, div) {
        if(tareas.length == 0) {
            const p = document.createElement("P");
            p.textContent = "No Hay Tareas";
            p.classList.add("no-tareas");
            div.appendChild(p);
        }
    }
})();