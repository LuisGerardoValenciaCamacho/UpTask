<div class="barra">
    <p>Hola: <span><?php echo $_SESSION["nombre"]; ?></span></p>
    <div>
        <form method="GET" action="/logout">
            <input type="submit" value="Cerrar Sesión" class="btn-indigo-darken">
        </form>
    </div>
</div>